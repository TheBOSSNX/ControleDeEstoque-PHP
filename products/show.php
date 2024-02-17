<?php
require_once('../db.php');

$data = date('Y-m-d H:i:s');

if (isset($_GET['id'])) {

    $id = $_GET['id'];
    $sql = "SELECT * FROM produtos WHERE id = '$id'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result)) {
        $row = mysqli_fetch_assoc($result);
    } else {
        $errorMsg = "Produto NÃO ENCONTRADO";
        echo $errorMsg;
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


    <title>Visualização de Produto</title>
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
                            <h5 class="card-title">Detalhes do(a) <?php echo $row['nome_produto']?></h5>
                            <br>
                            <form method="POST" action="" enctype="multipart/form-data">

                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label">Nome</label>
                                    <div class="col-sm-3">
                                        <input type="text" class="form-control nome_produto" name="nome_produto"
                                            placeholder="Nome do Produto" value="<?php echo $row['nome_produto'] ?>" readonly disabled="">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label">Descrição</label>
                                    <div class="col-sm-4">
                                        <textarea type="text" class="form-control descricao_produto"
                                            name="descricao_produto"
                                            placeholder="Descrição do Produto" readonly disabled=""><?php echo $row['descricao_produto'] ?></textarea>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label">Preço</label>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control preco_produto" name="preco_produto"
                                            placeholder="Preço Unitário do Produto"
                                            value="<?php echo $row['preco_produto'] ?>" readonly disabled="">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label">Quantidade</label>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control quantidade_estoque"
                                            name="quantidade_estoque" placeholder="Quantidade em Estoque"
                                            value="<?php echo $row['quantidade_estoque'] ?>" readonly disabled="">
                                    </div>
                                </div>
                                <div class="row mb-3">

                                    <label class="col-sm-2 col-form-label">Fornecedor</label>
                                    <div class="col-sm-3">

                                        <?php $idFornecedor = $row['id_fornecedor']?>

                                        <select class="form-select" aria-label="Default select example"
                                            name="id_fornecedor" readonly disabled="">
                                            <?php 
                                                
                                                $sqlF = "SELECT * FROM fornecedores WHERE id like '%$idFornecedor%'";
                                                $resultF = mysqli_query($conn, $sqlF);
                                                if(mysqli_num_rows($resultF)) {
                                                    $rowF = mysqli_fetch_assoc($resultF);
                                                }
                                            ?>
                                            <option value="<?php echo $row['id_fornecedor']?>"> <?php echo $rowF['nome_fornecedor'] ?> </option>
                                            <?php
                                            $choosedOption = $rowF['nome_fornecedor'];
                                            $sqlFornecedor = "SELECT * FROM fornecedores WHERE nome_fornecedor <> '$choosedOption'";
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
                                        <label class="col-sm-3 col-form-label"></label>
                                        <div class="col-sm-3">
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


    </main>
</body>

</html>