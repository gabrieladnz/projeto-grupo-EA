<?php session_start(); ?>
<?php if (isset($_SESSION["nome_usuario"])) : ?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Abrir chamado</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    </head>

    <body>
        <div class="container">
            <form action="cadastrar_chamado.php" method="POST">
                <h5>Olá, <?= $_SESSION["nome_usuario"]; ?>!
                    <h2>Abertura de chamado</h2>
                    <br />
                    <div class="form-group">
                        <label for="nome_setor">Setor:</label>
                        <input type="text" class="form-control" id="nome_setor" name="nome_setor" placeholder="Insira o setor">
                    </div>
                    <div class="form-group">
                        <label for="grau_setor">Grau de urgência:</label>
                        <input type="number" class="form-control" id="grau_setor" name="grau_setor" maxlength="4" placeholder="1) Não urgente 2) Pouco urgente 3) Urgente 4) Emergência">
                    </div>
                    <div class="form-group">
                        <label for="desc_setor">Descrição do problema:</label>
                        <input type="text" class="form-control" id="desc_setor" name="desc_setor">
                    </div>
                    <button type="submit" class="btn btn-primary">Solicitar</button>
                    <?php if (isset($resultado)) : ?>
                        <div class="alert <?= $resultado['style'] ?>">
                            <?php echo $resultado["msg"]; ?>
                        </div>
                    <?php endif; ?>
            </form>
        </div>
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