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
    <link rel="stylesheet" href="../Css/userconfig.css">
    <title>Configurations</title>
</head>
<body>

    <section class="container">

        <form id="UPDATE" method="POST" class="form">
            <h1>Alter</h1>
            
            <label for="name">Name</label>
            <input type="text" name="name" id="id" value="<?php echo $user->getName(); ?>">
            <br>
            <label for="email">E-mail</label>
            <input type="text" name="email" id="id" value="<?php echo $user->getEmail(); ?>">
            
            <label for="passoword">PassWord</label>
            <input type="text" name="password" id="id" value="<?php echo $user->getPassword(); ?>">
            
            <button type="submit">chang</button>

        </form>
    </section>


    
    <script src="../js/home.js"></script>
    <script src="../js/userInf.js"></script>
    <script src="../js/userConfig.js"></script>

</body>
</html>