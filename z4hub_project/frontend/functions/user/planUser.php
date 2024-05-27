<?php
session_start();
$user_plan = $_POST['user_plan'];

function updatePlan($user_plan)
{
    require_once '../../../backend/user.php';
    $user = new User();
    if (!empty($id)) {

        $user->connect('z4hub', 'localhost', 'root', '');

        if ($user->msg == "") {
            
            if ($user->updatePlan($user_plan)) {
                header("location: /z4hub_project/frontend/user/planos/planos.php");
            } else {
                header("location: /z4hub_project/frontend/user/planos/planos.php");
            }
        } else {
            echo "Erro: " . $user->msg;
        }
    } else {
        header("location: /z4hub_project/frontend/user/planos/planos.php");
    }
}

updatePlan($user_plan);
