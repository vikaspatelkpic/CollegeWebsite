<?php
if (isset($_POST['form'])) {
    global $_regNo;
    echo $_POST['form'];
    switch ($_POST['form']) {
        case "A": {
                $_regNo =   $_POST["reg_no"];
                $_dob =    $_POST["d_o_b"];
                $_udob =   "";
                // echo $_regNo;
                if (!empty($_regNo)) {
                    require_once './action/_config.php';
                    $sql = "SELECT dob FROM regestration WHERE regno = " . $_regNo;
                    $result = $conn->query($sql);
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            $_udob = $row["dob"];
                        }
                    } else {
                        echo "0 results";
                    }
                    $conn->close();
                    if ($_dob == $_udob) {
                        session_start();
                        $_SESSION['regno'] = $_POST['reg_no'];
                        echo $_SESSION['regno'];

                        echo 'Password Correct';
                        // header("location:index.php");
                    } else {
                        echo 'Password INCorrect';
                        // header("location:Reg.php");
                    }
                }
                break;
            }
        case "B": {
                session_start();
                $reg = $_SESSION['regno'];
                $_fname = $_POST["fname"];
                $mname = $_POST["mname"];
                $gen = $_POST["gen"];
                $cot = $_POST["cot"];
                $scot = $_POST["scot"];
                $nat = $_POST["nat"];
                $adhar = $_POST["adhar"];
                if (!empty($_fname)) {
                    require_once './action/_config.php';
                    $sql2 = "INSERT INTO p_details(father,mother,gender,cotegry,sub_cotegry,natinolity,adharno,regno) VALUES ('$_fname','$mname','$gen','$cot','$scot','$nat','$adhar',$reg)";
                    if (($conn->query($sql2) === TRUE)) {
                        echo "Enterd Sucess";
                    } else {
                        echo "Error: " . $sql2 . "<br>" . $conn->error;
                    }

                    $conn->close();
                }
                break;
            }
        case "C": {
                session_start();
                $reg = $_SESSION['regno'];
                $hno = $_POST["hno"];
                $rno = $_POST["rno"];
                $landm = $_POST["landm"];
                $city = $_POST["city"];
                $state = $_POST["state"];
                $pin = $_POST["pin"];
                $fladd = $_POST["fladd"];
                if (!empty($state)) {
                    require_once './action/_config.php';
                    $sql3 = "INSERT INTO address(reg_no,houseno,roadname,state,city,pin, full,vill_landmark) VALUES ('$reg','$hno','$rno','$state','$city','$pin','$fladd','$landm')";
                    if (($conn->query($sql3) === TRUE)) {
                        echo "Enterd Sucess";
                    } else {
                        echo "Error: " . $sql3 . "<br>" . $conn->error;
                    }

                    $conn->close();
                }
                break;
            }
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Maharaj Balwant Singh P.G. College</title>
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="./css/nav.css">
    <style>
        /* .containe2 {
            display: none;
        } */
    </style>
</head>

<body>
    <header>
        <?php
        include '_frontLogo.php';
        include '_nav.php';
        ?>
    </header>
    <div class="container1" style="margin-top: 50px;">
        <form action="<?php $_SERVER['PHP_SELF']; ?>" method="post">
            <input type="hidden" name="form" value="A">
            <input type="text" name="reg_no" placeholder="Username"><br>
            <input type="password" name="d_o_b" placeholder="Password"><br>
            <input type="submit" name="btn1" value="Login">
        </form>
    </div>
    <div class="containe2">
        <form action="<?php $_SERVER['PHP_SELF']; ?>" method="post">
            <input type="hidden" name="form" value="B">
            <input type="text" name="fname" placeholder="Father"><br>
            <input type="text" name="mname" placeholder="Mother"><br>
            <input type="text" name="gen" placeholder="gender"><br>
            <input type="text" name="cot" placeholder="cotegry"><br>
            <input type="text" name="scot" placeholder="sub-cotegry"><br>
            <input type="text" name="nat" placeholder="Nationality"><br>
            <input type="text" name="adhar" placeholder="Adhar"><br>
            <input type="submit" name="btn2" value="Next">
        </form>
    </div>
    <div class="container3">
        <form action="<?php $_SERVER['PHP_SELF']; ?>" method="post">
            <input type="hidden" name="form" value="C">
            <input type="text" name="hno" placeholder="House No."><br>
            <input type="text" name="rno" placeholder="Road No."><br>
            <input type="text" name="landm" placeholder="landmark"><br>
            <input type="text" name="city" placeholder="city"><br>
            <input type="text" name="state" placeholder="state"><br>
            <input type="text" name="pin" placeholder="pin"><br>
            <input type="text" name="fladd" placeholder="full Address"><br>
            <input type="submit" value="Next">
        </form>
    </div>
    <div class="container4">
    <form action="<?php $_SERVER['PHP_SELF']; ?>" method="post">
            <input type="hidden" name="form" value="D">
            <input type="text" name="" placeholder=""><br>
            <input type="text" name="" placeholder=""><br>
            <input type="text" name="" placeholder=""><br>
            <input type="text" name="" placeholder=""><br>
            <input type="text" name="" placeholder=""><br>
            <input type="text" name="" placeholder=""><br>
            <input type="text" name="" placeholder=""><br>
        </form>
    </div>
</body>

</html>