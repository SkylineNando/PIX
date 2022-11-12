<?php
/*
# Desenvolvido em 2022 por Fernando Bueno - https://github.com/SkylineNando/PIX
#
*/

//include "phpqrcode/qrlib.php"; 
include_once "pix.php";


$px[00]="01"; //Payload Format Indicator, Obrigatório, valor fixo: 01
// Se o QR Code for para pagamento único (só puder ser utilizado uma vez), descomente a linha a seguir.
//$px[01]="12"; //Se o valor 12 estiver presente, significa que o BR Code só pode ser utilizado uma vez. 
$px[26][00]="BR.GOV.BCB.PIX"; //Indica arranjo específico; “00” (GUI) obrigatório e valor fixo: br.gov.bcb.pix
$px[26][01]="+5562998055567"; //Chave do destinatário do pix, pode ser EVP, e-mail, CPF ou CNPJ.
$px[26][02]="Para para meu amigo"; // Descrição da transação, opcional.
/*
Outros exemplos de chaves:
CPF:
$px[26][01]="0123456789"; // CPF somente numeros.

CNPJ:
$px[26][01]="012365498798705"; // CNPJ somente numeros.

E-mail
$px[26][01]="seuemail@gmail.com"; // Chave de e-mail, tamanho maximo 77. Chave, descricao e os IDs devem totalizar no máximo 99 caracteres no campo 26.

Telefone:
$px[26][01]="+55119999999"; //Codificar o telefone no formato internacional, no exemplo: +55 Pais, 11 DDD, 999999999 telefone.
*/

$px[52]="0000"; //Merchant Category Code “0000” ou MCC ISO18245
$px[53]="986"; //Moeda, “986” = BRL: real brasileiro - ISO4217
$px[54]="1.00"; //Valor da transação, se comentado o cliente especifica o valor da transação no próprio app. Utilizar o . como separador decimal. Máximo: 13 caracteres.
$px[58]="BR"; //“BR” – Código de país ISO3166-1 alpha 2
$px[59]="FERNANDO ALVES BUENO"; //Nome do beneficiário/recebedor. Máximo: 25 caracteres.
$px[60]="SÃO PAULO"; //Nome cidade onde é efetuada a transação. Máximo 15 caracteres.
$px[62][05]="***"; //Identificador de transação, quando gerado automaticamente usar ***. Limite 25 caracteres. Vide nota abaixo.

$pix=montaPix($px);
$pix.="6304"; //Adiciona o campo do CRC no fim da linha do pix.
$pix.=crcChecksum($pix); //Calcula o checksum CRC16 e acrescenta ao final.
echo $pix;
?>
