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
    <meta charset="UTF-8">
    <title>Welcome</title>


    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <title>Welcome To MealPlanner</title>

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


    <div> <img src="images\meal.jpeg" width="100%" height="100%" style="position:absolute; z-index:0; ">
        <div class="container-fluid h-100 p-5" id="container">
            <div class="row ml-5 pl-5 justify-content-start ">
                <div class="col-12 col-lg-10">
                    <h1 class="display-4 "> Make Your Meal Happy</h1>
                    <h4> Attach Your Images </h4><br>
                    <lead> Make your meal happier by adding an image.</lead>
                    <br> <br>
                    <h4>Start attaching your images here.</h4><br>
                    <button type="button" class="btn btn-light btn-lg mr-3 "><a href="http://localhost/mealplanner/bimages.php">Breakfast Meal</a></button>
                    <button type="button" class="btn btn-light btn-lg mr-3"><a href="http://localhost/mealplanner/limages.php">Lunch Meal</a></button>
                    <button type="button" class="btn btn-light btn-lg"><a href="http://localhost/mealplanner/dimages.php">Dinner Meal</a></button>
                </div>
            </div>
        </div>
    </diV>



</body>

</html>