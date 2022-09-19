<?php session_start(); ?>
<?php if (isset($_SESSION["nome_usuario"])) : ?>

    <?php
    require_once("chamado/ChamadoController.php");
    $chamado_control = new ChamadoController();
    if (count($_POST) > 0) {
        $resultado = $chamado_control->cadastrar($_POST);
    }
    ?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Chamado</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    </head>

    <body>
        <div class="container">
            <form action="chamadoaberto.php" method="POST">
                <h2>Solicitação de chamados:</h2>
                <br />
                <div class="form-group">
                    <label for="nome_chamadoaberto">Nome do funcionário:</label>
                    <input type="text" required class="form-control" name="nome_chamadoaberto" id="nome_chamadoaberto">
                </div>
                <div class="form-group">
                    <label for="setor_chamadoaberto">Setor:</label>
                    <input type="text" required class="form-control" name="setor_chamadoaberto" id="setor_chamadoaberto">
                </div>
                <div class="form-group">
                    <label for="grau_chamadoaberto">Grau de urgência:</label>
                    <input type="number" required class="form-control" name="grau_chamadoaberto" id="grau_chamadoaberto">
                </div>
                <div class="form-group">
                    <label for="info_chamadoaberto">Informações adicionais:</label>
                    <textarea class="form-control" name="info_chamadoaberto" id="info_chamadoaberto" rows="4" cols="50"></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Adicionar chamado</button>
                <?php if (isset($resultado)) : ?>
                    <div class="alert <?= $resultado["style"] ?>">
                        <?php echo $resultado["msg"]; ?>
                    </div>
                <?php endif; ?>
            </form>
            <br /><br /><br />

            <?php $chamados = $chamado_control->selecionar(); ?>
            <?php if (count($chamados) > 0) : ?>
                <h4>Histórico de chamados:</h4>

                <table id="tab_chamado" class="table">
                    <tr>
                        <th>Cód.</th>
                        <th>Funcionário</th>
                        <th>Setor</th>
                        <th>Grau</th>
                        <th>Info adicional</th>
                        <th>Data hora</th>
                        <th></th>
                    </tr>

                    <?php foreach ($chamados as $p) : ?>
                        <tr id="chamado<?= $p['codigo'] ?>">
                            <td><?= $p["codigo"]; ?></td>
                            <td><?= $p["funcionario"]; ?></td>
                            <td><?= $p["setor"]; ?></td>
                            <td><?= $p["grau"]; ?></td>
                            <td><?= $p["info_adicional"]; ?></td>
                            <td><?= $p["data_hora"]; ?></td>
                            <td>
                                <a class="btn btn-outline-warking btn-sm" href="chamado_alterar.php?cod_cham=<?= $p['codigo'] ?>">Editar</a>
                                <a class="btn btn-outline-danger btn-sm" onclick="removerChamado('<?= $p['funcionario'] ?>', <?= $p['codigo'] ?>)">Remover</a>
                            </td>
                        </tr>

                    <?php endforeach; ?>
                </table>
            <?php endif; ?>
        </div>
    </body>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script>
        
        function removerChamado(nomeChamado, codChamado) {
            if (confirm('Remover' + nomeChamado + '?')) {
                //ajax
                var ajax = new XMLHttpRequest();
                ajax.responseType = "json"; //chave-valor
                ajax.open("GET", "chamado_remover.php?cod_cham=" + codChamado, true);
                ajax.send();
                ajax.addEventListener("readystatechange", function() {
                    if (ajax.status === 200 && ajax.readyState === 4) {
                        resposta = ajax.response.msg;
                        alert(resposta);
                        var linha = document.getElementById("chamado" + codChamado);
                        linha.parentNode.removeChild(linha);
                    }
                });
            }
        }
    </script>

    </html>

<?php else : ?>
    <div class="alert alert-danger">
        Você não está logado no sistema.
    </div>
<?php endif; ?>