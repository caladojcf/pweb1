<script type="text/javascript">
  // $(document).ready(function(){
  //   $("#novaSenha").keyup(verificaSenha);
  //   $("#confirmarSenha").keyup(verificaSenha);
  // });

  function verificaSenha(){
    var password = $("#novaSenha").val();
    var confirmPassword = $("#confirmarSenha").val();

    if (!document.getElementById('enviarSenha').disabled) {
      document.getElementById('enviarSenha').disabled=true;
    }
    if (password == '' && confirmPassword == '') {
      $("#divcheck").html("<span style='color: red'>Campos vazios!</span>");
      document.getElementById("enviarSenha").disabled = true;
    }
    else if (password == '' || confirmPassword == '') {
      $("#divcheck").html("<span style='color: red'>Um campo de senha está vazio!</span>");
      document.getElementById("enviarSenha").disabled = true;
    }
    else if (password != confirmPassword) {
      $("#divcheck").html("<span style='color: red'>Senhas não conferem!</span>");
      document.getElementById("enviarSenha").disabled = true;
    }
    else{
      $("#divcheck").html("<span style='color: green'>Senhas iguais!</span>");
      document.getElementById("enviarSenha").disabled = false;
    }
  }

  $(function(){
   var campo = $("#menor");
   campo.keyup(function(e){
     e.preventDefault();
     campo.val($(this).val().toLowerCase());
   });
  });

  $(function(){
   var campo = $("#maior");
   campo.keyup(function(e){
     e.preventDefault();
     campo.val($(this).val().toUpperCase());
   });
  });
</script>