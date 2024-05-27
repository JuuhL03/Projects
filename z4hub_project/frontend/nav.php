<?php

session_start();
session_destroy();

?>

<nav class="navbar navbar-expand-lg bg-body-tertiary" data-bs-theme="light">
    <div class="container">
        <a class="navbar-brand fontMajor" href="index.php">
            <img src="src/logo.png" class="logoImg" alt="">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse d-flex justify-content-end" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="index.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="index.php#sobre">Quem Somos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="index.php#solucoes">Soluções</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="index.php#planos">Planos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="index.php#contato">Contato</a>
                </li>
                <li class="nav-item">
                    <a type="button" href="login.php" class="btn btn-outline-primary">Login</a>  
                </li>
            </ul>
        </div>
    </div>
</nav>