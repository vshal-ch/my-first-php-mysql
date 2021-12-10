<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "user";
$conn = mysqli_connect($servername, $username, $password, $dbname);
if (!$conn) {
    die("Database Connection failed: " . mysqli_connect_error() . "<br>");
}
$errorMessage = "";
if (isset($_POST['reset'])) {
    $uname = $_POST['username'];
    $phone = $_POST['phone'];
    $newpass = randomPassword();
    $hash = sha1($newpass);
    $sql = "SELECT phone FROM reg_user WHERE username = '$uname'";
    $result = $conn->query($sql);
    $rows = $result->fetch_array();
    if ($result && gettype($rows)=="array" && sizeof($rows) > 0 && $rows['phone'] == $phone) {
        $update = "UPDATE reg_user SET password='$hash' WHERE username='$uname'";
        if ($conn->query($update) === TRUE) {
            $errorMessage = "Password reset to $newpass";
        }
    } else {
        $errorMessage = "Password reset unsuccessfull";
    }
}

function randomPassword()
{
    $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
    $pass = array();
    $alphaLength = strlen($alphabet) - 1;
    for ($i = 0; $i < 12; $i++) {
        $n = rand(0, $alphaLength);
        $pass[] = $alphabet[$n];
    }
    return implode($pass);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            height: 100vh;
            display: grid;
            place-items: center;
            font-family: Arial, Helvetica, sans-serif;
        }

        .form-container {
            display: flex;
            flex-direction: column;
            gap: 2rem;
        }

        form {
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }

        input:not([type='submit']) {
            padding: .5rem 1rem;
            border-radius: 4px;
        }

        input[type='submit'] {
            padding: .7rem 1rem;
            border-radius: 3px;
            align-self: center;
        }

        p {
            position: absolute;
            top: 100px;
            left: 50%;
            transform: translateX(-50%);
        }
    </style>
</head>

<body>
    <p><?php echo $errorMessage ?></p>
    <section class="form-container">
        <h2 class="title">Reset Password</h2>
        <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
            <input type="text" name="username" id="username" placeholder="Username">
            <input type="tel" name="phone" id="phone" placeholder="Phone">
            <input type="submit" value="RESET" name='reset'>
        </form>
    </section>
</body>

</html>