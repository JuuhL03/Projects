<?php
session_start();

$name_client = $_POST['name_client'];
$document = $_POST['document'];
$created_at = date("Y-m-d H:i:s");

function registerClient($name_client, $document, $created_at)
{
    require_once '../../../backend/client.php';
    $client = new Client();
    $client->connect('z4hub', 'localhost', 'root', '');

    if ($client->msg == "") {
        if ($client->register($name_client, $document, $created_at)) {
            header("location: /z4hub_project/frontend/user/clientes/register.php");
        } else {
            header("location: /z4hub_project/frontend/user/clientes/register.php");
        }
    } else {
        echo "Erro: " . $client->msg;
    }
}

registerClient($name_client, $document, $created_at);

