<?php include('header.php'); ?>

<?php

session_start();
    if(isset($_GET['product_id'])){
        $product_id = $_GET['product_id'];
        $stmt = $conn->prepare("SELECT * FROM products WHERE product_id=?");
        $stmt ->bind_param('i',$product_id);
        $stmt -> execute();
        $products = $stmt->get_result();
    }elseif(isset($_POST['edit_btn'])) {
        $product_id = $_POST['product_id'];
        $title = $_POST['title'];
        $description = $_POST['description'];
        $price = $_POST['price'];
        $category = $_POST['category'];
        $color = $_POST['color'];
        $offer = $_POST['offer'];


        $stmt = $conn->prepare("UPDATE products SET product_name=?, product_description=?, product_price=?, 
        product_category=?, product_special_offer=?, product_color=? where product_id=?");
        $stmt->bind_param('ssssssi',$title,$description,$price,$category,$offer,$color,$product_id);
        if ($stmt->execute()){

            header('location: products.php?edit_success_message=product has been update success');

        }else{
            header('location: products.php?edit_failure_message=failed to update the product');

        }

    }
  
    else{
        header('location: product.php');
        exit;
    }
?>








<?php include('sidemenu.php'); ?>
<div class="container-fluid">
  <div class="" style="min-height: 100%">
 
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
       <h2>Dashboard</h2>
      

      </div>

      
      <div class="table-responsive">
      <h2>Edit product</h2>

   <div class="mx-auto container">
        <form id="edit-form" method="POST" action="edit_product.php">
            <p style="color: 11D780" ><?php if(isset($_GET['error'])){echo $_GET['error'];}?></p>
            <div class="form-group mt-2">
        <?php foreach($products as $product){?>
                <input type="hidden" name="product_id" value="<?php echo $product['product_id'];?>">
                <label>Title</label>
                <input type="text" class="form-control" id="product-name" value="<?php echo $product['product_name']?>" name="title" placeholder="Title" required>
            </div>
            <div class="form-group mt-2">
                <label>description</label>
                <input type="text" class="form-control" id="product-desc" value="<?php echo $product['product_description']?>" name="description" placeholder="Description" required>
            </div>

            <div class="form-group mt-2">
                <label>price</label>
                <input type="text" class="form-control" id="product-price" value="<?php echo $product['product_price']?>" name="price" placeholder="price" required>
            </div>

            <div class="form-group mt-2">
                <label>Category</label> 
                <select class="form-select" required name="category">
                    <option value="coats">coats</option>
                    <option value="shoes">shoes</option>
                    <option value="watches">watches</option>
                    <option value="clothes">clothes</option>
                </select> 
            </div>
            <div class="form-group mt-2">
                <label>color</label>
                <input type="text" class="form-control" value="<?php echo $product['product_color']?>" name="color" placeholder="color" required>
            </div>
            <div class="form-group mt-2">
                <label>special offer/sale</label>
                <input type="number" class="form-control"value="<?php echo $product['product_special_offer']?>" name="offer" placeholder="sale %" required>
            </div>
            <div class="form-group mt-3">
                <input type="submit" class="btn btn-primary"  name="edit_btn" value="edit" >
            </div>
        <?php }?>
        </form>
    </div>
 