<?php
    //session_start();
    include('authentication.php');
    include('config/dbcon.php');
    include('includes/header.php');
    include('includes/topbar.php');
    include('includes/sidebar.php');
?>




<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <?php
        if(isset($_GET['prod_id']))
        {
            $product_id = $_GET['prod_id'];
            $query = "SELECT * FROM products where id='$product_id'";
            $query_run = mysqli_query($con,$query);

            if(mysqli_num_rows($query_run)>0)
            {
                $proditem = mysqli_fetch_array($query_run);
                ?>
                
                <?php
            
    ?>
    <div class="container mt-4">
        <div class="row">
            <div class="col-md-12">
                <?php include('message.php'); ?>
                <div class="card">
                    <div class="card-header">
                        <h4>
                            Edit Gift Products
                            <a href="product.php" class="btn btn-danger float-right">Back</a>
                        </h4>
                    </div>
                    <div class="card-body">
                        <form action="code.php" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="product_id" value="<?= $proditem['id'] ?>" />
                            
                            <div class="row">
                                <div class="col-md-12">
                                    <label for="">Category</label>
                                    <?php 
                                        $query = "SELECT * FROM categories";
                                        $query_run = mysqli_query($con,$query);

                                        if(mysqli_num_rows($query_run)>0)
                                        {
                                            ?>
                                            <select name="category_id" required class="form-control">
                                            <?php foreach($query_run as $item) 
                                            {?>
                                                <option value="" disabled >--SELECT CATEGORY--</option>
                                                <option value="<?=  $item['id']; ?>"
                                                    <?=  $proditem['category_id'] == $item['id'] ? 'selected': '' ?>>
                                                    <?=  $item['name']; ?>
                                                
                                                </option>
                                                <?php 
                                            }?>
                                                </select>
                                                
                                            <?php
                                        }
                                    ?>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="">Product Name</label>
                                        <input type="text" name="name" class="form-control" value="<?= $proditem['name'] ?>" placeholder="Enter Product Name" required>
                                    </div>
                                </div>
                            
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Small Description</label>
                                        <textarea name="small_description" id=""   class="form-control" rows="3" required><?= $proditem['small_description'] ?></textarea>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Long Description</label>
                                        <textarea name="long_description" id=""   class="form-control" rows="3" required><?= $proditem['long_description'] ?></textarea>
                                    </div>
                                </div>
                            
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="">Product Price</label>
                                        <input type="text" name="price" class="form-control" value="<?= $proditem['price'] ?>" placeholder="Enter Product Price" required>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="">Offer Price</label>
                                        <input type="text" name="offerprice" class="form-control" value="<?= $proditem['offerprice'] ?>" placeholder="Enter Offer Price" required>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="">Tax</label>
                                        <input type="text" name="tax" class="form-control"value="<?= $proditem['tax'] ?>" placeholder="Enter Tax" required>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="">Quantity</label>
                                        <input type="text" name="quantity" class="form-control" value="<?= $proditem['quantity'] ?>" placeholder="Enter Quantity" required>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="">Status (checked = Show | Hide)</label><br>
                                        <input type="checkbox" name="status" <?= $proditem['status'] == '1' ? 'checked':'' ?> /> Show / Hide
                                    </div>
                                </div>
                            
                                
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label for="">Upload Image</label>
                                        <input type="file" name="image" class="form-control">
                                        <input type="hidden" name="old_image" value="<?= $proditem['image'] ?>" />
                                    </div>
                                    <img src="uploads/products/<?= $proditem['image'] ?>" width="50px" height="50px" alt="">
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        
                                        <button type="submit" name="product_update" class="btn btn-primary btn-block">Update</button>
                                    </div>
                                </div>
                                
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
}
            else
            {
                echo "No Such product Found";
            }
        }
        ?>
</div>


<?php
    include('includes/script.php');
    include('includes/footer.php');
?>