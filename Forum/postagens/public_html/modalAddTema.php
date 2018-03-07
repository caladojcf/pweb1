<div class="modal fade" id="modalAddTema">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" title="Fechar"><span>X</span></button>
        <h3 class="modal-title" align="center">Criar Tema aqui</h3>
      </div>
      <div class="modal-body">
        <form id="formulario" action="cadastroTema.php" accept-charset="UTF-8" method="post">
          <div >
            <label>Título do Tema</label>
            <input class="form-control" type="text" id="menor" name="nome" required/>
          </div>
          <div class="modal-footer">
            <button class="btn btn-primary" type="submit" value="Salvar"/><span class="glyphicon glyphicon-floppy-disk"></span> Salvar</button>
            <button id="fechar" class="btn btn-danger" data-dismiss="modal" value="Fechar"><span class="glyphicon glyphicon-remove"></span> Fechar</button>
          </div>
        </form>
       </div>
    </div>
  </div>
</div>