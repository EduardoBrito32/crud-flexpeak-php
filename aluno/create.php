<?php ob_start(); ?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <!-- Latest compiled and minified CSS -->
  <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
  <title>Adicionar Aluno</title>
  
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
        <div clas="span10 offset1">
          <div class="card">
            <div class="card-header">
                <h3 class="well"> Adicionar Aluno </h3>
            </div>
            <div class="card-body">
            <form class="form-horizontal" action="create.php" method="post">

                <div class="control-group <?php echo !empty($nomeErro)?'error ' : '';?>">
                    <label class="control-label">Nome</label>
                    <div class="controls">
                        <input size="50" class="form-control" name="nome" type="text" placeholder="Nome" required="" value="<?php echo !empty($nome)?$nome: '';?>">
                        <?php if(!empty($nomeErro)): ?>
                            <span class="help-inline"><?php echo $nomeErro;?></span>
                            <?php endif;?>
                    </div>
                </div>

                <div class="control-group <?php echo !empty($cepErro)?'error ': '';?>">
                    <label class="control-label">Cep</label>
                    <div class="controls">
                        <input size="40" class="form-control" id="cep" name="cep" type="text" placeholder="cep" required="" value="<?php echo !empty($cep)?$cep: '';?>">
                        <?php if(!empty($cepErro)): ?>
                            <span class="help-inline"><?php echo $cepErro;?></span>
                            <?php endif;?>
                    </div>
                </div>

                <div class="control-group <?php echo !empty($logradouroErro)?'error ': '';?>">
                    <label class="control-label">logradouro</label>
                    <div class="controls">
                        <input size="80" class="form-control" id="rua" name="logradouro" type="text" placeholder="logradouro" required="" value="<?php echo !empty($logradouro)?$logradouro: '';?>">
                        <?php if(!empty($logradouroErro)): ?>
                            <span class="help-inline"><?php echo $logradouroErro;?></span>
                            <?php endif;?>
                    </div>
                </div>

                <div class="control-group <?php echo !empty($numeroErro)?'error ': '';?>">
                    <label class="control-label">numero</label>
                    <div class="controls">
                        <input size="35" class="form-control" name="numero" type="text" placeholder="numero" required="" value="<?php echo !empty($numero)?$numero: '';?>">
                        <?php if(!empty($numeroErro)): ?>
                            <span class="help-inline"><?php echo $numeroErro;?></span>
                            <?php endif;?>
                    </div>
                </div>

                <div class="control-group <?php echo !empty($bairroErro)?'error ': '';?>">
                    <label class="control-label">bairro</label>
                    <div class="controls">
                        <input size="40" class="form-control" id="bairro" name="bairro" type="text" placeholder="bairro" required="" value="<?php echo !empty($bairro)?$bairro: '';?>">
                        <?php if(!empty($bairroErro)): ?>
                            <span class="help-inline"><?php echo $bairroErro;?></span>
                            <?php endif;?>
                    </div>
                </div>

                <div class="control-group <?php echo !empty($cidade)?'error ': '';?>">
                    <label class="control-label">cidade</label>
                    <div class="controls">
                        <input size="40" class="form-control" id="cidade" name="cidade" type="text" placeholder="cidade" required="" value="<?php echo !empty($cidade)?$cidade: '';?>">
                        <?php if(!empty($cidadeErro)): ?>
                            <span class="help-inline"><?php echo $cidadeErro;?></span>
                            <?php endif;?>
                    </div>
                </div>

                <div class="control-group <?php echo !empty($estadoErro)?'error ': '';?>">
                    <label class="control-label">Estado</label>
                    <div class="controls">
                        <input size="40" class="form-control" name="estado" id="uf" type="text" placeholder="estado" required="" value="<?php echo !empty($estado)?$estado: '';?>">
                        <?php if(!empty($estadoErro)): ?>
                            <span class="help-inline"><?php echo $estadoErro;?></span>
                            <?php endif;?>
                    </div>
                </div>

                <div class="control-group <?php echo !empty($idCursoErro)?'error ': '';?>">
                    <label class="control-label">Curso</label>
                    <div class="controls">
                        <input size="40" class="form-control" name="idCurso" type="text" placeholder="id do curso" required="" value="<?php echo !empty($idCurso)?$idCurso: '';?>">
                        <?php if(!empty($idCursoErro)): ?>
                            <span class="help-inline"><?php echo $idCursoErro;?></span>
                            <?php endif;?>
                    </div>
                </div>

                <div class="control-group <?php echo !empty($dataNascimentoErro)?'error ': '';?>">
                    <label class="control-label">data de nascimento</label>
                    <div class="controls">
                        <input size="40" class="form-control" name="dataNascimento" type="date"  required="" value="<?php echo !empty($dataNascimento)?$dataNascimento: '';?>">
                        <?php if(!empty($dataNascimentoErro)): ?>
                            <span class="help-inline"><?php echo $dataNascimentoErro;?></span>
                            <?php endif;?>
                    </div>
                </div>

                <div class="form-actions">
                    <br/>

                    <button type="submit" class="btn btn-success">Adicionar</button>
                    <a href="index.php" type="btn" class="btn btn-default">Voltar</a>

                </div>
            </form>
          </div>
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

<?php
    require '../banco/banco.php';

    if(!empty($_POST))
    {
        //Acompanha os erros de validação
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

        //Validaçao dos campos:
        $validacao = true;
        if(empty($nome))
        {
            $nomeErro = 'Por favor digite o seu nome!';
            $validacao = false;
        }

        if(empty($logradouro))
        {
            $logradouroErro = 'Por favor digite o seu logradouro!';
            $validacao = false;
        }

        if(empty($numero))
        {
            $numeroErro = 'Por favor digite o número da sua casa!';
            $validacao = false;
        }

        if(empty($bairro))
        {
            $bairroErro = 'Por favor digite seu bairro';
            $validacao = false;
        }

        if(empty($cidade))
        {
            $cidadeErro = 'Por favor digite sua cidade';
            $validacao = false;
        }

        if(empty($estado))
        {
            $estadoErro = 'Por favor digite seu estado';
            $validacao = false;
        }

        if(empty($cep))
        {
            $cepErro = 'Por favor digite seu cep';
            $validacao = false;
        }

        if(empty($dataNascimento))
        {
            $dataNascimentoErro = 'Por favor digite sua data de nascimento';
            $validacao = false;
        }
        elseif (empty($idCurso))
        {
            $idCursoErro = 'Por favor escolha um curso!';
            $validacao = false;
        }

        //Inserindo no Banco:
        if($validacao)
        {
            $pdo = Banco::conectar();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "INSERT INTO pessoa (nome, logradouro,numero,bairro,cidade,estado,cep,data_nascimento,id_curso) VALUES(?,?,?,?,?,?,?,?,?)";
            $q = $pdo->prepare($sql);
            $q->execute(array($nome,$logradouro,$numero,$bairro,$cidade,$estado,$cep,$dataNascimento,$idCurso));
            Banco::desconectar();
            exit(header("Location: index.php"));
        }
    }
?>