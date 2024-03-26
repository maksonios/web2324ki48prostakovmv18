<?php
ini_set('display_errors', 1); error_reporting(E_ALL);

session_start();

if(isset($_POST["login"])) {

    require_once "./database.php";

    $email = $_POST["email"];
    $password = $_POST["password"];

    $sql = "SELECT * FROM users WHERE email = '$email'";
    $result = mysqli_query($conn, $sql);
    $user = mysqli_fetch_assoc($result);

    if ($user && $password === $user["password"]) {

        $_SESSION["user"] = $user;

        header("Location: acount.php");
        exit;
    } else {

        echo "Invalid email or password";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <script src="https://accounts.google.com/gsi/client" async></script>
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

        .btn-primary {
            background-color: #1b1b1b;
            border-color: #323232;
        }

        .btn-primary:hover {
            background-color: #323232;
        }

        .btn-secondary {
            background-color: #2c2c2c;
            border-color: #464646;
        }

        .btn-secondary:hover {
            background-color: #464646;
        }
    </style>
</head>
<body>
    <div class="container mt-5">

        <form action="login.php" method="post">
            <div class="mb-3">
                <input type="email" placeholder="Enter Email:" name="email" class="form-control">
            </div>
            <div class="mb-3">
                <input type="password" placeholder="Enter Password:" name="password" class="form-control">
            </div>
            <div class="d-grid gap-2">
                <input type="submit" value="Login" name="login" class="btn btn-primary">
            </div>
        </form>
        <div class="d-flex justify-content-center mt-3">
            <a href="register.php" class="btn btn-secondary">Register Here</a>
        </div>
        <div id="g_id_onload"
    data-client_id="642070027888-ge9cjqoja47lgr34h2vasj01as57656r.apps.googleusercontent.com"
    data-context="signin"
    data-ux_mode="popup"
    data-callback="handleCredentialResponse"
    data-auto_prompt="false">
</div>

<div class="g_id_signin"
    data-type="standard"
    data-shape="rectangular"
    data-theme="outline"
    data-text="signin_with"
    data-size="large"
    data-logo_alignment="left">
</div>
    </div>
</body>

<script>

async function handleCredentialResponse(response){
    console.log(response);
    console.log(response.credential);
    var parts = response.credential.split('.');
    console.log(parts[1]);
    var base64UrlPayload = parts[1];
    var base64Payload = base64UrlPayload.replace(/-/g, '+').replace(/_/g, '/');
    const response_result = JSON.parse(atob(base64Payload))           
    console.log(response_result)
    var formData = new FormData();
    formData.append("email",response_result.email)
    var xhr = new XMLHttpRequest();
    xhr.open('Post', 'authorize.php', true);
    xhr.onload = function() {
        window.location.href="../index.php"
    };
    xhr.send(formData);
}
</script>

</html>