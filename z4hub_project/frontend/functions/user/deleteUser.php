<?php
$id = $_POST['userId']; 

function deleteUser($id){
    require_once '../../../backend/user.php';
    $user = new User();
    
    if (!empty($id)) {
        $user->connect('z4hub', 'localhost', 'root', '');

        if ($user->msg == "") {
            if ($user->delete($id)) {
                return true;
            } else {
                return false;
            }
        } else {
            echo "Erro: " . $user->msg;
        }
    } else {
        return false;
    }
}

deleteUser($id);
