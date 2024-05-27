<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Z4Hub - Clientes</title>

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
                                <h2 class="fw-bold mb-2 text-uppercase">Painel de Gerenciamento</h2>
                                <p class="text-white-50 mb-5">Para buscar o cliente, informe o ID ou Nome!</p>
                                <form role="search" onsubmit="searchClient();return false;" id="form" method="post" class="flex-grow-1 d-flex flex-column justify-content-around">
                                    <div class="form-outline form-white mb-4">
                                        <input class="form-control form-control-lg" type="search" id="id" name="id" placeholder="Search" aria-label="Search">
                                        <label for="id" class="form-label">ID Cliente:</label>
                                    </div>
                                    <div class="form-outline form-white mb-4">
                                        <input class="form-control form-control-lg" type="search" id="name_client" name="name_client" placeholder="Search" aria-label="Search">
                                        <label for="name_client" class="form-label">Nome do Cliente:</label>
                                    </div>
                                    <div class="form-outline form-white mb-4">
                                        <input class="form-control form-control-lg" type="search" id="document" name="document" placeholder="Search" aria-label="Search">
                                        <label for="document" class="form-label">Documento do Cliente:</label>
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
                                <h2 class="fw-bold mb-2 text-uppercase text-center">Painel de Gerenciamento</h2>
                                <p class="text-white-50 mb-5 text-center">Retorno da busca com dados completos:</p>
                                <form method="post">
                                    <div class="form-outline form-white mb-4">
                                        <label class="form-label text-left" for="id">Id do Cliente</label>
                                        <input disabled type="id" id="inputId" name="id" class="form-control form-control-lg disabled" />
                                    </div>
                                    <div class="form-outline form-white mb-4">
                                        <label class="form-label text-left" for="name_client">Nome do Cliente</label>
                                        <input disabled type="name_client" id="inputNameClient" name="name_client" class="form-control form-control-lg disabled" />
                                    </div>
                                    <div class="form-outline form-white mb-4">
                                        <label class="form-label" for="inputDocument">Documento do Cliente</label>
                                        <input disabled type="document" id="inputDocument" name="document" class="form-control form-control-lg disabled" />
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
        function searchClient() {
            $.ajax({
                method: "POST",
                url: "../../functions/client/searchClient.php",
                data: $("#form").serialize(),
                success: function(response) {
                    console.log(response);
                    clientData = response;

                    document.getElementById('inputId').value = clientData["id"];
                    document.getElementById('inputDocument').value = clientData["document"];
                    document.getElementById('inputNameClient').value = clientData["name_client"];

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