<?php
include 'config.php';
if(isset($_POST["q"])){
    $q = $_POST["q"];
    $sql = "INSERT INTO `question` (`question`, `answer`) VALUES ('$q',' ')";
    $response = mysqli_query($conn, $sql);
    if($response){
        echo "<script>alert('Question added successfully.$q')</script>";
        
    } else{
        echo "<script>alert('Question addition failed.')</script>";
    }
    
}else{
    echo "<script>alert('Input cannot be empty.')</script>";
}
echo "<script>location.href='question.php'</script>";
?>