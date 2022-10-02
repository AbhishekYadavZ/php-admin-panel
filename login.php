<?php
    session_start();
    
    include('includes/header.php');
    if(isset($_SESSION['auth']))
    {
        $_SESSION['status'] = 'You are alreay logged in';
        header('Location: index.php');
        exit(0);
    }
?>

<div class="section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5 my-5">
            <?php include('message.php'); ?>
                <div class="card my-5">
                    <div class="card-header bg-light">
                        <h5>Login Form</h5>
                    </div>
                    <div class="card-body">
                        <form action="login-code.php" method="post">
                            <div class="form-group">
                                <label for="">Email ID</label>
                                <input type="email" name="email" class="form-control" placeholder="Enter Your Email" value="" required>
                            </div>
                            <div class="form-group">
                                <label for="">Password</label>
                                <input type="password" name="password" class="form-control" placeholder="Enter Your Password" value="" required>
                            </div>
                            <div class="form-group">
                                <button type="submit" name="login_btn" class="btn btn-primary btn-block" >Login</button>
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