<?php

$curl = curl_init();

curl_setopt_array($curl, array(
    CURLOPT_URL => 'http://192.168.155.146:8080/crops/admin/permiso.api.php',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'GET',
    CURLOPT_HTTPHEADER => array(
        'Cookie: PHPSESSID=32b10k04hu52j8otvrmbifitnm'
    ),
));

$response = curl_exec($curl);

/* if ($response === false) {
    echo "cURL Error: " . curl_erros($curl);
    $response = [];
} else {
    $response = json_decode($curl);
} */

curl_close($curl);
$response = json_decode($response);

foreach ($response as $dato):
    echo ($dato->permiso);
endforeach;