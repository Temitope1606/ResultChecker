<?php
include("Auth.php");

$error = "";
if (isset($_POST['purchase'])) {

    $_SESSION["fn"] = mysqli_real_escape_string($rc->link, $_POST['fn']);
    $_SESSION["email"] = mysqli_real_escape_string($rc->link, $_POST['email']);
    $_SESSION["matric"] = mysqli_real_escape_string($rc->link, $_POST['matric']);
    $_SESSION["session"] = mysqli_real_escape_string($rc->link, $_POST['session']);
    $_SESSION["semester"] = mysqli_real_escape_string($rc->link, $_POST['semester']);

    $_SESSION['purchase'] = true;
    echo ("<script> window.location.href='https://sandbox-flw-web-v3.herokuapp.com/pay/ajgabkzedxys';</script>");
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Purchase Pin Page</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <main>
        <section id="create">
            <form action="" method="POST">
                <!-- <h2>Purchase Pin</h2><span style="color: red;"><?php // echo (@$error->message); 
                                                                    ?> </span> -->
                <h2>Purchase Pin</h2><span style="color: red;"><?php echo $error; ?> </span>

                <div class="register">
                    <label for="fname"> FULL NAME:
                        <input type="text" id="fname" name="fn" required />
                    </label>
                </div>

                <div class="register">
                    <label for="email"> EMAIL:
                        <input type="email" id="email" name="email" required />
                    </label>
                </div>

                <div class="register">
                    <label for="matric"> MATRIC NUMBER:
                        <input type="text" id="matric" name="matric" required />
                    </label>
                </div>

                <div class="register">
                    <label for="session"> SESSION:</label>
                    <select name="session" id="session">
                        <option value="">---Select---</option>
                        <option value="2023/2024">2023/2024</option>
                    </select>
                </div>

                <div class="register">
                    <label for="semester"> SEMESTER:</label>
                    <select name="semester" id="semester">
                        <option value="">---Select---</option>
                        <option value="1">1st Semester</option>
                        <option value="2">2nd Semester</option>
                    </select>
                </div>

                <button type="submit" name="purchase"> Purchase Pin </button>
            </form>
            <h4 id="acct"> <span style="color: #000;">I have Pin? </span><a href="login.php" style="text-decoration: none; color: #ff0000;">Login here</a></h4>
        </section>
    </main>
</body>

</html>