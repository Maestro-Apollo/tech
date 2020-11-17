<?php
session_start();
if (!isset($_SESSION['info'])) {
    header('location:login.php');
}
include('class/database.php');
class course extends database
{
    // protected $link;
    public function courseFunction()
    {
        if (isset($_POST['search'])) {
            $info = $_POST['info'];
            $sql = "Select * from course_tbl where (course_id like '$info%' OR name like '$info%' OR instructor like '$info%')";
        } else {
            $sql = "select * from course_tbl";
        }
        $res = mysqli_query($this->link, $sql);
        if (mysqli_num_rows($res) > 0) {
            return $res;
        } else {
            return false;
        }
        # code...
    }
    public function checkFunction($data)
    {
        $course_id = $data;
        $info = $_SESSION['info'];

        $sqlFind = "select * from student_info where (email = '$info' OR stu_id = '$info' )";
        $resFind = mysqli_query($this->link, $sqlFind);
        if (mysqli_num_rows($resFind) > 0) {
            $row = mysqli_fetch_assoc($resFind);
            $stu_id = $row['stu_id'];

            $sqlCheck = "select * from student_course where course_id = '$course_id' AND stu_info = '$stu_id' AND enroll = 1  ";
            $resCheck = mysqli_query($this->link, $sqlCheck);
            if (mysqli_num_rows($resCheck) > 0) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
        # code...
    }
}
$obj = new course;
$objCourse = $obj->courseFunction();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Course</title>
    <link rel="stylesheet" href="css/fontawesme.min.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/parsley.css">
    <link rel="stylesheet" href="css/animate.css">



    <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
    <style>
    .back_img {
        background-color: #FF4500;

    }
    </style>
</head>

<body class="back_img">

    <div class="preloader js-preloader flex-center">
        <div class="dots">
            <div class="dot"></div>
            <div class="dot"></div>
            <div class="dot"></div>
        </div>
    </div>

    <?php include('layout/navbar.php'); ?>
    <div class="container">

        <div class="row mt-5">
            <div class="col-md-6">
                <form action="" method="post">
                    <div class="form-group d-flex">
                        <input type="text" name="info" class="form-control w-75 float-right"
                            placeholder="Enter Course ID/ Name/ Instructor">
                        <input type="submit" name="search" class="btn btn-dark w-25 ml-auto font-weight-bold"
                            value="Search">
                    </div>
                </form>
            </div>
            <div class="col-md-6">
                <a href="course.php" class="float-right text-white mt-3 mr-3"><i class="fas fa-sync-alt "></i></a>
            </div>
        </div>

        <table class="table table-hover bg-white">
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
                <?php if ($objCourse) { ?>
                <?php while ($row = mysqli_fetch_assoc($objCourse)) { ?>
                <tr>
                    <th scope="row"><?php echo $row['course_id']; ?></th>
                    <td><?php echo $row['name']; ?></td>
                    <td><?php echo $row['semester']; ?></td>
                    <td><?php echo $row['instructor']; ?></td>
                    <td><?php echo $row['classroom']; ?></td>
                    <td><?php echo $row['time']; ?></td>
                    <td><?php echo $row['days']; ?></td>

                    <?php if ($obj->checkFunction($row['course_id'])) { ?>
                    <td><a href="#" class="btn btn-danger btn-block">Enrolled</a></td>
                    <?php } else { ?>
                    <td><a href="enroll.php?course_id=<?php echo $row['course_id']; ?>&&info=<?php echo $_SESSION['info']; ?>"
                            class="btn btn-success btn-block">Enroll</a></td>
                    <?php } ?>


                </tr>
                <?php } ?>
                <?php } else { ?>
                <p class="text-center text-white font-weight-bold">No Data</p>
                <?php } ?>

            </tbody>
        </table>
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