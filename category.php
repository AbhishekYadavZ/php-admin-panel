<?php
    //session_start();
    include('authentication.php');
    include('config/dbcon.php');
    include('includes/header.php');
    include('includes/topbar.php');
    include('includes/sidebar.php');
?>


<!-- Modal -->
<div class="modal fade" id="categoryModal" tabindex="-1" aria-labelledby="categoryModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="categoryModalLabel">Gift Category</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <form action="code.php" method="post">
            <div class="modal-body">
                <div class="form-group">
                    <label for="">Category Name</label>
                    <input type="text" name="name" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="">Category Description</label>
                    <textarea name="description" id=""  rows="3"  class="form-control" required></textarea>
                  
                </div>
                <div class="form-group">
                    <label for=""></label>
                    <input type="checkbox" name="trending"> Trending
                </div>
                <div class="form-group">
                    <label for=""></label>
                    <input type="checkbox" name="status"> Status
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="sumbit" name="category_save" class="btn btn-primary">Save</button>
            </div>
        </form>
    </div>
  </div>
</div>


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <div class="container mt-4">
        <div class="row">
            <div class="col-md-12">
                <?php include('message.php'); ?>
                <div class="card">
                    <div class="card-header">
                        <h4>
                            Gift Category
                            <a href="" class="btn btn-primary float-right" data-toggle="modal" data-target="#categoryModal">Add</a>
                        </h4>
                    </div>
                    <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Description</th>
                                <th>Trending</th>
                                <th>Status</th>
                                <th>Created At</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                            $query = "SELECT * FROM `categories`";
                            $query_run =  mysqli_query($con,$query);

                            if(mysqli_num_rows($query_run)>0)
                            {  
                                foreach($query_run as $cateitem)
                                {
                                    
                                    ?>
                                    <tr>
                                        <td><?php echo $cateitem["id"]; ?></td>
                                        <td><?php echo $cateitem["name"]; ?></td>
                                        <td><?php echo $cateitem["description"]; ?></td>
                                        <td>
                                           <input type="checkbox" <?= $cateitem['trending'] == '1' ? 'checked':'' ?> readonly/>
                                        </td>
                                        <td>
                                        <input type="checkbox" <?= $cateitem['status'] == '1' ? 'checked':'' ?> readonly/>
                                        </td>
                                        <td><?php echo $cateitem["created_at"]; ?></td>
                                        <td>
                                            <a href="category_edit.php?id=<?php echo  $cateitem['id']; ?>" class="btn btn-sm btn-success">Edit</a>
                                        </td>
                                        <td>
                                            <form action="code.php" method="POST">
                                                <input type="hidden" name="cate_delete_id" value="<?php echo  $cateitem['id']; ?>">
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