<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pin page</title>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

</head>
<body>

    <?php
    include("Auth.php");

    
if (isset($_SESSION['purchase'])) {
$pin = "ESM". chr(rand(48,57)).chr(rand(48,57)).chr(rand(48,57)).chr(rand(48,57)).chr(rand(48,57));

$query = "INSERT INTO pin_table(fullname,email,pin,matric,session,semester)" ;
$query.= "VALUES('".$_SESSION['fn']."','".$_SESSION['email']."','".$pin."','".$_SESSION['matric']."','".$_SESSION['session']."',
'".$_SESSION['semester']."')";
//print_r($query);

$error = json_decode($rc->postData($query));

echo("<script> swal('Pin purchased successfully', '$pin Kindly Save it.', 'success'); </script>");
unset($_SESSION['purchase']);

// getting pin_id 
$getPinId = json_decode($rc->checkResult($pin, "pin_table"));
if ($getPinId) {
    $pinId = $getPinId->data->sn;
    $em = $_SESSION["email"];
    $ses = $_SESSION["session"];
    $sem = $_SESSION["semester"];

    $updateSql = "UPDATE results SET pin_id = '$pinId' WHERE email = '$em' AND session = '$ses' AND semester = '$sem'";
    $updateResult = mysqli_query($rc->link, $updateSql);
} 

echo("<a href ='login.php'> Check Result </a>");

}

else {
    echo("<script> swal('Pin Purchase Error', 'Kindly go through the normal process.', 'error'); </script>");
    echo("<a href ='index.php'> Purchase Pin Now </a>");
}
?>

</body>
</html>

