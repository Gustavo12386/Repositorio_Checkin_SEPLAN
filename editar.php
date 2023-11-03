<?php
    include('pdo.php');
    //Realiza a edição do evento
    if(isset($_POST['update'])){    
    
    $id = $_POST['id'];
    $nome = $_POST['nome'];
    $data = $_POST['data'];
    $inicio = $_POST['inicio'];
    $fim = $_POST['fim'];
    $organizador = $_POST['organizador'];
    $obs = $_POST['obs'];    
    
    $query = $conexao_pdo->prepare("UPDATE evento SET nome=:nome, data=:data, inicio=:inicio, fim=:fim,
    organizador=:organizador, obs=:obs WHERE id=:id");
    $query->bindparam(':id', $id);
    $query->bindparam(':nome', $nome); 
    $query->bindparam(':data', $data);
    $query->bindparam(':inicio', $inicio);
    $query->bindparam(':fim', $fim);
    $query->bindparam(':organizador', $organizador);
    $query->bindparam(':obs', $obs);
    $query->execute(); 
    
    //verifica se os dados foram atualizados
    if($query->rowCount() > 0)
    {
      echo "<script language='javascript' type='text/javascript'>window.location.href='eventos.php'</script>";
    } else
    {
        echo '<script>';
        echo '$(document).ready(function(){
        swal("Ocorreu Um erro!","", "warning");        
        })';
        echo'</script>';
      }  
    }          

?>



