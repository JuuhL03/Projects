<?php
session_start();

$name_client = $_POST['name_client'] ?? null;
$document = $_POST['document'] ?? null;
$id = $_POST['id'] ?? null;

function searchClient($name_client, $document, $id)
{
    require_once '../../../backend/client.php';

    $client = new Client();
    if (!empty($name_client) || !empty($document) || !empty($id)) {
        $client->connect('z4hub', 'localhost', 'root', '');

        if ($client->msg == "") {
            $data = $client->search($name_client, $document, $id);
            if ($data != false) {
                header('Content-Type: application/json');
                echo json_encode($data);
            } else {
                echo "<script>window.alert('Não foi possível encontrar o cliente.')
                window.location.href='..';</script>";
            }
        }
    }
}

searchClient($name_client, $document, $id);
