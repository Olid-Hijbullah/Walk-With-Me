<?php
include 'config.php';
if(!isset($_SESSION['userid'])){
    echo "<script>alert('Please login first.')</script>";
    echo "<script>location.href='login.php'</script>";
}
if(isset($_POST["ans"]) && isset($_POST["qid"])){
    $qid = $_POST["qid"];
    $answer = $_POST["ans"];
    $sql = "UPDATE `question` SET `answer`='$answer' WHERE `id`='$qid'";
    $response = mysqli_query($conn, $sql);
    if($response){
        echo "<script>alert('Answer Submitted Successfully')</script>";
    }
    else{
        echo "<script>alert('Something went wrong. Try again later.')</script>";
    }
    echo "<script>location.href='answer.php'</script>";
}
?>