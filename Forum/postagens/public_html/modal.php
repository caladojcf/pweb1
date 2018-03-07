<?php include_once "modalSenhaTeste.php" ?>

<div class="modal fade" id="modal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" title="Fechar"><span>X</span></button>
        <h3 class="modal-title" align="center">Cadastre-se aqui</h3>
      </div>
      <div class="modal-body">
        <form enctype="multipart/form-data" id="formulario" action="cadastroUsuario.php" accept-charset="UTF-8" method="post">
          <!-- <div class="form-group">
            <label class="form-label">Foto<br/>( Tipos suportados: pjpeg, jpeg, jpg, png e bmp com no máximo 2Mb)</label>
            <input class="form-control" type="file" name="foto"  />
          </div> -->
          <div >
            <label>CPF</label>
            <input class="form-control" type="text" name="cpf" minlength="11" maxlength="11" required autofocus />
          </div>
          <div >
            <label>Nome</label>
            <input class="form-control" type="text" id="menor" name="nome" required/>
          </div>
          <div >
            <label>E-mail</label>
            <input class="form-control" type="email" id="menor" name="email" required />
          </div>
          <div >
            <label>Senha</label>
            <input class="form-control" type="password" id="novaSenha" name="senha" onkeyup="verificaSenha()" minlength="3" required />
          </div>
          <div >
            <label>Confirmar Senha</label>
            <input class="form-control" type="password" id="confirmarSenha" name="senha" onkeyup="verificaSenha()" minlength="3" required />
          </div>
          <div id="divcheck" style="color: white;">
            .
          </div>
          <div class="modal-footer">
            <button id="enviarSenha" class="btn btn-primary" type="submit" value="Salvar"/><span class="glyphicon glyphicon-floppy-disk" disabled></span> Salvar</button>
            <!-- <button type="button" class="btn btn-danger" data-dismiss="modal">Fechar</button> -->
            <button id="fechar" class="btn btn-danger" data-dismiss="modal" value="Fechar"><span class="glyphicon glyphicon-remove"></span> Fechar</button>
          </div>
        </form>
       </div>
    </div>
  </div>
</div>