
<?php

session_start();

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $login = trim($_POST["login"]);
    $password = $_POST["password"];

    if (file_exists("students.txt")) {

        $students = file(
            "students.txt",
            FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES
        );

        $found = false;

        foreach ($students as $student) {

            $data = explode("|", $student);

            if (count($data) < 7) {
                continue;
            }

            $name = $data[0];
            $regno = $data[1];
            $email = $data[2];
            $phone = $data[3];
            $department = $data[4];
            $year = $data[5];
            $storedPassword = $data[6];


            /*
               Email OR Register Number
            */
            if ($login == $email || $login == $regno) {

                /*
                   Password Hash Verify
                */
                if (password_verify($password, $storedPassword)) {

                    $found = true;


                    /*
                       Create Session
                    */
                    $_SESSION["student"] = [

                        "name" => $name,

                        "regno" => $regno,

                        "email" => $email,

                        "phone" => $phone,

                        "department" => $department,

                        "year" => $year

                    ];


                    /*
                       Login Success
                    */
                    header("Location: dashboard.php");

                    exit;
                }

                break;
            }
        }


        if (!$found) {

            $message =
                "Invalid Email/Register Number or Password";
        }

    } else {

        $message = "No student registered yet.";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Student Login</title>

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

            display: flex;

            justify-content: center;

            align-items: center;

            padding: 30px;
        }

        .container {

            width: 100%;

            max-width: 1100px;

            min-height: 620px;

            background: white;

            border-radius: 20px;

            overflow: hidden;

            display: flex;

            box-shadow:
                0 10px 35px rgba(0,0,0,0.12);
        }

        .left {

            width: 45%;

            background: #2463b8;

            color: white;

            padding: 60px;
        }

        .logo {

            font-size: 25px;

            font-weight: bold;

            margin-bottom: 80px;
        }

        .left h1 {

            font-size: 45px;

            line-height: 1.2;

            margin-bottom: 25px;
        }

        .left h1 span {

            color: #7ed6ff;
        }

        .left p {

            font-size: 19px;

            line-height: 1.6;
        }

        .education {

            font-size: 90px;

            margin-top: 80px;
        }

        .right {

            width: 55%;

            padding: 60px;

            display: flex;

            flex-direction: column;

            justify-content: center;
        }

        .user-icon {

            width: 80px;

            height: 80px;

            background: #e8f1ff;

            border-radius: 50%;

            display: flex;

            justify-content: center;

            align-items: center;

            font-size: 40px;

            margin: 0 auto 20px;
        }

        .right h2 {

            text-align: center;

            color: #12264a;

            font-size: 35px;

            margin-bottom: 10px;
        }

        .subtitle {

            text-align: center;

            color: #66758c;

            font-size: 17px;

            margin-bottom: 35px;
        }

        .form-group {

            margin-bottom: 22px;
        }

        label {

            display: block;

            font-size: 16px;

            font-weight: bold;

            color: #172b4d;

            margin-bottom: 8px;
        }

        input {

            width: 100%;

            height: 55px;

            border: 1px solid #c8d5e8;

            border-radius: 8px;

            padding: 0 15px;

            font-size: 15px;

            outline: none;
        }

        input:focus {

            border-color: #2463b8;
        }

        .login-btn {

            width: 100%;

            height: 55px;

            border: none;

            border-radius: 8px;

            background: #246fe0;

            color: white;

            font-size: 18px;

            font-weight: bold;

            cursor: pointer;
        }

        .login-btn:hover {

            background: #185abc;
        }

        .error {

            background: #ffe5e5;

            color: #d00000;

            padding: 12px;

            border-radius: 8px;

            text-align: center;

            margin-bottom: 20px;
        }

        .or {

            display: flex;

            align-items: center;

            gap: 15px;

            margin: 25px 0;

            color: #68768a;
        }

        .or::before,
        .or::after {

            content: "";

            flex: 1;

            height: 1px;

            background: #d5dce5;
        }

        .register-link {

            text-align: center;

            color: #243650;
        }

        .register-link a {

            color: #1261d6;

            text-decoration: none;

            font-weight: bold;
        }

        @media (max-width: 800px) {

            .container {

                flex-direction: column;
            }

            .left,
            .right {

                width: 100%;
            }

            .left {

                padding: 35px;
            }

            .left h1 {

                font-size: 35px;
            }

            .education {

                display: none;
            }

            .right {

                padding: 40px 25px;
            }
        }

    </style>

</head>

<body>

<div class="container">

    <!-- LEFT -->

    <div class="left">

        <div class="logo">
            🎓 Student Portal
        </div>

        <h1>

            Welcome Back,<br>

            <span>Students!</span>

        </h1>

        <p>

            Login to access your dashboard,
            check your details and more.

        </p>

        <div class="education">
            📚
        </div>

    </div>


    <!-- RIGHT -->

    <div class="right">

        <div class="user-icon">
            👤
        </div>

        <h2>
            Student Login
        </h2>

        <p class="subtitle">
            Enter your credentials to continue
        </p>


        <?php

        if ($message != "") {

            echo
            "<div class='error'>" .
            htmlspecialchars($message) .
            "</div>";
        }

        ?>


        <form method="POST">

            <div class="form-group">

                <label>
                    Email / Register Number
                </label>

                <input
                    type="text"
                    name="login"
                    placeholder="Enter email or register number"
                    required
                >

            </div>


            <div class="form-group">

                <label>
                    Password
                </label>

                <input
                    type="password"
                    name="password"
                    placeholder="Enter your password"
                    required
                >

            </div>


            <button
                type="submit"
                class="login-btn">

                Login

            </button>

        </form>


        <div class="or">
            OR
        </div>


        <div class="register-link">

            New Student?

            <a href="register.php">
                Register Here
            </a>

        </div>

    </div>

</div>

</body>

</html>

