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
    <title>Search for a recipe</title>


    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>



    <title>Search</title>
    <style>
        table {
            border-collapse: collapse;
            width: 75%;
            font-size: 20px;
            text-align: center;

        }

        th {
            background-color: #4b0082;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #e3e4fa;
        }
    </style>
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
                    <a href="http://localhost/mealplanner/meals.php" class="nav-item nav-link ">Plan Weekly Meal</a>
                    <a href="http://localhost/mealplanner/viewmeals.php" class="nav-item nav-link">View Meals, Ingredients & Shopping List</a>
                    <a href="http://localhost/mealplanner/searchRec.php" class="nav-item nav-link active text-primary">Search Recipe</a>
                    <a href="http://localhost/mealplanner/randommeal.php" class="nav-item nav-link">Random</a>
                    <a href="http://localhost/mealplanner/caloriesmeal.php" class="nav-item nav-link ">Calories</a>
                    <a href="http://localhost/mealplanner/images.php" class="nav-item nav-link">Images</a>
                    <a href="http://localhost/mealplanner/kitchen.php" class="nav-item nav-link">Kitchen</a>
                </div>
                <div class="navbar-nav ml-auto">
                    <a href="#" class="nav-item nav-link text-info">Welcome, <?php echo htmlspecialchars($_SESSION["username"]); ?></a>
                    <a href="http://localhost/mealplanner/logout.php" class="nav-item nav-link text-danger">Logout</a>
                </div>
            </div>
        </nav>

            <p class="lead text-center mt-5">Here are the results found for the <?php echo $_POST['uname']; ?> recipe.</p>
            <div class="row mt-5 mx-auto col-lg-10 ">

                <div class="container mb-5 col-lg-4 mt-5">
                    <table>
                        <tr>
                            <th>Created On</th>
                        </tr>
                        <?php

                        $name = $_POST['uname'];

                        $host = "localhost";
                        $dbUsername = "root";
                        $dbPassword = "";
                        $dbname = "mealplan";

                        //create the connection

                        $conn = new mysqli($host, $dbUsername, $dbPassword, $dbname);


                        $sql = "CALL searchDate('$name')";
                        $result = mysqli_query($conn, $sql);
                        if (isset($result->num_rows) && $result->num_rows > 0) {

                            while ($row = mysqli_fetch_assoc($result)) {
                                echo "<tr><td>" . $row["recDate"] . "</td></tr>";


                                //<tr><td>" . $row["instructID"] . "</td></tr><tr><td>" . $row["direction"] . "</td></tr>";
                                //echo $row['direction'];

                                //echo "<tr><td>" . $row["instructID"] . "</td><td>"
                                // . $row["direction"] . "</td></tr>";

                            }


                            echo "</table>";
                        } else {
                            echo "0 results";
                        }

                        $conn->close();
                        ?>
                    </table>
                </div>
                        <!--Calories-->
                        <div class="container mb-5 col-lg-4 mt-5">
                    <table>
                        <tr>
                            <th>Calories</th>
                        </tr>
                        <?php

                        $name = $_POST['uname'];

                        $host = "localhost";
                        $dbUsername = "root";
                        $dbPassword = "";
                        $dbname = "mealplan";

                        //create the connection

                        $conn = new mysqli($host, $dbUsername, $dbPassword, $dbname);


                        $sql = "CALL searchCalories('$name')";
                        $result = mysqli_query($conn, $sql);
                        if (isset($result->num_rows) && $result->num_rows > 0) {

                            while ($row = mysqli_fetch_assoc($result)) {
                                echo "<tr><td>". $row["calorie"] . "</td></tr>";


                                //<tr><td>" . $row["instructID"] . "</td></tr><tr><td>" . $row["direction"] . "</td></tr>";
                                //echo $row['direction'];

                                //echo "<tr><td>" . $row["instructID"] . "</td><td>"
                                // . $row["direction"] . "</td></tr>";

                            }


                            echo "</table>";
                        } else {
                            echo "0 results";
                        }

                        $conn->close();
                        ?>
                    </table>
                </div>

                    </div>


                    <div class="row mt-1 mx-auto col-lg-10 ">

                <!--Instructions-->
                <div class="container mb-5 col-lg-4 mt-5">
                    <table>
                        <tr>
                            <th>Step Number </th>
                            <th>Instructions </th>
                        </tr>
                        <?php

                        $name = $_POST['uname'];

                        $host = "localhost";
                        $dbUsername = "root";
                        $dbPassword = "";
                        $dbname = "mealplan";

                        //create the connection

                        $conn = new mysqli($host, $dbUsername, $dbPassword, $dbname);


                        $sql = "CALL searchInstruction('$name')";
                        $result = mysqli_query($conn, $sql);
                        if (isset($result->num_rows) && $result->num_rows > 0) {

                            while ($row = mysqli_fetch_assoc($result)) {
                                echo "<tr><td>" . $row["instructID"] . "</td><td>"
                                    . $row["direction"] . "</td></tr>";


                                //<tr><td>" . $row["instructID"] . "</td></tr><tr><td>" . $row["direction"] . "</td></tr>";
                                //echo $row['direction'];

                                //echo "<tr><td>" . $row["instructID"] . "</td><td>"
                                // . $row["direction"] . "</td></tr>";

                            }


                            echo "</table>";
                        } else {
                            echo "0 results";
                        }

                        $conn->close();
                        ?>
                    </table>
                </div>


                <!--Ingredients-->

                <div class="container mb-5 col-lg-4 mt-5">
                    <table>
                        <tr>
                            <th>Ingredient </th>
                            <th>Measurements</th>
                        </tr>
                        <?php

                        $name = $_POST['uname'];

                        $host = "localhost";
                        $dbUsername = "root";
                        $dbPassword = "";
                        $dbname = "mealplan";

                        //create the connection

                        $conn = new mysqli($host, $dbUsername, $dbPassword, $dbname);


                        $sql = "CALL searchIngredient('$name')";
                        $result = mysqli_query($conn, $sql);
                        if (isset($result->num_rows) && $result->num_rows > 0) {

                            while ($row = mysqli_fetch_assoc($result)) {
                                echo "<tr><td>" . $row["ingrName"] . "</td><td>"
                                    . $row["measurement"] . "</td></tr>";


                                //<tr><td>" . $row["instructID"] . "</td></tr><tr><td>" . $row["direction"] . "</td></tr>";
                                //echo $row['direction'];

                                //echo "<tr><td>" . $row["instructID"] . "</td><td>"
                                // . $row["direction"] . "</td></tr>";

                            }


                            echo "</table>";
                        } else {
                            echo "0 results";
                        }

                        $conn->close();
                        ?>
                    </table>
                </div>
            </div>

</body>

</html>