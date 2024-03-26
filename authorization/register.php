<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <style>
        body {
            background-color: #121212;
            color: #e0e0e0;
        }

        .form-control {
            background-color: #333;
            border-color: #666;
            color: #e0e0e0;
        }

        .form-control:focus {
            background-color: #333;
            border-color: #555;
            box-shadow: 0 0 0 0.25rem rgba(130, 138, 145, 0.5);
        }

        .btn-primary, .btn-secondary {
            background-color: #1b1b1b;
            border-color: #323232;
        }

        .btn-primary:hover, .btn-secondary:hover {
            background-color: #323232;
        }

        .alert-danger {
            background-color: #721c24;
            border-color: #f5c6cb;
        }

        .alert-success {
            background-color: #155724;
            border-color: #c3e6cb;
        }
    </style>
</head>
<body class="bg-light">
    <div class="container py-5">
        <?php
        if (isset($_POST["submit"])) {
            $fullName = $_POST["fullname"];
            $email = $_POST["email"];
            $password = $_POST["password"];
            $passwordRepeat = $_POST["repeat_password"];

            $passwordHash = password_hash($password, PASSWORD_DEFAULT);

            $errors = array();

            if (empty($fullName) OR empty($email) OR empty($password) OR empty($passwordRepeat)) {
             array_push($errors,"All fields are required");
            }
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
             array_push($errors, "Email is not valid");
            }
            if (strlen($password)<8) {
             array_push($errors,"Password must be at least 8 charactes long");
            }
            if ($password!==$passwordRepeat) {
             array_push($errors,"Password does not match");
            }
            require_once "database.php";
            $sql = "SELECT * FROM users WHERE email = '$email'";
            $result = mysqli_query($conn, $sql);
            $rowCount = mysqli_num_rows($result);
            if ($rowCount>0) {
             array_push($errors,"Email already exists!");
            }
            if (count($errors)>0) {
             foreach ($errors as  $error) {
                 echo "<div class='alert alert-danger'>$error</div>";
             }
            }else{

             $sql = "INSERT INTO users (fullname, email, password) VALUES ( ?, ?, ? )";
             $stmt = mysqli_stmt_init($conn);
             $prepareStmt = mysqli_stmt_prepare($stmt,$sql);
             if ($prepareStmt) {
                 mysqli_stmt_bind_param($stmt,"sss",$fullName, $email, $password);
                 mysqli_stmt_execute($stmt);
                 echo "<div class='alert alert-success'>You are registered successfully.</div>";
             }else{
                 die("Something went wrong");
             }
            }
         }
        ?>
        <form action="register.php" method="post">
            <div class="mb-3">
                <input type="text" class="form-control" name="fullname" placeholder="Full Name">
            </div>
            <div class="mb-3">
                <input type="email" class="form-control" name="email" placeholder="Email">
            </div>
            <div class="mb-3">
                <input type="password" class="form-control" name="password" placeholder="Password">
            </div>
            <div class="mb-3">
                <input type="password" class="form-control" name="repeat_password" placeholder="Repeat Password">
            </div>
            <div class="d-grid gap-2">
                <input type="submit" class="btn btn-primary" value="Register" name="submit">
            </div>
        </form>
        <div class="text-center mt-3">
            <a href="login.php" class="btn btn-secondary">Login</a>
        </div>
    </div>
</body>
</html>