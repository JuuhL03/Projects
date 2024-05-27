<!DOCTYPE html>
<html lang="en">

<?php

if (isset($_SESSION["type"]) && $_SESSION["type"] != "admin") {
    header("Location: ../dashboard.php");
    exit;
}

?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clientes</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="../../css/style.css">
</head>

<body>
    <?php require_once "../nav.php" ?>

    <div class="row icons container-flex">
        <div class="dashContent">
            <div>
                <h1 class="text-center w-100 mb-5">Central de Administrador</h1>
                <div class="col d-inline-block shadow-lg p-3 mb-5 bg-body-tertiary rounded-5">
                    <div class="bg-body-tertiary">
                        <img src="../../src/addIcon.png" alt="">
                        <h1 class="fs-4 text-center">Adicionar Novo Usuário</h1>
                    </div>
                    <div class="bg-body-primary">
                        <div class="dashCard">
                            <a href="register.php" type="button" class="btn btn-primary">Acessar</a>
                        </div>
                    </div>
                </div>
                <div class="col d-inline-block shadow-lg p-3 mb-5 bg-body-tertiary rounded-5">
                    <div class="bg-body-tertiary">
                        <img src="../../src/editIcon.png" alt="">
                        <h1 class="fs-4 text-center">Editar Usuário Existente</h1>
                    </div>
                    <div class="bg-body-primary">
                        <div class="dashCard">
                            <a href="edit.php" type="button" class="btn btn-primary">Acessar</a>
                        </div>
                    </div>
                </div>
                <div class="col d-inline-block shadow-lg p-3 mb-5 bg-body-tertiary rounded-5">
                    <div class="bg-body-tertiary">
                        <img src="../../src/searchIcon.png" alt="">
                        <h1 class="fs-4 text-center">Buscar Usuário Existente</h1>
                    </div>
                    <div class="bg-body-primary">
                        <div class="dashCard">
                            <a href="search.php" type="button" class="btn btn-primary">Acessar</a>
                        </div>
                    </div>
                </div>
                <div class="col d-inline-block shadow-lg p-3 mb-5 bg-body-tertiary rounded-5">
                    <div class="bg-body-tertiary">
                        <img src="../../src/deleteIcon.png" alt="">
                        <h1 class="fs-4 text-center">Excluir Usuário Existente</h1>
                    </div>
                    <div class="bg-body-primary">
                        <div class="dashCard">
                            <a href="delete.php" type="button" class="btn btn-primary">Acessar</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
    <script type="text/javascript" src="js/script.js"></script>
</body>

</html>