<?php include('partials/menu.php');?>

<div class = "main-content">
    <div class="wrapper">
        <h1>Add admin</h1>

        <br/>

        <?php
            
            if(isset($_SESSION["add"]))//to check if set or not
            {
                echo $_SESSION["add"];//display session message
                unset($_SESSION["add"]);//removing session message
            }
       ?>
        


        <form action="" method="POST">

            <table class="tbl-30">
                <tr>
                    <td>full name:</td>
                    <td><input type="text" name="full_name" placeholder="Enter your name"></td>
                <tr>
                <tr>
                    <td>Username:</td>
                    <td><input type="text" name="username" placeholder=" your username"></td>

                </tr>
                <tr>
                    <td>password:</td>
                    <td><input type="password" name="password" placeholder=" your password"></td>

                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="add admin" class="btn-secondary">
                    </td>
                </tr>
            </table>

        </form>
    </div>
</div>
<?php include('partials/footer.php');?>


<?php
    //process the value from form and save it in database
    //check whether the submit button is clicked or not
    if(isset($_POST['submit']))
    {
        // Button clicked 
        //echo "button clicked";

        //get data from form
        $full_name = $_POST['full_name'];
        $username = $_POST['username'];
        $password = md5($_POST['password']); //Password encryption with md5
    
        //sql querry to save data in the 
        $sql = "INSERT INTO tbl_admin SET
            full_name='$full_name',
            username= '$username',
            password='$password'
        
        ";
        //executing querry and saving data into database
        $res = mysqli_query($conn,$sql) or die(mysqli_error());
        
        //check whether the data is inserted or not and display appropriate message
        if($res==TRUE)
        {
            //echo "data inserted";
            //create session variable to display messsage
            $_SESSION['add'] = "Admin added successfully";
            //Redirect page to manage admin
            header("location:".SITEURL.'admin/manage-admin.php');
        }
        else
        {
            //echo "failed to insert data";
            $_SESSION['add'] = "failed to add admin";
            //Redirect page to add admin
            header("location:".SITEURL.'admin/add-admin.php');
        }

    }
?>