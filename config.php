<?php
$servername = "localhost";
$username = "raphael";
$password = "12345Cx*,";
$dbname = "agrosapiens_clima";

// Verificar a conexão com o banco de dados
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Erro de conexão com o banco de dados: " . $conn->connect_error);
}
?>
