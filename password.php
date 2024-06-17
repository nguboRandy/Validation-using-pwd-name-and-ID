<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Question 2</title>
    <link rel="stylesheet" href="password.css">
</head>
<body>
<?php

//setting variables to contain information from form and validate  according to instructions
$name = ($_POST["name"] == "") ? null : $_POST["name"];
$password = ($_POST["pw"] == "") ? null : $_POST["pw"];
$IdOfUser = ($_POST["IDnumber"] == "") ? null : $_POST["IDnumber"];
$nameValidation = preg_match("/^[a-zA-Z]+$/", $name);
$passwordValidation = strlen($password) <= 10 && preg_match('/[0-9]/', $password) && preg_match('/[a-zA-Z]/', $password);
$idValidation = (preg_match("/^[0-9]{3}[\s-][0-9]{3}[\s-][0-9]{3}[\s-][0-9]{3}$/", $IdOfUser) || preg_match("/^\d{12}$/", $IdOfUser));

//checking if variables are can be used  if true 
if ((isset($name) && isset($password)) && isset($IdOfUser)) {

    if (($nameValidation && $passwordValidation) && $idValidation) {

        $IdOfUser = (strlen($IdOfUser) >= 12) ? preg_replace("/[\s-]/", "", $IdOfUser) : $IdOfUser; //id length is checked and spaces or dashes removed
        
        $password = preg_replace("/./", "*", $password); //replaces character in password with asterisk to protect password


        //to display data if successful
        $message = "
        <h1 style='color:green'>Successful</h1>
        <span>$name, </span>
        <span>$password, </span>
        <span>$IdOfUser </span>
        <br>
        ";
        echo "Data submitted successfully to <a href='resultsdisplay.html'>resultsdisplay.html</a>"; 

    } else {
        $IdOfUser = (strlen($IdOfUser) > 12) ? preg_replace("/[\s-]/", "", $IdOfUser) : $IdOfUser;
        //to display if unssuccesful
        $password = preg_replace("/./", "*", $password);
        $message = "
        <h1 style='color:red'>Access Denied!Invalid data.</h1>
        <span>$name, </span>
        <span>$password, </span>
        <span>$IdOfUser </span>
        <br>
        ";
        echo "Data submitted successfully to <a href='resultsdisplay.html'>resultsdisplay.html</a>";

    }
    $results = fopen("resultsdisplay.html", "a") or die("Unable to open resultsdisplay.html");
    // $results = fopen("accessresults.txt", "a") or die("Unable to open accessresults.txt");
    fwrite($results, $message);
} else {
    echo "Missing values";
}
?>
</body>
</html>