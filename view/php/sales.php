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
    <title>Sales</title>
 </head>
 <body>
      <form action="" method="post">
      <label for="location">Local</label>
      <select name="location" id="location"></select>
         

      <label for="product">Product</label>
      <select name="product" id="product"></select>

   
      <label for="amount">Amount</label>
      <input type="text" name="amount" id="amount">
   
      <label for="sales">Sales value</label>
      <input type="text" name="sales" id="sales">

      <button type="submit">Send</button>


      </form>
 </body>
 </html>

 <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

