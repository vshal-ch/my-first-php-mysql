<?php
include('./dbConn.php');

$id = $_GET['email'];

$del = $conn->query("delete from addressbook where email = '$id'"); 

if($del)
{
    mysqli_close($db); 
    header("location:index.php");
    exit;	
}
else
{
    echo "Error deleting record";
}

?>