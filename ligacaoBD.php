<?php

function ligaBD()
{
	$con=new mysqli("localhost","root","","bdcontactos");

	if ($con->connect_errno!=0)
	{
		echo "Ocorreu um erro no acesso à base de dados".$con->connect_error;
		exit;
	}
	return $con;
}
?>