<?php
require_once('../db.php');
session_start();

setlocale(LC_ALL, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
    date_default_timezone_set('America/Boa_Vista');
$dataRegistrada = date('Y-m-d H:i:s');


if (isset($_POST['Enviar'])) {
    $nome_fornecedor = $_POST['nome_fornecedor'];
    $endereco_fornecedor = $_POST['endereco_fornecedor'];
    $telefone_fornecedor = $_POST['telefone_fornecedor'];
    $email = $_POST['email'];

    $IdFuncionario = $_SESSION['id'];
    $Categoria = "Inclusão";
    $Mensagem = $nome_fornecedor . " adicionado(a) com sucesso";


    $sql = "INSERT INTO fornecedores (nome_fornecedor, endereco_fornecedor, telefone_fornecedor, email) VALUES ('$nome_fornecedor','$endereco_fornecedor','$telefone_fornecedor','$email')";

    

    $result = mysqli_query($conn, $sql);
    

    if ($result) {
        $sql2 = "INSERT INTO historico_acoes_fornecedores (funcionario_id, categoria, acao, dataRegistrada, dadoAnterior, dadoAlterado
        ) VALUES (
            '$IdFuncionario', '$Categoria', '$Mensagem', '$dataRegistrada', 'Nenhum', 'Nenhum')";
        $result2 = mysqli_query($conn, $sql2);
        if($result2){
            header("Location: suppliers.php");
        } 
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <link href="../assets/img/favicon.png" rel="icon">
    <link href="../assets/img/apple-touch-icon.png" rel="apple-touch-icon">


    <title>Cadastro de Fornecedor</title>
    <!-- Seus links CSS -->
    <link href="../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="../assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="../assets/vendor/quill/quill.snow.css" rel="stylesheet">
    <link href="../assets/vendor/quill/quill.bubble.css" rel="stylesheet">
    <link href="../assets/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="../assets/vendor/simple-datatables/style.css" rel="stylesheet">
    <!-- Seus links JavaScript -->
    <script src="../assets/vendor/apexcharts/apexcharts.min.js"></script>
    <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/vendor/chart.js/chart.umd.js"></script>
    <script src="../assets/vendor/echarts/echarts.min.js"></script>
    <script src="../assets/vendor/quill/quill.min.js"></script>
    <script src="../assets/vendor/simple-datatables/simple-datatables.js"></script>
    <script src="../assets/vendor/tinymce/tinymce.min.js"></script>
    <script src="../assets/vendor/php-email-form/validate.js"></script>
    <!-- Seu estilo CSS principal -->
    <link href="../assets/css/style.css" rel="stylesheet">

</head>

<body>
    <main id="main" class="main">


        <!-- Formulário de Inserção -->
        <section class="section">
            <div class="row">
                <div class="col-lg-20">

                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Cadastro de Fornecedor</h5>
                            <br>




                            <form method="POST" action="" enctype="multipart/form-data">

                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label">Nome</label>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control nome_fornecedor" name="nome_fornecedor"
                                            placeholder="Nome do Fornecedor">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label">Endereço</label>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control endereco_fornecedor"
                                            name="endereco_fornecedor" placeholder="Endereço do Fornecedor">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label">Telefone</label>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control telefone_fornecedor"
                                            name="telefone_fornecedor" placeholder="Telefone do Fornecedor">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label">Email</label>
                                    <div class="col-sm-4">
                                        <input type="email" class="form-control email" name="email"
                                            placeholder="Email do Fornecedor">
                                    </div>
                                </div>



                                <div class="row mb-4"></div>
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label"></label>
                                    <div class="col-sm-3">

                                        <button type="submit" name="Enviar" class="btn btn-success">Cadastrar</button>
                                        <a href="suppliers.php"><input type="button" value="Voltar"
                                                class="btn btn-primary"></a>
                                    </div>
                                </div>



                            </form>
                        </div>
                    </div>

                </div>


            </div>
            </div>
            </div>
            </div>
            <script src="<?php echo $url ?>assets/vendor/apexcharts/apexcharts.min.js"></script>
            <script src="<?php echo $url ?>assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
            <script src="<?php echo $url ?>assets/vendor/chart.js/chart.umd.js"></script>
            <script src="<?php echo $url ?>assets/vendor/echarts/echarts.min.js"></script>
            <script src="<?php echo $url ?>assets/vendor/quill/quill.min.js"></script>
            <script src="<?php echo $url ?>assets/vendor/simple-datatables/simple-datatables.js"></script>
            <script src="<?php echo $url ?>assets/vendor/tinymce/tinymce.min.js"></script>
            <script src="<?php echo $url ?>assets/vendor/php-email-form/validate.js"></script>

            <!-- Template Main JS File -->
            <script src="<?php echo $url ?>assets/js/main.js"></script>


            <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.10/jquery.mask.js"></script>


            <script>
                $(document).ready(function () {
                    // Adicione a máscara de CPF ao campo de input
                    $('.telefone_fornecedor').mask('(00) 00000-0000', { reverse: false });

                });
            </script>


    </main>
</body>

</html>