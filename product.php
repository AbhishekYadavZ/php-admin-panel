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
                            Gift Products
                            <a href="product_add.php" class="btn btn-primary float-right" >Add</a>
                        </h4>
                    </div>
                    <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Description</th>
                                <th>Price</th>
                                <th>Status</th>
                                <th>Created At</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                            $query = "SELECT * FROM `products`";
                            $query_run =  mysqli_query($con,$query);

                            if(mysqli_num_rows($query_run)>0)
                            {  
                                foreach($query_run as $proditem)
                                {
                                    
                                    ?>
                                    <tr>
                                        <td><?php echo $proditem["id"]; ?></td>
                                        <td><?php echo $proditem["name"]; ?></td>
                                        <td><?php echo $proditem["small_description"]; ?></td>
                                        <td><?php echo $proditem["price"]; ?></td>
                                        <td>
                                        <input type="checkbox" <?= $proditem['status'] == '1' ? 'checked':'' ?> readonly/>
                                        </td>
                                        <td><?php echo $proditem["created_at"]; ?></td>
                                        <td>
                                            <a href="product_edit.php?prod_id=<?php echo  $proditem['id']; ?>" class="btn btn-sm btn-success">Edit</a>
                                        </td>
                                        <td>
                                            <form action="code.php" method="POST">
                                                <input type="hidden" name="cate_delete_id" value="<?php echo  $proditem['id']; ?>">
                                                <button  type="submit" name="cate_delete_btn" class="btn btn-sm btn-danger">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                    <?php
                                }
                            }
                            else
                            {
                                ?>
                                <tr>
                                    <td>No Records Found</td>
                                </tr>
                                <?php
                            }
                        ?>
                      
                        </tbody>
                        <tfoot>
                        
                        </tfoot>
                    </table>
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