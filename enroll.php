<?php
session_start();
include('class/database.php');
class enroll extends database
{
    protected $link;
    public function enrollFunction()
    {
        $course_id = $_GET['course_id'];
        $info = $_GET['info'];

        $sqlFind = "select * from student_info where (email = '$info' OR stu_id = '$info' )";
        $resFind = mysqli_query($this->link, $sqlFind);
        if (mysqli_num_rows($resFind) > 0) {

            $row = mysqli_fetch_assoc($resFind);
            $stu_id = $row['stu_id'];
            $enroll = 1;

            $sql = "INSERT INTO `student_course` (`id`, `course_id`, `stu_info`, `enroll`) VALUES (NULL, '$course_id', '$stu_id', '$enroll')";
            $res = mysqli_query($this->link, $sql);
            if ($res) {
                header('location:course.php');
                return $res;
            } else {
                return false;
            }
        }


        # code...
    }
}
$obj = new enroll;
$objEnroll = $obj->enrollFunction();