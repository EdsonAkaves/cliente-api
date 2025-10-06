<?php
require_once __DIR__ . '/vendor/autoload.php';

echo "Iniciando processo..." . PHP_EOL;
echo "1. Realizando Login na API..." . PHP_EOL;

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$chLogin = curl_init();
$urlLogin = $_ENV['API_BASE_URL'] . '/login.php';

$dataLogin = [
    'email' => $_ENV['TEST_USER_EMAIL'],
    'senha' => $_ENV['TEST_USER_PASSWORD']
];

curl_setopt_array($chLogin, [
    CURLOPT_URL => $urlLogin,
    CURLOPT_POST => true,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_HTTPHEADER => [
        'Content-Type: application/json'
    ],
    CURLOPT_POSTFIELDS => json_encode($dataLogin)
]);

$responseLogin = curl_exec($chLogin);
$httpCodeLogin = curl_getinfo($chLogin, CURLINFO_HTTP_CODE);

if (curl_errno($chLogin)) {
    echo 'Erro do cURL no Login: ' . curl_error($chLogin) . PHP_EOL;
    curl_close($chLogin);
    exit(1);
} 


curl_close($chLogin);



if ($httpCodeLogin === 200) {
    echo "Login realizado com sucesso (Status: {$httpCodeLogin})" . PHP_EOL;
    $dataLogin = json_decode($responseLogin, true);
    $token = $dataLogin['token'];


    echo "2. Realizando a atualização do cliente..." . PHP_EOL;


    $chUpdate = curl_init();
    $dataUpdate = [
    'nome' => 'Edson Alves',
    'email' => 'edson.novo@email.com'
    ];
    $idClient = $_ENV['TEST_USER_ID'];
    $updateUrl = $_ENV['API_BASE_URL'] . "/atualizar_cliente.php?id={$idClient}";

    curl_setopt_array($chUpdate, [
        CURLOPT_URL => $updateUrl,
        CURLOPT_CUSTOMREQUEST =>'PUT',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_POSTFIELDS => json_encode($dataUpdate),
        CURLOPT_HTTPHEADER => [
            'Content-Type: application/json',
            "Authorization: Bearer {$token}"
        ]        
    ]);

    $updateResponse = curl_exec($chUpdate);
    $httpCodeUpdate = curl_getinfo($chUpdate, CURLINFO_HTTP_CODE);



    if (curl_errno($chUpdate)){
        echo 'Erro do cURL na atualização: ' . curl_error($chUpdate) . PHP_EOL;
    } else {
        echo "Resposta da API de atualização (Status: {$httpCodeUpdate}):" . PHP_EOL;
        echo $updateResponse . PHP_EOL;
    }

    curl_close($chUpdate);

} else {
    echo " Falha no login (Status: {$httpCodeLogin})." . PHP_EOL;
    echo " Resposta da API: " . $responseLogin . PHP_EOL;
}

echo PHP_EOL . "Processo finalizado." . PHP_EOL;