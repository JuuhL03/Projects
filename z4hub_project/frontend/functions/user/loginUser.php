<?php
$username = $_POST['username'];
$password = $_POST['password'];

function login($username, $password){
    require_once '../../../backend/user.php';
    
    $user = new User();
    if (!empty($username) && !empty($password)) {
        $user->connect('z4hub', 'localhost', 'root', '');

        if($user->login($username, $password)){
            header("location: ../../user/dashboard.php");
        }else {
            echo "<script>window.alert('Senha ou Usuário incorretos.')
            window.location.href='../../login.php';</script>";
        }
        
    } else {
        echo "<script>window.alert('Não foi possível fazer o login.')
        window.location.href='../../register.php';</script>";
    }
}

login($username, $password)
?>