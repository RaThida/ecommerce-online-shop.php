<?php
include('server/connection.php');
  session_start();
  if(!isset($_SESSION['logged_in'])){
    header('location: login.php');
    exit;
  }
  if(isset($_GET['logout'])){
    if(isset($_SESSION['logged_in'])){
      unset($_SESSION['logged_in']);
      unset($_SESSION['user_email']);
      unset($_SESSION['user_name']);
      header('location: login.php');
      exit;
    }

    // if(isset($_GET['logout'])){
    //   if(isset($_SESSION['logged_in'])){
    //     unset($_SESSION['logged_in']);
    //     unset($_SESSION['user_email']);
    //     unset($_SESSION['user_name']);

    //     header('location: login.php');
    //     exit;
    //   }
    // }
  }

  if(isset($_POST['change_password'])){
    $password = $_POST['new-password'];
    $confirm_password = $_POST['confirm-password'];
    $user_email = $_SESSION['user_email'];
    if($password !== $confirm_password){
      header('location: account.php?error=passwords dont match');

    }elseif(strlen($password) < 6){
      header('location: account.php?error=passwords must be at least 6 characters');
    }else{
      $stmt = $conn->prepare("UPDATE users SET user_password=? where user_email=?");
      $stmt->bind_param('ss',md5($password),$user_email);
      if($stmt->execute()){
        header('location: account.php?message=password has been update successfully');

      }else{
        header('location: account.php?error=password not correct');
      }
    }
  }

  //get orders
  if(isset($_SESSION['logged_in'])){

    $user_id = $_SESSION['user_id'];
    $stmt = $conn->prepare("SELECT * FROM orders where user_id=?");
    $stmt->bind_param('i',$user_id);
    $stmt->execute();
    $orders = $stmt->get_result();

  }
?>


<?php include('layouts/header.php')?>

        <!--account-->
        <section class="my-5 py-5">
            <div class="row container mx-auto">
              <?php if(isset($_GET['payment_message'])){ ?>
                <p class="mt-5 text-center" style="color:blue"><?php echo $_GET['payment_message'];?></p>
              <?php }?>
                <div class="text-center mt-3 pt-5 col-lg-6 col-md-12 col-sm-12">
                    <h3 class="font-weight-bold">account info</h3>
                    <hr class="mx-auto">
                    <div clas="account-info">
                        <p>name: <span><?php if(isset($_SESSION['user_name'])){echo $_SESSION['user_name'];}?></span></p>
                        <p>email: <span><?php if(isset($_SESSION['user_email'])){ echo $_SESSION['user_email'];}?></span></p>
                        <p><a href="" id="order-btn">your order</a></p>
                        <p><a href="account.php?logout=1" id="logout-btn">logout</a></p>
                    </div>
                </div>
                <div class="text-center mt-3 pt-5 col-lg-6 col-md-12 col-sm-12">
                    <form id="account-form" method="POST" action="account.php">
                      <p class="text-center" style="color: red"><?php if(isset($_GET['error'])){echo $_GET['error'];}?></p>
                      <p class="text-center" style="color: green"><?php if(isset($_GET['message'])){echo $_GET['message'];}?></p>

                        <h3>change password</h3>
                        <hr class="mx-auto">
                        
                        <div class="form-group">
                            <label>curent password</label>
                            <input type="password" class="form-control" id="current-password" name="current-password" placeholder="current password" required>
                        </div>
                        <div class="form-group">
                            <label>new password</label>
                            <input type="password" class="form-control" id="new-password" name="new-password" placeholder="new password" required>
                        </div>
                        <div class="form-group">
                            <label>confirm password</label>
                            <input type="password" class="form-control" id="confirm-password" name="confirm-password" placeholder="confirm password" required>
                        </div>
                        <div class="form-group">
                            
                            <input type="submit" value="change password" name="change_password" class="btn" id="change-password">
                        </div>
                    </form>
                </div>
            </div>
        </section>


           <!--order-->
           
          <section class="order container my-5 py-3">
              <div class="container mt-5">
                  <h2 class="font-weight-bolde text-center">Your order</h2>
                  <hr class="mx-auto">
              </div>
              <table class="mt-5 pt-5">
                  <tr>
                      <th>order id</th>
                      <th>order cost</th>
                      <th>order status</th>
                      <th>order date</th>
                      <th>order details</th>
                      
                  </tr>
                  <?php while($row = $orders->fetch_assoc()){ ?>
                    <tr>
                        <td>
                         <!--  <div class="product-info">
                            <img src="assets/imgs/dress.jpg"> 
                            <div>
                              <p class="mt-3"><?php echo $row['order_id'];?></p>
                            </div>
                          </div> -->
                          <span><?php echo $row['order_id'];?></span>
                        </td>

                        <td>
                          <span><?php echo $row['order_cost'];?></span>
                        </td>

                        <td>
                          <span><?php echo $row['order_status'];?></span>
                        </td>

                        <td>
                          <span><?php echo $row['order_date'];?></span>
                        </td>
                        <td>
                          <form method="POST" action="order_details.php">
                            <input type="hidden" value="<?php echo $row['order_status'];?>" name="order_status">
                            <input type="hidden" value="<?php echo $row['order_id'];?>" name="order_id">
                            <input class="btn orders-detail-btn" name="order_detail_btn" type="submit" value="details">
                          </form>
                        </td>
                    </tr> 
                  <?php } ?>
                
              </table>
            
          </section>

          <?php include('layouts/footer.php')?> 