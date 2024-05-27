<!DOCTYPE html>
<html lang="en">

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
                <form action="../../functions/user/planUser.php" method="post">
                    <h1 class="text-center w-100 mb-5">Central de Planos</h1>
                    <div class="col d-inline-block shadow-lg p-3 mb-5 bg-body-tertiary rounded-5">
                        <div class="bg-body-tertiary">
                            <img src="../../src/basicPlan.png" alt="">
                            <h1 class="fs-4 text-center">Básico</h1>
                            <h1 class="fs-5 text-center">R$ 49,90/mês</h1>
                        </div>
                        <div class="bg-body-primary">
                            <div class="dashCard">
                                <br>
                                <ul>
                                    <li>Gestão básica de CRM;</li>
                                    <li>Suporte via email;</li>
                                    <li>Integração com WhatsApp;</li>
                                    <li>Relatórios básicos.</li>
                                </ul>
                                <a href="register.php" type="button" class="btn btn-primary">Migrar</a>
                            </div>
                        </div>
                    </div>
                    <div class="col d-inline-block shadow-lg p-3 mb-5 bg-body-tertiary rounded-5">
                        <div class="bg-body-tertiary">
                            <img src="../../src/essentialPlan.png" alt="">
                            <h1 class="fs-4 text-center">Essencial</h1>
                            <h1 class="fs-5 text-center">R$ 99,90/mês</h1>
                        </div>
                        <div class="bg-body-primary">
                            <div class="dashCard">
                                <br>
                                <ul>
                                    <li>Tudo do Plano Básico;</li>
                                    <li>Integração com Instagram;</li>
                                    <li>Gestão de vendas;</li>
                                    <li>Relatórios avançados;</li>
                                </ul>
                                <a href="register.php" type="button" class="btn btn-primary">Migrar</a>
                            </div>
                        </div>
                    </div>
                    <div class="col d-inline-block shadow-lg p-3 mb-5 bg-body-tertiary rounded-5">
                        <div class="bg-body-tertiary">
                            <img src="../../src/profPlan.png" alt="">
                            <h1 class="fs-4 text-center">Profissional</h1>
                            <h1 class="fs-5 text-center">R$ 199,90/mês</h1>
                        </div>
                        <div class="bg-body-primary">
                            <div class="dashCard">
                                <br>
                                <ul>
                                    <li>Tudo do Plano Essencial;</li>
                                    <li>Automação de tarefas;</li>
                                    <li>Análise de dados e insights;</li>
                                    <li>Suporte prioritário.</li>
                                </ul>
                                <a href="register.php" type="button" class="btn btn-primary">Migrar</a>
                            </div>
                        </div>
                    </div>
                    <div class="col d-inline-block shadow-lg p-3 mb-5 bg-body-tertiary rounded-5">
                        <div class="bg-body-tertiary">
                            <img src="../../src/corporativePlan.png" alt="">
                            <h1 class="fs-4 text-center">Empresarial</h1>
                            <h1 class="fs-5 text-center">R$ 399,90/mês</h1>
                        </div>
                        <div class="bg-body-primary">
                            <div class="dashCard">
                                <br>
                                <ul>
                                    <li>Tudo do Plano Profissional;</li>
                                    <li>Integração (API);</li>
                                    <li>Personalização;</li>
                                    <li>Treinamento inicial;</li>
                                </ul>
                                <input type="hidden" name="user_plan" value="basic">
                                <button type="submit" class="btn btn-primary">Migrar</button>
                            </div>
                        </div>
                </form>
            </div>
        </div>
    </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
    <script type="text/javascript" src="js/script.js"></script>
</body>

</html>