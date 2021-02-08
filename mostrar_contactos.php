<?php

require_once 'ligacaoBD.php'; //verifica a ligacao à BD
require_once 'testaSessao.php'; //verifica se a sessão ainda está ativa ou não

if (testaSessao()) 
{
	if($con=ligaBD())
	{
		//verifa se o utilizador pressionou algum link para apagar um registo e apagar o registo com esse id

		if (isset($_GET["id"])) 
		{
			$stm=$con->prepare("delete from contactos where id_contacto=?");
			$stm->bind_param("i",$_GET["id"]);
			$stm->execute();
		}

		//Apresenta todos os registos da tabela contactos - consulta de dados

		$query=$con->query("select * from contactos");
		echo '<h1>Painel de Contactos - <a href="form_contactos.php">Adicionar Contacto</a></h1>';
		echo '<table>
				<tr>
					<th> Primeiro Nome</th>
					<th> Último Nome</th>
					<th> Editar</th>
					<th>Eliminar</th>
				</tr>';
		while ($resultados=$query->fetch_assoc()) 
		{
			echo '<tr>';
			echo "<td>".$resultados['primeiro_nome']."</td><td>".$resultados['ultimo_nome']."</td>"."<td><a href='form_contactos.php?id=".$resultados['id_contacto']."'>Editar</a></td>"."<td><a href='mostrar_contactos.php?id=".$resultados['id_contacto']."'>Eliminar</a></td>";
			echo '</tr>';
		}
		echo "</table>";
		$con->close();
	}
}
?>