<?php session_start() ?>
<?php
    //session_start();
    include('authentication.php');
    include('includes/header.php');
    include('includes/topbar.php');
    include('includes/sidebar.php');
?>
 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">





<h1>Home Page</h1>
<form action="code.php" method="post">
              <button type="submit" name="logout_btn" class="dropdown-item">Logout</button>
            </form>

<?php
    if(isset($_SESSION['status']))
    {
        echo $_SESSION['status'];
        unset($_SESSION['status']);
    }

?>

</div>

<?php
    include('includes/script.php');


    include('includes/footer.php');
?>