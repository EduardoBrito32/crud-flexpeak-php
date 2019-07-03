<?php ob_start(); ?>
<?php

	require '../banco/banco.php';

	$id = null;
	if ( !empty($_GET['id_professor']))
            {
		$id = $_REQUEST['id_professor'];
            }

	if ( null==$id )
            {
		header("Location: index_professor.php");
            }

	if ( !empty($_POST))
            {

                $nomeErro = null;
                $dataNascimentoErro = null;
        
                $nome = $_POST['nome'];
                $dataNascimento = $_POST['dataNascimento'];        

		//Validação
		$validacao = true;
		if (empty($nome))
                {
                    $nomeErro = 'Por favor preenche o campo!';
                    $validacao = false;
                }

                elseif (empty($dataNascimento))
                {
                    $dataNascimentoErro = 'Por favor preenche o campo!';
                    $validacao = false;
                }

		// update data
		if ($validacao)
                {
                    $pdo = Banco::conectar();
                    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    $sql = "UPDATE professor  set nome = ?,data_nascimento = ? WHERE id_professor = ?";
                    $q = $pdo->prepare($sql);
                    $q->execute(array($nome,$dataNascimento,$id));
                    Banco::desconectar();
                    header("Location: index_professor.php");
		}
	}
        else
            {
                $pdo = Banco::conectar();
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "SELECT * FROM professor where id_professor = ?";
		$q = $pdo->prepare($sql);
		$q->execute(array($id));
		$data = $q->fetch(PDO::FETCH_ASSOC);
        
        $nome = $data['nome'];
        $dataNascimento = $data['data_nascimento'];
        
        Banco::desconectar();
	}
?>

    <!DOCTYPE html>
    <html lang="pt-br">

    <head>
        <meta charset="utf-8">
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
				<title>Atualizar Professor</title>
                
    </head>

    <body>
        <div class="container">

            <div class="span10 offset1">
							<div class="card">
								<div class="card-header">
                    <h3 class="well"> Atualizar Professor </h3>
                </div>
								<div class="card-body">
                <form class="form-horizontal" action="update_professor.php?id_professor=<?php echo $id?>" method="post">

                    <div class="control-group <?php echo !empty($nomeErro)?'error':'';?>">
                        <label class="control-label">Nome</label>
                        <div class="controls">
                            <input name="nome" class="form-control" size="50" type="text" placeholder="Nome" value="<?php echo !empty($nome)?$nome:'';?>">
                            <?php if (!empty($nomeErro)): ?>
                                <span class="help-inline"><?php echo $nomeErro;?></span>
                                <?php endif; ?>
                        </div>
                    </div>

                    <div class="control-group <?php echo !empty($dataNascimento)?'error':'';?>">
                        <label class="control-label">data de nascimetno</label>
                        <div class="controls">
                            <input name="dataNascimento" class="form-control" size="40" type="date" value="<?php echo !empty($dataNascimento)?$dataNascimento:'';?>">
                            <?php if (!empty($dataNascimentoErro)): ?>
                                <span class="help-inline"><?php echo $dataNascimentoErro;?></span>
                                <?php endif; ?>
                        </div>
                    </div>


                    <br/>
                    <div class="form-actions">
                        <button type="submit" class="btn btn-warning">Atualizar</button>
                        <a href="index_curso.php" type="btn" class="btn btn-default">Voltar</a>
                    </div>
                </form>
							</div>
						</div>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <!-- Latest compiled and minified JavaScript -->
        <script src="../assets/js/bootstrap.min.js"></script>
    </body>

    </html>