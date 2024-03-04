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
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Configurations</title>
</head>
<body>

    <form id="UPDATE" method="POST">

        
    <input type="text" name="name" id="id" value="<?php echo $user->getName(); ?>">

    <input type="text" name="email" id="id" value="<?php echo $user->getEmail(); ?>">
    
    <input type="text" name="password" id="id" value="<?php echo $user->getPassword(); ?>">
    
    <button type="submit">chang</button>

    </form>


    
    <script src="../js/home.js"></script>
    <script src="../js/userInf.js"></script>
    <script src="../js/userConfig.js"></script>

</body>
</html>