<?php
//обрабатываем отправку новой формы в HubSpot для создания нового контакта
$hubspotutk=$_COOKIE['hubspotutk'];
$ip_addr=$_SERVER['REMOTE_ADDR'];

$hs_context=array(
    'hutk'=>$hubspotutk,
    'ipAddress'=>$ip_addr,
    'pageUrl'=>'http://contact/index.php',
    'pageName'=>'Contact US'
);
//возвращает данные в формате json
$hs_context_json=json_encode($hs_context);

$firstname=$_POST['firstname'];
$lastname=$_POST['lastname'];
$subject=$_POST['subject'];
$message=$_POST['message'];
$email=$_POST['email'];

//проверка на поля
if(empty($_POST['firstname'])  ||
    empty($_POST['lastname']) ||
    empty($_POST['subject']) ||
    empty($_POST['message']) ||
    empty($_POST['email']))
{
    echo "All fields are required.";
    exit;
}

//проверка на email
$errors = [];
if (!preg_match ('/[\.a-z0-9_\-]+[@][a-z0-9_\-]+([.][a-z0-9_\-]+)+[a-z]{1,4}/i', $_POST['email']))
    $errors[] = 'Не валидный email';

if ($errors) {
    $content = 'При отправке формы произошли следующие ошибки:<br/><br/>';
    foreach ($errors as $error) $content .= $error.'<br/>';
    echo $content;
    exit;
}

$str_post="firstname" .urlencode($firstname)
    . "&lastname=" . urlencode($lastname)
    . "&subject=" . urlencode($subject)
    . "&message=" . urlencode($message)
    . "&email=" . urlencode($email)
    . "&hs_context=" . urlencode($hs_context_json);



$endpoint = 'https://forms.hubspot.com/uploads/form/v2/25208162/154b249d-6df5-45d2-84de-79b0b94fdbb6';

$ch = @curl_init();
@curl_setopt($ch, CURLOPT_POST, true);
@curl_setopt($ch, CURLOPT_POSTFIELDS, $str_post);
@curl_setopt($ch, CURLOPT_URL, $endpoint);
@curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    'Content-Type: application/x-www-form-urlencoded'
));
@curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$response = @curl_exec($ch);  //Log the response from HubSpot as needed.
$status_code = @curl_getinfo($ch, CURLINFO_HTTP_CODE); //Log the response status code
@curl_close($ch);

echo $status_code . " " . $response;
