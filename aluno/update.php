<?php ob_start(); ?>
<?php

	require '../banco/banco.php';

	$id = null;
	if ( !empty($_GET['id_aluno']))
            {
		$id = $_REQUEST['id_aluno'];
            }

	if ( null==$id )
            {
		header("Location: index.php");
            }

	if ( !empty($_POST))
            {

                $nomeErro = null;
                $logradouroErro = null;
                $numeroErro = null;
                $bairroErro = null;
                $cidadeErro = null;
                $estadoErro = null;
                $cepErro = null;
                $dataNascimentoErro = null;
                $idCursoErro = null;
        
                $nome = $_POST['nome'];
                $logradouro = $_POST['logradouro'];
                $numero = $_POST['numero'];
                $bairro = $_POST['bairro'];
                $cidade = $_POST['cidade'];
                $estado = $_POST['estado'];
                $cep = $_POST['cep'];
                $dataNascimento = $_POST['dataNascimento'];
                $idCurso = $_POST['idCurso'];
        

		//Validação
		$validacao = true;
		if (empty($nome))
                {
                    $nomeErro = 'Por favor preenche o campo!';
                    $validacao = false;
                }

		if (empty($logradouro))
                {
                    $logradouro = 'Por favor preenche o campo!';
                    $validacao = false;
		}

                if (empty($numero))
                {
                    $numero = 'Por favor preenche o campo!';
                    $validacao = false;
		}

                if (empty($bairro))
                {
                    $bairro = 'Por favor preenche o campo!';
                    $validacao = false;
        }
        
        if (empty($cidade))
                {
                    $cidade = 'Por favor preenche o campo!';
                    $validacao = false;
                }

		if (empty($estado))
                {
                    $estado = 'Por favor preenche o campo!';
                    $validacao = false;
		}

                if (empty($cep))
                {
                    $cep = 'Por favor preenche o campo!';
                    $validacao = false;
		}

                if (empty($dataNascimento))
                {
                    $dataNascimento = 'Por favor preenche o campo!';
                    $validacao = false;
        }
        if (empty($idCurso))
                {
                    $idCurso = 'Por favor preenche o campo!';
                    $validacao = false;
		}


		// update data
		if ($validacao)
                {
                    $pdo = Banco::conectar();
                    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    $sql = "UPDATE pessoa  set nome = ?, logradouro = ?, numero = ?, bairro = ?, cidade = ?, estado = ?, cep = ?, data_nascimento = ?, id_curso = ? WHERE id_aluno = ?";
                    $q = $pdo->prepare($sql);
                    $q->execute(array($nome,$logradouro,$numero,$bairro,$cidade,$estado,$cep,$dataNascimento,$idCurso,$id));
                    Banco::desconectar();
                    header("Location: index.php");
		}
	}
        else
            {
                $pdo = Banco::conectar();
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "SELECT * FROM pessoa where id_aluno = ?";
		$q = $pdo->prepare($sql);
		$q->execute(array($id));
		$data = $q->fetch(PDO::FETCH_ASSOC);
        
        $nome = $data['nome'];
        $logradouro = $data['logradouro'];
        $numero = $data['numero'];
		$bairro = $data['bairro'];
		$cidade = $data['cidade'];
        $estado = $data['estado'];
        $cep = $data['cep'];
        $dataNascimento = $data['data_nascimento'];
        $idCurso = $data['id_curso'];
        
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
                
    <!-- Adicionando JQuery -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"
            integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
            crossorigin="anonymous"></script>

    <!-- Adicionando Javascript -->
    <script type="text/javascript" >

        $(document).ready(function() {

            function limpa_formulário_cep() {
                // Limpa valores do formulário de cep.
                $("#rua").val("");
                $("#bairro").val("");
                $("#cidade").val("");
                $("#uf").val("");
            }
            
            //Quando o campo cep perde o foco.
            $("#cep").blur(function() {

                //Nova variável "cep" somente com dígitos.
                var cep = $(this).val().replace(/\D/g, '');

                //Verifica se campo cep possui valor informado.
                if (cep != "") {

                    //Expressão regular para validar o CEP.
                    var validacep = /^[0-9]{8}$/;

                    //Valida o formato do CEP.
                    if(validacep.test(cep)) {

                        //Preenche os campos com "..." enquanto consulta webservice.
                        $("#rua").val("...");
                        $("#bairro").val("...");
                        $("#cidade").val("...");
                        $("#uf").val("...");
                        
                        //Consulta o webservice viacep.com.br/
                        $.getJSON("https://viacep.com.br/ws/"+ cep +"/json/?callback=?", function(dados) {

                            if (!("erro" in dados)) {
                                //Atualiza os campos com os valores da consulta.
                                $("#rua").val(dados.logradouro);
                                $("#bairro").val(dados.bairro);
                                $("#cidade").val(dados.localidade);
                                $("#uf").val(dados.uf);
                            } //end if.
                            else {
                                //CEP pesquisado não foi encontrado.
                                limpa_formulário_cep();
                                alert("CEP não encontrado.");
                            }
                        });
                    } //end if.
                    else {
                        //cep é inválido.
                        limpa_formulário_cep();
                        alert("Formato de CEP inválido.");
                    }
                } //end if.
                else {
                    //cep sem valor, limpa formulário.
                    limpa_formulário_cep();
                }
            });
        });

    </script>
    </head>

    <body>
        <div class="container">

            <div class="span10 offset1">
							<div class="card">
								<div class="card-header">
                    <h3 class="well"> Atualizar Contato </h3>
                </div>
								<div class="card-body">
                <form class="form-horizontal" action="update.php?id_aluno=<?php echo $id?>" method="post">

                    <div class="control-group <?php echo !empty($nomeErro)?'error':'';?>">
                        <label class="control-label">Nome</label>
                        <div class="controls">
                            <input name="nome" class="form-control" size="50" type="text" placeholder="Nome" value="<?php echo !empty($nome)?$nome:'';?>">
                            <?php if (!empty($nomeErro)): ?>
                                <span class="help-inline"><?php echo $nomeErro;?></span>
                                <?php endif; ?>
                        </div>
                    </div>
                    
                    <div class="control-group <?php echo !empty($cep)?'error':'';?>">
                        <label class="control-label">cep</label>
                        <div class="controls">
                            <input name="cep" class="form-control" id="cep" size="40" type="text" placeholder="Cep" value="<?php echo !empty($cep)?$cep:'';?>">
                            <?php if (!empty($cepErro)): ?>
                                <span class="help-inline"><?php echo $cepErro;?></span>
                                <?php endif; ?>
                        </div>
                    </div>

                    <div class="control-group <?php echo !empty($logradouroErro)?'error':'';?>">
                        <label class="control-label">Logradouro</label>
                        <div class="controls">
                            <input name="logradouro" class="form-control" id="rua" size="80" type="text" placeholder="Logradouro" value="<?php echo !empty($logradouro)?$logradouro:'';?>">
                            <?php if (!empty($logradouroErro)): ?>
                                <span class="help-inline"><?php echo $logradouroErro;?></span>
                                <?php endif; ?>
                        </div>
                    </div>

                    <div class="control-group <?php echo !empty($numeroErro)?'error':'';?>">
                        <label class="control-label">numero</label>
                        <div class="controls">
                            <input name="numero" class="form-control" size="30" type="text" placeholder="numero" value="<?php echo !empty($numero)?$numero:'';?>">
                            <?php if (!empty($numeroErro)): ?>
                                <span class="help-inline"><?php echo $numeroErro;?></span>
                                <?php endif; ?>
                        </div>
                    </div>

                    <div class="control-group <?php echo !empty($bairro)?'error':'';?>">
                        <label class="control-label">Bairro</label>
                        <div class="controls">
                            <input name="bairro" class="form-control" id="bairro" size="40" type="text" placeholder="Bairro" value="<?php echo !empty($bairro)?$bairro:'';?>">
                            <?php if (!empty($bairroErro)): ?>
                                <span class="help-inline"><?php echo $bairroErro;?></span>
                                <?php endif; ?>
                        </div>
                    </div>

                    <div class="control-group <?php echo !empty($cidade)?'error':'';?>">
                        <label class="control-label">Cidade</label>
                        <div class="controls">
                            <input name="cidade" class="form-control" id="cidade" size="40" type="text" placeholder="Cidade" value="<?php echo !empty($cidade)?$cidade:'';?>">
                            <?php if (!empty($cidadeErro)): ?>
                                <span class="help-inline"><?php echo $cidadeErro;?></span>
                                <?php endif; ?>
                        </div>
                    </div>

                    <div class="control-group <?php echo !empty($estado)?'error':'';?>">
                        <label class="control-label">Estado</label>
                        <div class="controls">
                            <input name="estado" id="uf" class="form-control" size="40" type="text" placeholder="Estado" value="<?php echo !empty($estado)?$estado:'';?>">
                            <?php if (!empty($estadoErro)): ?>
                                <span class="help-inline"><?php echo $estadoErro;?></span>
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

                    <div class="control-group <?php echo !empty($idCurso)?'error':'';?>">
                        <label class="control-label">Id do curso</label>
                        <div class="controls">
                            <input name="idCurso" class="form-control" size="40" type="text" placeholder="Id do curso" value="<?php echo !empty($idCurso)?$idCurso:'';?>">
                            <?php if (!empty($idCursoErro)): ?>
                                <span class="help-inline"><?php echo $idCursoErro;?></span>
                                <?php endif; ?>
                        </div>
                    </div>

                    <br/>
                    <div class="form-actions">
                        <button type="submit" class="btn btn-warning">Atualizar</button>
                        <a href="index.php" type="btn" class="btn btn-default">Voltar</a>
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
