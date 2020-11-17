<?php
session_start();
include('class/database.php');
class withdraw extends database
{
    protected $link;
    public function withdrawFunction()
    {
        $course_id = $_GET['course_id'];
        $info = $_GET['info'];

        $sqlFind = "select * from student_info where (email = '$info' OR stu_id = '$info' )";
        $resFind = mysqli_query($this->link, $sqlFind);
        if (mysqli_num_rows($resFind) > 0) {

            $row = mysqli_fetch_assoc($resFind);
            $stu_id = $row['stu_id'];
            $enroll = 0;

            $sql = "UPDATE `student_course` SET `enroll`= '$enroll' WHERE `stu_info` = '$stu_id' AND `course_id` = '$course_id' ";
            $res = mysqli_query($this->link, $sql);
            if ($res) {
                header('location:profile.php');
                return $res;
            } else {
                return false;
            }
        }


        # code...
    }
}
$obj = new withdraw;
$objWithdraw = $obj->withdrawFunction();