<?php
include('pdo.php');

function filterData(&$str){
  $str = preg_replace("/\t/", "\\t", $str); 
  $str = preg_replace("/\r?\n/", "\\n", $str); 
  if(strstr($str, '"')) $str = '"' . str_replace('"', '""', $str) . '"'; 
}
$fileName = "participantes" . ".xls";
// Nomes das Colunas
$fields = array('ID_Evento', 'N°Inscrição', 'NOME', 'CPF', 'EMAIL', 'TELEFONE', 'ORGÃO', 'CARGO');

$excelData = implode("\t", array_values($fields)) . "\n"; 
if(!empty($_GET['lista'])){
  $id = $_GET['lista'];
  $sql = $conexao_pdo->prepare("SELECT * FROM participantes WHERE id=:id");
  $sql->bindparam(':id', $id);
  $sql->execute();
  if($sql->rowCount() > 0){
    while($rows = $sql->fetch(PDO::FETCH_ASSOC)) { 
      $informacoes = array($rows['id'], $rows['id_participante'], $rows['nome'], 
      $rows['cpf'], $rows['email'], $rows['telefone'], $rows['orgao'], $rows['cargo']);      
      array_walk($informacoes, 'filterData'); 
      $excelData .= implode("\t", array_values($informacoes)) . "\n";

    }    
  } else{ 
    $excelData .= 'Valores não encontrados...'. "\n"; 
}  

header("Content-Type: application/vnd.ms-excel"); 
header("Content-Disposition: attachment; filename=\"$fileName\""); 

echo $excelData; 
 
exit();
}
?>