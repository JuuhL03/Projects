<?php
session_start();
$name_client = $_POST['name_client'];
$document = $_POST['document'];
$id = $_POST['id'];

function updateClient($name_client, $document, $id)
{
    require_once '../../../backend/client.php';
    $client = new Client();
    $client->connect('z4hub', 'localhost', 'root', '');

    if (!empty($client->msg)) {
        echo "Erro de conexão: " . $client->msg;
        exit;
    }

    if (!empty($document) && !empty($name_client) && !empty($id)) {
        if ($client->update($name_client, $document, $id)) {
            header("location: /z4hub_project/frontend/user/clientes/clientes.php");
        } else {
            header("location: /z4hub_project/frontend/user/clientes/clientes.php");
        }
    } else {
        header("location: /z4hub_project/frontend/user/clientes/clientes.php");
    }
}

updateClient($name_client, $document, $id);
