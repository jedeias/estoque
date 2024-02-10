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
   <div id="menu" class="fas fa-bars"></div>
   <link rel="stylesheet" href="../css/user.css">
   <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
   <script src="../js/user.js"></script>
   <title>User</title>
</head>
<body>
   
   <div class="container">
      <form id="POST" action="pagina_temporaria.php" method="post">
         <h1>Cadastro de Usúario</h1>

         <label for="name"></label>
         <input type="text" name="name" id="name" placeholder="Nome">
         
         <label for="email"></label>
         <input type="email" name="email" id="email" placeholder="E-mail">
         
         <label for="password"></label>
         <input type="password" name="password" id="password" placeholder="Password">
         
         <select name="type" id="type">
            <option value="Administrator">Administrator</option>
            <option value="Assistant">Assistant</option>
         </select>
         <button type="submit" form="POST">Send</button>
      </form>
   </div>

   <section class="tabela">
      <table border="1 px solid">
            <thead>
               <tr>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Type</th>
               </tr>
            </thead>

            <tbody class="elements"></tbody>
      </table>
   </section>
</body>
</html>
