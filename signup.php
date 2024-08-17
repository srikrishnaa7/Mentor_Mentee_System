<?php
session_start();
 
if(isset($_SESSION["user_id"]) && $_SESSION["user_id"] === true){
    header("location: dashboard.php");
    exit;
}

require_once "db_config.php";

$name = $username = $password = $confirm_password = $department = "";
$name_err = $username_err = $password_err = $confirm_password_err = $department_err = "";

$registration_success = false;

if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    if(empty(trim($_POST["name"]))){
        $name_err = "Please enter your name.";
    } else{
        $name = trim($_POST["name"]);
    }

    if(empty(trim($_POST["department"]))){
        $department_err = "Please Select Department name.";
    } else{
        $department = trim($_POST["department"]);
    }
    
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter a username.";
    } else{
        $sql = "SELECT id FROM user WHERE user_name = ?";
        
        if($stmt = $mysqli->prepare($sql)){
            $stmt->bind_param("s", $param_username);
            
            $param_username = trim($_POST["username"]);
            
            if($stmt->execute()){
                $stmt->store_result();
                
                if($stmt->num_rows == 1){
                    $username_err = "This username is already taken.";
                } else{
                    $username = trim($_POST["username"]);
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            $stmt->close();
        }
    }
    
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter a password.";     
    } elseif(strlen(trim($_POST["password"])) < 6){
        $password_err = "Password must have at least 6 characters.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Please confirm password.";     
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($password_err) && ($password != $confirm_password)){
            $confirm_password_err = "Password did not match.";
        }
    }
    
    if(empty($name_err) && empty($username_err) && empty($password_err) && empty($confirm_password_err) && empty($department_err)){
        
        $sql = "INSERT INTO user (name, user_name, password, department) VALUES (?, ?, ?, ?)";
         
        if($stmt = $mysqli->prepare($sql)){
            $stmt->bind_param("ssss", $param_name, $param_username, $param_password, $param_department);

            
            $param_name = $name;
            $param_username = $username;
            // $param_password = password_hash($password, PASSWORD_DEFAULT); 
            $param_password = $password; 
            $param_department = $department;
            
            // if($stmt->execute()){
            //     header("location: login.php");
            // } else{
            //     echo "Something went wrong. Please try again later.";
            // }

            if($stmt->execute()){
                $registration_success = true;
            } else{
                echo "Something went wrong. Please try again later.";
            }

            $stmt->close();
        }
    }
    
    $mysqli->close();
}
?>

