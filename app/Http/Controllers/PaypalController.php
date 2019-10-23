<?php

namespace App\Http\Controllers;

//use Illuminate\Http\Request;
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

class PaypalController extends Controller
{
    private $_api_context;
    
    public function __construct()
    {
        $paypalConf = \Config::get('paypal');
        $this->_api_context = new \PayPal\Rest\ApiContext(new \PayPal\Auth\OAuthTokenCredential($paypalConf['client_id'], $paypalConf['secret']));
        $this->_api_context->setConfig($paypalConf['settings']);
    }

    public function postPayment()
    {
        try
        {
            $dolar = $this->getUSD();
        }catch(Exception $ex){
            return Redirect::to('/')->with('error','No se pudo obtener el valor del dolar.');       
        }
        $gastosDeEnvio = 100/$dolar;

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

        $payerId = $request['paymentId'];
        $token = $request['token'];

        if(empty($payerId) || empty($token))
        {
            return Redirect::to('/')->with('message', 'Ocurrió un problema al intentar pagar con Paypal.');
        }

        $payment = Payment::get($paymentId, $this->_api_context);

        $execution = new PaymentExecution();
        $execution->setPayerId($request['paymentId']);

        try{
            $result = $payment->execute($execution, $this->_api_context);
        } catch (PayPal\Exception\PayPalConnectionException $ex) {
            dd($ex->getCode(), $ex->getData(), $ex);
        } catch (Exception $ex) {
            dd($ex);
        }

        if($result->getState() == 'approved')
        {
            return Redirect::to('/')->with('message','La compra fue realizada con exito.');
        }

        return Redirect::to('/')->with('message','La compra fue cancelada.');

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
}
