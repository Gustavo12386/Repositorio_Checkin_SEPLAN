<?php

include_once('pdo.php');

$nome = addslashes($_POST['nome']);
$senha = addslashes($_POST['senha']);

//reconhece a criptografia 
$senhamd5 = md5($senha);

//localiza o email e senha e realiza o login
$sql = $conexao_pdo->prepare("SELECT * FROM usuario WHERE nome = ? AND senha = ?");
$sql->execute(array($nome, $senhamd5));


if($sql->rowCount() > 0)
{
   session_start(); 
   $sql->fetch();  
   $_SESSION['nome'] = $nome;
   $_SESSION['senha'] = $senha;   
   echo "<script language='javascript' type='text/javascript'>window.location.href='index.php'</script>";
}

else
{
    $mensagem = "Usuario ou senha incorretos!";
    echo "<script language='javascript'>";
    echo "alert('".$mensagem."');";
    echo "</script>";
    echo "<script language='javascript' type='text/javascript'>window.location.href='login.php'</script>";
}

?>