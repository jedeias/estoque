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
    <link rel="stylesheet" href="/view/Css/logs.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <title>Logs</title>
 </head>
 <body>

   <header>

      <h1>Logs!</h1>
    
         <nav class="navbar">
             <ul>
                 <li><a href='exit.php'>Exit</a></li>
                 <li><a href="./matriz.html">Matriz</a></li>
                 <li><a href="./sales.html">Sales</a></li>
                 <li><a href="./user.html">User</a></li>
             </ul>
         </nav>
 
    
   </header>

   <div id="menu" class="fas fa-bars"></div>

   <section class="tabela">

      <table border="1px solid ">
         <tr>
            <th>Alteration</th>
            <th>Camp</th>
            <th>Old Value</th>
            <th>New Value</th>
            <th>Date</th>
         </tr>
         <tr>
            <td>elements</td>
            <td>elements</td>
            <td>elements</td>
            <td>elements</td>
            <td>elements</td>
            
         </tr>

         
      </table>

   </section>


   <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
   <script src="/view/js/home.js"></script>
 </body>
 </html>

