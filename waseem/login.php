<?php

session_start(); //start a session
if(isset($_SESSION['loggedin']))
{
    header('Location:profile.php');
    die;
}
$errors = [];
if (isset($_POST['submit'])) {
    $email = $_POST['email'] ? $_POST['email'] : '';
    $password = $_POST['password'] ? $_POST['password'] : '';
    // server side validation
    if ($email == '') {
        array_push($errors, "Email is required");
    } elseif ($password == '') {
        array_push($errors, "Password is required");
    } else {
        $conn = new mysqli('localhost', 'root', '', 'test');
        if ($conn->connect_error) {
            die("Connection Failed : " . $conn->connect_error);
        } else {
            //prepare and execute the query
            $stmt = "SELECT * FROM user WHERE email = '{$email}'AND password = '{$password}'";
            $result = $conn->query($stmt);

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                //login successful
                $_SESSION['loggedin'] = $row;
                header("Location: profile.php");
            } else {
                //login failed
                array_push($errors, "Invalid email or password");
                // echo '<script>alert(Invalid email or password)</script>';
                header("Location: login.php");
            }
            // $stmt->close();
            $conn->close();
        }
    }
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Login Page</title>
    <!-- <link rel="stylesheet" type="text/css" href="trt.css" /> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.2.3/css/bootstrap.min.css" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <div class="container">
        <?php if (isset($_SESSION['success'])) : ?>
            <div class="alert alert-success" role="alert">
                <h4 class="alert-heading">Congrats!</h4>
                <p><?= $_SESSION['success'] ?></p>
                <hr>
            </div>
            <?php unset($_SESSION['success']) ?>
        <?php endif; ?>
        <div class="row" style="justify-content:center;">
            <div class="col-md-6 mt-2">
                <?php if (count($errors) > 0) : ?>
                    <div class="alert alert-danger" role="alert">
                        <h4 class="alert-heading">OOPS!</h4>
                        <?php foreach ($errors as $error) : ?>
                            <h6><?= $error ?></h6>
                        <?php endforeach; ?>
                        <hr>
                    </div>
                <?php endif; ?>
                <div class="card card-primary" style="justify-items: center;">
                    <div class="card-header text-center">
                        <h1>Login Form</h1>
                    </div>
                    <div class="card-body">
                        <form action="" method="post">
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="text" class="form-control" id="email" name="email" value="<?= (isset($_POST['email'])) ? $_POST['email'] : '' ?>" />
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" class="form-control" id="password" name="password" value="<?= (isset($_POST['password'])) ? $_POST['password'] : '' ?>" />
                            </div>
                            <input type="submit" class="btn btn-info mt-2" name="submit" />
                        </form>
                    </div>
                    <div class="panel-footer text-right" style="text-align: center;">
                        <small>Waseem Akram</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.2.3/js/bootstrap.min.js" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</body>

</html>