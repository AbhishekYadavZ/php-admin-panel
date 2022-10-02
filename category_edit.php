<?php
    include('authentication.php');
    include('includes/header.php');
    include('includes/topbar.php');
    include('includes/sidebar.php');
    include('config/dbcon.php');
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
                            Edit Gift Category
                            <a href="category.php" class="btn btn-danger float-right">Back</a>
                        </h4>
                    </div>
                    <div class="card-body">
                    <form action="code.php" method="post">
                        <?php
                            if(isset($_GET['id']))
                            {
                                $cate_id = $_GET['id'];
                                $query = "SELECT * FROM categories where id='$cate_id'";
                                $query_run = mysqli_query($con, $query);
                                
                                foreach($query_run as $item):
                                ?>
                                <input type="hidden" name="cate_id" value="<?= $item['id']; ?>">
                                <div class="modal-body">
                                <div class="form-group">
                                    <label for="">Category Name</label>
                                    <input type="text" name="name" value="<?= $item['name']; ?>" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="">Category Description</label>
                                    <textarea name="description" id=""  rows="3"  class="form-control" required><?= $item['description']; ?> </textarea>
                                
                                </div>
                                <div class="form-group">
                                    <label for=""></label>
                                    <input type="checkbox" name="trending" <?= $item['trending'] == "1" ? 'checked' : ''; ?>  /> Trending
                                </div>
                                <div class="form-group">
                                    <label for=""></label>
                                    <input type="checkbox" name="status" <?= $item['status'] == "1" ? 'checked' : ''; ?>> Status
                                </div>
                                <div class="form-group">
                                    <label for="">Created At</label>
                                    <input type="text" name="created_at" value="<?= $item['created_at']; ?>" class="form-control" required>
                                </div>
                                </div>
                                <div class="modal-footer">
                                    
                                    <button type="sumbit" name="category_update" class="btn btn-primary">Update</button>
                                </div>
                                <?php
                                endforeach;
                            }

                            else
                            {
                                echo "No ID Found!";
                            }
                        ?>
                        
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