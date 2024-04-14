<?php
session_start();

require_once "./../connections/connections.php";

$err = "";
$username = "";

if (isset($_SESSION['session_username'])) {
    header("location:admin.php");
    exit();
}

if (isset($_POST['tb_admin'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if ($username == '' or $password == '') {
        $err .= "<p class='text-danger' style='margin: 10px 30px 0px 30px;'>Silakan masukkan username dan juga password</p>";
    } else {
        $sql1 = "select * from tb_admin where username = '$username'";
        $q1   = mysqli_query($conn, $sql1);
        $r1   = mysqli_fetch_array($q1);

        if (empty($r1['username'])) {
            $err .= "<p class='text-danger' style='margin: 10px 30px 0px 30px;'>Username <b>$username</b> tidak tersedia</p>";
        } elseif ($r1['password'] != md5($password)) {
            $err .= "<p class='text-danger' style='margin: 10px 30px 0px 30px;'>Password yang dimasukkan tidak sesuai</p>";
        }

        if (empty($err)) {
            $_SESSION['session_username'] = $username;
            $_SESSION['session_password'] = md5($password);
            header("location:admin.php");
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Roboto', sans-serif;
        }

        .container {
            margin-top: 50px;
        }

        .card {
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .card-header {
            background-color: #fff;
            color: white;
            text-align: center;
            padding: 20px 0;
            font-size: 24px;
            font-weight: bold;
        }

        .form-label {
            font-weight: bold;
        }

        .btn-success {
            width: 100%;
            transition: background-color 0.3s;
        }

        .btn-success:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }

        .form-control {
            border-radius: 20px;
            /* border-color: #007bff; */
        }

        .form-control:focus {
            border-color: #0056b3;
            box-shadow: none;
        }

        .btn {
            border-radius: 20px;
        }

        .text-center-container {
            text-align: center;
        }

        .mt-4 {
            margin-top: 1.5rem;
        }

        .logo-container {
            text-align: center;
        }

        .logo {
            width: 100px;
            height: 100px;
            margin-bottom: 20px;
        }

        @media (min-width: 576px) {
            .card {
                max-width: 400px;
                margin: 0 auto;
            }
        }
    </style>
</head>

<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                <div class="card">
                    <div class="card-header">
                    <div class="logo-container">
                        <img src="../images/logo.png" alt="Logo" class="logo" style="width: 50%;">
                    </div>
                    </div>
                    <div class="card-body">
                        <form method="POST">
                            <div class="mb-3">
                                <label for="username" class="form-label">Username</label>
                                <input type="text" class="form-control" id="username" name="username" required>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>
                            <div class="text-center-container mt-4">
                                <button type="submit" name="tb_admin" class="btn btn-success">Login</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
