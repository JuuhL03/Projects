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
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-20">
                <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                    <div class="card bg-dark text-white" style="border-radius: 1rem;">
                        <div class="card-body p-5 text-center">
                            <div class="mb-md-5 mt-md-4 pb-5">

                                <h2 class="fw-bold mb-2 text-uppercase">Painel de Gerenciamento</h2>
                                <p class="text-white-50 mb-5">Insira o ID do Cliente que você gostaria de excluir.</p>

                                <form role="search" onsubmit="deleteClient();return false;" id="form" method="post">
                                    <div data-mdb-input-init class="form-outline form-white mb-4">
                                        <input class="form-control form-control-lg" type="search" id="id" name="id" placeholder="Search" aria-label="Search">
                                        <label class="form-label" for="id">Id do Cliente</label>
                                    </div>
                                    <button data-mdb-button-init data-mdb-ripple-init class="btn btn-outline-primary btn-lg px-5" type="submit">Deletar</button>
                                </form>
                                <p class="mt-4">Não sabe o ID? <a href="search.php" class="text-white-50 fw-bold">Consulte aqui</a></p>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script type="text/javascript">
        function deleteClient() {
            $.ajax({
                method: "POST",
                url: "../../functions/client/deleteClient.php",
                data: $("#form").serialize(),
                success: function(response) {
                    var data = JSON.parse(response);
                    if (data.success) {
                        alert(data.message);
                    } else {
                        alert("Erro: " + data.message);
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.error("Erro na requisição AJAX: ", textStatus, errorThrown);
                    alert("Erro técnico: " + textStatus);
                }
            });
        }
    </script>

    <script src="../../js/script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
</body>

</html>