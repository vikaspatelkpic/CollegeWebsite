<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    echo $_name =    $_POST["s_name"];
    echo $_course =    $_POST["course"];
    echo $_mobile =    $_POST["mobile"];
    echo $_email =    $_POST["e_mail"];
    echo $_dob =    $_POST["dateofbirth"];
    $_regno = '';
    if (isset($_name) && !empty($_course)) {
        require_once './action/_config.php';
        $sql1 = "SELECT * FROM regestration ORDER BY srno DESC LIMIT 1";
        $result1 = $conn->query($sql1);

        if ($result1->num_rows > 0) {
            // output data of each row
            while ($row1 = $result1->fetch_assoc()) {
                $_regno =  $row1["regno"] + 1;
            }
        } else {
            $_regno = "915255";
            $yera =  date("Y");
            echo $_regno = $_regno . $yera . "001";
        }
        $sql2 = "INSERT INTO regestration (s_name,dob,course,mob,e_mail,regno) VALUES ('$_name','$_dob','$_course','$_mobile','$_email','$_regno')";
        if (($conn->query($sql2) === TRUE)) {
            echo "Your Reg No $_regno" . "<br>" . "And Password = " . $_dob;
        } else {
            echo "Error: " . $sql2 . "<br>" . $conn->error;
        }

        $conn->close();
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Regester Here</title>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="./css/nav.css">
</head>

<body>
    <header>
        <?php
        include '_frontLogo.php';
        include '_nav.php';
        ?>
    </header>
    <div class="container">
        <form action="<?php $_PHP_SELF ?>" method="POST">
            <label>Name</label>
            <input type="text" name="s_name" placeholder="Name"><br>
            <label>Course:</label>
            <select name="course">
                <option value="">-------</option>
                <?php
                require_once './action/_config.php';
                $sql = "SELECT c_name FROM course";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    // output data of each row
                    while ($row = $result->fetch_assoc()) {
                        echo " <option value =" . $row["c_name"] . ">" . $row["c_name"] . "</option>";
                    }
                } else {
                    echo "0 results";
                }
                $conn->close();
                ?>
            </select><br>
            <label>Mobile No:</label>
            <input type="text" name="mobile" placeholder="6390569706"><br>
            <label>Email:</label>
            <input type="text" name="e_mail" placeholder="Email.."><br>
            <label>Date of Birth:</label>
            <input type="date" name="dateofbirth" placeholder="Date of Birth.."><br>
            <input type="submit" value="Submit">
        </form>
    </div>
</body>

</html>