<?php
$name_object = $_POST['name_object'];
$preco = $_POST['preco'];
$id = $_POST['id'];

function updateObject($name_object, $preco, $id)
{
    require_once '../../../backend/objects.php';
    $objects = new Objects();
    $objects->connect('z4hub', 'localhost', 'root', '');

    if (!empty($objects->msg)) {
        echo "Erro de conexão: " . $objects->msg;
        exit;
    }

    if (!empty($preco) && !empty($name_object) && !empty($id)) {
        if ($objects->update($name_object, $preco, $id)) {
            header("location: /z4hub_project/frontend/user/produtos/produtos.php");
        } else {
            header("location: /z4hub_project/frontend/user/produtos/produtos.php");
        }
    } else {
        header("location: /z4hub_project/frontend/user/produtos/produtos.php");
    }
}

updateObject($name_object, $preco, $id);
