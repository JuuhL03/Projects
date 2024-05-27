<?php

class User
{
    private $pdo;
    public $msg = "";

    public function connect($dbname, $host, $usuario, $senha)
    {
        try {
            $this->pdo = new PDO('mysql:host=' . $host . ';dbname=' . $dbname, $usuario, $senha);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $erro) {
            global $msg;
            $msg = $erro->getMessage();
        }
    }

    public function register($username, $password, $email, $created_at, $account_status, $user_plan)
    {
        $sql = $this->pdo->prepare("SELECT * FROM users WHERE username LIKE '$username'");
        $sql->execute();

        if ($sql->rowCount() > 0) {
            /* User existe */
            return false;
        } else {
            $sql = $this->pdo->prepare("INSERT INTO users(`username`, `password`, `email`, `created_at`, `account_status`, `user_plan`) VALUES ('$username', '$password', '$email', '$created_at', '$account_status', '$user_plan');");
            $sql->execute();
        }
    }

    public function login($username, $password)
    {
        $sql = $this->pdo->prepare("SELECT id, user_plan FROM users WHERE `username` LIKE '$username' AND `password` LIKE '$password' AND account_status LIKE 'ON'");
        $sql->execute();

        if ($sql->rowCount() > 0) {
            /* User existe */
            $data = $sql->fetch();

            if (!isset($_SESSION)) {
                session_start();
                $_SESSION["id_user"] = $data[0];
                $_SESSION["type"] = $data[1];
                $_SESSION["username"] = $username;
            }
            return true;
        } else {
            return false;
        }
    }

    public function search($username, $email, $id)
    {
        $query = "SELECT * FROM users WHERE ";
        $conditions = [];
        if (!empty($username)) {
            $conditions[] = "`username` LIKE '%$username%'";
        }
        if (!empty($email)) {
            $conditions[] = "`email` LIKE '%$email%'";
        }
        if (!empty($id)) {
            $conditions[] = "`id` LIKE '%$id%'";
        }
        if (count($conditions) > 0) {
            $query .= implode(" OR ", $conditions);
        } else {
            echo "<script>
                        window.alert('Por favor, preencha pelo menos um campo para busca.');
                        window.location.href='../';
                      </script>";
            exit;
        }

        $sql = $this->pdo->prepare($query);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            /* User existe */
            $data = $sql->fetch();
            return $data;
        } else {
            return false;
        }
    }

    public function update($id, $username, $password, $email, $account_status, $user_plan)
    {
        $sql = $this->pdo->prepare("UPDATE users SET username = '$username', password = '$password', email = '$email', account_status = '$account_status', user_plan = '$user_plan' WHERE id = $id");
        $sql->execute();
    }

    public function delete($id)
    {
        $sql = $this->pdo->prepare("DELETE FROM users WHERE id = $id");
        $sql->execute();
    }

    public function updatePlan($user_plan)
    {
        if (isset($_SESSION['id_user'])) {
            $id_user = $_SESSION['id_user'];
            $sql = $this->pdo->prepare("UPDATE users SET user_plan = '$user_plan' WHERE id = '$id_user'");
            $sql->execute();
        }
    }
}


