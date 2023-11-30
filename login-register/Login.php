<?php
session_start();
if (isset($_SESSION ["user"])){
    header("location: index.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Login Form</title>
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
   <link rel="stylesheet" href="style2.css">
   <link rel="stylesheet" href="signstyle.css">
   <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
   <link rel = "stylesheet" href = "master.css">
   <title>Sign In</title> 
</head>
<body>

<?php


if (isset($_POST["login"])) {
   $username = $_POST["username"];
   $password = $_POST["password"];
      require_once "database.php";
      $sql = "SELECT * FROM users WHERE username = '$username'";
      $result = mysqli_query($conn, $sql);
      $user = mysqli_fetch_array($result, MYSQLI_ASSOC);
   if ($user) {
      if (password_verify($password, $user["password"])) { 
            session_start();
                $_SESSION["user"] = "yes";
                header("Location: homepage.php");
                die();
}else{
   echo "<div class='alert alert-danger'>Password does not match</div>";
}
      }else{
         echo "<div class='alert alert-danger'>Email does not match</div>";
      }
    }
?>

   <div class="wrapper">
      <form action="login.php" method="post">
         <h1>Login</h1>
               <div class = "input-box2">     
                  <div class = "input-field2">
                     <input required="" type="text" placeholder="Enter Username:" name="username" class="form-control">
                     <i class='bx bx-envelope' ></i>
                  </div>
                  
                  
                  <div class = "input-field2">
                     <input required="" type="password" placeholder="Enter Password:" name="password" class="form-control">
                     <i class='bx bx-lock-open' ></i>
                  </div>
                        
                  
              
                  <button type="submit" required = "" class ="button" value="Login" name="login">Login</button>
           

                  <div class = "login">
                     <div>
                        <a href="Registration.php"> Register Here. </a>
                  </div>
      </div>
   </div>
      
</body>
</html>