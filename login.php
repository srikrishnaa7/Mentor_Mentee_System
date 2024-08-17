<?php
session_start();

// if(isset($_SESSION['user_id'])) {
//     header("Location: dashboard.php"); // Redirect to dashboard if user is already logged in
//     exit;
// }

if($_SERVER["REQUEST_METHOD"] == "POST") {
    require_once "db_config.php";

    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT id, name, password, department FROM user WHERE user_name = ?";
    if($stmt = $mysqli->prepare($sql)) {
        $stmt->bind_param("s", $param_username);
        $param_username = $username;
        
        if($stmt->execute()) {
            $stmt->store_result();
            
            if($stmt->num_rows == 1) {
                $stmt->bind_result($id, $name, $hashed_password, $department);
                if($stmt->fetch()) {
                    // if(password_verify($password, $hashed_password)) {
                    if($password == $hashed_password) {
                        // session_start(); // Start session here if login is successful
                        $_SESSION["user_id"] = $id;
                        $_SESSION["username"] = $username;   
                        $_SESSION["name"] = $name;
                        $_SESSION["department"] = $department;                             
                        header("location: index.php");
                        exit; // Ensure script execution stops after redirect
                    } else {
                        $login_err = "Invalid username or password.";
                    }
                }
            } else {
                $login_err = "Invalid username or password.";
            }
        } else {
            echo "Oops! Something went wrong. Please try again later.";
        }

        $stmt->close();
    }

    $mysqli->close();
}
?>

<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <h2>Login</h2>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <div>
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>
        </div>
        <div>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
        </div>
        <div>
            <button type="submit">Login</button>
        </div>
        
    </form>
    <div>
            <a href="signup.php"><button>SignUp</button></a>
        </div>
    <?php
    // if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //     if (isset($login_err)) {
    //         echo '<div>' . $login_err . '</div>';
    //     }
    // }
    ?>
</body>
</html> -->


<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="icon" href="SREC_logo.png" type="image/ico">
    <script src="https://rawgit.com/evidenceprime/html-docx-js/master/dist/html-docx.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/mammoth/1.0.1/mammoth.browser.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.3/jspdf.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.6/jspdf.plugin.autotable.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

</head>

<body>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSpd4K-pjmQUKAGuVfJ3ynKc7tySLlVX_7Slw&usqp=CAU"
        alt="SREC_logo.png"
        style="width:150px;height:150px; text-align:center; font-size: 5rem; margin: 18px; float: left; max-width: 100%; max-height: 100%; padding: 1px;">
    <img src="https://srec.ac.in/uploads/resource/src/8yeEAIUofd01022018043456srec-logo.jpg" alt="SNR_trust_logo"
        style="width:150px;height:150px; text-align:center;font-size: 5rem; float: right; margin: 18px; max-width: 100%; max-height: 100%; padding: 1px;">

    <div class="container-fluid" style="background-color:rgb(125, 40, 159)">
        <font color="white" style="font-family:Verdana;font-style:cursive;">
            <h2
                style="text-align: center; padding: 0px ;font-size:50px;background-color:purple;color:transparent;-webkit-text-stroke:1px #fff;background:url(assets/SREC_and_SNR_logo_header_back.png);clip:text;background-position:0 0;animation:back 20s linear infinite;">
                <b>
                    <style>
                        @keyframes back {
                            100% {
                                background-position: 2000px 0;
                            }
                        }
                    </style>
                    <h1 style="font-size:40px" class="flicker">SRI RAMAKRISHNA ENGINEERING COLLEGE</h1>
                    <h4>[Educational Service: SNR Sons Charitable Trust]<br>
                        [Autonomous Institution, Reaccredited by NAAC with ‘A+’ Grade]<br>
                        [Approved by AICTE and Permanently Affiliated to Anna University, Chennai]<br>
                        [ ISO 9001:2015 Certified and all eligible programmes Accredited by NBA]<br>
                        VATTAMALAIPALAYAM, N.G.G.O. COLONY POST, COIMBATORE – 641 022.</h4>
                    <h5>Developed by<br>AI&DS and IQAC</h5>
        </font>
    </div>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <style>
        .login-container {
            max-width: 400px;
            margin: 0 auto;
            margin-top: 50px;
        }
        .login-form {
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 10px;
            background-color: #f9f9f9;
        }
    </style>
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css" rel="stylesheet">
    <link href="style.css" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <style>
        .footer {
            position: relative;
            left: 0;
            bottom: 0;
            width: 100%;
            color: white;
            text-align: center;
        }

        .img1 {
            margin: 4px 4px;
        }

        br body {
            font-family: Verdana;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        br div {
            width: 100%;
            max-width: 1000px;
            background-color: #fff;
            padding: 10px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            box-sizing: border-box;
        }

        h2 {
            color: #333;
            text-align: center;
        }

        button {
            display: block;
            width: 100%;
            padding: 10px;
            background-color: #4caf50;
            color: white;
            border: none;
            cursor: pointer;
            margin-bottom: 10px;
        }

        button:hover {
            background-color: #45a049;
        }

        .input-section {
            margin-top: 10px;
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            box-sizing: border-box;
        }

        .input-section label {
            /* width: calc(32% - 28px); */
            margin-bottom: 5px;
            box-sizing: border-box;
            display: block;
            font-weight: bold;
        }

        .input-section input {
            /* width: calc(32% - 28px); */
            margin-bottom: 15px;
            box-sizing: border-box;
            padding: 10px;
        }

        .input-section input[type="button"] {
            width: 100%;
            padding: 10px;
            align-self: center;
        }

        .display-section {
            margin-top: 20px;
            overflow-x: auto;
        }

        .input-section input {
            width: calc(45% - 28px);
            margin-bottom: 15px;
            box-sizing: border-box;
            padding: 10px;
        }
    </style>


    <div class="container login-container">
        <h3 class="text-center">Mentor Mentee System - Student Track Record(STR)</h3>
        <h3 class="text-center">LOGIN</h3>
        <div class="login-form">
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <div class="form-group">
                    <label for="username">User Name</label>
                    <input type="text" class="form-control" id="username" name="username" required>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>
                <div class="form-group">
                    <?php
                    if ($_SERVER["REQUEST_METHOD"] == "POST") {
                        if (isset($login_err)) {
                            echo '<label for="NameoftheMentor" class="text-danger">' . $login_err . '</label>';
                        }
                    }
                    ?>
                </div>
                <div class="form-group text-center">
                    <button type="submit" class="btn btn-primary">Login</button>
                </div>
            </form>
            <div class="form-group text-center">
                    <a href="signup.php" class="btn btn-success">Sign Up</a>
                </div>
        </div>
    </div>

</body>

</html>