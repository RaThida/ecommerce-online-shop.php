<?php
session_start();
include('server/connection.php');


if(isset($_SESSION['logged_in'])){
  header('location: account.php');
  exit;
}

if(isset($_POST['register'])){
  $name = $_POST['name'];
  $email = $_POST['email'];
  $password = $_POST['password'];
  $confirmpassword = $_POST['confirm-password'];
  //if passwords dont't match
  if($password !== $confirmpassword){
    header('location: register.php?error = passwords dont match');
  }
  //if password is less than 6 char
  elseif(strlen($password) <6 ){
    header('location: register.php?error=password must be at least 6 characters');
  }
  else{
        //check whether there is a user with this email or not 

    $stmt1 = $conn->prepare("SELECT count(*) FROM users where user_email=?");
    $stmt1->bind_param('s',$email);
    $stmt1->execute();
    $stmt1->bind_result($num_rows);
    $stmt1->store_result();
    $stmt1->fetch();

    if($num_rows != 0){
      header('location: register.php?error = user with email already exists');
    }else{
           //create a new user
            $stmt = $conn->prepare("INSERT INTO users (user_name,user_email,user_password)
            VALUES (?,?,?)");
            $stmt->bind_param('sss',$name,$email,md5($password));

            if($stmt->execute()){
              $user_id = $stmt->insert_id;
              
              $_SESSION['user_id'] = $user_id;
              $_SESSION['user_email'] = $email;
              $_SESSION['user_name'] = $name;
              $_SESSION['logged_in'] = true;
              header('location: account.php?register=You registered successfull!');
              //acc cout not be created 
            }else{
                header('location: register.php?error=could not create an account at the moment');
            }
    }

   
  }



  //if user has already registered, then take user to account page
}
?>



<?php include('layouts/header.php')?>
        <!--register part-->
        <section class="my-5 py-5">
            <div class="container text-center mt-3 pt-5">
                <h2 class="form-weight-bold">register</h2>
                <hr class="mx-auto">
            </div>
            <div class="mx-auto container">
                <form id="register-form" method="POST" action="register.php">
                    <p style="color: #14B478 "><?php if(isset($_GET['error'])){echo $_GET['error'];} ?></p>
                    <div class="form-group">
                        <label>fullname</label>
                        <input type="text" class="form-control" id="register-name" name="name" placeholder="fullname" required>
                    </div>
                    <div class="form-group">
                        <label>email</label>
                        <input type="text" class="form-control" id="register-email" name="email" placeholder="email" required>
                    </div>
                    <div class="form-group">
                        <label>password</label>
                        <input type="password" class="form-control" id="register-password" name="password" placeholder="password" required>
                    </div>
                    <div class="form-group">
                        <label>confirm password</label>
                        <input type="password" class="form-control" id="register-confirm-password" name="confirm-password" placeholder="confirm password" required>
                    </div>
                    <div class="form-group">
                        
                        <input type="submit" class="btn" id="register-btn" name="register" value="rigister">
                    </div>
                    <div class="form-group">
                        <a id="login-url" href="login.php" class="btn"></a>
                    </div>

                </form>
            </div>
        </section>









        <?php include('layouts/footer.php')?>