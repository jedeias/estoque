<!-- 

    Esta pagina fica uma pagina com tabela contendo todos os os materias do estoque e suas quantidades

-->

<?php

require_once("../../vendor/autoload.php");

use Estoque\Core\UseCases\Session\Session;

$session = new Session();

if (empty($_SESSION) && session_id() !== "user") {
    header("Location: ../");
    exit();
}

$serializedUser = $session->get("serializeUser");
$user = unserialize($serializedUser);

?>

<!DOCTYPE html>
 <html lang="Pt-Br">
 <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Matriz</title>
 </head>
 <body>
    <h1>Olá Mundo!!</h1>
 </body>
 </html>