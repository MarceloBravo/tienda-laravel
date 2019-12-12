<?php
//VENTA CON WEBPAY

namespace App\Http\Controllers;

use Redirect;
use Freshwork\Transbank\WebpayNormal;
use Freshwork\Transbank\RedirectorHelper;
use Freshwork\Transbank\WebpayPatPass;
use App\Orden;
use App\OrdenItem;
use App\OrdenWebPay;
use App\Estado;
use DB;

class CheckoutController extends Controller
{
	use \App\Http\Traits\CarritoTrait;
	
	private $shipping = 100;
	private static $codigoCompra;
	private static $ordenId;
	private static $tokenWebPay;

    public function initTransaction(WebpayNormal $webpayNormal)
	{
        if(count(\Session::get('carrito')) == 0){ return Redirect::to('/pago-error')->with('error','El carrito está vacio');}
		$monto = $this->total();
		$codigoCompra = 'order-' . rand(1000, 9999);
		$webpayNormal->addTransactionDetail(1000, $codigoCompra);  
		$response = $webpayNormal->initTransaction(route('checkout.webpay.response'), route('checkout.webpay.finish')); 		
		// Probablemente también quieras crear una orden o transacción en tu base de datos y guardar el token ahí.
		session(['orden_id' => $this->grabarPedido($response)]);
		if(!session('orden_id'))
		{
			Redirect::to('/pago-error')->with('message','Error al registrar la orden.');
		}		
		session(['tokenWebPay' => $response->token]);
        
	    return RedirectorHelper::redirectHTML($response->url, $response->token);
	}


	public function response(WebpayPatPass $webpayPatPass)  
	{          
		$result = $webpayPatPass->getTransactionResult();
		session(['response' => $result]);
		// dd($result, $result->cardDetail, $result->detailOutput->authorizationCode);
		// Revisar si la transacción fue exitosa ($result->detailOutput->responseCode === 0) o fallida para guardar ese resultado en tu base de datos. 
		if($result->detailOutput->responseCode === 0)
		{
			//La transacción fue exitosa
			  $this->registroWebPay($result);
			  
	  	}else{
			//La transacción fue fallida
			return Redirect::to('/pago-error')->with('message','La transacción fue fallida. La compra no pudo llevarse a cavo. Intentalo nuevamente mas tarde.');
		}
		  
		return RedirectorHelper::redirectBackNormal($result->urlRedirection);
	}


	public function finish()
	{
        if(session('response') == null || !isset($_POST['TBK_TOKEN']))
        {
            return Redirect::to('/pago-error')->with('message','No se ha efectuado la transacción, la compra ha sido cancelada.');
        }else{
			// Acá buscar la transacción en tu base de datos y ver si fue exitosa o fallida, para mostrar el mensaje de gracias o de error según corresponda
			//dd($_POST, session('response'));
			if($this->verificarTransaccion($_POST['TBK_TOKEN']))
			{
				return Redirect::to('/pago-ok')->with('message', 'La transacción ha sido exitosa');
			}else{
				return Redirect::to('/pago-error')->with('message','La compra no pudo llevarse a cabo. Ocurrió un error al intentar efectuar la transacción.');
			}
            
        }
	}


	private function grabarPedido($responseWebPay)
	{
		$carrito = \Session::get('carrito');

		try{
			DB::beginTransaction();
			$estado = Estado::where('estado_inicial','=', true)->first();
			if(!isset($estado->id))
			{
				throw new Exception("No se encuentra configurado el estado inicial para las ventas. La transacción no puyede completarse.");
			}
			$orden = new Orden();
			$orden->subtotal = $this->total();
			$orden->shiping = $this->shipping;
			$orden->user_id = \Auth::user()->id;
			$orden->estado_id = $estado->id;
			$orden->save();

			foreach($carrito as $item)
			{
				$ordenItem = new OrdenItem();
				$ordenItem->cantidad = $item->cantidad;
				$ordenItem->orden_id = $orden->id;
				$ordenItem->producto_id = $item->cantidad;
				$ordenItem->precio = $item->precio;				

				$ordenItem->save();
			}
			DB::commit();
			$resp = $orden->id;
		}catch(Exception $ex){
			DB::callback();
			dd($ex);
			$resp = false;
		}

		return $resp;		
	}


	private function registroWebPay($webPay)
	{


		try{
			//dd(session('orden_id'), session('tokenWebPay'), $webPay);
			$ordenWebPay = new OrdenWebPay();
			$ordenWebPay->orden_id = session('orden_id');
			$ordenWebPay->accountingDate = $webPay->accountingDate;
			$ordenWebPay->buyOrder = $webPay->buyOrder;
			$ordenWebPay->cardNumber = $webPay->cardDetail->cardNumber;
			$ordenWebPay->cardExpirationDate = $webPay->cardDetail->cardExpirationDate;
			$ordenWebPay->authorizationCode = $webPay->detailOutput->authorizationCode;
			$ordenWebPay->paymentTypeCode = $webPay->detailOutput->paymentTypeCode;
			$ordenWebPay->responseCode = $webPay->detailOutput->responseCode; 
			$ordenWebPay->sharesNumber = $webPay->detailOutput->sharesNumber;
			$ordenWebPay->amount = $webPay->detailOutput->amount;
			$ordenWebPay->commerceCode = $webPay->detailOutput->commerceCode;
			$ordenWebPay->transactionDate = $webPay->transactionDate;
			$ordenWebPay->VCI = $webPay->VCI;
			$ordenWebPay->token = session('tokenWebPay');
			$ordenWebPay->save();

			return true;
		}catch(Exception $ex){
			return false;
		}
	}

	private function verificarTransaccion($token)
	{
		$ts = OrdenWebPay::where('token','=',$token)->first();
		return $ts != null;
	}
}
