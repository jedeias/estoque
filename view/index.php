<?php

require_once("../vendor/autoload.php");

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
    <link rel="stylesheet" href="./Css/home.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <title>Home</title>
</head>
<body>
    
    <header>
    
        <nav class="navbar">
            <h1 class="title">Bem-Vindo à área de redirecionamento <?php echo $user->getName();?>!</h1>
            <ul>
                <li><a href='exit.php'>Exit</a></li>
                <li><a href="./php/logs.php">Logs</a></li>
                <li><a href="./php/matriz.php">Matriz</a></li>
                <li><a href="./php/products.php">Products</a></li>
                <li><a href="./php/sales.php">Sales</a></li>
                <li><a href="./php/user.php">User</a></li>
            </ul>

            <div class="buttons">
        
                <button id="toggle" class="button">toggle</button>
                
                <button id="refresh" class="button">refresh</button>
            </div>

        </nav>
    </header>

    <div id="menu" class="fas fa-bars"></div>

    
    <div class="container">
        <div class="card">
            <div class="face facel">
                <div class="content">
                    <img src="image/gojo_um.jpg" alt="">
                    <h3>Logs</h3>
                </div>
            </div>

            <div class="face face2">
                <div class="content">
                    <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Perspiciatis iure doloremque, molestias dolorem eveniet provident optio magni possimus? Illo minima labore quae mollitia fuga neque voluptates velit quo pariatur sit.</p>
                    <a href="./php/logs.php">Read More</a>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="face facel">
                <div class="content">
                    <img src="image/gojo_um.jpg" alt="">
                    <h3>Matriz</h3>
                </div>
            </div>

            <div class="face face2">
                <div class="content">
                    <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Perspiciatis iure doloremque, molestias dolorem eveniet provident optio magni possimus? Illo minima labore quae mollitia fuga neque voluptates velit quo pariatur sit.</p>
                    <a href="./php/matriz.php">Read More</a>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="face facel">
                <div class="content">
                    <img src="image/gojo_um.jpg" alt="">
                    <h3>Products</h3>
                </div>
            </div>

            <div class="face face2">
                <div class="content">
                    <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Perspiciatis iure doloremque, molestias dolorem eveniet provident optio magni possimus? Illo minima labore quae mollitia fuga neque voluptates velit quo pariatur sit.</p>
                    <a href="./php/products.php">Read More</a>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="face facel">
                <div class="content">
                    <img src="image/gojo_um.jpg" alt="">
                    <h3>Sales</h3>
                </div>
            </div>

            <div class="face face2">
                <div class="content">
                    <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Perspiciatis iure doloremque, molestias dolorem eveniet provident optio magni possimus? Illo minima labore quae mollitia fuga neque voluptates velit quo pariatur sit.</p>
                    <a href="./php/sales.php">Read More</a>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="face facel">
                <div class="content">
                    <img src="image/gojo_um.jpg" alt="">
                    <h3>User</h3>
                </div>
            </div>

            <div class="face face2">
                <div class="content">
                    <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Perspiciatis iure doloremque, molestias dolorem eveniet provident optio magni possimus? Illo minima labore quae mollitia fuga neque voluptates velit quo pariatur sit.</p>
                    <a href="./php/user.php">Read More</a>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="./js/home.js"></script>
</body>
</html>