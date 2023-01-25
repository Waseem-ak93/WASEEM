<?php
// echo phpinfo();die;
session_start(); //start a session
if(isset($_SESSION['loggedin']))
{
    header('Location:profile.php');
    die;
}
$errors = [];
if (isset($_POST['submit'])) {
    $fname = $_POST['firstname'] ? $_POST['firstname'] : '';
    $lname = $_POST['lastname'] ? $_POST['lastname'] : '';
    $gender = isset($_POST['gender']) ? $_POST['gender'] : '';
    $email = $_POST['email'] ? $_POST['email'] : '';
    $password = $_POST['password'] ? $_POST['password'] : '';
    $confirmpassword = $_POST['confirmpassword'] ? $_POST['confirmpassword'] : '';
    $number = $_POST['number'] ? $_POST['number'] : '';
    $country = $_POST['country'] ? $_POST['country'] : '';
    $error_type = '';
    // server side validation
    if ($fname == '') {
        array_push($errors, "First Name is required");
    } elseif ($lname == '') {
        array_push($errors, "Last Name is required");
    } elseif ($gender == '') {
        array_push($errors, "Gender is required");
    } elseif ($email == '') {
        array_push($errors, "Email is required");
    } elseif ($password == '') {
        array_push($errors, "Password is required");
    } elseif (strlen($password) < 8) {
        array_push($errors, "Password should have atleast 8 charecters ");
    } elseif ($password != $confirmpassword) {
        array_push($errors, "Password and Confirm password should be equal");
    } elseif ($number == '' || strlen($number) < 10) {
        array_push($errors, "Enter a valid mobile number");
    } elseif ($country == '') {
        array_push($errors, "Country is required");
    } else {
        // Database connection
        $conn = new mysqli('localhost', 'root', '', 'test');
        if ($conn->connect_error) {
            die("Connection Failed : " . $conn->connect_error);
        } else {

            $stmt = "INSERT INTO user(firstname, lastname,gender, email, password,number,country) VALUES ('{$fname}', '{$lname}', '{$gender}','{$email}','{$confirmpassword}','{$number}','{$country}')";
            if ($conn->query($stmt)) {
                $_SESSION['success'] = 'Registration successfully...';
                header('location:login.php');
            } else {
                echo "Error: " . $stmt->error;
            }
            $conn->close();
        }
    }
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Registration Page</title>
    <!-- <link rel="stylesheet" type="text/css" href="trt.css" /> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.2.3/css/bootstrap.min.css" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <div class="container">
        <div class="row" style="justify-content:center;">
            <div class="col-md-6 mt-2">
                <?php if (count($errors) > 0) : ?>
                    <div class="alert alert-danger" role="alert">
                        <h4 class="alert-heading">OOPS!</h4>
                        <?php foreach($errors as $error): ?>
                            <h6><?= $error ?></h6>
                        <?php endforeach; ?>
                        <hr>
                    </div>
                <?php endif; ?>
                <div class="card card-warning">
                    <div class="card-header text-center">
                        <h1>Registration Form</h1>
                    </div>
                    <div class="card-body">
                        <form action="" method="post">
                            <div class="form-group">
                                <label for="firstname">First Name</label>
                                <input type="text" class="form-control" id="firstname" name="firstname" value="<?= (isset($_POST['firstname'])) ? $_POST['firstname'] : '' ?>" />
                            </div>
                            <div class="form-group">
                                <label for="lastname">Last Name</label>
                                <input type="text" class="form-control" id="lastname" name="lastname" value="<?= (isset($_POST['lastname'])) ? $_POST['lastname'] : '' ?>" />
                            </div>
                            <div class="form-group">
                                <label for="gender">Gender</label>
                                <div>
                                    <label  for="male" class="radio-inline"><input type="radio" name="gender" value="m" id="male" <?= (isset($_POST['gender']) && $_POST['gender']  == "m" ? "checked" : "") ?> />Male</label>
                                    <label for="female" class="radio-inline"><input type="radio" name="gender" value="f" id="female" <?= (isset($_POST['gender']) && $_POST['gender']  == "f" ? "checked" : "") ?> />Female</label>
                                    <label for="others" class="radio-inline"><input type="radio" name="gender" value="o" id="others" <?= (isset($_POST['gender']) && $_POST['gender']  == "o" ? "checked" : "") ?> />Others</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="text" class="form-control" id="email" name="email" value="<?= (isset($_POST['email'])) ? $_POST['email'] : '' ?>" />
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" class="form-control" id="password" name="password" value="<?= (isset($_POST['password'])) ? $_POST['password'] : '' ?>" />
                            </div>
                            <div class="form-group">
                                <label for="cpassword">Confirm Password</label>
                                <input type="password" class="form-control" id="cpassword" name="confirmpassword" value="<?= (isset($_POST['confirmpassword'])) ? $_POST['confirmpassword'] : '' ?>" />
                            </div>
                            <div class="form-group">
                                <label for="number">Phone Number</label>
                                <input type="number" class="form-control" id="number" name="number" value="<?= (isset($_POST['number'])) ? $_POST['number'] : '' ?>" />
                            </div>
                            <div class="form-group">
                                <label for="country">Country</label>
                                <select class="form-control custom-select" name="country">
                                    <option <?= (isset($_POST['country']) && $_POST['country']  == "india" ? "selected" : "") ?> value="india">India</option>
                                    <option <?= (isset($_POST['country']) && $_POST['country']  == "usa" ? "selected" : "") ?> value="usa">USA</option>
                                    <option <?= (isset($_POST['country']) && $_POST['country']  == "pakistan" ? "selected" : "") ?> value="pakistan">Pakistan</option>
                                </select>
                            </div>
                            <input type="submit" class="btn btn-success mt-2" name="submit" />
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