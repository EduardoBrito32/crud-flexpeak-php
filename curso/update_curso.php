<?php ob_start(); ?>
<?php

	require '../banco/banco.php';

	$id = null;
	if ( !empty($_GET['id_curso']))
            {
		$id = $_REQUEST['id_curso'];
            }

	if ( null==$id )
            {
		header("Location: index_curso.php");
            }

	if ( !empty($_POST))
            {

                $nomeErro = null;
                $idProfessorErro = null;
                
                $nome = $_POST['nome'];
                $idProfessor = $_POST['id_professor'];
                
		//Validação
		$validacao = true;
		if (empty($nome))
                {
                    $nomeErro = 'Por favor preenche o campo!';
                    $validacao = false;
                }

		if (empty($idProfessor))
                {
                    $idProfessorErro = 'Por favor preenche o campo!';
                    $validacao = false;
		}

		// update data
		if ($validacao)
                {
                    $pdo = Banco::conectar();
                    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    $sql = "UPDATE curso  set nome = ?, id_professor = ? WHERE id_curso = ?";
                    $q = $pdo->prepare($sql);
                    $q->execute(array($nome,$idProfessor,$id));
                    Banco::desconectar();
                    header("Location: index_curso.php");
		}
	}
        else
            {
                $pdo = Banco::conectar();
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "SELECT * FROM curso where id_curso = ?";
		$q = $pdo->prepare($sql);
		$q->execute(array($id));
		$data = $q->fetch(PDO::FETCH_ASSOC);
        
        $nome = $data['nome'];
        $idProfessor = $data['id_professor'];
        
        Banco::desconectar();
	}
?>

    <!DOCTYPE html>
    <html lang="pt-br">

    <head>
        <meta charset="utf-8">
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
				<title>Atualizar Contato</title>
        
    </head>

    <body>
        <div class="container">

            <div class="span10 offset1">
							<div class="card">
								<div class="card-header">
                    <h3 class="well"> Atualizar Contato </h3>
                </div>
								<div class="card-body">
                <form class="form-horizontal" action="update_curso.php?id_curso=<?php echo $id?>" method="post">

                    <div class="control-group <?php echo !empty($nomeErro)?'error':'';?>">
                        <label class="control-label">Nome</label>
                        <div class="controls">
                            <input name="nome" class="form-control" size="50" type="text" placeholder="Nome" value="<?php echo !empty($nome)?$nome:'';?>">
                            <?php if (!empty($nomeErro)): ?>
                                <span class="help-inline"><?php echo $nomeErro;?></span>
                                <?php endif; ?>
                        </div>
                    </div>
                    
                    <div class="control-group <?php echo !empty($idProfessorErro)?'error':'';?>">
                        <label class="control-label">id do professor</label>
                        <div class="controls">
                            <input name="id_professor" class="form-control" id="cep" size="40" type="text" placeholder="professor" value="<?php echo !empty($idProfessor)?$idProfessor:'';?>">
                            <?php if (!empty($idProfessorErro)): ?>
                                <span class="help-inline"><?php echo $idProfessorErro;?></span>
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
