
<?php

session_start();




if (!isset($_SESSION["student"])) {

    header("Location: login.php");

    exit;
}




$student = $_SESSION["student"];

$name = $student["name"];
$regno = $student["regno"];
$email = $student["email"];
$phone = $student["phone"];
$department = $student["department"];
$year = $student["year"];

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Student Dashboard</title>

    <style>

        * {

            margin: 0;

            padding: 0;

            box-sizing: border-box;

            font-family: Arial, sans-serif;
        }

        body {

            min-height: 100vh;

            background: #eef5ff;
        }


        /* HEADER */

        .header {

            height: 75px;

            background: #2463b8;

            color: white;

            display: flex;

            justify-content: space-between;

            align-items: center;

            padding: 0 50px;
        }

        .logo {

            font-size: 25px;

            font-weight: bold;
        }

        .logout {

            background: white;

            color: #2463b8;

            padding: 10px 20px;

            border-radius: 7px;

            text-decoration: none;

            font-weight: bold;
        }

        .logout:hover {

            background: #e8f1ff;
        }


        /* MAIN */

        .main {

            max-width: 1000px;

            margin: 50px auto;

            padding: 0 20px;
        }


        /* WELCOME */

        .welcome {

            background: white;

            padding: 30px;

            border-radius: 15px;

            box-shadow:
                0 5px 20px rgba(0,0,0,0.08);

            margin-bottom: 30px;
        }

        .welcome h1 {

            color: #12264a;

            margin-bottom: 10px;
        }

        .welcome p {

            color: #66758c;

            font-size: 17px;
        }


        /* DETAILS */

        .details {

            background: white;

            padding: 35px;

            border-radius: 15px;

            box-shadow:
                0 5px 20px rgba(0,0,0,0.08);
        }

        .details h2 {

            color: #12264a;

            margin-bottom: 25px;
        }

        .row {

            display: flex;

            justify-content: space-between;

            padding: 18px 10px;

            border-bottom:
                1px solid #e1e6ee;
        }

        .label {

            font-weight: bold;

            color: #52647c;
        }

        .value {

            color: #12264a;

            font-weight: bold;
        }


        /* MOBILE */

        @media (max-width: 600px) {

            .header {

                padding: 0 20px;
            }

            .logo {

                font-size: 20px;
            }

            .main {

                margin-top: 30px;
            }

            .row {

                flex-direction: column;

                gap: 7px;
            }

        }

    </style>

</head>

<body>


<!-- HEADER -->

<div class="header">

    <div class="logo">
        🎓 Student Portal
    </div>

    <a href="logout.php" class="logout">
        Logout
    </a>

</div>


<!-- MAIN -->

<div class="main">


    <!-- WELCOME -->

    <div class="welcome">

        <h1>

            Welcome,
            <?php echo htmlspecialchars($name); ?>
            👋

        </h1>

        <p>

            Welcome to your student dashboard.
            Here you can view your registered details.

        </p>

    </div>


    <!-- STUDENT DETAILS -->

    <div class="details">

        <h2>
            Student Details
        </h2>


        <div class="row">

            <span class="label">
                Full Name
            </span>

            <span class="value">

                <?php
                echo htmlspecialchars($name);
                ?>

            </span>

        </div>


        <div class="row">

            <span class="label">
                Register Number
            </span>

            <span class="value">

                <?php
                echo htmlspecialchars($regno);
                ?>

            </span>

        </div>


        <div class="row">

            <span class="label">
                Email
            </span>

            <span class="value">

                <?php
                echo htmlspecialchars($email);
                ?>

            </span>

        </div>


        <div class="row">

            <span class="label">
                Phone Number
            </span>

            <span class="value">

                <?php
                echo htmlspecialchars($phone);
                ?>

            </span>

        </div>


        <div class="row">

            <span class="label">
                Department
            </span>

            <span class="value">

                <?php
                echo htmlspecialchars($department);
                ?>

            </span>

        </div>


        <div class="row">

            <span class="label">
                Year
            </span>

            <span class="value">

                <?php
                echo htmlspecialchars($year);
                ?>

            </span>

        </div>

    </div>

</div>

</body>

</html>

