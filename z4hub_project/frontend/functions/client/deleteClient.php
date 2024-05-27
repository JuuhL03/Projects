<?php
session_start();

$id = $_POST['id'];

function deleteClient($id)
{
    require_once '../../../backend/client.php';
    $client = new Client();

    if (!empty($id)) {
        $client->connect('z4hub', 'localhost', 'root', '');

        if ($client->msg == "") {
            if ($client->delete($id)) {
                return true;
            } else {
                return false;
            }
        } else {
            echo "Erro: " . $client->msg;
        }
    } else {
        return false;
    }
}

deleteClient($id);
