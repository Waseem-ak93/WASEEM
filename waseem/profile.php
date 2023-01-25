<?php 
session_start();
if(!isset($_SESSION['loggedin']))
{
    header('Location:login.php');
    die;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/css/bootstrap.min.css">

    <style>
        @import url("https://fonts.googleapis.com/css2?family=Poppins:weight@100;200;300;400;500;600;700;800&display=swap");


        body {
            background-color: #545454;
            font-family: "Poppins", sans-serif;
            font-weight: 300;
        }

        .container {
            height: 100vh;
        }

        .card {

            width: 380px;
            border: none;
            border-radius: 15px;
            padding: 8px;
            background-color: #fff;
            position: relative;
            height: 370px;
        }

        .upper {

            height: 100px;

        }

        .upper img {

            width: 100%;
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;

        }

        .user {
            position: relative;
        }

        .profile img {


            height: 80px;
            width: 80px;
            margin-top: 2px;


        }

        .profile {

            position: absolute;
            top: -50px;
            left: 38%;
            height: 90px;
            width: 90px;
            border: 3px solid #fff;

            border-radius: 50%;

        }

        .follow {

            border-radius: 15px;
            padding-left: 20px;
            padding-right: 20px;
            height: 35px;
        }

        .stats span {

            font-size: 29px;
        }
    </style>
</head>

<body>
    <div class="container d-flex justify-content-center align-items-center">

        <div class="card">

            <div class="upper">

                <img src="https://i.imgur.com/Qtrsrk5.jpg" class="img-fluid">

            </div>

            <div class="user text-center">

                <div class="profile">

                    <img src="pic.webp" class="rounded-circle" width="80">

                </div>

            </div>


            <div class="mt-5 text-center">

                <h4 class="mb-0"><?= $_SESSION['loggedin']['firstname'] . ' ' . $_SESSION['loggedin']['lastname'] ?></h4>
                <span class="text-muted d-block mb-2">Email : <?= $_SESSION['loggedin']['email'] ?></span>
                <span class="text-muted d-block mb-2">Number : <?= $_SESSION['loggedin']['number'] ?></span>
                <span class="text-muted d-block mb-2">Gender : <?php  if($_SESSION['loggedin']['gender'] == 'm'){ echo 'Male'; }elseif($_SESSION['loggedin']['gender'] == 'f'){ echo 'Female'; }else{ echo 'Other'; } ?></span>
                <span class="text-muted d-block mb-2">Created On : <?= date($_SESSION['loggedin']['created_on']) ?></span>

                <a class="btn btn-danger btn-sm follow" href="logout.php">Logout</a>

            </div>

        </div>

    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</body>

</html>