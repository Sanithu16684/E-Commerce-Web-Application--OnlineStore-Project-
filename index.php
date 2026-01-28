<?php

include "connection.php";

?>

<!DOCTYPE html>

<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Online Store</title>

    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="style_bg.css">
    <!-- <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet"> -->
    <link rel="stylesheet" href="aos.css">

    <link rel="icon" href="resource/logo.svg" />

</head>

<body class="main-body">

    <style>
        @import url('https://fonts.googleapis.com/css?family=Montserrat:400,800');

        * {
            box-sizing: border-box;
        }

        body {
            
            justify-content: center;
            flex-direction: column;
           
        }

        .container {
            position: relative;
            width: 720px;
            max-width: 100%;
            min-height: 550px;
            background: #fff;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 14px 28px rgba(0, 0, 0, 0.25),
                0 10px 10px rgba(0, 0, 0, 0.22)
        }

        .sign-up,
        .sign-in {
            position: absolute;
            top: 0;
            left: 0;
            height: 100%;
            transition: all 0.6s ease-in-out;
        }

        .sign-up {
            width: 50%;
            opacity: 0;
            z-index: 1
        }

        .sign-in {
            width: 50%;
            z-index: 2;
        }

        form {
            background: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            padding: 0 50px;
            height: 100%;
            text-align: center;
        }

        h1 {
            font-weight: bold;
            margin: 0;
            margin-top: 10px;
        }

        p {
            font-size: 14px;
            font-weight: 100;
            line-height: 20px;
            letter-spacing: 0.5px;
            margin: 15px 0 20px;
        }

        .input {
            background: #eee;
            padding: 5px 10px;
            margin: 5px 10px;
            width: 100%;
            border-radius: 5px;
            border: none;
            outline: none;
        }

        a {
            color: #333;
            font-size: 14px;
            text-decoration: none;
            margin: 15px 0;
        }

        .gender {
            width: 100%;
            background: #eee;
            outline: none;
            border: none;
            color: #757575;
            margin-top: 5px;
        }

        button {
            color: #fff;
            background: #3700ff;
            font-size: 12px;
            font-weight: bold;
            padding: 12px 55px;
            margin: 20px;
            border-radius: 20px;
            border: 1px solid #33376e;
            outline: none;
            letter-spacing: 1px;
            text-transform: uppercase;
            transition: transform 80ms ease-in;
            cursor: pointer;
        }

        button:active {
            transform: scale(0.90);
        }

        #signIn,
        #signUp {
            background-color: transparent;
            border: 2px solid #fff;
        }

        .container.right-panel-active .sign-in {
            transform: translateX(100%);
        }

        .container.right-panel-active .sign-up {
            transform: translateX(100%);
            opacity: 1;
            z-index: 5;
            animation: show 0.6s;
        }

        @keyframes show {

            0%,
            49.99% {
                opacity: 0;
                z-index: 1;
            }

            50%,
            100% {
                opacity: 1;
                z-index: 5;
            }
        }

        .overlay-container {
            position: absolute;
            top: 0;
            left: 50%;
            width: 50%;
            height: 100%;
            overflow: hidden;
            transition: transform 0.6s ease-in-out;
            z-index: 100;
        }

        .container.right-panel-active .overlay-container {
            transform: translateX(-100%);
        }

        .overlay {
            position: relative;
            color: #fff;
            background: #ff416c;
            left: -100%;
            height: 100%;
            width: 200%;
            background: linear-gradient(to right, #020c6b, #2294ff);
            transform: translateX(0);
            transition: transform 0.6s ease-in-out;
        }

        .container.right-panel-active .overlay {
            transform: translateX(50%);
        }

        .overlay-left,
        .overlay-right {
            position: absolute;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            padding: 0 40px;
            text-align: center;
            top: 0;
            height: 100%;
            width: 50%;
            transform: translateX(0);
            transition: transform 0.6s ease-in-out;
        }

        .overlay-left {
            transform: translateX(-20%);
        }

        .overlay-right {
            right: 0;
            transform: translateX(0);
        }

        .container.right-panel-active .overlay-left {
            transform: translateX(0);
        }

        .container.right-panel-active .overlay-right {
            transform: translateX(20%);
        }

        .social-container {
            margin: 20px 0;
        }

        .social-container a {
            height: 40px;
            width: 40px;
            margin: 0 5px;
            display: inline-flex;
            justify-content: center;
            align-items: center;
            border: 1px solid #ccc;
            border-radius: 50%;
        }

        .remember {
            margin-left: -10px;
        }

        h6 {
            color: chartreuse;
            cursor: pointer;
        }
    </style>

    <div class="container-fluid vh-100 d-flex justify-content-center wrapper">
        <div class="box">
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
        </div>
        <div class="row align-content-center">

            <!-- header -->

            <div class="col-12">
                <div class="row">
                    <div class="col-12 logo" data-aos="zoom-in-up"></div>
                    <!-- <div class="col-12"> -->
                        <p data-aos="flip-right" data-aos-duration="2000" class="text-center text-white title01">Hi, Welcome to Online Shop</p>
                    <!-- </div> -->
                </div>
            </div>

            <!-- header -->

            <!-- content -->

            <div class="col-12 p-3">
                <div class="row">



                    <div class="container" id="main">
                        <div class="sign-up">
                            <form action="#">
                                <h1>Create Account</h1>
                                
                                <div class="col-12 d-none" id="msgdiv">
                                    <div class="alert alert-danger" role="alert" id="msg">

                                    </div>
                                </div>
                                <input class="input" type="text" placeholder="First Name" id="fname">
                                <input class="input" type="text" placeholder="Last Name" id="lname">
                                <input class="input" type="email" placeholder="Email" id="email">
                                <input class="input" type="password" placeholder="Password" id="password">
                                <input class="input" type="text" placeholder="ex:- 0771234568" id="mobile" />
                                <select class="form-control gender" id="gender">
                                    <option value="0">Gender</option>
                                    <?php

                                    $rs = Database::search("SELECT * FROM `gender`");
                                    $num = $rs->num_rows;

                                    for ($x = 0; $x < $num; $x++) {
                                        $data = $rs->fetch_assoc();
                                    ?>

                                        <option value="<?php echo $data["gender_id"]; ?>">
                                            <?php echo $data["gender_name"]; ?>
                                        </option>

                                    <?php
                                    }

                                    ?>
                                </select>

                                <button onclick="signup();">Sign Up</button>
                            </form>
                        </div>
                        <div class="sign-in">
                            <form action="#">
                                <h1>Sign in</h1>
                                

                                <div class="col-12 d-none" id="msgdiv1">
                                    <div class="alert alert-danger" role="alert" id="msg1">

                                    </div>
                                </div>

                                <?php
                                $email = "";
                                $password = "";

                                if (isset($_COOKIE["email"])) {
                                    $email = $_COOKIE["email"];
                                }

                                if (isset($_COOKIE["password"])) {
                                    $password = $_COOKIE["password"];
                                }
                                ?>

                                <input class="input" type="email" placeholder="Email" id="email2" value="<?php echo $email; ?>" />
                                <input class="input" type="password" placeholder="Password" id="password2" value="<?php echo $password; ?>" />
                                <div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="rememberme" />
                                        <label class="form-check-label">Remember Me</label>
                                    </div>
                                </div>
                                <a onclick="forgotPassword();" style="cursor: pointer !important;">Forget your Password?</a>
                                <button onclick="signin();">Sign In</button>
                            </form>
                        </div>
                        <div class="overlay-container">
                            <div class="overlay">
                                <div class="overlay-left">
                                    <h1>Welcome Back!</h1>
                                    <p>To keep connected with us please login with your personal info</p>
                                    <button id="signIn">Sign In</button>
                                </div>
                                <div class="overlay-right">
                                    <h1>Hello, Friend</h1>
                                    <p>Enter your personal details and start journey with us</p>
                                    <button id="signUp">Sign Up</button>

                                    <h6 onclick="window.location='adminSignin.php';">Are You an Admin click Me....</h6>
                                </div>
                            </div>
                        </div>
                    </div>




                    

                </div>

                <!-- content -->

                <!-- modal -->
                <div class="modal" tabindex="-1" id="fpmodal">
                    <div class="modal-dialog">
                        <div class="modal-content ">
                            <div class="modal-header">
                                <h5 class="modal-title" >Forgot Password</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">

                                <div class="row">

                                    <div class="col-6">
                                        <label class="form-label">New Password</label>
                                        <div class="input-group mb-3">
                                            <input style="height: 35px;" type="password" class="form-control" id="np" aria-label="Recipient's username" aria-describedby="button-addon2">
                                            <button class="btn btn-outline-secondary mt-0" type="button" id="button-addon2" onclick="showPassword1();">Show</button>
                                        </div>
                                       
                                    </div>

                                    <div class=" col-6">
                                        <label class="form-label">Re-type Password</label>
                                        <div class="input-group mb-3">
                                            <input style="height: 35px;" type="password" id="rnp" class="form-control" id="np" aria-label="Recipient's username" aria-describedby="button-addon2">
                                            <button class="btn btn-outline-secondary mt-0" type="button" id="button-addon2" onclick="showPassword2();">Show</button>
                                        </div>
                                     
                                    </div>

                                    <div class="col-12">
                                        <label class="form-label w-100">Verification Code</label>
                                        <input type="text" class="form-control" id="vcode" />
                                    </div>

                                </div>

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary" onclick="resetPassword();">Reset</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- modal -->

                <!-- footer -->
                <div class="col-12 fixed-bottom d-none d-lg-block">
                    <p class="text-center" style="color:white;">&copy; 2024 onlinestore.lk || All Rights Reserved</p>
                </div>
                <!-- footer -->

            </div>

        </div>


        <!-- <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script> -->

        <script type="text/javascript">
            const signUpButton = document.getElementById('signUp');
            const signInButton = document.getElementById('signIn');
            const main = document.getElementById('main');

            signUpButton.addEventListener('click', () => {
                main.classList.add("right-panel-active");
            });
            signInButton.addEventListener('click', () => {
                main.classList.remove("right-panel-active");
            });
        </script>

        <script src="script.js"></script>
        <script src="bootstrap.js"></script>
        <script src="aos.js"></script>
        <script>
            AOS.init();
        </script>

</body>

</html>