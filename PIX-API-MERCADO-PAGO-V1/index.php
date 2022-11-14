<?php include('config.php');?>
<?php
$curl = curl_init();

    $dados["transaction_amount"]                    = 0.01;
    $dados["description"]                           = "Título do produto";
    $dados["external_reference"]                    = "2";
    $dados["payment_method_id"]                     = "pix";
    $dados["notification_url"]                      = "https://your-site.com.br/notification.php";
    $dados["payer"]["email"]                        = "test@test.com";
    $dados["payer"]["first_name"]                   = "Test";
    $dados["payer"]["last_name"]                    = "User";
    
    $dados["payer"]["identification"]["type"]       = "CPF";
    $dados["payer"]["identification"]["number"]     = "19119119100";
    
    $dados["payer"]["address"]["zip_code"]          = "06233200";
    $dados["payer"]["address"]["street_name"]       = "Av. das Nações Unidas";
    $dados["payer"]["address"]["street_number"]     = "3003";
    $dados["payer"]["address"]["neighborhood"]      = "Bonfim";
    $dados["payer"]["address"]["city"]              = "Osasco";
    $dados["payer"]["address"]["federal_unit"]      = "SP";

    curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://api.mercadopago.com/v1/payments/',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => json_encode($dados),
    CURLOPT_HTTPHEADER => array(
        'accept: application/json',
        'content-type: application/json',
        'Authorization: Bearer APP_USR-1456542728372245-111407-e2d2bedaacfea615c9becde48f0e865d-248252678'
    ),
    ));
    $response = curl_exec($curl);
    $resultado = json_decode($response);
    //var_dump($response);
curl_close($curl);
?>

<img style='display:block; width:300px;height:300px;' id='base64image'
       src='data:image/jpeg;base64, <?php echo $resultado->point_of_interaction->transaction_data->qr_code_base64;?>' />

<b>Copie:</b>
<?php echo $resultado->point_of_interaction->transaction_data->qr_code;?>       
       
       
       
<?php 
    $sql="INSERT INTO status(`status`, `codigo`) VALUES('".$resultado->status."', '".$resultado->id."')";
    mysqli_query($conexao, $sql);
?>
