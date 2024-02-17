<!DOCTYPE html>
<html lang="pt-BR">
<?php
include("../db.php");

if (isset($_POST['password']) || isset($_POST['nomeFuncionario'])) {

    if (strlen($_POST['nomeFuncionario']) == 0) {

        echo 'Preencha seu username';

    } else if (strlen($_POST['password']) == 0) {

        echo 'Preencha sua senha';

    } else {

        $nomeFuncionario = mysqli_real_escape_string($conn, $_POST['nomeFuncionario']);
        $password = mysqli_real_escape_string($conn, $_POST['password']);


        $sql_code = "SELECT * FROM funcionarios WHERE nomeFuncionario='$nomeFuncionario' AND password = '$password'";
        $sql_query = mysqli_query($conn, $sql_code) or die("Falha na execução do código SQL: " . mysqli_error($conn));

        $quantidade = $sql_query->num_rows;

        if ($quantidade == 1) {
            $usuario = $sql_query->fetch_assoc();

            if (!isset($_SESSION)) {
                session_start();
            }

            $_SESSION['id'] = $usuario['id'];
            $_SESSION['nomeFuncionario'] = $usuario['nomeFuncionario'];

            header("Location: ../index.php");

        } else {
            echo "Falha ao logar! E-mail ou senha incorretos";
        }

    }

}

?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Funcionários</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="../assets/img/favicon.png" rel="icon">
    <link href="../assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="../assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="../assets/vendor/quill/quill.snow.css" rel="stylesheet">
    <link href="...assets/vendor/quill/quill.bubble.css" rel="stylesheet">
    <link href="../assets/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="../assets/vendor/simple-datatables/style.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="../assets/css/style.css" rel="stylesheet">
</head>

<body>
    <main>
        <div style="background-color: lightgray" class="container1">
            <section
                class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
                <div style="background-color: lightgray" class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

                            <div class="d-flex justify-content-center py-4">
                                <a href="#" class="logo d-flex align-items-center w-auto">
                                    <img src="../assets/img/logo.png" alt="">
                                    <span class="d-none d-lg-block">Funcionários</span>
                                </a>
                            </div>
                            <div class="card mb-3">
                                <div  class="card-body">
                                    <div class="pt-4 pb-2">
                                        <h5 class="card-title text-center pb-0 fs-4">
                                            Login
                                        </h5>
                                        
                                    </div>

                                    <form method="POST" action="" class="row g-3 needs-validation" novalidate>
                                        <div class="col-12">
                                            <label for="yourUsername" class="form-label">Username</label>
                                            <div class="input-group has-validation">                                                
                                                <input style="background-color: lightgray" type="text" name="nomeFuncionario" class="form-control"
                                                    id="yourUsername" placeholder="Username" required>
                                                <div class="invalid-feedback">Please enter your username.</div>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <label for="yourPassword" class="form-label">Password</label>
                                            <input style="background-color: lightgray" type="password" name="password" class="form-control"
                                                id="yourPassword" placeholder="*******" required>
                                            <div class="invalid-feedback">Please enter your password!</div>
                                        </div>
                                        <div class="col-12"></div>
                                        
                                        <div class="col-12">
                                            <button class="btn btn-primary w-100" type="submit">Login</button>
                                        </div>                                        

                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </main>
</body>

</html>