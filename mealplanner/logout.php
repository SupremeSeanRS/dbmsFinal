<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">

        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.css">
        <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css' integrity='sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm' crossorigin='anonymous'>

        <script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.5.1.js"></script>
        <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.js"></script>
        <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap4.min.js"></script>

    </head>
    <body>
        <?php
        // Initialize the session
        session_start();
        
        // Unset all of the session variables
        $_SESSION = array();
        
        // Destroy the session.
        session_destroy();
        
        // Redirect to login page
        echo '<h1 class="alert alert-success" role="alert">';
        echo 'You have been successfully logged out. Redirecting to login page.';
        echo '</h1>';
        /*header("location:login.php");*/
        header("refresh:2;login.php");
        exit;
        ?>
    </body>
</html>