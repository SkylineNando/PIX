<?php

  $access_token = "{Access Token}";

  if(isset($_POST)){

    if(isset($_POST['pix'])){

      if($_POST['pix']){

        $valor = 0.02;

        include_once 'mercadopago/lib/mercadopago/vendor/autoload.php';

        MercadoPago\SDK::setAccessToken($access_token);


  			$payment = new MercadoPago\Payment();
  			$payment->description = 'Pagamento Nome';
  			$payment->transaction_amount = (double)$valor;
  			$payment->payment_method_id = "pix";

  			$payment->notification_url   = 'https://seusite.com/notification.php';
  			$payment->external_reference = '1520';

  				$payment->payer = array(
  					"email" => 'emailcliente@gmail.com',
  					"first_name" => 'Primeiro nome do cliente',
  					"address"=>  array(
  						"zip_code" => "06233200",
  						"street_name" => "Av. das Nações Unidas",
  						"street_number" => "3003",
  						"neighborhood" => "Bonfim",
  						"city" => "Osasco",
  						"federal_unit" => "SP"
  					)
  				);

  				$payment->save();

         echo json_encode($payment->point_of_interaction);

      }else{
        echo json_encode(array(
          'status'  => 'error',
          'message' => 'pix required'
        ));
        exit;
      }

    }else{
      echo json_encode(array(
        'status'  => 'error',
        'message' => 'pix required'
      ));
      exit;
    }

  }else{
    echo json_encode(array(
      'status'  => 'error',
      'message' => 'post required'
    ));
    exit;
  }
