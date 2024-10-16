<?php
include("Auth.php");

$error = "";
if (isset($_POST['check'])) {
   // $_SESSION["pin"] = mysqli_real_escape_string($rc->link,$_POST['pin']);
   $pin = mysqli_real_escape_string($rc->link, $_POST['pin']);
    $_SESSION["pin"] = $pin;
    
    $logged = json_decode($rc->checkResult($pin, "pin_table"));

    if ($logged!=null) {
       $_SESSION['data']= $logged->data;
       header("location:result.php");
    } 
    else{
    $error = "Invalid PIN Supplied, Kindly re-enter your pin or click on the link below to purchase a pin.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page To Check Result</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<main>
    <section id="create">
        <form action="" method="POST">
            <h2>LOGIN</h2>
           <!-- <h4> LOGIN To check result </h4> -->
            <span style="color: red;"><?php echo $error; ?></span>
            <div class="register">
                <label for="pin">Examination PIN:
                    <input type="password" id="pin" name="pin" required />
                </label>
            </div>


            <button type="submit" name="check">Check Result</button>
        </form>
        <h4 id="acct"> <span style="color: #000;">Don't have a pin?</span> <a href="index.php" style="text-decoration: none; color: #ff0000;">Purchase Pin here</a></h4>
    </section>
</main>
</body>
</html>
