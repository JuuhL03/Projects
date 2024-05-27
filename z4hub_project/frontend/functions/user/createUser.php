<?php
$username = $_POST['username'];
$password = $_POST['password'];
$email = $_POST['email'];
$user_plan = $_POST['plans'];
$account_status = "ON";
$created_at = date("Y-m-d H:i:s");

function registerUser($username, $password, $email, $created_at, $account_status, $user_plan)
{

    require_once '../../../backend/user.php';
    $user = new User();
    if (!empty($username) && !empty($password) && !empty($email) && !empty($user_plan)) {

        $user->connect('z4hub', 'localhost', 'root', '');

        if ($user->msg == "") {
            if($user->register($username, $password, $email, $created_at, $account_status, $user_plan)){
                
                if(isset($_SESSION["id_user"]))
                    header("location: ../login.php");
                else
                    header("location: /z4hub_project/frontend/user/usercontrol/userControl.php");
            }else {
                if(isset($_SESSION["id_user"]))
                    header("location: ../register.php");
                else
                    header("location: /z4hub_project/frontend/user/usercontrol/userControl.php");
            }
        } else {
            echo "Erro: " . $user->msg;
        }
    } else {
        if(isset($_SESSION["id_user"]))
            echo "<script>window.alert('Dados faltantes.')
            window.location.href='../register.php';</script>";
        else
            header("location: /z4hub_project/frontend/user/usercontrol/userControl.php");            
    }
}

registerUser($username, $password, $email, $created_at, $account_status, $user_plan);
