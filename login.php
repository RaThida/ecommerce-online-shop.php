<?php //include('header.php');?>

<?php
 session_start();

  include('../server/connection.php');
  if(isset($_SESSION['admin_logged_in'])){
    header('location: index.php');
    exit;
  }
  if(isset($_POST['login_btn'])){
    $email = $_POST['email'];
    $password = md5($_POST['password']);
    $stmt = $conn->prepare("SELECT admin_id,admin_name,admin_email,admin_password FROM admins where admin_email= ? and admin_password= ? LIMIT 1");

    $stmt->bind_param('ss',$email,$password);
    if($stmt->execute()){
      $stmt->bind_result($admin_id,$admin_name,$admin_email,$admin_password);
      $stmt->store_result();

      if($stmt->num_rows()== 1){
          $stmt->fetch();
          $_SESSION['admin_id'] = $admin_id;
          $_SESSION['admin_name'] = $admin_name;
          $_SESSION['admin_email'] = $admin_email;
          $_SESSION['admin_logged_in'] = true;

          header('location: index.php?message=logged in successfully');
      }else{
        header('location: login.php?error=could not verify your account');
      }
    }else{
      header('location: login.php?error=something went worng');
    }
  }


?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.88.1">

    <link rel="canonical" href="https://getbootstrap.com/docs/5.1/examples/sign-in/">

    

    <!-- Bootstrap core CSS -->
<link href="/docs/5.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <!-- Favicons -->
<link rel="apple-touch-icon" href="/docs/5.1/assets/img/favicons/apple-touch-icon.png" sizes="180x180">
<link rel="icon" href="/docs/5.1/assets/img/favicons/favicon-32x32.png" sizes="32x32" type="image/png">
<link rel="icon" href="/docs/5.1/assets/img/favicons/favicon-16x16.png" sizes="16x16" type="image/png">
<link rel="manifest" href="/docs/5.1/assets/img/favicons/manifest.json">
<link rel="mask-icon" href="/docs/5.1/assets/img/favicons/safari-pinned-tab.svg" color="#7952b3">
<link rel="icon" href="/docs/5.1/assets/img/favicons/favicon.ico">
<meta name="theme-color" content="#7952b3">





<link rel="stylesheet" href="../assets/css/log.css"/>
  <body class="text-center">
    
    <main class="form-signin">
      <form id="login-form" method="POST" action="login.php">
      <p style="color: 11D780" class="text-center" ><?php if(isset($_GET['error'])){echo $_GET['error'];}?></p>

        <h1 class="h3 mb-3 fw-normal">login</h1>
        <hr class="mx-auto">
        <div class=" mx-auto form-floating">
          <label for="floatingInput">Email address</label>
          <input type="email" class="form-control" id="product-name" name="email" placeholder="email" required>
          
        </div>
        <div class="form-floating">
        <label for="floatingPassword">Password</label>
          <input type="password" class="form-control" id="product-desc" name="password" placeholder="password" required>
          
        </div>
    
        <div class="checkbox mb-3">
          <label>
            <input type="checkbox" value="remember-me"> Remember me
          </label>
        </div>
        <button class="w-100 btn btn-lg btn-primary" id="login-btn" name="login_btn" value="login" type="submit">Sign in</button>
      </p> 
      </form>
    </main>

  </body>
</html>
      















