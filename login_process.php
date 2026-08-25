<?php

include "config.php";

if(isset($_POST['login']))
{

$username=mysqli_real_escape_string($conn,$_POST['username']);

$password=mysqli_real_escape_string($conn,$_POST['password']);

$sql=mysqli_query($conn,"SELECT * FROM admin
WHERE username='$username'
AND password='$password'");

if(mysqli_num_rows($sql)>0)
{

$_SESSION['admin']=$username;

header("Location:admin/dashboard.php");

exit();

}
else{

echo "<script>

alert('Invalid Username or Password');

window.location='login.php';

</script>";

}

}
?>