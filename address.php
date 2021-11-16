<?php
include('./dbConn.php');

if (isset($_POST['upload'])) {
    $fname = $_POST['fname'];
    $desig = $_POST['desig'];
    $address1 = $_POST['address1'];
    $address2 = $_POST['address2'];
    $city = $_POST['city'];
    $state = $_POST['state'];
    $emailup = $_POST['emailupload'];
    
    $sql = "UPDATE addressbook SET firstname ='$fname', designation='$desig' ,address1='$address1', address2='$address2', city='$city', state='$state' WHERE email='$emailup'";
    // echo $sql;
    if ($conn->query($sql) === TRUE) {
        echo "inside";
        echo "Updated successfull";
        header("location:index.php");
    }
}

$result = null;

if (isset($_GET['search'])) {
    $email = $_GET['emailsearch'];
    $sql = "SELECT * FROM addressbook WHERE email = '$email'";
    $result = $conn->query($sql);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        body {
            display: grid;
            align-items: center;
            height: 100vh;

        }

        table,
        tr,
        td,
        th {
            border: 1px solid #000;
            border-collapse: collapse;
            margin: auto;
        }

        td,
        th {
            padding: .6rem 1rem;
        }

        .upload-form {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1rem;
            width: 80%;
            margin: auto;
        }
    </style>
</head>

<body>
    <div class="left">
        <table>
            <tr>

                <th>First name</th>
                <th>Designation</th>
                <th>Address 1</th>
                <th>Address 2</th>
                <th>City</th>
                <th>State</th>
                <th>Email</th>
                <th>Delete</th>
            </tr>
            <?php
            $array = $result->fetch_array();
            echo "<tr><td>" . $array['firstname'] . "</td><td>" . $array['designation'] . "</td><td>" . $array['address1'] . "</td><td>" . $array['address2'] . "</td><td>" . $array['city'] . "</td><td>" . $array['state'] . "</td><td>" . $array['email'] . "</td><td><a href='delete.php?email=" . $array['email'] . "'>Delete</a></td></tr>";
            ?>
        </table>
    </div>
    <div class="update">
        <h2>Update Data</h2>
        <?php
        echo '<form action="' . $_SERVER['PHP_SELF'] . ' " method="post" class="upload-form">
            <input type="text" name="fname" id="fname" placeholder="First name" value=' . $array['firstname'] . ' required>
            <input type="text" name="desig" id="desig" placeholder="Designation" value=' . $array['designation'] . ' required>
            <input type="text" name="address1" id="address1" placeholder="Address 1" value=' . $array['address1'] . ' required>
            <input type="text" name="address2" id="address2" placeholder="Address 2" value=' . $array['address2'] . ' required>
            <input type="text" name="city" id="city" placeholder="City" value=' . $array['city'] . ' required>
            <input type="text" name="state" id="state" placeholder="State" value=' . $array['state'] . ' required>
            <input type="email" name="emailupload" id="emailupload" placeholder="Email" value=' . $array['email'] . ' required>
            <input type="submit" name=\'upload\' id="submit" value="UPDATE">
        </form>'; ?>
    </div>
    <a href="index.php">HOME</a>
</body>

</html>