<?php
session_start();

$id = $_POST['id'];

function deleteObject($id)
{
    require_once '../../../backend/objects.php';
    $objects = new Objects();

    if (!empty($id)) {
        $objects->connect('z4hub', 'localhost', 'root', '');

        if ($objects->msg == "") {
            if ($objects->delete($id)) {
                return true;
            } else {
                return false;
            }
        } else {
            echo "Erro: " . $objects->msg;
        }
    } else {
        return false;
    }
}

deleteObject($id);
