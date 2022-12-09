<?php

  session_start();
  if(isset($_POST['add_to_cart'])){
    //if user has already added a product to cart
    if(isset($_SESSION['cart'])){

      $product_array_ids = array_column($_SESSION['cart'],"product_id");
      //if product has already added to cart or not
      if( !in_array($_POST['product_id'], $product_array_ids)){

        $product_id = $_POST['product_id'];
         
  
        $product_array= array(
          'product_id'=>$_POST['product_id'],
          'product_name'=>$_POST['product_name'],
          'product_price'=>$_POST['product_price'],
          'product_image'=>$_POST['product_image'],
          'product_quantity'=>$_POST['product_quantity']
  
        );
  
        $_SESSION['cart'][$product_id]= $product_array;
  

       

      }
      //product has already been added
      else{
        echo '<script>alert("product was already to cart");</script>';
      
      }
    }
    //if this is the first product
    else{
      $product_id = $_POST['product_id'];
      $product_name = $_POST['product_name'];
      $product_price = $_POST['product_price'];
      $product_image = $_POST['product_image'];
      $product_quantity = $_POST['product_quantity'];

      $product_array= array(
        'product_id'=>$product_id,
        'product_name'=>$product_name,
        'product_price'=>$product_price,
        'product_image'=>$product_image,
        'product_quantity'=>$product_quantity

      );

      $_SESSION['cart'][$product_id]= $product_array;

    } 

    
  }
  elseif(isset($_POST['remove_product'])){

    $product_id = $_POST['product_id'];
    unset($_SESSION['cart'][$product_id]);

    //calculate total
    calculateTotalCart();

  }elseif(isset($_POST['edit_quantity'])){

    $product_id = $_POST['product_id'];
    $product_quantity = $_POST['product_quantity'];

    $product_array = $_SESSION['cart'][$product_id];
    $product_array['product_quantity'] = $product_quantity;
    $_SESSION['cart'][$product_id] = $product_array;
    
    //calculate total
    calculateTotalCart();
  }
  else
  {
    //header('location: index.php');
  }

  function calculateTotalCart(){
    $total_price = 0;
    $tptal_quantity = 0;
    foreach($_SESSION['cart'] as $key => $value){
      $product = $_SESSION['cart'][$key];

      $price = $product['product_price'];
      $quantity = $product['product_quantity'];

      $total_price = $total_price + ($price * $quantity);
      $total_quantity = $total_quantity + $quantity;
    }
    $_SESSION['total'] = $total_price;
    $_SESSION['quantity'] = $total_quantity;
  }

?>


<?php include('layouts/header.php')?>

        <!--cart-->
        <section class="cart container my-5 py5">
            <div class="container mt-5">
                <h2 class="font-weight-bolde">Your cart</h2>
                <hr>
            </div>
            <table class="mt-5 pt-5">
                <tr>
                    <th>product</th>
                    <th>quantity</th>
                    <th>subtotal</th>
                    
                </tr>

              <?php foreach($_SESSION['cart'] as $key => $value){?>

                <tr>
                    <td>
                        <div class="product-info">
                            <img src="assets/imgs/<?php echo $value['product_image'];?>">
                            <div>
                                <p><?php echo $value['product_name'];?></p>
                                <small><span>$</span><?php echo $value['product_price'];?></small>
                                <br>
                                <form method="POST" action="cart.php">
                                  <input type="hidden" name="product_id" value="<?php echo $value['product_id'];?>">
                                  <input type="submit" name="remove_product" class="remove-tbn" value="remove">
                                </form>
                                
                            </div>
                        </div>
                    </td>
                    <td>
                        
                        <form method="POST" action="cart.php">
                          <input type="hidden" name="product_id" value="<?php echo $value['product_id'];?>">
                          <input type="number" name= "product_quantity" value="<?php echo $value['product_quantity'];?>">
                         <input type="submit" class="edit-btn" value="edit" name="edit_quantity">
                        
                        </form>
                    </td>
                    <td>
                        <span>$</span>
                        <span class="product-price"><?php echo $value['product_quantity'] * $value['product_price'];?></span>
                    </td>
                </tr>
              <?php }?>
              

            

                
            </table>
            <div class="cart-total">
                <table>
                    <!-- <tr>
                        <td>subtotal</td>
                        <td>120</td>
                    </tr> -->
                    <tr>
                        <td>total</td>
                        <td>$ <?php if(isset($_SESSION['total'])){ echo $_SESSION['total'];}?></td>
                    </tr>
                </table>
            </div>

            <div class="checkout-btn-container">
              <form method ="POST" action="checkout.php">
               <button class="btn checkout-btn" value="checkout" name="checkout">checkout</button>
              </form>
                
            </div>
        </section>







        <?php include('layouts/footer.php')?>