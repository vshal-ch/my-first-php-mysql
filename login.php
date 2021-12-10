<?php
include "./mysql_connect.php";
$errorMessage = "";
if (isset($_POST['login'])) {
    $uname = $_POST['username'];
    $pass = sha1($_POST['password']);
    $sql = "SELECT password FROM reg_user WHERE username = '$uname'";
    $result = $conn->query($sql);
    $rows = $result->fetch_array();
    if ($result && sizeof($rows) > 0 && $rows['password'] == $pass) {
        header('location:welcome.php');
        exit;
    } else {
        $errorMessage = "Invalid Login details";
    }
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
            color: red;
            left: 50%;
            transform: translateX(-50%);
        }
    </style>
</head>

<body>
    <p><?php echo $errorMessage ?></p>
    <section class="form-container">
        <h2 class="title">Login</h2>
        <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
            <input type="text" name="username" id="username" placeholder="Username">
            <input type="password" name="password" id="password" placeholder="Password">
            <input type="submit" value="LOGIN" name='login'>
        </form>
    </section>
</body>

</html>