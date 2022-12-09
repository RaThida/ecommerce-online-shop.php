<?php include('header.php');?>
<?php 


  if(isset($_SESSION['admin_logged_in'])){
    header('location: login.php');
    exit;
  }
?>
<?php


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
  $total_records_per_page =6;
  $offset = ($page_no-1) * $total_records_per_page;
  $previous_page = $page_no - 1;
  $next_page = $page_no + 1;
  
  $total_no_of_pages = ceil($total_records/$total_records_per_page);



  //4. get all products
  $stmt2 = $conn->prepare("SELECT * FROM products LIMIT $offset,$total_records_per_page");
  $stmt2 ->execute();
  $products = $stmt2->get_result();



 



?>
<?php include('sidemenu.php'); ?>

<div class="container-fluid">
  <div class="" style="min-height: 100%">
  <br><br>

<br><br>
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
       
      <br><br>

      </div>

      
      <div class="table-responsive">
      <h2>Prpducts</h2>
      <?php if(isset($_GET['edit_success_message'])){ ?>
        <p class="text-center" style="color:green;"><?php echo $_GET['edit_success_message'];?></p>
      <?php }?>

      <?php if(isset($_GET['edit_failure_message'])){ ?>
        <p class="text-center" style="color:red;"><?php echo $_GET['edit_failure_message'];?></p>
      <?php }?>
      
      <?php if(isset($_GET['deleted_successfully'])){ ?>
        <p class="text-center" style="color:green;"><?php echo $_GET['deleted_successfully'];?></p>
      <?php }?>
      

      <?php if(isset($_GET['deleted_failed'])){ ?>
        <p class="text-center" style="color:red;"><?php echo $_GET['deleted_failed'];?></p>
      <?php }?>


      <?php if(isset($_GET['product_created'])){ ?>
        <p class="text-center" style="color:green;"><?php echo $_GET['product_created'];?></p>
      <?php }?>

      <?php if(isset($_GET['created_failed'])){ ?>
        <p class="text-center" style="color:red;"><?php echo $_GET['created_failed'];?></p>
      <?php }?>


        <table class="table table-striped table-sm">
          <thead>
            <tr>
              <th scope="col col-1">product id</th>
              <th scope="col col-2">product image</th>
              <th scope="col col-3">product name</th>
              
              <th scope="col col-5">product price</th>
              <th scope="col col-4">product offer</th>
              <th scope="col col-5">product category</th>
              <th scope="col col-5">product color</th>
              <th scope="col col-5">edit</th>
              <th scope="col col-5">delete</th>
            </tr>
          </thead>
          <br>
          <tbody>
            <?php foreach($products as $product){?>
            <tr>
              <td><?php echo $product['product_id'];?></td>
              <td><img src="<?php echo "../assets/imgs/".$product['product_image'];?>" style="width:70px; height:70px;"></td>
              <td><?php echo $product['product_name'];?></td>
              <td><?php echo $product['product_price'];?></td>
              <td><?php echo $product['product_special_offer']."%";?></td>
              <td><?php echo $product['product_category'];?></td>
              <td><?php echo $product['product_color'];?></td>
              <td><a class="btn btn-primary" href="edit_product.php?product_id=<?php echo $product['product_id'];?>">Edit</a></td>
              <td><a class="btn btn-danger" href="delete_product.php?product_id=<?php echo $product['product_id'];?>">delete</a></td>
            </tr>
          <?php }?>

          </tbody>
        </table>

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
    </main>
  </div>
</div>


    <script src="/docs/5.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

      <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script><script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js" integrity="sha384-zNy6FEbO50N+Cg5wap8IKA4M/ZnLJgzc6w2NqACZaK0u0FXfOWRRJOnQtpZun8ha" crossorigin="anonymous"></script><script src="dashboard.js"></script>
  </body>
</html>








