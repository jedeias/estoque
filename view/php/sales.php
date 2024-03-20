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
    <link rel="stylesheet" href="../css/sales.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <title>Sales</title>
 </head>
 <body>

    <header>
        <nav class="navbar">
            <h1 class="title">Bem-Vindo à área de Sales <?php echo $user->getName();?>!</h1>
            <ul>
                <li><a href='../exit.php'>Exit</a></li>
                <li><a href="./logs.php">Logs</a></li>
                <li><a href="./matriz.php">Matriz</a></li>
                <li><a href="./sales.php">Sales</a></li>
                <li><a href="./user.php">User</a></li>
            </ul>

                
            <button id = "toggle" class="button">Toggle</button>
            <button id="refresh" class="button">refresh</button>

        </nav>
    </header>


    <div id="menu" class="fas fa-bars"></div>

    <div class="container">
      <form action="" method="post">
        <h1>Sales</h1>
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
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="../js/sales.js"></script>
 </body>
 </html>


