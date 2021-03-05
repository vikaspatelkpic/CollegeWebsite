<?php
if (isset($_POST['form'])) {
    // global $_regNo;
    // echo $_POST['form'];
    switch ($_POST['form']) {
        case "A": {
                $_regNo =   $_POST["reg_no"];
                $_dob =    $_POST["d_o_b"];
                $_udob =   "";
                // echo $_regNo;
                if (!empty($_regNo) && !empty($_dob)) {
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
                    if ($_dob == $_udob) {
                        session_start();
                        $_SESSION['regno'] = $_POST['reg_no'];
                        // echo 'Password Correct';
                        // header("location:index.php");
                    } else {
                        echo 'Password INCorrect';
                        echo '<script>alert("Wrong Id or Password")</script>';
                        // header("location:Reg.php");
                    }
                } else {
                    echo '<script>alert("Please Fill Details")</script>';
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
</head>

<body>
    <header>
        <?php
        include '_frontLogo.php';
        include '_nav.php';
        ?>
    </header>
    <div class="container mt-4">
        <div style="z-index: -1;" class="alert alert-danger mt-4">
            Login Here
        </div>

        <form action="<?php $_SERVER['PHP_SELF']; ?>" method="post">
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Email address</label>
                <input type="hidden" name="form" value="A">
                <input type="text" name="reg_no" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                <div id="emailHelp" class="form-text">We'll never share your details with anyone else.</div>
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Password (Ex. yyyy-dd-mm)</label>
                <input type="password" name="d_o_b" class="form-control" id="exampleInputPassword1">
            </div>
            <button type="submit" class="btn btn-primary mb-3">Submit</button>
        </form>
    </div>
    <div class="container hide">
        <?php
        if (isset($_SESSION)) {
            $_regNo = $_SESSION['regno'];
            $sql5 = "SELECT * FROM regestration where regno = " . $_regNo;
            $result = $conn->query($sql5);
            if ($result->num_rows > 0) {
                // output data of each row
                while ($row = $result->fetch_assoc()) {
                    // echo $row["s_name"] . $row["dob"] . $row["course"] . $row["mob"] . $row["e_mail"] . $row["date"];
                    echo "
                        <div style='z-index: -1;' class='alert alert-danger mt-4'>
                        Your Regestration Details Here
                    </div>
                    <div class='row g-3'>
                    <div class='col-md-4'>
                    <label for='validationCustom01' class='form-label'>Reg No</label>
                    <input type='text' class='form-control' id='validationCustom01' disabled value='" . $_regNo . "'>
                    </div>
                    <div class='col-md-4'>
                    <label for='validationCustom02' class='form-label'>Name</label>
                    <input type='text' class='form-control' id='validationCustom02' disabled value='" . $row["s_name"] . "'>
                    </div>
                    <div class='col-md-4'>
                    <label for='validationCustomUsername' class='form-label'>Date Of Birth</label>
                    <input type='text' class='form-control' id='validationCustomUsername' disabled value='" . $row["dob"] . "'>
                    </div>
                    <div class='col-md-4'>
                    <label for='validationCustom03' class='form-label'>Course</label>
                    <input type='text' class='form-control' id='validationCustom03' disabled value='" . $row["course"] . "'>                    
                    </div>
                    <div class='col-md-4'>
                    <label for='validationCustom03' class='form-label'>Mobile No</label>
                    <input type='text' class='form-control' id='validationCustom03' disabled value='" . $row["mob"] . "'>                    
                    </div>
                    <div class='col-md-4'>
                    <label for='validationCustom03' class='form-label'>Email</label>
                    <input type='text' class='form-control' id='validationCustom03' disabled value='" . $row["e_mail"] . "'>                    
                    </div>
                    <div class='col-md-4'>
                    <label for='validationCustom03' class='form-label'>Time When You Regester</label>
                    <input type='text' class='form-control' id='validationCustom03' disabled value='" .  $row["date"] . "'>                    
                    </div>
                    ";
                }
            }
        }
        ?>
    </div>
    </div>
    <div class="container">
        <form action="#" method="post">
            <div style="z-index: -1;" class="alert alert-danger mt-4">
                Personal Details Here
            </div>
            <div class='row g-3'>
                <div class='col-md-4'>
                    <label for='f_name' class='form-label'>Father Name </label>
                    <input type="hidden" name="form" value="B">
                    <input type='text' class='form-control' id="f_name" name="fname" placeholder="Father">
                </div>
                <div class='col-md-4'>
                    <label for='f_name' class='form-label'>Mother Name</label>
                    <input type='text' class='form-control' id="f_name" name="mname" placeholder="Mother">
                </div>
                <div class='col-md-4'>
                    <label for='gen' class='form-label'>Gender</label>
                    <select class="form-select" name="gen" aria-label="Default select example">
                        <option value="">Open this select menu</option>
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                        <option value="other">Other</option>
                    </select>
                </div>
                <div class='col-md-4'>
                    <label for='cot' class='form-label'>Cotegry</label>
                    <select class="form-select" name="cot" aria-label="Default select example">
                        <option value="">Open this select menu</option>
                        <option value="ganra;">Genral</option>
                        <option value="obc">Obc</option>
                        <option value="sc_st">Sc / St</option>
                        <option value="other">Other</option>
                    </select>
                </div>
                <div class='col-md-4'>
                    <label for='scot' class='form-label'>Sub-Cotegry</label>
                    <select class="form-select" name="scot" aria-label="Default select example">
                        <option value="-1">-- select --</option>
                        <option value="1">अहिर, यादव,ग्वाला,यदुवंशी</option>
                        <option value="2">जाट</option>
                        <option value="3">सोनार, सुनार, स्वर्णकार</option>
                        <option value="कुर्मी, चनऊ, पटेल, पटनवारकुर्मी-मल्ल, कुर्मी-सैथवार">कुर्मी, चनऊ, पटेल, पटनवारकुर्मी-मल्ल, कुर्मी-सैथवार</option>
                        <option value="5">थ्गरी</option>
                        <option value="6">गूजर</option>
                        <option value="7">गोसाई</option>
                        <option value="8">लोध, लोधा, लोधिराजपुत</option>
                        <option value="9">कम्बोज</option>
                        <option value="10">अरख, अर्कवंशीय</option>
                        <option value="11">काछी, काछी-कुशवाहा, शाक्य</option>
                        <option value="12">कहार, कश्यप</option>
                        <option value="13">केवट, मल्लाह, निषाद</option>
                        <option value="14">थ्कसान</option>
                        <option value="15">कोइरी</option>
                        <option value="16">कुम्हार, प्रजापति</option>
                        <option value="17">क्सगर</option>
                        <option value="18">कुजडा या राईन</option>
                        <option value="19">गडेरिया, पाल, बघेल</option>
                        <option value="20">गददी, घोसी</option>
                        <option value="21">चिकवा, कस्साब, कुरैशी, चक</option>
                        <option value="22">छिपी, छिपा</option>
                        <option value="23">जेगी</option>
                        <option value="24">झोजा</option>
                        <option value="25">दफाली</option>
                        <option value="26">तमोली, बरई, चौरसिया</option>
                        <option value="27">तेली, सामानी, रोगनगर, साहू, रौनियार, गन्धी, अर्राक</option>
                        <option value="28">दर्जी, इदरीसी, काकुत्स्त</option>
                        <option value="29">धीवर</option>
                        <option value="30">नक्कल</option>
                        <option value="31">नट( जो अनुसुचितजातियों की श्रेणी में सम्मिलित न हों)</option>
                        <option value="32">नायक</option>
                        <option value="33">फकीर</option>
                        <option value="34">बंजारा, रंकि, मुकेरी, मकेरानी</option>
                        <option value="35">बढ़ई, सैफी, विश्वकर्मा, पंचाल, रमगढ़िया, जांगिड, धीमान</option>
                        <option value="36">बरी</option>
                        <option value="37">बैरागी</option>
                        <option value="38">बिन्द</option>
                        <option value="39">बियार</option>
                        <option value="40">भर, राजभर</option>
                        <option value="41">भुर्जी, भड़भुजा, भूजॅ, कादु, कशोधन</option>
                        <option value="42">भठियारा</option>
                        <option value="43">माली, सैनी</option>
                        <option value="44">स्वीपर ( जो अनुशुचितजातियों की श्रेणी में सम्मिलित न हो ) हलालखोर</option>
                        <option value="45">लोहार, लोहार-सैफी</option>
                        <option value="46">लोनिया, नोनिया, गोले-ठाकुर, लोनियाचौहान</option>
                        <option value="47">रंगरेज, रंगवा</option>
                        <option value="48">मारछा</option>
                        <option value="49">हलवाई, मोदनवाल</option>
                        <option value="50">हज्जाम, नाइ, सलमानी, सविता, श्रीवास</option>
                        <option value="51">राय, सिक्ख</option>
                        <option value="52">सक्का-भिश्ती, भिश्तीअब्बासी</option>
                        <option value="53">धोबी (जो अनुसुचितजातियों या अनुसुचितजातियों की श्रेणी में सम्मिलित न हो )</option>
                        <option value="54">कसेरा , ठठेरा, ताम्रकार</option>
                        <option value="55">नानबाई</option>
                        <option value="56">मीरशिकार</option>
                        <option value="57">शेख, सरवारी (पिराई) पीराही</option>
                        <option value="58">मेव, मेवाती</option>
                        <option value="59">कोष्टा/कोष्टी</option>
                        <option value="60">रोड़</option>
                        <option value="61">खुमरा, संगतराश हंसीरी</option>
                        <option value="62">मेची</option>
                        <option value="63">खागी</option>
                        <option value="64">तंवरसिंघाडिया</option>
                        <option value="65">कतुआ</option>
                        <option value="66">महीगीर</option>
                        <option value="67">छांगी</option>
                        <option value="68">धाकड़</option>
                        <option value="69">गाडा</option>
                        <option value="70">तंतवा</option>
                        <option value="71">जोरिया</option>
                        <option value="72">पटवा, पटहारा, पटेहरा, देववंशी</option>
                        <option value="73">कलाल, कलवार, कलार</option>
                        <option value="74">मनिहार, कचेर, लखेरा</option>
                        <option value="75">मुराव, मुराई, मौर्य</option>
                        <option value="76">मोमिन (अंसार)</option>
                        <option value="77">मुस्लिमकायस्थ</option>
                        <option value="78">मिरासी</option>
                        <option value="79">नददाफ (धुनिया) मंसुरी, कंडेरे, कड़ेरे, करण (कर्ण)</option>
                        <option value="80">नाई</option>
                    </select>
                </div>
                <div class='col-md-4'>
                    <label for='nation_ality' class='form-label'>Nationality</label>
                    <input type='text' class='form-control' id="nation_ality" name="nat" placeholder="Nationality">
                </div>
                <div class='col-md-4'>
                    <label for='nadhar' class='form-label'>Adhar No.</label>
                    <input type='text' class='form-control' id="nadhar" name="adhar" placeholder="Adhar">
                </div>
                <div class='row-md mb-3'>
                    <input type="submit" class="btn btn-primary" name="btn2" value="Next">
                </div>
            </div>
        </form>
    </div>
    <div class="container">
        <div style="z-index: -1;" class="alert alert-danger mt-4">
            Address Details Here
        </div>
            <h4 class="mt-4 mb-4">Current Address</h4>
        <form class="row g-3" action="<?php $_SERVER['PHP_SELF']; ?>" method="post">
            <div class="col-md-4">
                <input type="hidden" name="form" value="C">
                <label for='cityU' class='form-label'>House No</label>
                <input type="text" name="hno" placeholder="House No." class="form-control">
            </div>
            <div class="col-md-4   ">
                <label for='state' class='form-label'>Road No.</label>
                <input type="text" name="rno" placeholder="Road No." class="form-control">
            </div>
            <div class="col-md-4">
                <label for='zip' class='form-label'>Landmark</label>
                <input type="text" name="landm" placeholder="landmark" class="form-control">
            </div>
            <div class="col-md-4">
                <label for='cityU' class='form-label'>City</label>
                <input type="text" name="city" class="form-control" placeholder="City">
            </div>
            <div class="col-md-4   ">
                <label for='state' class='form-label'>State</label>
                <input type="text" name="state" class="form-control" placeholder="State">
            </div>
            <div class="col-md-4">
                <label for='zip' class='form-label'>Zip/Postal Code</label>
                <input type="text" name="pin" class="form-control" placeholder="Zip">
            </div>
            <div class="col">
                <label for='f_add' class='form-label'>Zip/Postal Code</label>
                <textarea name="fladd" id="f_add" class="form-control"  rows="3"></textarea>
            </div>
            <div class="row-md mb-3">
            <input type="submit" class="btn btn-primary" value="Next">
            </div>
        </form>
    </div>
</body>

</html>