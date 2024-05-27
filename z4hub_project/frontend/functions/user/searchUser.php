<?php
$username = $_POST['username'] ?? null;
$email = $_POST['email'] ?? null;
$userId = $_POST['userId'] ?? null;

function searchUser($username, $email, $userId)
{
    require_once '../../../backend/user.php';

    $user = new User();
    if (!empty($username) || !empty($email) || !empty($userId)) {
        $user->connect('z4hub', 'localhost', 'root', '');

        if ($user->msg == "") {
            $data = $user->search($username, $email, $userId);
            if ($data != false) {
                header('Content-Type: application/json');
                echo json_encode($data);
            } else {
                echo "<script>window.alert('Não foi possível encontrar o usuário.')
                window.location.href='..';</script>";
            }
        }
    }
}

searchUser($username, $email, $userId);
