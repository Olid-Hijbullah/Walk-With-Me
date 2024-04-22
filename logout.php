<?php
session_start();

if(isset($_SESSION['userid'])){
    session_unset();
    session_destroy();
    echo "<script>location.href='login.php'</script>";

}
else{
    echo "<script>alert('You have no account at WalkWithMe.')</script>";
    echo "<script>location.href='login.php'</script>";
}

?>