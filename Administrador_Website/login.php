<?php
include_once("base_dados"); 
/* Informações do Banco de Dados*/

$host = "138.68.15.190";
$username = "root";
$password = "asafaster";
$database = "cinecampo";
$table = "Administrador";

/* Criação da Tabela Administrador

create table Administrador(id int primary key not null auto_increment, usuario varchar(255), senha varchar(255));

*/

/* Autenticação */
mysql_connect("$host","$username","$password") or die ("Impossível conectar!");
mysql_select_db("$database") or die ("Database inválida. Tente novamente.");

$field_username = $_POST['field_username'];
$field_password = $_POST['field_password'];

$field_username = stripslashes($field_username);
$field_password = stripslashes($field_password);
$field_username = mysql_real_escape_string($field_username);
$field_password = mysql_real_escape_string($field_password);

$mysql_code = "SELECT * FROM $table WHERE nome = '$field_username' AND senha = '$field_password'";
$query = mysql_query($mysql_code) or die("Erro na seleção");

$number_of_results = mysql_num_rows($query);

if ($number_of_results > 0) {
    	session_start();
    	$_SESSION['usuario'] = $field_username;
    	$_SESSION['senha'] = $field_password;
	header("location:homepage.php");
}

else {
	session_destroy();
	unset ($_SESSION['usuario']);
    	unset ($_SESSION['senha']);
 
	header("location:index.php?loginFail=true");
}
?>