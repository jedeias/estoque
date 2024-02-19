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
    <link rel="stylesheet" href="../css/user.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="../js/products.js"></script>
    <title>User</title>
</head>
<body>

        <header>
        
            <nav class="navbar">
                <h1 class="title">Bem-Vindo à área de produtos <?php echo $user->getName();?>!</h1>
                <ul>
                    <li><a href='exit.php'>Exit</a></li>
                    <li><a href="./logs.php">Logs</a></li>
                    <li><a href="./matriz.php">Matriz</a></li>
                    <li><a href="./products.php">Products</a></li>
                    <li><a href="./sales.php">Sales</a></li>
                    <li><a href="./user.php">User</a></li>
                </ul>
            </nav>
        </header>

    <div id="menu" class="fas fa-bars"></div>
   
    <div class="container">
        <form id="POST" action="pagina_temporaria.php" method="post">
            <h1>Register products</h1>

            <label for="name"></label>
            <input type="text" name="name" id="name" placeholder="Name">
            
            <label for="price"></label>
            <input type="text" name="price" id="price" placeholder="Price">
            
            <label for="marck"></label>
            <input type="text" name="mark" id="mark" placeholder="Mark">
            
            <label for="validate"></label>
            <input type="date" name="validate" id="validate">
            
            
            <button type="submit" form="POST">Send</button>
        </form>
    </div>

   <section class="tabela">
      <table border="1 px solid">
            <thead>
               <tr>
                  <th>Name</th>
                  <th>Price</th>
                  <th>Mark</th>
                  <th>Validate</th>
               </tr>
            </thead>
<!-- 
            <tr class="elements">

            </tr> -->
            <tbody class="elements"></tbody>
      </table>
   </section>

   <div id="perfil" class="perfil" onclick="mostrarInformacoes()">
   
   </div>
  
   <div id="informacoes" class="informacoes">
      <h2>Informações do Perfil</h2>
      <p>Nome: <?php echo $user->getName();?></p>
      <p>Email: <?php echo $user->getEmail();?></p>
   </div>

</body>
</html>
