<?php include('header.php');?>

<?php

    session_start();

    if(isset($_GET['order_id'])){
        $order_id = $_GET['order_id'];
        $stmt = $conn->prepare("SELECT * FROM orders WHERE order_id=?");
        $stmt ->bind_param('i',$order_id);
        $stmt -> execute();
        $orders = $stmt->get_result();
    }elseif(isset($_POST['edit_order'])){

        $order_status = $_POST['order_status'];
        $order_id = $_POST['order_id'];

        $stmt = $conn->prepare("UPDATE orders SET order_status=? where order_id=?");
        $stmt->bind_param('si',$order_status,$order_id);
        if ($stmt->execute()){

            header('location: index.php?order_update=the order has updated');

        }else{
            header('location: index.php?failed_update=failed to update the order');

        }


    }else{
        header('location: index.php');
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
      <h2>Edit Order</h2>

   <div class="mx-auto container">
        <form id="edit-form" method="POST" action="edit_order.php">

        <?php foreach($orders as $order){?>
            <p style="color: 11D780" ><?php if(isset($_GET['error'])){echo $_GET['error'];}?></p>
            <div class="form-group mt-2">

                <label>order_id</label>
                <p class="my-4"><?php echo $order['order_id'];?></p>
            </div>
            <div class="form-group mt-2">
                <label>order price</label>
                <p class="my-4"><?php echo $order['order_cost'];?></p>
            </div>

            <input type="hidden" name="order_id" value="<?php echo $order['order_id']?>">

            <div class="form-group mt-2">
                <label>order status</label>
                <select class="form-select" required name="order_status">
                    
                    <option value="not paid" <?php if($order['order_id']=='not paid'){echo "selected";}?>>no paid</option>
                    <option value="paid" <?php if($order['order_id']=='paid'){echo "selected";}?>>paid</option>
                    <option value="shipped" <?php if($order['order_id']=='shipped'){echo "selected";}?>>shipped</option>
                    <option value="delivered" <?php if($order['order_id']=='delivered'){echo "selected";}?>>delivered</option>
                </select> 
            </div>

            <div class="form-group mt-2">
                <label>order date</label>
                <p class="my-4"><?php echo $order['order_date'];?></p>
            </div>

            <div class="form-group mt-3">
                <input type="submit" class="btn btn-primary"  name="edit_order" value="edit" >
            </div>
         
          <?php }?>
       
        </form>
    </div>