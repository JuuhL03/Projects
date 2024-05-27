<?php
session_start();

$name_object = $_POST['name_object'] ?? null;
$preco = $_POST['preco'] ?? null;
$id = $_POST['id'] ?? null;

function searchObject($name_object, $preco, $id)
{
    require_once '../../../backend/objects.php';

    $objects = new Objects();
    if (!empty($name_object) || !empty($preco) || !empty($id)) {
        $objects->connect('z4hub', 'localhost', 'root', '');

        if ($objects->msg == "") {
            $data = $objects->search($name_object, $preco, $id);
            if ($data != false) {
                header('Content-Type: application/json');
                echo json_encode($data);
            } else {
                echo "<script>window.alert('Não foi possível encontrar o produto.')
                window.location.href='..';</script>";
            }
        }
    }
}

searchObject($name_object, $preco, $id);
