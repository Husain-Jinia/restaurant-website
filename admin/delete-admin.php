<?php
    //include constants.php file here
    include('../config/constants.php');
    //1. get the id of admin to be deleted
    $id = $_GET['id'];
    //2. create sql query to delete admin
    $sql = "DELETE FROM tbl_admin WHERE id= $id";

    //execute the query
    $res = mysqli_query($conn,$sql);

    // check whether the query is executed successfully or not
    if($res==true)
    {
        //query executed successfully and admin deleted
        //echo "Admin Deleted";
        //create seession variable to display message
        $_SESSION['delete'] = "<div class='success'>Admin Deleted Successfully</div>";
        //redirect to manage admin page
        header("location:".SITEURL."<div class='error'>admin/manage-admin.php</div>");
    }
    else
    {
        //failed to delete admin
        //echo "failed to delete Admin";

        $_SESSION['delete'] = "Failed to delete admin. Try again Later";
        header("location:".SITEURL.'admin/manage-admin.php');
    }
    //3.Redirect to manage admin page with message (success/error)

?>