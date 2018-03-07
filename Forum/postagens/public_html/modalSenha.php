<?php include_once "modalSenhaTeste.php" ?>
<div class="modal fade" id="modal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" title="Fechar"><span>X</span></button>
        <h3 class="modal-title" align="center">Altere sua senha aqui</h3>
      </div>
      <div class="modal-body">
        <form action="alterarSenha.php" accept-charset="UTF-8" method="post">
          <div class="form-group">
            <label for="senhaAtual">Senha Atual</label>
            <input class="form-control" type="password" name="senhaAtual" minlength="3" required autofocus />
          </div>
          <div class="form-group">
            <label>Nova Senha</label>
            <input class="form-control" type="password" id="novaSenha" name="novaSenha" onkeyup="verificaSenha()" minlength="3" required autofocus />
          </div>
          <div class="form-group">
            <label>Confirmar Nova Senha</label>
            <input class="form-control" type="password" id="confirmarSenha" name="confirmarSenha" onkeyup="verificaSenha()" minlength="3" required />
          </div>
          <div id="divcheck" style="color: white;">
            .
          </div>
          <div class="modal-footer">
            <button id="enviarSenha" class="btn btn-primary" type="submit" value="Salvar" /><span class="glyphicon glyphicon-floppy-disk" disabled></span> Salvar</button>
            <!-- <button type="button" class="btn btn-danger" data-dismiss="modal">Fechar</button> -->
            <button id="fechar" class="btn btn-danger" data-dismiss="modal" value="Fechar"><span class="glyphicon glyphicon-remove"></span> Fechar</button>
          </div>
        </form>
       </div>
    </div>
  </div>
</div>

