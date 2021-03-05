<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- jquery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.17.0/dist/jquery.validate.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/js/bootstrap-datepicker.min.js"></script>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu&display=swap" rel="stylesheet">
    <!-- Custom Css -->
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="./css/nav.css">

    <title>Hello, world!</title>
</head>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $_name =    $_POST["s_name"];
    $_course =    $_POST["course"];
    $_mobile =    $_POST["mobile"];
    $_email =    $_POST["e_mail"];
    $_dob =    $_POST["dateofbirth"];
    $_regno = '';
    if (!empty($_name) && !empty($_course) && !empty($_mobile) && !empty($_email) && !empty($_dob)) {
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
            $_regno = $_regno . $yera . "001";
        }
        $sql2 = "INSERT INTO regestration (s_name,dob,course,mob,e_mail,regno) VALUES ('$_name','$_dob','$_course','$_mobile','$_email','$_regno')";
        if (($conn->query($sql2) === TRUE)) {
            session_start();
            $_SESSION['reg_no'] = $_regno;
            $_SESSION['dob'] = $_dob;
            header("location:regnopwd.php");
        } else {
            echo "Error: " . $sql2 . "<br>" . $conn->error;
        }
        $conn->close();
    } else {
        echo "<div class='alert alert-warning alert-dismissible fade show' role='alert'>
        <strong>Holy guacamole!</strong> You should check in on some of those fields below.
        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
      </div>";
    }
}
?>

<body>
    <header>
        <?php
        include '_frontLogo.php';
        include '_nav.php';
        ?>
    </header>
    <div class="container">
        <div style="z-index: -1;" class="alert alert-danger mt-4">
            Regestration Here
        </div>
        <form id="editEventForm" action="<?php $_PHP_SELF ?>" method="POST">

            <div class="mb-3 mt-4">
                <label for="fullName" class="form-label">Name <font style="color: red;">*</font></label>
                <input type="text" class="form-control" name="s_name" id="fullName" placeholder="Name">
            </div>
            <div class="mb-3 mt-4">
                <label for="CourseSelect" class="form-label">Course <font style="color: red;">*</font></label>
                <select class="form-select" id="CourseSelect" name="course" aria-label="Default select example">
                    <option value="" selected>Open this select menu</option>
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
                </select>
            </div>
            <div class="mb-3">
                <label for="numberInput" class="form-label">Mobile Number <font style="color: red;">*</font></label>
                <input type="text" class="form-control" name="mobile" id="numberInput" placeholder="9114526879">
            </div>
            <div class="mb-3">
                <label for="emailinput" class="form-label">Email address <font style="color: red;">*</font></label>
                <input type="email" class="form-control" name="e_mail" id="emailinput" placeholder="name@example.com">
            </div>
            <div class="mb-3">
                <label for="dateofbirthinput" class="form-label">Date of Birth <font style="color: red;">*</font></label>
                <input type="date" class="form-control" name="dateofbirth" id="dateofbirthinput" placeholder="name@example.com">
            </div>
            <div class="text-center mt-4 mb-3">
                <input type="submit" class="btn btn-primary" value="submit">
            </div>
        </form>
    </div>
</body>
<script>
    $(function() {
        $("#editEventForm").validate({
            rules: {
                s_name: {
                    required: true,
                },
                course: {
                    required: true,
                },
                dateofbirth: {
                    required: true,
                },
                mobile: {
                    required: true,
                },
                e_mail: {
                    required: true,
                },
            },
            messages: {
                s_name: "Please enter your full name!",
                event_date: "Please enter valid date!",
            },
            onfocusout: function(element) {
                $(element).valid();
                $('.error').css({
                    "color": "red"
                });
            },
        });

    });
</script>

</html>