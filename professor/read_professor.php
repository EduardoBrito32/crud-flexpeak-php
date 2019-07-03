<?php
    require '../banco/banco.php';
    $id = null;
    if(!empty($_GET['id_professor']))
    {
        $id = $_REQUEST['id_professor'];
    }

    if(null==$id)
    {
        header("Location: index_professor.php");
    }
    else
    {
       $pdo = Banco::conectar();
       $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
       $sql = "SELECT * FROM professor where id_professor = ?";
       $q = $pdo->prepare($sql);
       $q->execute(array($id));
       $data = $q->fetch(PDO::FETCH_ASSOC);
       Banco::desconectar();
    }
?>

    <!DOCTYPE html>
    <html lang="pt-br">

    <head>
        <meta charset="utf-8">
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
        <title>Informações do Contato</title>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.5/jspdf.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.min.js"></script>

    </head>

    <body>
        <div  id="geraPDF" class="container">
            <div class="span10 offset1">
                  <div class="card">
    								<div class="card-header">
                    <h3 class="well">Informações do Professor</h3>
                </div>
                <div class="container">
                <div class="form-horizontal">
                    <div class="control-group">
                        <label class="control-label font-weight-bold">Nome:</label>
                        <div class="controls">
                            <label class="carousel-inner">
                                <?php echo $data['nome'];?>
                            </label>
                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label font-weight-bold">data de nascimento:</label>
                        <div class="controls">
                            <label class="carousel-inner">
                                <?php echo $data['data_nascimento'];?>
                            </label>
                        </div>
                    </div>

                    <br/>
                    <div class="form-actions">
                        <a href="index_professor.php" type="btn" class="btn btn-default">Voltar</a>
                        <button class="btn btn-danger" id="btnPDF">Gerar PDF</button>
                    </div>
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

    
<script type='text/javascript'>
$(document).ready(function(){
    $('#btnPDF').click(function() {
        var doc = new jsPDF('landscape');
        doc.addHTML($('#geraPDF'), function() {
        doc.save("relatorio_aluno_<?php echo $data['nome'] ?>.pdf");
        });
    });
});
</script>
    </html>
