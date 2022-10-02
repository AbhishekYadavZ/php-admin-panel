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
    <div class="container mt-4">
        <div class="row">
            <div class="col-md-12">
                <?php include('message.php'); ?>
                <div class="card">
                    <div class="card-header">
                        <h4>
                            Add Gift Products
                            <a href="product.php" class="btn btn-danger float-right">Back</a>
                        </h4>
                    </div>
                    <div class="card-body">
                        <form action="code.php" method="post" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-md-12">
                                    <label for="">Category</label>
                                    <?php 
                                        $query = "SELECT * FROM categories";
                                        $query_run = mysqli_query($con,$query);

                                        if(mysqli_num_rows($query_run)>0)
                                        {
                                            ?>
                                            <select name="category_id" class="form-control">
                                            <?php foreach($query_run as $item) 
                                            {?>
                                                <option value="" disabled selected>--SELECT CATEGORY--</option>
                                                <option value=""><?=  $item['name']; ?></option>
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
                                        <input type="text" name="name" class="form-control" placeholder="Enter Product Name" required>
                                    </div>
                                </div>
                            
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Small Description</label>
                                        <textarea name="small_description" id=""   class="form-control" rows="3" required></textarea>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Long Description</label>
                                        <textarea name="long_description" id=""   class="form-control" rows="3" required></textarea>
                                    </div>
                                </div>
                            
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="">Product Price</label>
                                        <input type="text" name="price" class="form-control" placeholder="Enter Product Price" required>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="">Offer Price</label>
                                        <input type="text" name="offerprice" class="form-control" placeholder="Enter Offer Price" required>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="">Tax</label>
                                        <input type="text" name="tax" class="form-control" placeholder="Enter Tax" required>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="">Quantity</label>
                                        <input type="text" name="quantity" class="form-control" placeholder="Enter Quantity" required>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="">Status (checked = Show | Hide)</label><br>
                                        <input type="checkbox" name="status"> Show / Hide
                                    </div>
                                </div>
                            
                                
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label for="">Upload Image</label>
                                        <input type="file" name="image" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">Click to Save</label><br>
                                        <button type="submit" name="product_save" class="btn btn-primary btn-block">Save</button>
                                    </div>
                                </div>
                                
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<?php
    include('includes/script.php');
    include('includes/footer.php');
?>