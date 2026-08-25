<?php
session_start();

$conn = mysqli_connect("localhost","root","","certificate_system");

if(!$conn)
{
    die("Database Connection Failed : ".mysqli_connect_error());
}
?>