<?php
/**
 * Created by PhpStorm.
 * User: victor
 * Date: 2/15/2017
 * Time: 6:48 AM
 */

//If the form is submitted with an intent
if (isset($_POST['intent'])) {

    $name = $_POST['name'];
    $email = $_POST['email'];
    $comments = $_POST['comment'];

    $conn = mysqli_connect("localhost", "root", "");

    //Create database if not exists
    mysqli_query($conn, 'CREATE DATABASE IF NOT EXISTS userfeedback;');

    //Prefer database
    mysqli_query($conn, "USE userfeedback;");

    //Create table if not exists
    mysqli_query($conn, "CREATE TABLE IF NOT EXISTS feedbacks(feedbackId int PRIMARY KEY AUTO_INCREMENT,name VARCHAR (128 ) NOT NULL, email VARCHAR(128) NOT NULL, comment TEXT NOT NULL);");

    //Dump data
    mysqli_query($conn, "INSERT INTO feedbacks (`email`,`name`,`comment`) VALUES ('$email','$name','$comments')");

    echo "Thank you $name. Your comments `$comments` have been received. We shall send a response to $email soon" ;

}

?>