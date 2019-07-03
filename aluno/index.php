<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <title>Página Inicial</title>
</head>

<body>
        <div class="container">
          <div class="jumbotron">
            <div class="row">
                <h2>Alunos</h2>
            </div>
          </div>
            </br>
            <div class="row">
                <p>
                    <a href="create.php" class="btn btn-success">Adicionar</a>
                    <a href="../index.php" type="btn" class="btn btn-default">Voltar</a>
                </p>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">Id</th>
                            <th scope="col">Nome</th>
                            <th scope="col">logradouro</th>
                            <th scope="col">numero</th>
                            <th scope="col">bairro</th>
                            <th scope="col">cidade</th>
                            <th scope="col">estado</th>
                            <th scope="col">cep</th>
                            <th scope="col">data de nascimento</th>
                            <th scope="col">curso</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        include '../banco/banco.php';
                        $pdo = Banco::conectar();
                        $sql = 'SELECT * FROM pessoa ORDER BY id_aluno DESC';

                        foreach($pdo->query($sql)as $row)
                        {
                            echo '<tr>';
			                      echo '<th scope="row">'. $row['id_aluno'] . '</th>';
                            echo '<td>'. $row['nome'] . '</td>';
                            echo '<td>'. $row['logradouro'] . '</td>';
                            echo '<td>'. $row['numero'] . '</td>';
                            echo '<td>'. $row['bairro'] . '</td>';
                            echo '<td>'. $row['cidade'] . '</td>';
                            echo '<td>'. $row['estado'] . '</td>';
                            echo '<td>'. $row['cep'] . '</td>';
                            echo '<td>'. $row['data_nascimento'] . '</td>';
                            echo '<td>'. $row['id_curso'] . '</td>';
                            echo '<td width=250>';
                            echo '<a class="btn btn-primary" href="read.php?id_aluno='.$row['id_aluno'].'">Info</a>';
                            echo ' ';
                            echo '<a class="btn btn-warning" href="update.php?id_aluno='.$row['id_aluno'].'">Atualizar</a>';
                            echo ' ';
                            echo '<a class="btn btn-danger" href="delete.php?id_aluno='.$row['id_aluno'].'">Excluir</a>';
                            echo '</td>';
                            echo '</tr>';
                        }
                        Banco::desconectar();
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    <script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <!-- Latest compiled and minified JavaScript -->
    <script src="../assets/js/bootstrap.min.js"></script>
</body>

</html>
