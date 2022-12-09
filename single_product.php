<?php

  include('server/connection.php');

  if(isset($_GET['product_id'])){
    $product_id = $_GET['product_id'];
    $stmt = $conn->prepare("SELECT * FROM products  WHERE product_id = ?");

    $stmt ->bind_param("i", $product_id);

    $stmt->execute();

    $product = $stmt ->get_result();
  }
  else{
    header('location: index.php');
  }
?>


<?php include('layouts/header.php')?>


    
        <!--single product-->
        <section class=" container single-product my-5 pt-5 ">
            <div class="row mt-5 ">

              <?php while($row=$product->fetch_assoc()){ ?>
                
                

                


                  <div class="col-lg-5 col-md-6 col-sm-12">
                      <img class="img-fluid w-100 pb-1" src="assets/imgs/<?php echo $row['product_image']; ?>" id="mainImg">
                      <div class="small-img-group">
                          <div class="small-img-col">
                              <img src="assets/imgs/<?php echo $row['product_image']; ?>" width="100%" class="small-img">
                          </div>
                          <div class="small-img-col">
                              <img src="assets/imgs/<?php echo $row['product_image']; ?>" width="100%" class="small-img">
                          </div>
                          <div class="small-img-col">
                              <img src="assets/imgs/<?php echo $row['product_image']; ?>" width="100%" class="small-img">
                          </div>
                          <div class="small-img-col">
                              <img src="assets/imgs/<?php echo $row['product_image']; ?>" width="100%" class="small-img">
                          </div>
                          <div class="small-img-col">
                              <img src="assets/imgs/<?php echo $row['product_image']; ?>" width="100%" class="small-img">
                          </div>
                      </div>
                  </div> 
                
                


                  <div class="col-lg-5 col-md-6 col-sm-12">
                      <h6>women/clothes</h6>
                      <h3 class="py-4"><?php echo $row['product_name']; ?></h3>
                      <h2>$<?php echo $row['product_price']; ?></h2>
                      <form method="POST" action="cart.php">
                        <input type="hidden" name="product_id" value="<?php echo $row['product_id'];?>">
                        <input type="hidden" name="product_image" value="<?php echo $row['product_image']; ?>">
                        <input type="hidden" name="product_name" value="<?php echo $row['product_name']; ?>">
                        <input type="hidden" name="product_price" value="<?php echo $row['product_price']; ?>">

                        <input type="number" value="product_quantity" value="1">
                        <button class="buy-btn" type="submit" name="add_to_cart">Add to cart</button>

                      </form>
                      
                      <h4 class="mt-5 mb-5">product details</h4>
                      <span><?php echo $row['product_description'];?></span>
                  </div>
               
              <?php } ?>


            </div>
        </section>

        <!--related product-->
        <section id="related product" class="my-5 pb-5">
            <div class="container text-center my-5 pb-5 ">
              <h3>related products</h3>
              <hr class="mx-auto">
              
            </div>
            <div class="row mx-auto container-fluid">
              <div class="product col-lg-3 col-md-4 col-sm-12">
                <img class="img-fluid mb-3" src="assets/imgs/springoutfit.jpg">
                <div class="star">
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                </div>
                <h5 class="p-name">korean spring outfit for girl</h5>
                <h4 class="p-price">30$</h4>
                <button class="buy-btn">buy now</button>
              </div>
  
              <div class="product col-lg-3 col-md-4 col-sm-12">
                <img class="img-fluid mb-3" src="assets/imgs/springoutfit3.jpg">
                <div class="star">
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                </div>
                <h5 class="p-name">korean spring outfit  for girl</h5>
                <h4 class="p-price">25$</h4>
                <button class="buy-btn">buy now</button>
              </div>
  
              <div class="product col-lg-3 col-md-4 col-sm-12">
                <img class="img-fluid mb-3" src="assets/imgs/springoutfit1.jpg">
                <div class="star">
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                </div>
                <h5 class="p-name">korean spring outfit for girl</h5>
                <h4 class="p-price">20$</h4>
                <button class="buy-btn">buy now</button>
              </div>
            </div>
        </section>


        <footer class="'mt-5 py-5">
            <div class="row container mx-auto pt-5">
              <div class="footer-one col-lg-3 col-md-6 col-sm-12">
                <img class="logo" src="assets/imgs/logo.png">
                <p class="pt-3"> We provide the best products for the most affordable prices</p>
              </div>
              <div class="footer-one col-lg-3 col-md-6 col-sm-12">
                <h5 class="pb-2">Featured</h5>
                <ul class="text-uppercase">
                  <li><a href="#">men</a></li>
                  <li><a href="#">women</a></li>
                  <li><a href="#">new arrivals</a></li>
                  <li><a href="#">new collection</a></li>
                  
                </ul>
              </div>
              <div class="footer-one col-lg-3 col-md-6 col-sm-12">
                <h5 class="pb-2">Contact</h5>
               <div >
                <h6 class="text-uppercase">Address</h6>
               </div>
               <div >
                <h6 class="text-uppercase">phone number</h6>
               </div>
               <div >
                <h6 class="text-uppercase">Email</h6>
               </div>
              </div>
              <div class="footer-one col-lg-3 col-md-6 col-sm-12">
                <h5 class="pb-2">Instagram</h5>
                <div class="row">
                  <img src="assets/imgs/watch.jpg" class="img-fluid w-25 h-100 m-2">
                  <img src="assets/imgs/nacklace.jpg" class="img-fluid w-25 h-100 m-2">
                  <img src="assets/imgs/ring.jpg" class="img-fluid w-25 h-100 m-2">
                  <img src="assets/imgs/springoutfit1.jpg" class="img-fluid w-25 h-100 m-2">
                  <img src="assets/imgs/springoutfit3.jpg" class="img-fluid w-25 h-100 m-2">
                  <img src="assets/imgs/springoutfit.jpg" class="img-fluid w-25 h-100 m-2">
                </div>
              </div>
            </div>
            <div class="copyright mt-5">
              <div class="row container mx-auto">
                <div class="col-lg-3 col-md-5 col-sm-12 mb-4">
                  <img src="assets/imgs/paymentpic.png">
        
                </div>
                <div class="col-lg-3 col-md-5 col-sm-12 mb-4">
                  <p>ecommerce @ IT Team all right reserved</p>
                </div>
                <div class="col-lg-3 col-md-5 col-sm-12 mb-4 text-nowrap mb-2">
                  <a class="#"><i class="fab fa-facebook"></i></a>
                  <a class="#"><i class="fab fa-instagram"></i></a>
                  <a class="#"><i class="fab fa-twitter"></i></a>
                </div>
              </div>
            </div>
        </footer>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
        <script>
          var mainImg= document.getElementById("mainImg");
          var smallImg = document.getElementsByClassName("small-img");


          for(let i=0; i<6; i++){
            smallImg[i].onclick = function(){
            mainImg.src = smallImg[i].src;
          }
          }
          

         
        </script>
    </body>
</html>