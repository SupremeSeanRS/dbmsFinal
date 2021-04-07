<?php
// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect him to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <title>Add Image</title>
    
</head>

<body>

    <nav class="navbar navbar-expand-md navbar-light bg-light">
        <a href="#" class="navbar-brand">
            MealPlanner
        </a>
        <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarCollapse">
            <div class="navbar-nav">
                <a href="http://localhost/mealplanner/welcome.php" class="nav-item nav-link">Home</a>
                <a href="http://localhost/mealplanner/recipeAdd.php" class="nav-item nav-link">Add Recipe</a>
                <a href="http://localhost/mealplanner/meals.php" class="nav-item nav-link">Plan Weekly Meal</a>
                <a href="http://localhost/mealplanner/viewmeals.php" class="nav-item nav-link">View Meals, Ingredients & Shopping List</a>
                <a href="http://localhost/mealplanner/searchRec.php" class="nav-item nav-link">Search Recipe</a>
                <a href="http://localhost/mealplanner/randommeal.php" class="nav-item nav-link">Random</a>
                <a href="http://localhost/mealplanner/caloriesmeal.php" class="nav-item nav-link ">Calories</a>
                <a href="http://localhost/mealplanner/images.php" class="nav-item nav-link active text-primary">Images</a>
                <a href="http://localhost/mealplanner/kitchen.php" class="nav-item nav-link">Kitchen</a>
            </div>
            <div class="navbar-nav ml-auto">
                <a href="#" class="nav-item nav-link text-info">Welcome, <?php echo htmlspecialchars($_SESSION["username"]); ?></a>
                <a href="http://localhost/mealplanner/logout.php" class="nav-item nav-link text-danger">Logout</a>
            </div>
        </div>
    </nav>

    <?php 
        $msg = "";
        

        $conn = mysqli_connect("localhost", "root", "", "mealplan");
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        
        // If upload button is clicked ...
        if (isset($_POST['upload'])) { 
            $rname=$_POST['rname'];
            $name = ($_SESSION["username"]);    
            $mealid = "SELECT dinner.mealID FROM recipe JOIN dinner ON recipe.recID=dinner.recID WHERE recipe.recName='{$rname}' and dinner.uName='{$name}'";
            $mealquery = mysqli_query($conn, $mealid);
            while ($row = $mealquery->fetch_assoc()) {
                $mealidno = $row['mealID'];
            }
            
            //"SELECT DISTINCT dinner.mealID FROM dinner JOIN recipe ON dinner.recID=recipe.recID WHERE dinner.uName='{$name}'";
            $mealresult = $conn->query($mealid);
            /*echo $mealresult;*/
            if (isset($mealresult->num_rows) && $mealresult->num_rows > 0) {
        
                $filename = $_FILES["uploadfile"]["name"];
                $tempname = $_FILES["uploadfile"]["tmp_name"];    
                $folder = "images/".$filename;
        
                // Get all the submitted data from the form
                $sql = "INSERT INTO dimages (mealID, uName,images) VALUES ('$mealidno','$name','$filename')";
                // Execute query
                mysqli_query($conn, $sql);
                
                // Now let's move the uploaded image into the folder: image
                if (move_uploaded_file($tempname, $folder))  {
                    $msg = "Image uploaded successfully";
                    echo '<h2 class="alert alert-success" role="alert">';
                    echo $msg;
                    echo '</h2>';
                    header("refresh:3;dimages.php");
                }
                else{
                    $msg = "Failed to upload image";
                    echo '<h2 class="alert alert-danger" role="alert">';
                    echo $msg;
                    echo '</h2>';
                    header("refresh:3;dimages.php");
                }
            }
            else {
                $msg = "Recipe does not exists or failed to upload image";
                echo '<h2 class="alert alert-danger" role="alert">';
                echo $msg;
                echo '</h2>';
                header("refresh:3;dimages.php");
            }
        }

    ?>

    <div class="container col-lg-5 mx-auto">
            <form method="POST" class="main-form "action="" enctype="multipart/form-data">
            
            <br>
            <br>

            <!-- First Name -->
            <div class="">
                <label class="" >Dinner Recipe Name:</label>
                <div class="">
                    <input type="text" class="form-control" id="rname" name="rname"
                        placeholder="Enter recipe name ">
                </div>
            </div>

            <div class="mt-3">
                <div class="">
                <input type="file" name="uploadfile" value="" />

                    <input type="submit" name="upload" class="btn btn-primary" value="Submit">
                </div>
            </div>



        </form>
    </div>



    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
        crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
        crossorigin="anonymous"></script>
</body>

</html>

