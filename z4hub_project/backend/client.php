<?php

class Client
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

    public function register($name_client, $document, $created_at)
    {
        $sql = $this->pdo->prepare("SELECT * FROM client WHERE document = ?");
        $sql->execute([$document]);

        if ($sql->rowCount() > 0) {
            return false; // Cliente já existe
        } else {
            if (isset($_SESSION['id_user'])) {
                $id_user = $_SESSION['id_user'];
                $sql = $this->pdo->prepare("INSERT INTO client(name_client, document, created_at, user_id) VALUES (?, ?, ?, ?)");
                $sql->execute([$name_client, $document, $created_at, $id_user]);
                return true;
            } else {
                echo "<script>alert('Deu ruim e ele não localizou o userId.'); window.location.href='../';</script>";
                exit;
            }
        }
    }

    public function search($name_client, $document, $id)
    {
        if (isset($_SESSION['id_user'])) {
            $id_user = $_SESSION['id_user'];

            $query = "SELECT * FROM client WHERE user_id = $id_user AND ";
            $conditions = [];

            if (!empty($name_client)) {
                $conditions[] = "`name_client` LIKE '%$name_client%'";
            }
            if (!empty($document)) {
                $conditions[] = "`document` LIKE '%$document%'";
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

    public function update($name_client, $document, $id)
    {
        if (isset($_SESSION['id_user'])) {
            $id_user = $_SESSION['id_user'];
            $sql = $this->pdo->prepare("UPDATE client SET name_client = '$name_client', document = '$document' WHERE id = '$id', user_id = '$id_user'");
            $sql->execute();
        }
    }

    public function delete($id)
    {
        if (isset($_SESSION['id_user'])) {
            $id_user = $_SESSION['id_user'];
            $sql = $this->pdo->prepare("DELETE FROM client WHERE id = '$id' AND user_id = '$id_user'");
            $sql->execute();
        }
    }
}