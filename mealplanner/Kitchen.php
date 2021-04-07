<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
?>
<!DOCTYPE html>

<head>
    <title>Kitchen</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
        integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
        integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous">
    </script>

    <script type="text/javascript">
        $(document).ready(function () {
            var html =
                '<tr><td><select class="form-control" id="ingredient" name="ingredient[]" required><option class="form-control" selected disabled> -- Ingredient List -- </option><option class="form-control" value="Sauce">Sauce</option><option class="form-control" value="Wheat">Wheat</option><option class="form-control" value="Grains">Grains</option><option class="form-control" value="Seasoning">Seasoning</option><option class="form-control" value="Vegetables">Vegetables</option><option class="form-control" value="Meat">Meat</option><option class="form-control" value="Dairy">Dairy</option><option class="form-control" value="Fruits">Fruits</option><option class="form-control" value="Beans">Beans</option></select></td><td><select class="form-control" id="measurement" name="measurement[]" required><option class="form-control" selected disabled> -- Quantity -- </option><option class="form-control" value="1 cup">1 Cup</option><option class="form-control" value="1/2 cup">1/2 Cup</option><option class="form-control" value="1 ounce">1 ounce</option><option class="form-control" value="1 tablespoon">1 tablespoon</option><option class="form-control" value="1 gallon">1 gallon</option><option class="form-control" value="16 ounces">16 ounces</option><option class="form-control" value="1 pound">1 pound</option></select></td><td><input class="btn btn-danger" type="button" name="removeBtn" id="removeBtn" value="Remove"></td></tr>';


            var max = 5;
            var x = 1;
            $("#addBtn").click(function () {
                if (x <= max) {
                    $("#table_field").append(html);
                    x++;
                }
            });

            $("#table_field").on('click', '#removeBtn', function () {
                $(this)
                    .closest('tr')
                    .remove();
                x--;
            });
        });
    </script>
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
                <a href="http://localhost/mealplanner/images.php" class="nav-item nav-link">Images</a>
                <a href="http://localhost/mealplanner/kitchen.php" class="nav-item nav-link active text-primary">Kitchen</a>
            </div>
            <div class="navbar-nav ml-auto">
                <a href="#" class="nav-item nav-link text-info">Welcome, <?php echo htmlspecialchars($_SESSION["username"]); ?></a>
                <a href="http://localhost/mealplanner/logout.php" class="nav-item nav-link text-danger">Logout</a>
            </div>
        </div>
    </nav>

    <div class="container">
        <form class="insert-form" id="insert_form" method="POST" action="">
            <!--<hr> <h1 class="text-center">Add Input Field</h1> <hr>-->
            <br><br><br>
            <h1 class="text-center">Kitchen Ingredients</h1>
            <p class="lead text-center">Enter the ingredients that you have in your kitchen</p>

            <br>

            <div class="input-field">
                <table class="table table-bordered" id="table_field">
                    <tr>
                        <th>Ingredient</th>
                        <th>Quantity</th>
                        <th>Add or Remove</th>
                    </tr>

                    <?php 
                        $conn = mysqli_connect("localhost", "root", "", "mealplan");

                        if (isset($_POST['saveBtn'])) {
                            $ingredient = $_POST['ingredient'];
                            $measuremnt = $_POST['measurement'];
                            $usrname = htmlspecialchars($_SESSION["username"]);

                            foreach ($ingredient as $key => $value) {
                                if ($value == "Sauce") {
                                    $valuen = 1;
                                }
                                if ($value == "Wheat") {
                                    $valuen = 2;
                                }
                                if ($value == "Grains") {
                                    $valuen = 3;
                                }
                                if ($value == "Seasoning") {
                                    $valuen = 4;
                                }
                                if ($value == "Vegetables") {
                                    $valuen = 5;
                                }
                                if ($value == "Meat") {
                                    $valuen = 6;
                                }
                                if ($value == "Dairy") {
                                    $valuen = 7;
                                }
                                if ($value == "Fruits") {
                                    $valuen = 8;
                                }
                                if ($value == "Beans") {
                                    $valuen = 9;
                                }
                                $save = "INSERT INTO kitchen(uName, ingredID, quantity, ingredName) VALUES('".$usrname."','".$valuen."', '".$measuremnt[$key]."','".$value."')";
                                    
                                $query = mysqli_query($conn, $save);
                            }
                            echo '<div class="alert alert-success" role="alert">';
                            echo "Recipe has been successfully saved.";
                            echo '</div>';
                        }
                    ?>

                    <tr>
                        <td>
                            <select class="form-control" id="ingredient" name="ingredient[]" required="required">
                                <option class="form-control" selected="selected" disabled="disabled">
                                    -- Ingredient List --
                                </option>
                                <option class="form-control" value="Sauce">Sauce</option>
                                <option class="form-control" value="Wheat">Wheat</option>
                                <option class="form-control" value="Grains">Grains</option>
                                <option class="form-control" value="Seasoning">Seasoning</option>
                                <option class="form-control" value="Vegetables">Vegetables</option>
                                <option class="form-control" value="Meat">Meat</option>
                                <option class="form-control" value="Dairy">Dairy</option>
                                <option class="form-control" value="Fruits">Fruits</option>
                                <option class="form-control" value="Beans">Beans</option>
                            </select>
                        </td>
                        <td>
                            <select class="form-control" id="measurement" name="measurement[]" required="required">
                                <option class="form-control" selected="selected" disabled="disabled">
                                    -- Quantity --
                                </option>
                                <option class="form-control" value="1 cup">1 Cup</option>
                                <option class="form-control" value="1/2 cup">1/2 Cup</option>
                                <option class="form-control" value="1 ounce">1 ounce</option>
                                <option class="form-control" value="1 tablespoon">1 tablespoon</option>
                                <option class="form-control" value="1 gallon">1 gallon</option>
                                <option class="form-control" value="16 ounces">16 ounces</option>
                                <option class="form-control" value="1 pound">1 pound</option>
                            </select>
                        </td>
                        <td><input class="btn btn-success" type="button" name="addBtn" id="addBtn" value="Add"></td>
                    </tr>
                </table>

                <div class="container mt-5 text-center">
                    <input class="btn btn-success" type="submit" name="saveBtn" id="saveBtn" value="Save">
                </div>
            </div>
        </form>
    </div>
</body>

</html>