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
    <title>Calories Results </title>


    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <style>
        table {
            border-collapse: collapse;
            width: 80%;
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
                <a href="http://localhost/mealplanner/viewmeals.php" class="nav-item nav-link ">View Meals, Ingredients & Shopping List</a>
                <a href="http://localhost/mealplanner/searchRec.php" class="nav-item nav-link">Search Recipe</a>
                <a href="http://localhost/mealplanner/randommeal.php" class="nav-item nav-link ">Random</a>
                <a href="http://localhost/mealplanner/caloriesmeal.php" class="nav-item nav-link active text-primary">Calories</a>
                <a href="http://localhost/mealplanner/images.php" class="nav-item nav-link">Images</a>
                <a href="http://localhost/mealplanner/kitchen.php" class="nav-item nav-link">Kitchen</a>
            </div>
            <div class="navbar-nav ml-auto">
                <a href="#" class="nav-item nav-link text-info">Welcome, <?php echo htmlspecialchars($_SESSION["username"]); ?></a>
                <a href="http://localhost/mealplanner/logout.php" class="nav-item nav-link text-danger">Logout</a>
            </div>
        </div>
    </nav>


    <!--Breakfast-->
    <br>
    <p class="lead mt-4 text-center">Here are our meal suggestions with the calorie count between <?php echo $_POST['cal1'] ?> and <?php echo $_POST['cal2'] ?> calories. </p> <br>
    <div class="row mt-1 mx-auto col-lg-10 ">
   
        <div class="container mb-5 col-lg-4 mt-5">
            <table>
                <tr>
                    <th>Random Breakfast Meals </th>
                </tr>

                <?php

                $calorie1=$_POST['cal1'];
                $calorie2=$_POST['cal2'];

                $conn = mysqli_connect("localhost", "root", "", "mealplan");
                // Check connection
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }
            
                $sql = "SELECT recName FROM recipe WHERE calorie BETWEEN $calorie1 and $calorie2 ORDER BY rand() LIMIT 7 ";
                $result = $conn->query($sql);
                if (isset($result->num_rows) && $result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr><td>" . $row["recName"] . "</td></tr>";
                    }
                    echo "</table>";
                } else {
                    echo "0 results";
                }

                $conn->close();
                ?>
            </table>
        </div>

        <!--Lunch Table-->

        <div class="container mb-5 col-lg-4 mt-5">
            <table>
                <tr>
                    <th> Random Lunch Meals </th>
                </tr>

                <?php

                $calorie1=$_POST['cal1'];
                $calorie2=$_POST['cal2'];

                $conn = mysqli_connect("localhost", "root", "", "mealplan");
                // Check connection
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                $sql1 = "SELECT recName FROM recipe WHERE calorie BETWEEN $calorie1 and $calorie2 ORDER BY rand() LIMIT 7 ";
                $result1 = $conn->query($sql1);
                if (isset($result1->num_rows) && $result1->num_rows > 0) {

                    while ($row = $result1->fetch_assoc()) {
                        echo "<tr> <td>" . $row["recName"] . "</td></tr>";
                    }
                    echo "</table>";
                } else {
                    echo "0 results";
                }

                $conn->close();
                ?>
            </table>
        </div>


        <!--Dinner Table-->

        <div class="container mb-5 col-lg-4 mt-5">
            <table>
                <tr>
                    <th> Random Dinner Meals </th>
                </tr>

                <?php

                $calorie1=$_POST['cal1'];
                $calorie2=$_POST['cal2'];
                $conn = mysqli_connect("localhost", "root", "", "mealplan");
                // Check connection
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

        
                $sql1 = "SELECT recName FROM recipe WHERE calorie BETWEEN $calorie1 and $calorie2 ORDER BY rand() LIMIT 7 ";
                $result1 = $conn->query($sql1);
                if (isset($result1->num_rows) && $result1->num_rows > 0) {

                    while ($row = $result1->fetch_assoc()) {
                        echo "<tr> <td>" . $row["recName"] . "</td></tr>";
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