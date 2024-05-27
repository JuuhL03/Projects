<?php
session_start();

$name_object = $_POST['name_object'];
$preco = $_POST['preco'];
$created_at = date("Y-m-d H:i:s");

function registerObject($name_object, $preco, $created_at)
{
    require_once '../../../backend/objects.php';
    $objects = new Objects();
    $objects->connect('z4hub', 'localhost', 'root', '');

    if ($objects->msg == "") {
        if ($objects->register($name_object, $preco, $created_at)) {
            header("location: /z4hub_project/frontend/user/produtos/register.php");
        } else {
            header("location: /z4hub_project/frontend/user/produtos/register.php");
        }
    } else {
        echo "Erro: " . $object->msg;
    }
}

registerObject($name_object, $preco, $created_at);

