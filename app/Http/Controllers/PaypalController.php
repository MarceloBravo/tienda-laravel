<?php
//VENTA CON PAYPAL

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesCommands;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequest;
use Illuminate\Http\Request;

use PayPal\Rest\ApiContext;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\RedirectUrls;
use PayPal\Api\ExecutePayment;
use PayPal\Api\PaymentExecution;
use PayPal\Api\Transaction;
use Redirect;
use App\Estado;
use App\Orden;
use App\OrdenItem;
use App\Producto;
use App\Mail;

class PaypalController extends Controller
{
    use \App\Http\traits\CarritoTrait;

    private $_api_context;
    private $shipping = 100;
    
    public function __construct()
    {
        $paypalConf = \Config::get('paypal');
        $this->_api_context = new \PayPal\Rest\ApiContext(new \PayPal\Auth\OAuthTokenCredential($paypalConf['client_id'], $paypalConf['secret']));
        $this->_api_context->setConfig($paypalConf['settings']);
    }

    public function postPayment()
    {
        $dolar = $this->consultarDolar();
        $gastosDeEnvio = $this->gastosDeEnvio($dolar);

        $payer = new Payer();
        $payer->setPaymentMethod('paypal');

        $items = array();
        $subTotal = 0;
        $carrito = \Session::get('carrito');
        $currency = 'USD';

        foreach ($carrito as $producto) {
            $item = new Item();
            $item->setName($producto->nombre)
                ->setCurrency($currency)
                ->setDescription($producto->descripcion)
                ->setQuantity($producto->cantidad)
                ->setPrice(intval($producto->precio/$dolar));

                $items[] = $item;
                $subTotal += intval($producto->precio/$dolar) * $producto->cantidad;
        }

        $itemList = new ItemList();
        $itemList->setItems($items);

        $details = new Details();
        $details->setSubTotal($subTotal)
            ->setShipping($gastosDeEnvio);

        $total = $subTotal + $gastosDeEnvio;

        $amount = new Amount();
        $amount->setCurrency($currency)
            ->setTotal($total)
            ->setDetails($details);
            
        $transaction = new Transaction();
        $transaction->setAmount($amount)
            ->setItemList($itemList)
            ->setDescription('Compra desde tienda tiendaLrv');

        $redirectUrls = new RedirectUrls();
        $redirectUrls->setReturnUrl(\URL::route('payment.status'))
                ->setCancelUrl(\URL::route('payment.status'));

        $payment = new Payment();
        $payment->setIntent('Sale')
                ->setPayer($payer)
                ->setRedirectUrls($redirectUrls)
                ->setTransactions(array($transaction));

        try{
            $payment->create($this->_api_context);
        } catch (\PayPal\Exception\PayPalConnectionException $ex) {
            if(\Config::get('app.debug'))
            {
                dd($ex->getData(), $ex->getMessage(), $payment);
                echo 'Error '.$ex->getMessage().'PHP_EOL';
                $errData = json_decode($ex->getData(), true);
            }else{
                die('Ups!, Algo salió mal');
            }
        }

        $redirectTo = "";
        foreach ($payment->getLinks() as $link) {
            if($link->getRel() == 'approval_url')
            {
                $redirectTo = $link->getHref();
                break;
            }
        }

        \Session::put('paypal_payment_id', $payment->getId());

        if(isset($redirectTo))
        {
            //Redirect to Paypal
            return \Redirect::away($redirectTo);
        }
            

        return \Redirect::route('/carrito')
            ->with('error', 'Ups! Error desconocido');
    }


