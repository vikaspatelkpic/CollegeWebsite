<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu&display=swap" rel="stylesheet">
    <!-- Custom Css -->
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="./css/nav.css">
    <title>Hello, world!</title>

</head>

<body onload="noBack();" onpageshow="if (event.persisted) noBack();" onunload="">
    <header>
        <?php
        include '_frontLogo.php';
        include '_nav.php';
        ?>
    </header>
    <div class="container mt-4 text-center">
        <div class="mb-3 row">
            <label for="staticEmail" class="col-sm-2 col-form-label">Reg No</label>
            <div class="col-sm-10">
                <label class="form-control col-form-label border-0"><?php session_start();
                                                                    echo $_SESSION['reg_no']; ?></label>
            </div>
        </div>
        <div class="mb-3 row">
            <label for="inputPassword" class="col-sm-2 col-form-label">Password</label>
            <div class="col-sm-10">
                <label class="form-control col-form-label border-0"><?php
                                                                    echo $_SESSION['dob'];
                                                                    session_abort();
                                                                    ?></label>
            </div>
        </div>
        <button type="button" onclick="window.print();" class="btn btn-primary">Print</button>
    </div>
</body>
</html>