
<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = trim($_POST["name"]);
    $regno = trim($_POST["regno"]);
    $email = trim($_POST["email"]);
    $phone = trim($_POST["phone"]);
    $department = trim($_POST["department"]);
    $year = trim($_POST["year"]);
    $password = $_POST["password"];

    /*
       Password Hashing
       Plain password students.txt-ல் save ஆகாது.
    */
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    /*
       Existing students check
    */
    $alreadyExists = false;

    if (file_exists("students.txt")) {

        $students = file("students.txt", FILE_IGNORE_NEW_LINES);

        foreach ($students as $student) {

            $data = explode("|", $student);

            if (count($data) >= 7) {

                $existingRegno = $data[1];
                $existingEmail = $data[2];

                if ($regno == $existingRegno || $email == $existingEmail) {

                    $alreadyExists = true;
                    break;
                }
            }
        }
    }

    if ($alreadyExists) {

        echo "<script>
                alert('Email or Register Number already exists!');
                window.location='register.php';
              </script>";

        exit;
    }

    /*
       Registration data
    */
    $data = $name . "|" .
            $regno . "|" .
            $email . "|" .
            $phone . "|" .
            $department . "|" .
            $year . "|" .
            $hashedPassword . "\n";

    file_put_contents(
        "students.txt",
        $data,
        FILE_APPEND | LOCK_EX
    );

    echo "<script>
            alert('Registration Successful!');
            window.location='login.php';
          </script>";

    exit;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Student Registration</title>

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

            background: white;

            border-radius: 20px;

            overflow: hidden;

            display: flex;

            box-shadow: 0 10px 35px rgba(0,0,0,0.12);
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

            margin-bottom: 70px;
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
            margin-top: 70px;
        }

        .right {
            width: 55%;
            padding: 45px 60px;
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

            margin-bottom: 30px;
        }

        .form-row {
            display: flex;
            gap: 20px;
        }

        .form-group {
            flex: 1;

            margin-bottom: 18px;
        }

        label {
            display: block;

            font-size: 16px;

            font-weight: bold;

            color: #172b4d;

            margin-bottom: 8px;
        }

        input,
        select {

            width: 100%;
            height: 50px;

            border: 1px solid #c8d5e8;

            border-radius: 8px;

            padding: 0 15px;

            font-size: 15px;

            outline: none;
        }

        input:focus,
        select:focus {
            border-color: #2463b8;
        }

        .register-btn {

            width: 100%;
            height: 55px;

            border: none;

            border-radius: 8px;

            background: #246fe0;

            color: white;

            font-size: 18px;

            font-weight: bold;

            cursor: pointer;

            margin-top: 10px;
        }

        .register-btn:hover {
            background: #185abc;
        }

        .login-link {

            text-align: center;

            margin-top: 25px;

            color: #243650;
        }

        .login-link a {

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
                padding: 35px 25px;
            }

            .form-row {
                flex-direction: column;
                gap: 0;
            }
        }

    </style>

</head>

<body>

<div class="container">

    <!-- LEFT SIDE -->

    <div class="left">

        <div class="logo">
            🎓 Student Portal
        </div>

        <h1>
            Join Our<br>
            <span>Student Community!</span>
        </h1>

        <p>
            Create your student account and
            access your dashboard, profile
            and other features.
        </p>

        <div class="education">
            📚
        </div>

    </div>


    <!-- RIGHT SIDE -->

    <div class="right">

        <h2>Student Registration</h2>

        <p class="subtitle">
            Create your account to continue
        </p>


        <form method="POST">

            <!-- NAME + REGISTER NUMBER -->

            <div class="form-row">

                <div class="form-group">

                    <label>Full Name</label>

                    <input
                        type="text"
                        name="name"
                        placeholder="Enter your name"
                        required
                    >

                </div>


                <div class="form-group">

                    <label>Register Number</label>

                    <input
                        type="text"
                        name="regno"
                        placeholder="Enter register number"
                        required
                    >

                </div>

            </div>


            <!-- EMAIL + PHONE -->

            <div class="form-row">

                <div class="form-group">

                    <label>Email</label>

                    <input
                        type="email"
                        name="email"
                        placeholder="Enter your email"
                        required
                    >

                </div>


                <div class="form-group">

                    <label>Phone Number</label>

                    <input
                        type="tel"
                        name="phone"
                        placeholder="Enter phone number"
                        required
                    >

                </div>

            </div>


            <!-- DEPARTMENT + YEAR -->

            <div class="form-row">

                <div class="form-group">

                    <label>Department</label>

                    <select name="department" required>

                        <option value="">
                            Select Department
                        </option>

                        <option value="IT">
                            Information Technology
                        </option>

                        <option value="CSE">
                            Computer Science
                        </option>

                        <option value="ECE">
                            Electronics & Communication
                        </option>

                        <option value="EEE">
                            Electrical & Electronics
                        </option>

                    </select>

                </div>


                <div class="form-group">

                    <label>Year</label>

                    <select name="year" required>

                        <option value="">
                            Select Year
                        </option>

                        <option value="1st Year">
                            1st Year
                        </option>

                        <option value="2nd Year">
                            2nd Year
                        </option>

                        <option value="3rd Year">
                            3rd Year
                        </option>

                        <option value="4th Year">
                            4th Year
                        </option>

                    </select>

                </div>

            </div>


            <!-- PASSWORD -->

            <div class="form-group">

                <label>Password</label>

                <input
                    type="password"
                    name="password"
                    placeholder="Create password"
                    required
                >

            </div>


            <!-- REGISTER -->

            <button
                type="submit"
                class="register-btn">

                Register

            </button>

        </form>


        <div class="login-link">

            Already have an account?

            <a href="login.php">
                Login Here
            </a>

        </div>

    </div>

</div>

</body>

</html>
