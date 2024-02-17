<?php
require_once('../db.php');
session_start();

setlocale(LC_ALL, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
date_default_timezone_set('America/Boa_Vista');
$dataRegistrada = date('Y-m-d H:i:s');


if (isset($_POST['Enviar'])) {
    $nome_produto = $_POST['nome_produto'];
    $descricao_produto = $_POST['descricao_produto'];
    $preco_produto = $_POST['preco_produto'];
    $quantidade_estoque = $_POST['quantidade_estoque'];
    $id_fornecedor = $_POST['id_fornecedor'];

    $IdFuncionario = $_SESSION['id'];
    $Categoria = "Inclusão";
    $Mensagem = $nome_produto . " adicionado(a) com sucesso";

    $sql = "INSERT INTO produtos (nome_produto, descricao_produto, preco_produto, quantidade_estoque, id_fornecedor) VALUES ('$nome_produto','$descricao_produto','$preco_produto','$quantidade_estoque','$id_fornecedor')";

    $result = mysqli_query($conn, $sql);

    if ($result) {
        $sql2 = "INSERT INTO historico_acoes (funcionario_id, categoria, acao, dataRegistrada, dadoAnterior, dadoAlterado) VALUES ('$IdFuncionario', '$Categoria', '$Mensagem', '$dataRegistrada', 'Nenhum', 'Nenhum')";
        $result2 = mysqli_query($conn, $sql2);
        if ($result2) {
            header("Location: ../index.php");
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


    <title>Cadastro de Produto</title>
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
                            <h5 class="card-title">Cadastro de Produto</h5>
                            <br>




                            <form method="POST" action="" enctype="multipart/form-data">

                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label">Nome</label>
                                    <div class="col-sm-3">
                                        <input type="text" class="form-control nome_produto" name="nome_produto"
                                            placeholder="Nome do Produto">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label">Descrição</label>
                                    <div class="col-sm-4">
                                        <textarea type="text" class="form-control descricao_produto"
                                            name="descricao_produto" placeholder="Descrição do Produto"></textarea>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label">Preço</label>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control preco_produto" name="preco_produto"
                                            placeholder="Preço Unitário do Produto">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label">Quantidade</label>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control quantidade_estoque"
                                            name="quantidade_estoque" placeholder="Quantidade em Estoque">
                                    </div>
                                </div>
                                <div class="row mb-3">

                                    <label class="col-sm-2 col-form-label">Fornecedor</label>
                                    <div class="col-sm-3">
                                        <select class="form-select" aria-label="Default select example"
                                            name="id_fornecedor">
                                            <option value=""> - Selecione uma opção - </option>
                                            <?php
                                            $sqlFornecedor = "SELECT * FROM fornecedores";
                                            $result = mysqli_query($conn, $sqlFornecedor);
                                            if (mysqli_num_rows($result)) {
                                                while ($rowFornecedor = mysqli_fetch_assoc($result)) {
                                                    ?>
                                                    <option value="<?php echo $rowFornecedor['id'] ?>">
                                                        <?php echo $rowFornecedor['nome_fornecedor'] ?>
                                                    </option>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="row mb-4"></div>
                                    <div class="row mb-3">
                                        <label class="col-sm-2 col-form-label"></label>
                                        <div class="col-sm-3">

                                            <button type="submit" name="Enviar"
                                                class="btn btn-success">Cadastrar</button>
                                            <a href="../index.php"><input type="button" value="Voltar"
                                                    class="btn btn-primary"></a>
                                        </div>
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
            <script
                src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/5.0.6/jquery.inputmask.min.js"></script>


            <script>
                $(document).ready(function () {
                    $('.preco_produto').mask('R$0000', { reverse: false });
                });
            </script>


    </main>
</body>

</html>