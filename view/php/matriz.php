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
   <script src="../js/local.js"></script>
   <title>User</title>
</head>
<body>
   
    <div class="container">
        <form id="POST" action="pagina_temporaria.php" method="post">
            <h1>Register Stock</h1>

            <label for="local"></label>
            <input type="text" name="local" id="local" placeholder="Local">
            
            <label for="product"></label>
            <select name="product" id="product" class="products"></select>
            
            <label for="amount"></label>
            <input type="number" name="amount" id="amount" placeholder="Amount">

            <button type="submit" form="POST">Send</button>
        </form>
    </div>

    <section class="tabela">
        <table border="1 px solid">
            <thead>
                <tr>
                    <th>LOCAL</th>
                    <th>PRODUCT</th>
                    <th>PRICE</th>
                    <th>AMOUNT</th>
                </tr>
            </thead>

            <tbody class="elements"></tbody>
        </table>
    </section>
</body>
</html>
