<?php
require_once('db.php');
session_start();
include("employees/protect.php");

?>


<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Controle de Estoque</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <link href="assets/img/favicon.png" rel="icon">
    <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    Google Fonts
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">

    Vendor CSS Files
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="assets/vendor/quill/quill.snow.css" rel="stylesheet">
    <link href="assets/vendor/quill/quill.bubble.css" rel="stylesheet">
    <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet">

    Template Main CSS File
    <link href="assets/css/style.css" rel="stylesheet">
</head>

<body>
    <!-- ======= Header ======= -->
    <header id="header" class="header fixed-top d-flex align-items-center">

        <div class="d-flex align-items-center justify-content-between">
            <i class="bi bi-list toggle-sidebar-btn"></i>
            <a style="margin-left: 5%; " href="index.php" class="logo d-flex align-items-center">
                <span class="d-none d-lg-block">Controle de Estoque</span>
            </a>
        </div><!-- End Logo -->

        <a style="margin-left: auto; margin-right: 10px" class="btn btn-danger" href="employees/logout.php"><i
                class="bi bi-box-arrow-right"></i></a>





    </header><!-- End Header -->

    <!-- ======= Sidebar ======= -->
    <aside id="sidebar" class="sidebar">

        <ul class="sidebar-nav" id="sidebar-nav">


            <li class="nav-item">
                <a style="background-color: lightgreen" class="nav-link " href="index.php">
                    <i class="bx bxs-cart"></i>
                    <span>Produtos</span>
                </a>
            </li><!-- End Dashboard Nav -->
            <li class="nav-item">
                <a class="nav-link " href="suppliers/suppliers.php">
                    <i class="bi bi-person"></i>
                    <span>Fornecedores</span>

                </a>

            </li><!-- End Dashboard Nav -->


        </ul>

    </aside><!-- End Sidebar-->

    <?php

    setlocale(LC_ALL, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
    date_default_timezone_set('America/Boa_Vista');
    $dataRegistrada = date('Y-m-d H:i:s');

    if (isset($_GET['delete'])) {
        $id = $_GET['delete'];
        $sql = "select * from produtos where id = '$id'";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $nome_produto = $row['nome_produto'];

            $IdFuncionario = $_SESSION['id'];
            $Categoria = "Exclusão";
            $Mensagem = $nome_produto . " excluído(a) com sucesso";

            $sql = "delete from produtos where id = '$id'";
            if (mysqli_query($conn, $sql)) {
                $sql2 = "INSERT INTO historico_acoes (funcionario_id, categoria, acao, dataRegistrada, dadoAnterior, dadoAlterado) VALUES ('$IdFuncionario', '$Categoria', '$Mensagem', '$dataRegistrada', 'Nenhum', 'Nenhum')";
                $result2 = mysqli_query($conn, $sql2);
                if ($result2) {
                    header("Location: index.php");
                } 
            }
        }
    }

    ?>

    <main id="main" class="main">

        <div class="col-12">
            <div class="card recent-sales overflow-auto">
                <div class="card-body">

                    <h5 class="card-title">Estoque de Produtos</h5>

                    <a href="products/create.php" class="btn btn-success">Adicionar Produto</a>

                    <table id="produtos" class="table table-borderless datatable">
                        <thead>
                            <tr>
                                <th scope="col">Nº</th>
                                <th scope="col">Nome</th>
                                <th scope="col">Descrição</th>
                                <th scope="col">Preço</th>
                                <th scope="col">Quantidade</th>
                                <th scope="col">Fornecedor</th>
                                <th scope="col">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $num_aut = 1;

                            $sql = "SELECT *, produtos.id as 'idProduto',  fornecedores.nome_fornecedor as 'Fornecedor' FROM produtos INNER JOIN fornecedores on fornecedores.id = produtos.id_fornecedor ORDER BY produtos.id ASC";

                            $result = mysqli_query($conn, $sql);

                            if (mysqli_num_rows($result)) {
                                while ($row = mysqli_fetch_assoc($result)) {
                                    ?>
                                    <tr>
                                        <td>
                                            <?php echo $num_aut; ?>
                                        </td>

                                        <td>
                                            <?php echo $row['nome_produto']; ?>
                                        </td>
                                        <td>
                                            <?php echo $row['descricao_produto'] ?>
                                        </td>
                                        <td>
                                            <?php echo $row['preco_produto'] ?>
                                        </td>
                                        <td>
                                            <?php echo $row['quantidade_estoque'] ?>
                                        </td>
                                        <td>
                                            <?php echo $row['Fornecedor'] ?>
                                        </td>

                                        <?php $num_aut++ ?>

                                        <td>

                                            <a href="products/show.php?id=<?php echo $row['idProduto'] ?>"
                                                class="btn btn-success"><i class="bi bi-eye"></i></a>
                                            <a href="products/edit.php?id=<?php echo $row['idProduto'] ?>"
                                                class="btn btn-info"><i class="bx bxs-pencil"></i></a>
                                            <a href="index.php?delete=<?php echo $row['idProduto'] ?>" class="btn btn-danger"
                                                onclick="return confirm('Are you sure to delete this record?')"><i
                                                    class="bx bxs-trash"></i></a>


                                        </td>

                                    </tr>
                                    <?php
                                }
                            }
                            ?>

                        </tbody>
                    </table>

                </div>

            </div>
            <?php include('history.php'); ?>
        </div>



        <script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
        <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="assets/vendor/chart.js/chart.umd.js"></script>
        <script src="assets/vendor/echarts/echarts.min.js"></script>
        <script src="assets/vendor/quill/quill.min.js"></script>
        <script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
        <script src="assets/vendor/tinymce/tinymce.min.js"></script>
        <script src="assets/vendor/php-email-form/validate.js"></script>

        <!-- Template Main JS File -->
        <script src="assets/js/main.js"></script>


    </main>


</body>

</html>