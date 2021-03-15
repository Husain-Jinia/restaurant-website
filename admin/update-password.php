<?php include('partials/menu.php');?> 


<div class = "main-content">
    <div class="wrapper">
        <h1>Change password</h1>
        <br/><br/>

        <?php
            if(isset($_GET['id']))
            {
                $id = $_GET['id'];
            }
        ?>

        <form action="" method="POST">

            <table class="tbl-30">
                <tr>
                    <td> Current password</td>
                    <td>
                        <input type="password" name="current_password" placeholder="Current password">
                    </td>
                </tr>
                <tr>
                    <td>New Psssword</td>
                    <td>
                        <input type="password" name="new_password" placeholder="new password">
                    </td>
                </tr>
                <tr>
                    <td> Cornfirm password</td>
                    <td>
                        <input type="password" name="confirm_password" placeholder="confirm password">
                    </td>
                </tr>
                
                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit" name="submit" value="Change password" class="btn-secondary">
                    </td>
                </tr>
            
            </table>
        
        </form>
    </div>
</div>

<?php
    //check whther the submit button is clicked or not
    if(isset($_POST['submit']))
    {
        //echo "clicked";
        //1. get the data from form
        $id = $_POST['id'];
        $current_password = md5($_POST['current_password']);
        $new_password = md5($_POST['new_password']);
        $confirm_password = md5($_POST['confirm password']);

        //2. Check if current  ID and current Password Exists or not
        $sql = "SELECT * FROM tbl_admin WHERE  id=$id AND password='$current_password'";

        //execute the query
        $res = mysqli_query($conn, $sql);
        if($res==true)
        {
            //Check whether data is availabke or not
            $count=mysqli_num_rows($res);

            if($count == 1)
            {
                //user exists and password be changed
                //check whether the new passsword and confirm password match or not
                if($new_password==$confirm_password)
                {
                    //update password
                    $sql2 = "UPDATE tbl_admin SET
                        password = '$new_password'
                        WHERE id= $id
                    ";

                    //execute the query
                    $res2 = mysqli_query($conn, $sql2);

                    //check whether the query executed or not
                    if ($res==true)
                    {
                        //display success msg
                        //redirect to manage admin with error msg
                        $_SESSION['change-pwd'] = "<div class="success"> Password changed successfully </div>";
                        //redirect the user
                        header('location:'.SITEURL.'admin/manage-admin.php');
                    }
                    else
                    {
                        //display error msg
                        $_SESSION['change-pwd'] = "<div class="error"> Failed to change password </div>";
                        //redirect the user
                        header('location:'.SITEURL.'admin/manage-admin.php');
                    }
                }
                else
                {
                    //redirect to manage admin with error msg
                    $_SESSION['pwd-not-match'] = "<div class="error"> Password did not match </div>";
                    //redirect the user
                    header('location:'.SITEURL.'admin/manage-admin.php');
                }
            }
            else
            {
                //user does not exist. Set msg and redirect
                $_SESSION['user-not-found'] = "<div class="error"> user not found </div>";
                //redirect the user
                header('location:'.SITEURL.'admin/manage-admin.php');
            }
        }
        //3. Check whether the new password and confirm Password match or not

        //4. update password if all above is true
    }
?>

<?php include('partials/footer.php');?>