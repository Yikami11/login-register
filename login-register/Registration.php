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
   <meta https-equiv="X-UA_Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Registration Form</title>
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
   <link rel="stylesheet" href="signstyle.css">
   <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
   <link rel = "stylesheet" href = "sign2.css"> 
   <link rel = "stylesheet" href = "master.css">
</head>
    <body>
      <div class="container">
         <?php
         
         if (isset($_POST["submit"])) {
            $firstname = $_POST["firstname"]; 
            $midname = $_POST["midname"]; 
            $surname = $_POST["surname"];
            $username = $_POST["username"];
            $birthday = $_POST["birthday"];
            
            $houseblockno = $_POST["houseblockno"]; 
            $street = $_POST["street"]; 
            $baranggay = $_POST["baranggay"]; 
            $municipality = $_POST["municipality"];
            $cityprovince = $_POST["cityprovince"];
            $zipcode = $_POST["zipcode"];


            $email = $_POST["email"];
            $contactno = $_POST["contactno"];
            $password = $_POST["password"];
            $passwordRepeat = $_POST["repeat_password"];








            $passwordHash = password_hash($password, PASSWORD_DEFAULT);
            
            $errors = array();
            
            if (empty($firstname) OR empty($midname) OR empty($surname) OR empty($email) 
            OR empty($password) OR empty($passwordRepeat) OR empty($contactno)
            OR empty($houseblockno) OR empty($street) OR empty($baranggay) 
            OR empty($municipality) OR empty($cityprovince) OR empty($zipcode)
            OR empty($birthday)) { 

               array_push($errors, "All fields are required");
            }
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) { 
               array_push($errors, "Email is not valid");
            }
            if (strlen($contactno) <11) { 
               array_push($errors, "Contact Number contain 11 digit");
            }
            if (strlen($password) <8) { 
               array_push($errors, "Password must be at least 8 charactes long");
            }
            if ($password!==$passwordRepeat) { 
               array_push($errors, "Password does not match");
            }
            require_once "database.php";
            $sql = "SELECT * FROM users WHERE email = '$email'";
            $result = mysqli_query($conn, $sql);
            $rowCount = mysqli_num_rows($result);
            if($rowCount>0){
            array_push($errors, "Email Already is already existing");
            }
            require_once "database.php";
            $sql = "SELECT * FROM users WHERE contactno = '$contactno'";
            $result = mysqli_query($conn, $sql);
            $rowCount = mysqli_num_rows($result);
            if($rowCount>0){
            array_push($errors, "Contact No. Already is already existing");
            }
            require_once "database.php";
            $sql = "SELECT * FROM users WHERE username = '$username'";
            $result = mysqli_query($conn, $sql);
            $rowCount = mysqli_num_rows($result);
            if($rowCount>0){
            array_push($errors, "Username Already is already existing");
            }
            
            if (count($errors)>0) { 
               foreach ($errors as $error) { 
                  echo "<div class='alert alert-danger'>$error</div>";
            }
            }
            else{

                  $sql = "INSERT INTO users (firstname, midname, surname, username, birthday, houseblockno, street, baranggay, 
                  municipality, cityprovince, zipcode, email, contactno , password) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
                  $stmt = mysqli_stmt_init($conn);
                  $prepareStmt = mysqli_stmt_prepare($stmt, $sql);
                  if ($prepareStmt) {
	                  mysqli_stmt_bind_param($stmt,"ssssssssssssss", $firstname, $midname, $surname, $username, $birthday, $houseblockno,
                     $street, $baranggay, $municipality, $cityprovince, $zipcode, $email, $contactno, $passwordHash,);
	                  mysqli_stmt_execute($stmt);
	                  echo "<div class='alert alert-success'>You are registered successfully.</div>";
                  }else{
	                  die("Something went wrong");
            }}}  
         ?>
         
         
         
         
         <form action="registration.php" method="post">
         <div class="wrapper">
            <form id="signupForm" action="" id = "step1">
            <h1>Welcome, Sign up and continue</h1> 
               <div class="input-box2">  
                     
                  <div class="input-field2">
                     <input required="" type="email" class ="form-control" name="email" placeholder="Email:">
                     <i class='bx bx-envelope' ></i>
                  </div>
                  
                  <div class="input-field2">
                     <input required="" type="text" class ="form-control" name="username" placeholder="Username:">
                     <i class='bx bx-ghost' ></i>
                  </div>
                  
                  <div class="input-field2">
                     <input required="" type="password" class ="form-control" name="password" placeholder="Password:">
                     <i class='bx bx-lock-open' ></i>
                  </div>
                  
                  <div class="input-field2">
                     <input required="" type="password" class ="form-control" name="repeat_password" placeholder="Repeat Password:">
                     <i class='bx bx-lock' ></i>
                  </div>

                  <div class = "login">
                           <a href = "Login.php">Already have an account? Sign Up.</a>
                  </div>
                  <div class = "login2">
                           <a href = "index.php">Go Home</a>
                  </div>




               
                     <button type="button" class = "button" onclick="nextStep()">Next</button>
                     </div>
                     <div class="input-box" id="step2" style="display: none;">
                
                <div class="input-field">
                      <input required="" type="text" class ="form-control" name="firstname" placeholder="First Name:">
                      <i class='bx bx-user-circle'></i>
                   </div>
                   <div class="input-field">
                      <input required="" type="text" class ="form-control" name="midname" placeholder="Middle Name:">
                      <i class='bx bx-user-circle'></i>
                   </div>
                   <div class="input-field">
                      <input required="" type="text" class ="form-control" name="surname" placeholder="Surname:">
                      <i class='bx bx-user-circle'></i>
                   </div>


                   <div class="input-field">
                      <input required="" type="text" class ="form-control" name="houseblockno" placeholder="House/Block no. :">
                      <i class='bx bx-building-house' ></i>
                   </div>
                   <div class="input-field">
                      <input required="" type="text" class ="form-control" name="street" placeholder="Street:">
                      <i class='bx bx-building-house' ></i>
                   </div>
                   <div class="input-field">
                      <input required="" type="text" class ="form-control" name="baranggay" placeholder="Baranggay:">
                      <i class='bx bx-building-house' ></i>
                   </div>
                   <div class="input-field">
                   <input required="" type="text" class ="form-control" name="municipality" placeholder="Municipality:">
                   <i class='bx bx-building-house' ></i>
                   </div>
                   <div class="input-field">
                      <input required="" type="text" class ="form-control" name="cityprovince" placeholder="City/Province:">
                      <i class='bx bx-building-house' ></i>
                   </div>
                   <div class="input-field">
                      <input required="" type="text" class ="form-control" name="zipcode" placeholder="Zipcode:">
                      <i class='bx bx-building-house' ></i>
                   </div>
             

                   <div class="input-field">
                      <input required="" type="date" class ="form-control" name="birthday" placeholder="Birthdate:">
                      <i class='bx bx-cake' ></i>
                   </div>
                   
                   <div class="input-field">
                      <input required="" type="contactno" class ="form-control" name="contactno" placeholder="Contact Number:">
                      <i class='bx bx-phone-call' ></i>
                   </div>

                   
                     <button type="button" class = "button2" onclick="prevStep()">Previous</button>

               
                     <button class = "button2" onclick = "gotoLink(this)" value = "index.php">Cancel</button>
         
                        
                     
                      <button type="submit" required = "" class ="button" value="Register" name="submit">Register</button> 
                                  
         </form>
      </div>
      
      
      <script>
        function nextStep() {
            document.getElementById('step2').style.display = 'flex';
            document.getElementById('signupForm').scrollIntoView();
        }

        function prevStep() {
            document.getElementById('step2').style.display = 'none';
            document.getElementById('signupForm').scrollIntoView();
        }

        function gotoLink(link){
         console.log(link.value);
         location.href = link.value;
        }
    </script>

</body>
</html>