    public function getPaymentStatus(Request $request)
    {
        $paymentId = \Session::get('paypal_payment_id');        

        \Session::forget('paypal_payment_id');

        $payerId = $request['PayerID'];
        $token = $request['token'];

        if(empty($payerId) || empty($token))
        {
            return Redirect::to('/pago-error')->with('message', 'Ocurrió un problema al intentar pagar con Paypal.');
        }

        $payment = Payment::get($paymentId, $this->_api_context);

        $execution = new PaymentExecution();
        $execution->setPayerId($payerId);

        try{
            $result = $payment->execute($execution, $this->_api_context);
        } catch (\PayPal\Exception\PayPalConnectionException $ex) {
            return Redirect::to('/pago-error')->with('message', 'Ocurrió un problema al intentar finalizar la transacción.<br/>Código del error: '.$ex->getCode());
            //dd($ex->getCode(), $ex->getData(), $ex);
        }catch(PayPalConnectionException $e){
            return Redirect::to('/pago-error')->with('message', 'Ocurrió un problema al intentar finalizar la transacción.<br/>Código del error: '.$ex->getCode());
            //dd($ex->getCode(), $ex->getData(), $ex);
        } catch (\Exception $ex) {
            //dd($ex);
            return Redirect::to('/pago-error')->with('message', 'Ocurrió un problema al intentar finalizar la transacción.<br/>Código del error: '.$ex->getCode());
        }

        if($result->getState() == 'approved')
        {
            $carrito = \Session::get('carrito');
            $dolar = $this->consultarDolar();
            $total = $this->gastosDeEnvio($dolar) + $this->total();
            $this->registrarOrden($carrito);
            return view('pages.pago-ok', compact('carrito','total') )->with('message','La compra fue realizada con exito.');
        }

        return view('pages.pago-error')->with('message','La compra fue cancelada.');

    }

    
    private function gastosDeEnvio($dolar)
    {
        return $this->shipping / $dolar;
    }


    private function consultarDolar()
    {
        try
        {
            return $this->getUSD();
        }catch(Exception $ex){
            return Redirect::to('/')->with('error','No se pudo obtener el valor del dolar.');       
        }

    }


    public function getUSD()
    {
        // Get cURL resource
        $curl = curl_init();
        // Set some options - we are passing in a useragent too here
        curl_setopt_array($curl, [
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_URL => 'https://mindicador.cl/api',
            CURLOPT_USERAGENT => 'Codular Sample cURL Request'
        ]);
        // Send the request & save response to $resp
        $resp = curl_exec($curl);
        if (!curl_exec( $curl)) {
            dd('Error: "' . curl_error($curl) . '" - Code: ' . curl_errno($curl));
        }
        // Close request to clear up some resources
        curl_close($curl);

        //dd();
        return json_decode($resp)->dolar->valor;
    }

    public function pagoError()
    {
        return view('pages.pago-error');
    }
    /*
    public function endSale()
    {
        \Mail::to(\Auth::user()->email)->send(new EmailFinVenta(\Session::get('carrito'), $this->total())); //Enviando el email de notificación de la compra
        \Session::put('carrito', array());  //Vaciendo el carro de compras
        return Redirect::to('/');   //Redireccionando a home
    }
    */

    private function registrarOrden($carrito)
    {
        $this->total();   
        $this->shipping; 
                
        $estado = Estado::where('estado_inicial','=', true)->first();
        if(!isset($estado->id))
        {
            throw new Exception("No se encuentra configurado el estado inicial para las ventas. La transacción no puyede completarse.");
        }
        
        $orden = new Orden();        
        $orden->user_id = \Auth::user()->id;
        $dolar = $this->consultarDolar();
        $orden->shiping = $this->gastosDeEnvio($dolar);
        $orden->subTotal = $this->total();
        $orden->estado_id = $estado->id;
        
        try{
            \DB::beginTransaction();            
            if(!$orden->save())
                throw new \ErrorException('Error al registrar la orden.');

            foreach($carrito as $item)
            {
                $ordenItem = new OrdenItem();
                $ordenItem->precio = $item->precio;
                $ordenItem->cantidad = $item->cantidad;
                $ordenItem->orden_id = $orden->id;
                $ordenItem->producto_id = $item->id;
                if(!$ordenItem->save())
                    throw new \ErrorException('Error al registrar el detalle de la venta.');
            }
            
            \DB::commit();

            \Session::forget('carrito');	//Vaciando el carrito de compras
            return true;

        }catch(Exception $ex){
            \DB::rollback();
        } 

        return false;
    }
}
