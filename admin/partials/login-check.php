<?php
    //authorization or access control
    //check whether the user is logged in or not
    if(!isset($_SESSION['user'])) //if user session is not set
    {
        //user is not logged in
        //redirect to login page with msg
        $_SESSION['no-login-message'] = "<div class='error'> please login to access menu panel</div>";
        //redirect to login page
        header('location:'.SITEURL.'admin/login.php');
    }
?>