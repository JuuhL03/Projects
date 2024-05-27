<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Z4Hub - Clientes</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="../../css/style.css">
</head>

<body>
    <?php require_once "../nav.php" ?>

    <section class="gradient-custom tam">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-20">
                <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                    <div class="card bg-dark text-white" style="border-radius: 1rem;">
                        <div class="card-body p-4 text-center">

                            <div class="mb-md-5 mt-md-4 pb-5">
                                <form action="../../functions/client/createClient.php" method="post">
                                    <h2 class="fw-bold mb-2 text-uppercase">Painel de Gerenciamento</h2>
                                    <p class="text-white-50 mb-5">Para cadastrar novo cliente, preencha os campos abaixo!</p>

                                    <div data-mdb-input-init class="form-outline form-white mb-4">
                                        <input type="username" id="name_client" name="name_client" class="form-control form-control-lg" />
                                        <label class="form-label" for="inputUsername">Nome do Cliente</label>
                                    </div>

                                    <div data-mdb-input-init class="form-outline form-white mb-4">
                                        <input type="text" id="document" name="document" class="form-control form-control-lg" />
                                        <label class="form-label" for="inputDocument">Documento do Cliente</label>
                                    </div>
                                        <button data-mdb-button-init data-mdb-ripple-init class="btn btn-outline-primary btn-lg px-5" type="submit">Cadastrar</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </section>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
</body>

</html>