<?php 

session_start();

if (!isset($_SESSION["id_user"])) {
    header("Location: /z4hub_project/frontend/index.php");
    exit;
}

?>

<nav class="navbar navbar-expand-lg bg-body-tertiary" data-bs-theme="light">
    <div class="container">
        <a class="navbar-brand fontMajor" href="/z4hub_project/frontend/user/dashboard.php">
            <img src="/z4hub_project/frontend/src/logo.png" class="logoImg" alt="">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse d-flex justify-content-end" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="/z4hub_project/frontend/user/dashboard.php">Dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/z4hub_project/frontend/user/clientes/clientes.php">Clientes</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/z4hub_project/frontend/user/produtos/produtos.php">Produtos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/z4hub_project/frontend/user/planos/planos.php">Planos</a>
                </li>
                <?php
                    if(isset($_SESSION["type"]) && $_SESSION["type"]=="admin"){
                ?>
                    <li class="nav-item">
                        <a class="nav-link" href="/z4hub_project/frontend/user/usercontrol/userControl.php">Usuários</a>
                    </li>
                <?php
                    }
                ?>
                <li class="nav-item">
                    <form action="" id="exit" method="post">
                        <button class="btn btn-outline-primary" name="exit" type="submit">
                            Logout
                        </button>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</nav>

<?php

if (isset($_POST["exit"])) {
  session_destroy();
  header('Location: /z4hub_project/frontend/index.php');
}

?>