<?php include('layouts/header.php')?>


    <!--Home-->
   <section id="home">
    <div class="container" >
      <h5>NEW ARRIVALS</h5>
      <h1><span>Best Prices</span> This season  </h1>
      <p>Eshop offers the best products for you</p>
      <button>Shop Now</button>
      
    </div>
  </section>
  <!--Brabd-->
  <section id="brand" class="container">
    <div class="row">
      <img class="img-fluid col-lg-3 col-md-6 col-sm-12" src="assets/imgs/FILA.png"/>
      <img class="img-fluid col-lg-3 col-md-6 col-sm-12" src="assets/imgs/g-shock-casio.png"/>
      <img class="img-fluid col-lg-3 col-md-6 col-sm-12" src="assets/imgs/converse.png"/>
      <img class="img-fluid col-lg-3 col-md-6 col-sm-12" src="assets/imgs/chanel.png"/>

  
    </div>
  </section>
  <!--new-->
  <section id="new" class="w-100">
    <div class="row p-0 m-0">
      <!--one-->
      <div class="one col-lg-4 col-md-12 col-sm-12 p-0">
        <img class="img-fluid" src="assets/imgs/3.jpg">
        <div class="details">
          <h2> extreamely awesome shoes</h2>
          <button class="text-uppercase">shop now</button>
        </div>
      </div>
      <!--two-->
      <div class="one col-lg-4 col-md-12 col-sm-12 p-0">
        <img class="img-fluid" src="assets/imgs/3.jpeg">
        <div class="details">
          <h2> bagpag</h2>
          <button class="text-uppercase">shop now</button>
        </div>
      </div>
      <!--three-->
      <div class="one col-lg-4 col-md-12 col-sm-12 p-0">
        <img class="img-fluid" src="assets/imgs/smart-watch.jpg">
        <div class="details">
          <h2> new style of watch</h2>
          <button class="text-uppercase">shop now</button>
        </div>
      </div>
        <!--four-->
        <div class="one col-lg-4 col-md-12 col-sm-12 p-0">
          <img class="img-fluid" src="assets/imgs/summeroutfit.webp">
          <div class="details">
            <h2> best for summer season</h2>
            <button class="text-uppercase">shop now</button>
          </div>
        </div>
        <!--five-->
        <div class="one col-lg-4 col-md-12 col-sm-12 p-0">
          <img class="img-fluid" src="assets/imgs/dress.jpg">
          <div class="details">
            <h2> cute dress</h2>
            <button class="text-uppercase">shop now</button>
          </div>
        </div>
    </div>
  </section>
  <!--featured-->
  <section id="featured" class="my-5 pb-5">
    <div class="container text-center my-5 pb-5 ">
      <h3>our featured</h3>
      <hr class="mx-auto">
      <p>Here our products featured</p>
    </div>
    <div class="row mx-auto container-fluid">
    <?php include('server/get_featured_product.php');?>
    <?php while($row= $featured_products->fetch_assoc()){ ?>  

      <div class="product text-center col-lg-3 col-md-4 col-sm-12">
        <img class="img-fluid mb-3" src="assets/imgs/<?php echo $row['product_image'];?>">
        <div class="star">
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
        </div>
        <h5 class="p-name"><?php echo $row['product_name']; ?></h5>
        <h4 class="p-price">$<?php echo $row['product_price']; ?></h4>
        <a href="single_product.php?product_id=<?php echo $row['product_id'];?>"><button class="buy-btn">buy now</button></a>
      </div>

     

    <?php } ?>
    </div>
  </section>
  <!--banner-->
  <section id="banner" class="my-5 py-5">
    <div class="container">
      <h4>MID SEASON'S SALE</h4>
      <h1>Autumn collection<br> up to 15% off</h1>
      <button class="text-uppercase">shop now</button>
    </div>
  </section>
  <!--coats-->
  <section id="coats" class="my-5 ">
    <div class="container text-center my-5 pb-5 ">
      <h3>Dress & Coats</h3>
      <hr class="mx-auto">
      <p>Here our products1</p>
    </div>
    <div class="row mx-auto container-fluid">

      <?php include('server/get_coat.php');?>

      <?php while($row=$coats_products->fetch_assoc()){ ?>

        <div class="product col-lg-3 col-md-4 col-sm-12">
          <img class="img-fluid mb-3 coat-image" src="assets/imgs/<?php echo $row['product_image']; ?>">
          <div class="star">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
          </div>
          <h5 class="p-name"><?php echo $row['product_name']; ?></h5>
          <h4 class="p-price">$<?php echo $row['product_price']; ?></h4>
          <button class="buy-btn">buy now</button>
        </div>
      
      <?php } ?>
     

      

      
    </div>
  </section>

  <!--shoes-->
  <section id="shoes" class="my-5 ">
    <div class="container text-center my-5 pb-5 ">
      <h3>Shoes</h3>
      <hr class="mx-auto">
      <p>fashionable shoes for who like the fashion</p>
    </div>
    
        <div class="row mx-auto container-fluid">
        <?php include('server/get_shoes.php');?>
          <?php while($row= $shoes->fetch_assoc()){ ?>
            <div class="product text-center col-lg-3 col-md-4 col-sm-12">
              <img class="img-fluid mb-3" src="assets/imgs/<?php echo $row['product_image'];?>">
                <div class="star">
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                </div>
                <h5 class="p-name"><?php echo $row['product_name'];?></h5>
                <h4 class="p-price">$<?php echo $row['product_price'];?></h4>
                <a href="single_product.php?product_id=<?php echo $row['product_id'];?>"><button class="buy-btn">buy now</button></a>
            </div>
          <?php }?>
        </div>

    
    
      

  
  </section>

  <!--watches-->
  <section id="watches" class="my-5 ">
    <div class="container text-center my-5 pb-5 ">
      <h3>Watches</h3>
      <hr class="mx-auto">
      <p>here is what you wanna see</p>
    </div>

   
    <div class="row mx-auto container-fluid">
    <?php include('server/get_watch.php');?>
    <?php while($row= $watches->fetch_assoc()){ ?>
      <div class="product text-center col-lg-3 col-md-4 col-sm-12">
      <img class="img-fluid mb-3 wateches-image" src="assets/imgs/<?php echo $row['product_image'];?>">
        <div class="star">
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
        </div>
        <h5 class="p-name"><?php echo $row['product_name'];?></h5>
        <h4 class="p-price">$<?php echo $row['product_price'];?></h4>
        <a href="single_product.php?product_id=<?php echo $row['product_id'];?>"><button class="buy-btn">buy now</button></a>
        <?php } ?>
      </div>


   
  </section>
 
  <?php include('layouts/footer.php')?>
