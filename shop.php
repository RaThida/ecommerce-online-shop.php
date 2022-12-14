<?php
  include('server/connection.php');

    //use the search section
  if(isset($_POST['search'])){
    //1. determine page no
    if(isset($_GET['page_no']) && $_GET['page_no'] != ""){
        $page_no = $_GET['page_no'];
    }else{
        $page_no = 1;
    }
    $category = $_POST['category'];
    $price = $_POST['price'];
    //2. return number of products
     $stmt1 = $conn->prepare("SELECT COUNT(*) As total_records FROM products Where product_category=? and product_price<=?");
     $stmt1 ->bind_param('si',$category,$price);
     $stmt1 -> execute();
     $stmt1 ->bind_result($total_records);
     $stmt1 ->store_result();
     $stmt1 ->fetch();
    //3. products per page
     $total_records_per_page = 2;
     $offset = ($page_no-1) * $total_records_per_page;
     $previous_page = $page_no - 1;
     $next_page = $page_no + 1;
     $adjacents  = "2";
     $total_no_of_pages = ceil($total_records/$total_records_per_page);

    //4. get all products
    $stmt2 = $conn->prepare("SELECT * FROM products where product_category=? and product_price<=? LIMIT $offset,$total_records_per_page");
    $stmt2->bind_param('si',$category,$price);
    $stmt2 ->execute();
    $products = $stmt2->get_result();



   
    //return all product
  }else{
    //1. determine page no
    if(isset($_GET['page_no']) && $_GET['page_no'] != ""){
        $page_no = $_GET['page_no'];
    }else{
        $page_no = 1;
    }
    //2. return number of products
    $stmtl = $conn->prepare("SELECT COUNT(*) As total_records FROM products");
    $stmtl -> execute();
    $stmtl ->bind_result($total_records);
    $stmtl ->store_result();
    $stmtl ->fetch();
   
    //3. products per page
    $total_records_per_page = 2;
    $offset = ($page_no-1) * $total_records_per_page;
    $previous_page = $page_no - 1;
    $next_page = $page_no + 1;
    $adjacents  = "2";
    $total_no_of_pages = ceil($total_records/$total_records_per_page);



    //4. get all products
    $stmt2 = $conn->prepare("SELECT * FROM products LIMIT $offset,$total_records_per_page");
    $stmt2 ->execute();
    $products = $stmt2->get_result();
  }

   
?>





<?php include('layouts/header.php')?>

        <!-- Search -->
        <section id="search" class=" my-5 py-5 ms-2 ">
            <div class="container mt-5 py-5">
                <p>search products</p>
                <hr>
            </div>
            <form action="shop.php" method="POST">
                <div class="row mx-auto container"style=" float: left">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <p>category</p>
                        <div class="form-check">
                            <input class="form-check-input" value="watches" type="radio" name="category" id="category_one"<?php if(isset($category) && $category=='watches'){echo 'checked';} ?> >
                            <label class="form-check-label" for="flexRadioDefault1">
                            watches</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" value="shoes" type="radio" name="category" id="category_one" <?php if(isset($category) && $category=='shoes'){echo 'checked';} ?> >
                            <label class="form-check-label" for="flexRadioDefault2">
                            shoes</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" value="coats" type="radio" name="category" id="category_one" <?php if(isset($category) && $category=='coats'){echo 'checked';} ?> >
                            <label class="form-check-label" for="flexRadioDefault3">
                            coats</label>
                        </div>
                    </div>
                </div>
                <div class="row mx-auto  container mt-5">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <p>price</p>
                        <input type="range" class="form-range w-50" name="price" value="<?php if(isset($price)){echo $price;}else{echo "100"; }?>" min="1" max="500" id="customRange2">
                        <div class="w-50">
                            <span style="float: left">1</span>
                            <span style="float: right">500</span>
                        </div>
                    </div>

                </div>
                <div class="form-group my-3 mx-3">
                    <input type="submit" name="search" class="btn btn-primary">
                </div>
            </form>
        </section>

          <!--shoes-->
  <section id="shop" class="my-5 ">
    <div class="container text-center my-5 py-5 ">
      <h3>Shop</h3>
      <hr class="mx-auto">
      <p>fashionable shoes for who like the fashion</p>
    </div>
    
        <div class="row mx-auto container-fluid">
        
          <?php while($row= $products->fetch_assoc()){ ?>
            <div class="product text-center col-lg-3 col-md-4 col-sm-12">
              <img class="img-fluid mb-3 shop-image" src="assets/imgs/<?php echo $row['product_image'];?>">
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
          <?php } ?>

                <div aria-label="Page navigation example" class="mx-auto">
                    <ul class="pagination mt-5 mx-auto">
                        <li class="page-item <?php if($page_no<=1){echo 'disabled';}?> ">
                            <a class="page-link" href="<?php if($page_no<=1){echo '#';}else{echo "?page_no=".($page_no-1);} ?>" >previous</a>
                        </li>

                        <li class="page-item"><a class="page-link" href="?page_no=1">1</a></li>
                        <li class="page-item"><a class="page-link" href="?page_no=2">2</a></li>
                        <?php if($page_no>=3){ ?>
                            <li class="page-item"><a class="page-link" href="#">...</a></li>
                            <li class="page-item"><a class="page-link" href="<?php echo"?page_no=".$page_no; ?>"><?php echo $page_no; ?></a></li>
                        <?php }?>
                        <li class="page-item <?php if($page_no>= $total_no_of_pages){echo 'disabled';}?>">
                            <a class="page-link" href="<?php if($page_no >= $total_no_of_pages ){echo '#';} else{ echo "?page_no=".($page_no+1);}?>">next</a>
                        </li>

                    </ul>
                </div>
        </div>
  
  </section>











        <?php include('layouts/footer.php')?>