<?php
$servername = "localhost";
$username = "root";
$password = "";
$name = "addressbook";

$conn = new mysqli($servername, $username, $password, $name);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$msg = "";

if (isset($_POST['submit'])) {

    $fname = $_POST['fname'];
    $desig = $_POST['desig'];
    $address1 = $_POST['address1'];
    $address2 = $_POST['address2'];
    $city = $_POST['city'];
    $state = $_POST['desig'];
    $email = $_POST['emailadd'];

    $sql = "INSERT INTO addressbook VALUES ('.$fname.','.$desig.','.$address1.','.$address2.','.$city.','.$state.','.$email.')";


    if ($conn->query($sql) === TRUE) {
        $msg = "Added successfully";
    } else {
        $msg = "Error occured";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Address Book</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            display: grid;
            place-items: center;
            height: 100vh;
            font-family: Arial, Helvetica, sans-serif;
            position: relative;
        }

        main {
            width: 100%;
            display: flex;
            justify-content: space-evenly;
            align-items: center;
        }

        /* .left,.right{
            flex:1;
        } */

        .left {
            display: flex;
            flex-direction: column;
            gap: 1.5rem;
            justify-content: center;
        }

        .search-form {
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            gap: 1rem;
        }

        input:not([type='submit']) {
            width: 250px;
            padding: 8px 12px;
            border-radius: 5px;
        }

        #search {
            padding: .5rem .6rem;
            font-size: .8rem;
            border-radius: 3px;
        }

        .add-form {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: .7rem;
        }

        #emailadd {
            grid-column: 1/3;
            width: 100%;
        }

        #submit {
            margin-top: 1rem;
            grid-column: 1/3;
            width: 100px;
            justify-self: center;
            padding: .5rem .6rem;
        }

        .abs {
            position: absolute;
            top: 200px;
            left: 50%;
            transform: translateX(-50%);
        }
    </style>
</head>

<body>
    <p class="abs">
        <?php echo $msg ?>
    </p>
    <main>
        <section class="left">
            <h2 class="title">Get Address</h2>
            <form action="./address.php" method="get" class="search-form">
                <input type="email" name="emailsearch" id="emailsearch" placeholder="Enter EmailId to get address">
                <input type="submit" id="search" value="SEARCH">
            </form>
        </section>
        <section class="left">
            <h2 class="title">Add Address</h2>
            <form action="<?php echo $_SERVER['PHP_SELF'] ?> " method="post" class="add-form">
                <input type="text" name="fname" id="fname" placeholder="First name" required>
                <input type="text" name="desig" id="desig" placeholder="Designation" required>
                <input type="text" name="address1" id="address1" placeholder="Address 1" required>
                <input type="text" name="address2" id="address2" placeholder="Address 2" required>
                <input type="text" name="city" id="city" placeholder="City" required>
                <input type="text" name="state" id="state" placeholder="State" required>
                <input type="email" name="emailadd" id="emailadd" placeholder="Email" required>
                <input type="submit" name='submit' id="submit" value="ADD">
            </form>
        </section>
    </main>
</body>

</html>