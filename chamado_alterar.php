<?php session_start(); ?>
<?php if (isset($_SESSION["nome_usuario"])) : ?>
   
   <?php
    require_once("chamado/ChamadoController.php");
    $chamado_control = new ChamadoController();
    ?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Chamado</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    </head>

    <body>
        <div class="container">
            <?php
            $cod_cham = $_GET["cod_cham"];
            $chamados = $chamado_control->selecionar($cod_cham);
            ?>
            <form action="alterar_chamadoaberto.php" method="POST">
                <h2>Chamados</h2>
                <br />
                <div class="form-group">
                    <label for="nome_chamadoaberto">Código do chamado:</label>
                    <input type="text" required readonly value="<?= $chamados[0]['codigo']; ?>" class="form-control" name="cod_cham" id="cod_cham">
                </div>
                <div class="form-group">
                    <label for="nome_chamadoaberto">Nome do funcionário:</label>
                    <input type="text" required value="<?= $chamados[0]['funcionario']; ?>" class="form-control" name="nome_chamadoaberto" id="nome_chamadoaberto">
                </div>
                <div class="form-group">
                    <label for="setor_chamadoaberto">Setor:</label>
                    <input type="text" required value="<?= $chamados[0]['setor']; ?>" class="form-control" name="setor_chamadoaberto" id="setor_chamadoaberto">
                </div>
                <div class="form-group">
                    <label for="grau_chamadoaberto">Grau de urgência:</label>
                    <input type="number" required value="<?= $chamados[0]['grau']; ?>" class="form-control" name="grau_chamadoaberto" id="grau_chamadoaberto">
                </div>
                <div class="form-group">
                    <label for="info_chamadoaberto">Informações adicionais:</label>
                    <textarea class="form-control" name="info_chamadoaberto" id="info_chamadoaberto" rows="4" cols="50"><?= $chamados[0]['info_adicional']; ?></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Alterar chamado</button>
                <br />
            </form>
            <?php if (isset($resultado)) : ?>
                <div class="alert <?= $resultado["style"] ?>">
                    <?php echo $resultado["msg"]; ?>
                </div>
            <?php endif; ?>
            <br /><br /><br />

        </div>
        <br /><br /><br /><br /><br /><br /><br /><br /><br /><br />
    </body>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    </html>

<?php else : ?>
    <div class="alert alert-danger">
        Você não está logado no sistema.
    </div>
<?php endif; ?>