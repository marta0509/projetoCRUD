<?php
require_once 'ligacaoBD.php';

//verifica a conexão à BD
session_start();
$_SESSION["sessionmaxtime"]=time();

$con=LigaBD();

if ($stm=$con->prepare("select * from utilizadores where utilizador=? and password=?")) 
{
	$stm->bind_param("ss",$_POST["utilizador"],$_POST["password"]);  //faz a aconexão à BD

	$stm->execute();

	$stm->store_result();

	if($stm->num_rows>0)
	{
		$_SESSION["login"]=1;
		$_SESSION["browser"]=$_SERVER["HTTP_USER_AGENT"];
		header("Location:mostrar_contactos.php");  //se a autenticação for realizada com sucesso, vai para mostrar_contactos
	}
	else
	{
		echo "Os dados não são válidos. Aguarde...";
		header("Refresh:3; url=login.php"); //se a conexão não for realizada com sucesso, volta para o login.php
	}
}
?>