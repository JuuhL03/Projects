<?php
$id = $_POST['id']; 
$username = $_POST['username'];
$password = $_POST['password'];
$email = $_POST['email'];
$user_plan = $_POST['plans'];
$account_status = isset($_POST['status']) ? $_POST['status'] : 'OF';

function updateUser($id, $username, $password, $email, $account_status, $user_plan){
    require_once '../../../backend/user.php';
    $user = new User();
    if (!empty($username) && !empty($password) && !empty($email) && !empty($user_plan)) {

        $user->connect('z4hub', 'localhost', 'root', '');

        if ($user->msg == "") {

            if ($user->update($id, $username, $password, $email, $account_status, $user_plan)) {
                header("location: /z4hub_project/frontend/user/usercontrol/userControl.php");
            } else {
                header("location: /z4hub_project/frontend/user/usercontrol/userControl.php");
            }
        } else {
            echo "Erro: " . $user->msg;
        }
    } else {
        header("location: /z4hub_project/frontend/user/usercontrol/userControl.php");
    }
}

updateUser($id, $username, $password, $email, $account_status, $user_plan);
