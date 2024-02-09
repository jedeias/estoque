<!DOCTYPE html>
<html lang="Pt-Br">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="stylesheet" href="/view/Css/user.css">
   <title>User</title>
</head>
<body>
   
   <div class="container">
      <form action="" method="post">
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
         <button type="submit">Send</button>
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

            <tr>
               <td>elemen</td>
               <td>elemen</td>
               <td>elemen</td>
            </tr>
            <tbody class="elements"></tbody>
      </table>

</body>
</html>
