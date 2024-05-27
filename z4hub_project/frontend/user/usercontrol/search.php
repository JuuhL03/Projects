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
    <title>Z4Hub - Admin</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="../../css/style.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

</head>

<body>
    <?php require_once "../nav.php" ?>

    <section class="gradient-custom tam">
        <div class="container">
            <div class="row d-flex justify-content-center align-items-stretch">
                <div class="col-12 col-md-6 d-flex mt-5">
                    <div class="card bg-dark text-white w-100" style="border-radius: 1rem;">
                        <div class="card-body p-4 text-center d-flex flex-column">
                            <div class="mt-md-4 pb-5 flex-grow-1">
                                <h2 class="fw-bold mb-2 text-uppercase">Painel do Administrador</h2>
                                <p class="text-white-50 mb-5">Para buscar o usuário, informe o ID ou Nome ou Email!</p>
                                <form role="search" onsubmit="searchUser();return false;" id="form" method="post" class="flex-grow-1 d-flex flex-column justify-content-around">
                                    <div class="form-outline form-white mb-4">
                                        <input class="form-control form-control-lg" type="search" id="userId" name="userId" placeholder="Search" aria-label="Search">
                                        <label for="userId" class="form-label">ID Usuário:</label>
                                    </div>
                                    <div class="form-outline form-white mb-4">
                                        <input class="form-control form-control-lg" type="search" id="username" name="username" placeholder="Search" aria-label="Search">
                                        <label for="username" class="form-label">Nome do Usuário:</label>
                                    </div>
                                    <div class="form-outline form-white mb-4">
                                        <input class="form-control form-control-lg" type="search" id="email" name="email" placeholder="Search" aria-label="Search">
                                        <label for="email" class="form-label">Email do Usuário:</label>
                                    </div>
                                    <button class="btn btn-outline-primary btn-lg px-5" type="submit">Buscar</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-6 d-flex mt-5">
                    <div class="card bg-dark text-white w-100" style="border-radius: 1rem;">
                        <div class="card-body p-4 d-flex flex-column">
                            <div class="mt-md-4 pb-5 flex-grow-1">
                                <h2 class="fw-bold mb-2 text-uppercase text-center">Painel do Administrador</h2>
                                <p class="text-white-50 mb-5 text-center">Retorno da busca com dados completos:</p>
                                <form method="post">
                                    <div class="form-outline form-white mb-4">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <label class="form-label" for="inputId">Id do Usuário</label>
                                                <input disabled type="text" id="inputId" name="id" class="form-control" />
                                            </div>
                                            <div class="col-sm-6 d-flex align-items-center">
                                                <div>
                                                    <label for="flexSwitchCheckChecked" class="form-label">Status da conta</label>
                                                    <div class="form-check form-switch">
                                                        <input disabled class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckChecked" name="status" value="ON" checked>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-outline form-white mb-2 mt-2">
                                            <label class="form-label text-left" for="inputUsername">Nome do Usuário</label>
                                            <input disabled type="username" id="inputUsername" name="username" class="form-control form-control-lg disabled" />
                                        </div>
                                        <div class="form-outline form-white mb-2">
                                            <label class="form-label" for="inputEmail">Email do Usuário</label>
                                            <input disabled type="email" id="inputEmail" name="email" class="form-control form-control-lg disabled" />
                                        </div>
                                        <div class="form-outline form-white mb-2">
                                            <label class="form-label" for="inputPassword">Senha</label>
                                            <input disabled type="text" id="inputPassword" name="password" class="form-control form-control-lg disabled" />
                                        </div>
                                        <div class="form-outline form-white mb-2">
                                            <label for="inputPlan" class="form-label">Planos</label>
                                            <select disabled id="inputPlan" class="form-control form-control-lg" name="plans">
                                                <option value=""></option>
                                                <option value="admin">Administrador</option>
                                                <option value="basic">Plano Básico</option>
                                                <option value="essential">Plano Essencial</option>
                                                <option value="prof">Plano Profissional</option>
                                                <option value="business">Plano Empresarial</option>
                                            </select>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <script type="text/javascript">
        function searchUser() {
            $.ajax({
                method: "POST",
                url: "../../functions/user/searchUser.php",
                data: $("#form").serialize(),
                success: function(response) {
                    userData = response;

                    document.getElementById('inputId').value = userData["id"];
                    document.getElementById('inputUsername').value = userData["username"];
                    document.getElementById('inputPassword').value = userData["password"];
                    document.getElementById('inputEmail').value = userData["email"];
                    document.getElementById('inputPlan').value = userData["user_plan"];

                    if (userData.account_status === "ON") {
                        document.getElementById('flexSwitchCheckChecked').checked = true;
                    } else {
                        document.getElementById('flexSwitchCheckChecked').checked = false;
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.error("Erro na requisição AJAX: ", textStatus, errorThrown);
                }
            });
        }
    </script>

    <script src="../../js/script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
</body>

</html>