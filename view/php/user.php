<!DOCTYPE html>
<html lang="Pt-Br">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>User</title>
</head>
<body>
   <form action="" method="post">

      <label for="name">Name</label>
      <input type="text" name="name" id="naem">
      
      <label for="email">Email</label>
      <input type="email" name="email" id="email">
      
      <label for="password">Password</label>
      <input type="password" name="password" id="password">
      
      <select name="type" id="type">
         <option value="Administrator">Administrator</option>
         <option value="Assistant">Assistant</option>
      </select>

      <button type="submit">Send</button>
   </form>

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

</body>
</html>