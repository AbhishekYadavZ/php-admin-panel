<?php
    
    include('authentication.php');
    include('config/dbcon.php');

    if(isset($_POST['product_update']))
    {
        $product_id = $_POST['product_id'];
        $category_id = $_POST['category_id'];
        $name = $_POST['name'];
        $small_description = $_POST['small_description'];
        $long_description = $_POST['long_description'];
        $price = $_POST['price'];
        $offerprice = $_POST['offerprice'];
        $tax = $_POST['tax'];
        $quantity = $_POST['quantity'];
        $status = $_POST['status'] == true ? '1' : '0';
        $image = $_FILES['image']['name'];
        $old_image = $_FILES['old_image'];

        if($image != '')
        {
            $update_filename = $_FILES['image']['name'];
            $allowed_extension = array('png','jpg','jpeg');
            $file_extension = pathinfo($image,PATHINFO_EXTENSION);

            $filename = time().'.'.$file_extension;

            if(!in_array($file_extension,$allowed_extension))
            {
                $_SESSION['status'] = "You are allowed with only jpg,png, and jpeg image";
                header('Location: product_add.php');
                exit(0);
            }
        }
        else
        {
            $update_filename = $old_image;
        }

        $query = "UPDATE products SET category_id= '$category_id',
        name='$name',
        small_description='$small_description',
        long_description='$long_description',
        price='$price',offerprice='$offerprice',
        tax='$tax',quantity='$quantity', 
        status='$status', 
        image='$update_filename' where id='$product_id'";
        mysqli_query($con,$query);

        if($query_run)
        {
            if($image != '')
            {
                move_uploaded_file($_FILES['image']['tmp_name'],'uploads/products/'.$filename);
            }
            $_SESSION['status'] = "Product Updated Successfully";
            header('Location: product_edit.php?prod_id='.$product_id);
            exit(0);
        }
        else
        {
            $_SESSION['status'] = "Something went wrong";
            header('Location: product_edit.php?prod_id='.$product_id);
            exit(0);
        }

    }

    if(isset($_POST['product_save']))
    {
        $category_id = $_POST['category_id'];
        $name = $_POST['name'];
        $small_description = $_POST['small_description'];
        $long_description = $_POST['long_description'];
        $price = $_POST['price'];
        $offerprice = $_POST['offerprice'];
        $tax = $_POST['tax'];
        $quantity = $_POST['quantity'];
        $status = $_POST['status'] == true ? '1' : '0';
        $image = $_FILES['image']['name'];

        $allowed_extension = array('png','jpg','jpeg');
        $file_extension = pathinfo($image,PATHINFO_EXTENSION);

        $filename = time().'.'.$file_extension;

        if(!in_array($file_extension,$allowed_extension))
        {
            $_SESSION['status'] = "You are allowed with only jpg,png, and jpeg image";
            header('Location: product_add.php');
            exit(0);
        }
        else
        {
            $query = "INSERT INTO products (category_id,name,small_description,long_description,price,offerprice,tax,quantity,image,status) 
            values ('$category_id','$name','$small_description','$long_description','$price','$offerprice','$tax','$quantity','$filename','$status')";
            $query_run = mysqli_query($con,$query);

            if($query_run)
            {
                move_uploaded_file($_FILES['image']['tmp_name'],'uploads/products/'.$filename);
                $_SESSION['status'] = "Product Added Successfully";
                header('Location: product_add.php');
                exit(0);
            }
            else
            {
                $_SESSION['status'] = "Something went wrong";
                header('Location: product_add.php');
                exit(0);
            }
        }

    }

    if(isset($_POST['category_save']))
    {
        $name = $_POST['name'];
        $description = $_POST['description'];
        $trending = $_POST['trending'] == true ? '1':'0';
        $status = $_POST['status'] == true ? '1':'0';
        
        $category_query = "INSERT INTO categories (name,description,trending,status) values('$name','$description','$trending','$status')";
        $category_query_run = mysqli_query($con,$category_query);

        if(mysqli_num_rows($category_query_run) > 0)
        {
            $_SESSION['status'] = "Catrgory inserted successfully";
            header('Location: category.php');
        }
        else
        {
            $_SESSION['status'] = "Catrgory insertion failed";
            header('Location: category.php');
        }
    }

    if(isset($_POST['category_update']))
    {
        $cate_id = $_POST['cate_id'];
        $name = $_POST['name'];
        $description = $_POST['description'];
        $trending = $_POST['trending'] == true ?'1':'0';
        $status = $_POST['status'] == true ?'1':'0';

        $query = "UPDATE categories SET name = '$name', description='$description',trending='$trending',status='$status' where id='$cate_id'";
        $query_run = mysqli_query($con,$query);

        if($query_run)
        {
            $_SESSION['status'] = "Category Updated Successfully";
            header("Location: category.php");
        }
        else
        {
            $_SESSION['status'] = "category Updation Failed";
            header("Location: category.php");
        }

    }

    if(isset($_POST['cate_delete_btn']))
    {
        $cate_id = $_POST['cate_delete_id'];
        $query = "DELETE FROM categories where id='$cate_id'";
        $query_run = mysqli_query($con,$query);

        if($query_run)
        {
            $_SESSION['status'] = "Category DELETED Successfully";
            header("Location: category.php");
        }
        else
        {
            $_SESSION['status'] = "category deletion Failed";
            header("Location: category.php");
        }
    }

    if(isset($_POST['logout_btn']))
    {
        //session_destroy();
        unset($_SESSION['auth']);
        unset($_SESSION['auth_user']);

        $_SESSION['status'] = "Logged Out Successfully";
        header('Location:login.php');
        exit(0);
    }

    if(isset($_POST['check_Emailbtn']))
    {
        $email = $_POST['email'];
        $checkemail = "SELECT email from users WHERE email = '$email'";
        $checkemail_run = mysqli_query($con, $checkemail);

        if(mysqli_num_rows($checkemail_run) > 0)
        {
            echo "Email ID already exists!";
        }
        else
        {
            echo "Email is Avaialble!";
        }
    }

    if(isset($_POST['addUser']))
    {  
        $name = $_POST['name'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $password = $_POST['password'];
        $confirmpassword = $_POST['confirmpassword'];

        if($password == $confirmpassword)
        {
            $checkemail = "SELECT email from users WHERE email = '$email'";
            $checkemail_run = mysqli_query($con, $checkemail);

            if(mysqli_num_rows($checkemail_run) > 0)
            {
                // Taken - ALready Exists
                $_SESSION['status'] = "Email ID is already exists!";
                header("Location: registered.php");
            }
            else
            {
                // Available = Record Not Found
                $user_query = "INSERT INTO `users` (`name`, `email`, `phone`, `password`) VALUES ('$name','$email','$phone','$password')";
                $user_query_run = mysqli_query($con, $user_query);

                if($user_query_run)
                {
                    $_SESSION['status'] = "User Added Successfully";
                    header("Location: registered.php");
                }
                else
                {
                    $_SESSION['status'] = "User Registerd Failed";
                    header("Location: registered.php");
                }
            }

            
        }
        else
        {
            $_SESSION['status'] = "Password and Confirm Password does not match!";
            header("Location: registered.php");
        }

        
        
    }


    if(isset($_POST['updateUser']))
    {
        $user_id = $_POST['user_id'];
        $name = $_POST['name'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $password = $_POST['password'];
        $role_as = $_POST['role_as'];

        $query = "UPDATE users SET name='$name', phone='$phone', email='$email', password='$password', role_as='$role_as' WHERE id ='$user_id'";
        $query_run = mysqli_query($con,$query);

        if($query_run)
        {
            $_SESSION['status'] = "User Updated Successfully";
            header("Location: registered.php");
        }
        else
        {
            $_SESSION['status'] = "User Updation Failed";
            header("Location: registered.php");
        }
    }

    if(isset($_POST['DeleteUserbtn']))
    {
        $user_id = $_POST['delete_id'];
        $query = "DELETE FROM users WHERE id = '$user_id'";
        $query_run = mysqli_query($con,$query);

        if($query_run)
        {
            $_SESSION['status'] = "User Deleted Successfully";
            header("Location: registered.php");
        }
        else
        {
            $_SESSION['status'] = "User Deletion Failed";
            header("Location: registered.php");
        }
    }
?>