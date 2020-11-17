<?php
session_start();
include('class/database.php');
class login extends database
{
    protected $link;
    public function loginFunction()
    {
        if (isset($_POST['submit'])) {
            $info = $_POST['info'];
            $password = $_POST['password'];

            $sql = "select * from student_info where (email = '$info' OR stu_id = '$info') ";
            $res = mysqli_query($this->link, $sql);
            if (mysqli_num_rows($res) > 0) {
                $pass = mysqli_fetch_assoc($res);
                if (password_verify($password, $pass['password']) == true) {
                    $_SESSION['info'] = $info;
                    header('location:profile.php');
                } else {
                    $msg = "Wrong";
                    return $msg;
                }
            } else {
                header('location:registration.php');
            }
        }
        # code...
    }
}
$obj = new login;
$objLogin = $obj->loginFunction();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="css/fontawesme.min.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/parsley.css">
    <link rel="stylesheet" href="css/animate.css">

    <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
    <style>
    .back_img {
        background-color: #FF4500;
        height: 95vh;
    }
    </style>
</head>

<body>
    <?php include('layout/navbar.php'); ?>

    <div class="back_img">
        <div class="container">

            <div class="pt-5">
                <div class="bg-light p-5 rounded">
                    <h3 class="text-dark" style="font-size:40px; font-family: 'Montserrat', sans-serif;">
                        Login</h3>
                    <?php if (strcmp($objLogin, 'Wrong') == 0) { ?>
                    <div class="alert alert-danger alert-dismissible">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <strong>Wrong Password</strong>
                    </div>
                    <?php } ?>
                    <form action="" method="post" data-parsley-validate>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6 col-12">
                                    <input type="text" name="info" class="form-control mt-3 p-3 bg-white"
                                        placeholder="Enter ID/ Email" required>
                                    <input type="password" name="password" class="form-control mt-3 p-3 bg-white"
                                        placeholder="Password" required>

                                </div>
                                <div class="col-md-6 col-12">


                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <input type="submit" name="submit"
                                            class="mt-3 w-100 btn font-weight-bold btn-dark ml-3" value="Login">
                                    </div>
                                </div>

                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>




    <script src="js/jquery-3.5.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/parsley.min.js"></script>
    <script src="js/wow.js"></script>
    <script>
    new WOW().init();
    </script>

</body>

</html>