<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PaymentController extends Controller
{

    public function payment(Request $request){
        $picpay =  new picpayController;

        // Dados do produto
        $prod['ref']    = rand(1000,99999);
        $prod['nome']  = "Credito";
        $prod['valor'] = 35.50;

        // Dados do cliente
        $cli['nome']      = "João";
        $cli['sobreNome'] = "Das Neves";
        $cli['cpf']		 = "000.000.000-00";
        $cli['email']	 = "email@provedor.com";
        $cli['telefone']  = "11999999999";

        $produto = (object)$prod;
        $cliente = (object)$cli;

        $payment = $picpay->requestPayment($produto,$cliente);

        //verifica se exite algum erro
        if(isset($payment->message)){
            return response()->json($payment->message);
        }else{
            $link   = $payment->paymentUrl;
            $qrCode = $payment->qrcode->base64;

            return response()->json($link);
//            echo '<a href="'.$link.'">Pagar com PicPay</a>';
//            echo '<br />';
//            echo '<img src="'.$qrCode.'" />';
        }






    }
}
