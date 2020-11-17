<?php
session_start();
if (isset($_SESSION['info'])) {
} else {
    header('location:login.php');
}
include('class/database.php');
class profile extends database
{
    protected $link;
    public function profileFunction()
    {
        $info = $_SESSION['info'];
        $sql = "select * from student_info where (email = '$info' OR stu_id = '$info' )";
        $res = mysqli_query($this->link, $sql);
        if (mysqli_num_rows($res) > 0) {
            return $res;
        } else {
            return false;
        }
        # code...
    }
    public function enrolledFunction()
    {

        $info = $_SESSION['info'];

        $sqlFind = "select * from student_info where (email = '$info' OR stu_id = '$info' )";
        $resFind = mysqli_query($this->link, $sqlFind);
        if (mysqli_num_rows($resFind) > 0) {
            $row = mysqli_fetch_assoc($resFind);
            $stu_id = $row['stu_id'];

            $sql = "SELECT *
            FROM student_course
            INNER JOIN course_tbl
            ON student_course.course_id = course_tbl.course_id where student_course.stu_info = '$stu_id' AND student_course.enroll = 1 ";
            $res = mysqli_query($this->link, $sql);
            if (mysqli_num_rows($res) > 0) {
                return $res;
            } else {
                return false;
            }
        }

        # code...
    }
}
$obj = new profile;
$objProfile = $obj->profileFunction();
$row = mysqli_fetch_assoc($objProfile);
$objEnroll = $obj->enrolledFunction();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link rel="stylesheet" href="css/fontawesme.min.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/parsley.css">
    <link rel="stylesheet" href="css/animate.css">

    <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
    <style>
    .back_img {
        background-color: #FF4500;
        padding: 60px 0;
    }
    </style>
</head>

<body>
    <?php include('layout/navbar.php'); ?>
    <div class="back_img">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-12 text-center">

                    <?php if (strcmp($row['gender'], 'male') == 0) { ?>
                    <img src="images/man.png" class="img-fluid w-50" alt="">
                    <?php } ?>
                    <?php if (strcmp($row['gender'], 'female') == 0) { ?>
                    <img src="images/girl.png" class="img-fluid w-50" alt="">
                    <?php } ?>

                </div>
                <div class="col-md-6 col-12 p-5">
                    <h3 class="text-white mt-5 text-capitalize">Name: <?php echo $row['name']; ?></h3>
                    <h3 class="text-white text-capitalize">Gender: <?php echo $row['gender']; ?></h3>
                    <h3 class="text-white">Email: <?php echo $row['email']; ?></h3>
                    <?php if ($row['birthday'] == NULL) { ?>
                    <h3 class="text-white">Birthday: Not Selected</h3>
                    <?php } else { ?>
                    <h3 class="text-white">Birthday: <?php echo $row['birthday']; ?></h3>

                    <?php } ?>
                </div>
            </div>
            <h2 class="text-center text-white mb-3">All available courses</h2>
            <div class="bg-white">

                <table class="table table-hover">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">Course ID</th>
                            <th scope="col">Name</th>
                            <th scope="col">Semester</th>
                            <th scope="col">Instructor</th>
                            <th scope="col">Classroom</th>
                            <th scope="col">Time</th>
                            <th scope="col">Days</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ($objEnroll) { ?>
                        <?php while ($row = mysqli_fetch_assoc($objEnroll)) { ?>
                        <tr>
                            <th scope="row"><?php echo $row['course_id']; ?></th>
                            <td><?php echo $row['name']; ?></td>
                            <td><?php echo $row['semester']; ?></td>
                            <td><?php echo $row['instructor']; ?></td>
                            <td><?php echo $row['classroom']; ?></td>
                            <td><?php echo $row['time']; ?></td>
                            <td><?php echo $row['days']; ?></td>

                            <td><a href="withdraw.php?course_id=<?php echo $row['course_id']; ?>&&info=<?php echo $_SESSION['info']; ?>"
                                    class="btn btn-danger">Withdraw</a></td>


                        </tr>
                        <?php } ?>
                        <?php } else { ?>
                        <p class="text-center text-black font-weight-bold pt-3">No Enrolled Courses</p>
                        <?php } ?>
                    </tbody>
                </table>
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