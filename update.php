<?php
session_start();
include('class/database.php');
class update extends database
{
    protected $link;
    public function updateFunction()
    {
        if (isset($_POST['submit'])) {
            $stu_info = $_SESSION['info'];
            $new_pass = $_POST['new_password'];
            $old_pass = $_POST['current_password'];

            $sqlFind = "Select * from student_info where (email = '$stu_info' OR stu_id = '$stu_info' )";
            $resFind = mysqli_query($this->link, $sqlFind);
            if (mysqli_num_rows($resFind) > 0) {

                $row = mysqli_fetch_assoc($resFind);
                $pass = $row['password'];

                if (password_verify($old_pass, $pass) == true) {
                    $changed_password = password_hash($new_pass, PASSWORD_DEFAULT);
                    $sql = "UPDATE `student_info` SET `password`='$changed_password',`updated`= CURRENT_TIMESTAMP WHERE (email = '$stu_info' OR stu_id = '$stu_info' )";
                    $res = mysqli_query($this->link, $sql);
                    if ($res) {
                        $msg = "Updated";
                        return $msg;
                    } else {
                        $msg = "Invalid";
                        return $msg;
                    }
                } else {
                    $msg = "Wrong";
                    return $msg;
                }
            } else {
                return false;
            }
        }
    }
}
$obj = new update;
$objUpdate = $obj->updateFunction();
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
                        Update Profile</h3>
                    <?php if (strcmp($objUpdate, 'Wrong') == 0) { ?>
                    <div class="alert alert-danger alert-dismissible">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <strong>Wrong Password</strong>
                    </div>
                    <?php } ?>
                    <?php if (strcmp($objUpdate, 'Updated') == 0) { ?>
                    <div class="alert alert-success alert-dismissible">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <strong>Password Updated</strong>
                    </div>
                    <?php } ?>
                    <form action="" method="post" data-parsley-validate>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6 col-12">


                                    <input type="password" name="new_password" class="form-control mt-3 p-3 bg-white"
                                        placeholder="New Password" required>
                                    <input type="password" name="current_password"
                                        class="form-control mt-3 p-3 bg-white" placeholder="Current Password" required>

                                </div>
                                <div class="col-md-6 col-12">


                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <input type="submit" name="submit"
                                            class="mt-3 w-100 btn font-weight-bold btn-success ml-3" value="Update">
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