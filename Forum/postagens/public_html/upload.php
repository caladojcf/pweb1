<?php


//$diretorio = "imagens/";
$diretorio = "../img/";
$imagem = $diretorio . basename($_FILES["imagem"]["name"]);var_dump($imagem);exit;
$uploadOk = 1;
$imageFileType = pathinfo($imagem,PATHINFO_EXTENSION);var_dump($imageFileType);exit;
// Verificação para saber se o arquivo é uma imagem
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["imagem"]["tmp_name"]);
    if($check !== false) {
        echo "O arquivo é uma imagem - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "O arquivo não é uma imagem.";
        $uploadOk = 0;
    }
}



// Verifica se a imagem já existe
if (file_exists($imagem)) {
    echo "Este arquivo já existe.";
    $uploadOk = 0;
}

// Verifica o tamanho do arquivo
if ($_FILES["imagem"]["size"] > 2000) {
    echo "Desculpe, aquivo muito grande.";
    $uploadOk = 0;
}
// tipos permitidos
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
    echo "Desculpe, mas só é permitido o envio de imagens nos formatos JPG, PNG e GIF.";
    $uploadOk = 0;
}
// Mensagem de erro, caso haja algum
if ($uploadOk == 0) {
    echo "Desculpe, o arquivo não pode ser enviado.";
// Se estiver tudo certo, o arquivo será enviado
} else {
    if (move_uploaded_file($_FILES["imagem"]["tmp_name"], $imagem)) {
        echo "O arquivo ". basename( $_FILES["imagem"]["name"]). " foi enviado.";
    } else {
        echo "Erro ao enviar imagem.";
    }
}



?>