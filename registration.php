<?php
session_start();
include('class/database.php');
class registration extends database
{
    protected $link;
    public function registerFunction()
    {
        if (isset($_POST['submit'])) {
            $name = addslashes($_POST['name']);
            $gender = $_POST['gender'];
            $stu_id = $_POST['id'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $date = $_POST['date'];

            $pass = password_hash($password, PASSWORD_DEFAULT);

            $sqlFind = "select * from student_info where (stu_id = '$stu_id' OR email = '$email') ";
            $resFind = mysqli_query($this->link, $sqlFind);
            if (mysqli_num_rows($resFind) > 0) {
                $msg = "Taken";
                return $msg;
            } else {
                $sql = "INSERT INTO `student_info` (`id`, `name`, `gender`, `stu_id`, `birthday`, `email`, `password`, `created`, `updated`) VALUES (NULL, '$name', '$gender', '$stu_id', '$date', '$email', '$pass', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP)";
                $res = mysqli_query($this->link, $sql);
                if ($res) {
                    $_SESSION['info'] = $stu_id;
                    header('location:profile.php');
                    $msg = "Added";
                    return $msg;
                } else {
                    $msg = "Not Added";
                    return $msg;
                }
            }
        }
        # code...
    }
}
$obj = new registration;
$objReg = $obj->registerFunction();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
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
                    <h3 class="text-dark" style=" font-size:40px; font-family: 'Montserrat', sans-serif;">
                        Registration</h3>

                    <?php if (strcmp($objReg, 'Not Added') == 0) { ?>
                    <div class="alert alert-danger alert-dismissible">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <strong>Invalid Information</strong>
                    </div>
                    <?php } ?>
                    <?php if (strcmp($objReg, 'Taken') == 0) { ?>
                    <div class="alert alert-warning alert-dismissible">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <strong>Student Email or ID is already taken</strong>
                    </div>
                    <?php } ?>

                    <form action="" method="post" data-parsley-validate>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <input type="text" name="name" class="form-control mt-3 p-3 bg-white"
                                        placeholder="Enter Name" required>
                                    <input type="text" name="id" class="form-control mt-3 p-3 bg-white"
                                        placeholder="Enter ID" required>
                                    <input type="password" id="password" name="password" data-parsley-length="[6, 10]"
                                        class="form-control mt-3 p-3 bg-white" placeholder="Enter Password" required>
                                    <input type="text" name="date" class="form-control mt-3 p-3 bg-white"
                                        placeholder="Enter Birthday" required>

                                </div>
                                <div class="col-md-6">
                                    <select name="gender" id="" class="form-control bg-white mt-3" required>
                                        <option value="" selected disabled class="text-dark">Choose Gender</option>
                                        <option value="male" class="text-dark">Male</option>
                                        <option value="female" class="text-dark">Female</option>
                                    </select>
                                    <input type="email" name="email" class="form-control mt-3 p-3 bg-white"
                                        placeholder="Enter Email" required>
                                    <input type="password" data-parsley-equalto="#password" name="confirm_password"
                                        class="form-control mt-3 p-3 bg-white" placeholder="Confirm Password" required>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <input type="submit" name="submit"
                                            class="mt-3 w-100 font-weight-bold btn btn-dark ml-3" value="Submit">
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