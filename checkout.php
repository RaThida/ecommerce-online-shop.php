<?php
//include('server/connection.php');


include('layouts/header.php');
session_start();
if(!empty($_SESSION['cart'])){

}else{
    header('location: index.php');
}



?>


        <!--checkout-->
          <!--register part-->
        <section class="my-5 py-5">
            <div class="container text-center mt-3 pt-5">
                <h2 class="form-weight-bold">checkout</h2>
                <hr class="mx-auto">
            </div>
            <div class="mx-auto container">
                <form id="checkout-form" method="POST" action="server/place_order.php">
                <p class="text-center" style="color: red;">
                    <?php if(isset($_GET['message'])){ echo $_GET['message'];} ?>
                    <?php if(isset($_GET['message'])) {?>
                        <a href="login.php" class="btn btn-primary"> login</a>
                    <?php }?>

            
                </p>
                    <div class="form-group checkout-small-element">
                        <label>fullname</label>
                        <input type="text" class="form-control" id="checkout-name" name="name" placeholder="fullname" required>
                    </div>
                    <div class="form-group checkout-small-element">
                        <label>email</label>
                        <input type="text" class="form-control" id="checkout-email" name="email" placeholder="email" required>
                    </div>
                    <div class="form-group checkout-small-element">
                        <label>phone number</label>
                        <input type="tel" class="form-control" id="checkout-phone-number" name="phone" placeholder="phone number" required>
                    </div>
                    <div class="form-group checkout-small-element">
                        <label>city</label>
                        <input type="text" class="form-control" id="checkout-city" name="city" placeholder="city" required>
                    </div>
                    <div class="form-group checkout-large-element">
                        <label>address</label>
                        <input type="text" class="form-control" id="checkout-address" name="address" placeholder="address" required>
                    </div>
                    <div class="form-group checkout-btn-container">
                        <p>total amount: $ <?php echo $_SESSION['total'];?></p>
                        <input type="submit" class="btn" id="checkout-btn" name="place_order" value="place order">
                    </div>
                   

                </form>
            </div>
        </section>











        <?php include('layouts/footer.php')?>