<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
</head>
<body>
    <h2>Sign Up</h2>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <div>
            <label>Name</label>
            <input type="text" name="name" value="<?php echo $name; ?>">
            <span><?php echo $name_err; ?></span>
        </div>    
        <div>
            <label>Username</label>
            <input type="text" name="username" value="<?php echo $username; ?>">
            <span><?php echo $username_err; ?></span>
        </div>
        <div>
            <label>Password</label>
            <input type="password" name="password" value="<?php echo $password; ?>">
            <span><?php echo $password_err; ?></span>
        </div>
        <div>
            <label>Confirm Password</label>
            <input type="password" name="confirm_password" value="<?php echo $confirm_password; ?>">
            <span><?php echo $confirm_password_err; ?></span>
        </div>
        <div>
            <input type="submit" value="Sign Up">
        </div>
        <p>Already have an account? <a href="login.php">Login here</a>.</p>
    </form>
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
        <h3 class="text-center">Sign Up</h3>
        <div class="login-form">
            <?php if ($registration_success): ?>
            <div class="alert alert-success" role="alert">
                Registration successful! You can now.,
            </div>
            <?php else: ?>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" id="name" name="name" value="<?php echo $name; ?>" required>
                </div>  
                <div class="form-group">
                        <?php
                        if ($_SERVER["REQUEST_METHOD"] == "POST") {
                            if (isset($name_err)) {
                                echo '<label for="name" class="text-danger">' . $name_err . '</label>';
                            }
                        }
                        ?>
                </div>  
                <div class="form-group">
                    <label for="department">Department</label>
                    <select class="form-control" id="department" name="department" required>
                        <option value="" disabled selected hidden>Select</option>
                        <option value="Department of Artificial Intelligence and Data Science" <?php if($department == 'Department of Artificial Intelligence and Data Science') echo 'selected'; ?>>Department of Artificial Intelligence and Data Science</option>
                        <option value="Department of Aeronautical Engineering" <?php if($department == 'Department of Aeronautical Engineering') echo 'selected'; ?>>Department of Aeronautical Engineering</option>
                        <option value="Department of Biomedical Engineering" <?php if($department == 'Department of Biomedical Engineering') echo 'selected'; ?>>Department of Biomedical Engineering</option>
                        <option value="Department of Computer Science Engineering" <?php if($department == 'Department of Computer Science Engineering') echo 'selected'; ?>>Department of Computer Science Engineering</option>
                        <option value="Department of Civil Engineering" <?php if($department == 'Department of Civil Engineering') echo 'selected'; ?>>Department of Civil Engineering</option>
                        <option value="Department of Electrical & Communication Engineering" <?php if($department == 'Department of Electrical & Communication Engineering') echo 'selected'; ?>>Department of Electrical & Communication Engineering</option>
                        <option value="Department of Electrical & Electronics Engineering" <?php if($department == 'Department of Electrical & Electronics Engineering') echo 'selected'; ?>>Department of Electrical & Electronics Engineering</option>
                        <option value="Department of Electrical & Instrumentation Engineering" <?php if($department == 'Department of Electrical & Instrumentation Engineering') echo 'selected'; ?>>Department of Electrical & Instrumentation Engineering</option>
                        <option value="Department of Information Technology" <?php if($department == 'Department of Information Technology') echo 'selected'; ?>>Department of Information Technology</option>
                        <option value="Department of Mechanical Engineering" <?php if($department == 'Department of Mechanical Engineering') echo 'selected'; ?>>Department of Mechanical Engineering</option>
                        <option value="Department of Robotics & Automation" <?php if($department == 'Department of Robotics & Automation') echo 'selected'; ?>>Department of Robotics & Automation</option>
                        <option value="Department of Nano Science and Technology" <?php if($department == 'Department of Nano Science and Technology') echo 'selected'; ?>>Department of Nano Science and Technology</option>
                        <option value="Program-M.Tech Computer Science Engineering" <?php if($department == 'Program-M.Tech Computer Science Engineering') echo 'selected'; ?>>Program-M.Tech Computer Science Engineering</option>
                        <option value="Master of Business Administration (MBA)" <?php if($department == 'Master of Business Administration (MBA)') echo 'selected'; ?>>Master of Business Administration (MBA)</option>
                    </select>
                </div>
                <div class="form-group">
                        <?php
                        if ($_SERVER["REQUEST_METHOD"] == "POST") {
                            if (isset($department_err)) {
                                echo '<label for="department" class="text-danger">' . $department_err . '</label>';
                            }
                        }
                        ?>
                </div> 
                <div class="form-group">
                    <label for="username">User Name</label>
                    <input type="text" class="form-control" id="username" name="username" value="<?php echo $username; ?>" required>
                </div>
                <div class="form-group">
                        <?php
                        if ($_SERVER["REQUEST_METHOD"] == "POST") {
                            if (isset($username_err)) {
                                echo '<label for="username" class="text-danger">' . $username_err . '</label>';
                            }
                        }
                        ?>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" id="password" name="password" value="<?php echo $password; ?>" required>
                </div>
                <div class="form-group">
                        <?php
                        if ($_SERVER["REQUEST_METHOD"] == "POST") {
                            if (isset($password_err)) {
                                echo '<label for="password" class="text-danger">' . $password_err . '</label>';
                            }
                        }
                        ?>
                </div>
                <div class="form-group">
                    <label for="password">Confirm Password</label>
                    <input type="password" class="form-control" id="confirm_password" name="confirm_password" value="<?php echo $confirm_password; ?>" required>
                </div>
                <div class="form-group">
                        <?php
                        if ($_SERVER["REQUEST_METHOD"] == "POST") {
                            if (isset($confirm_password_err)) {
                                echo '<label for="confirm_password" class="text-danger">' . $confirm_password_err . '</label>';
                            }
                        }
                        ?>
                </div>
                <div class="form-group text-center">
                    <button type="submit" class="btn btn-success">Sign Up</button>
                </div>
            </form>
            <?php endif; ?>
            <div class="form-group text-center">
                    <a href="login.php" class="btn btn-primary">Login</a>
                </div>
        </div>
    </div>

</body>

</html>