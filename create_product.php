
<?php 
    include('../server/connection.php');
     include('header.php'); 

    if(isset($_POST['create_product'])){
        $product_name = $_POST['name'];
        $product_description = $_POST['description'];
        $product_price = $_POST['price'];
        $product_special_offer = $_POST['offer'];
        $product_category = $_POST['category'];
        $product_color = $_POST['color'];

        $image = $_FILES['image']['tmp_name'];
        $file_name = $_FILES['image']['name'];

        $image_name = $product_name."";


        move_uploaded_file($image."../assets/imgs/".$image_name);


        $stmt = $conn->prepare("INSERT INTO products (product_name,product_description,product_price,product_specail_offer,
                                product_image,product_category,product_color)
                                 VALUE (?,?,?,?,?,?,?)");

        $stmt->bind_param('sssssss',$product_name,$product_description,$product_price,$product_specail_offer,$image,$product_category,$product_color);
        if($stmt->execute()){
            header('location: products.php?product_created=product has been created');

        }else{
            header('location: products.php?created_failed=failed to created the new product');
        }


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
      <h2>create product</h2>

   <div class="mx-auto container">
        <form id="edit-form" method="POST" action="add_product.php">
            <p style="color: 11D780" ><?php if(isset($_GET['error'])){echo $_GET['error'];}?></p>
            <div class="form-group mt-2">
        <?php //foreach($products as $product){?>
                <!-- <input type="hidden" name="product_id" value="<?php// echo $product['product_id'];?>"> -->
                <label>Title</label>
                <input type="text" class="form-control" id="product-name" name="name" placeholder="Title" required>
            </div>
            <div class="form-group mt-2">
                <label>description</label>
                <input type="text" class="form-control" id="product-desc"  name="description" placeholder="Description" required>
            </div>

            <div class="form-group mt-2">
                <label>price</label>
                <input type="text" class="form-control" id="product-price"  name="price" placeholder="price" required>
            </div>

            <div class="form-group mt-2">
                <label>special offer/sale</label>
                <input type="number" class="form-control" name="offer" placeholder="sale %" required>
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
                <input type="text" class="form-control"  name="color" placeholder="color" required>
            </div>
            <div class="form-group mt-2">
                <label>image</label>
                <input type="file" class="form-control"  name="image" placeholder="image" required>
            </div>

            <div class="form-group mt-3">
                <input type="submit" class="btn btn-primary"  name="create_btn" value="create" >
            </div>

