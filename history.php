<?php

require_once('db.php');

?>

<div class="card recent-sales overflow-auto">
    <div class="card-body">
        <h5 class="card-title">Histórico</h5>


        <table class="table table-borderless datatable">
            <thead>
                <tr>
                    <th scope="col">Data e Hora</th>
                    <th scope="col">Usuário</th>
                    <th scope="col">Categoria</th>
                    <th scope="col">Ação</th>
                    <th scope="col">Dado Anterior</th>
                    <th scope="col">Dado Alterado</th>
                </tr>
            </thead>
            <tbody>

                <?php
                // Sql das tabela Historico
                $sql2 = "SELECT *, funcionarios.nomeFuncionario as 'Funcionário' FROM historico_acoes INNER JOIN funcionarios on funcionarios.id = historico_acoes.funcionario_id ORDER BY historico_acoes.id DESC";

                $result2 = mysqli_query($conn, $sql2);
                if (mysqli_num_rows($result2)) {
                    while ($row2 = mysqli_fetch_assoc($result2)) {

                        ?>

                        <tr>
                            <td><i>
                                    <?php echo date('d/m/Y H:i:s', strtotime($row2['dataRegistrada'])) ?>
                                </i></td>
                            <td><i>
                                    <?php echo $row2['Funcionário'] ?>
                                </i></td>
                            <td><i>
                                    <?php echo $row2['categoria'] ?>
                                </i></td>
                            <td><i>
                                    <?php echo $row2['acao'] ?>
                                </i></td>
                            <td><i>
                                    <?php 
                                        
                                        echo $row2['dadoAnterior'];                                   
                                    ?>
                                </i></td>
                            <td><i>
                                    <?php echo $row2['dadoAlterado'] ?>
                                </i></td>
                        </tr>
                        <?php
                    }
                }
                ?>
            </tbody>
        </table>
    </div>
</div>