<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Admin SignIn | Online Store</title>

    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="adminstyle.css">
    <link rel="stylesheet" type="text/css" href="style.css">

    <link rel="icon" href="resource/logo.svg" />
</head>

<body class="body">

    <div class="container-fluid justify-content-center" style="margin-top: 100px;">
        <div class="row align-content-center">

            <div class="col-12">
                <div class="row">

                    <div class="col-12 logo"></div>
                    <div class="col-12">
                        <p class="text-center title01">Hi, Welcome To Online Store Admins</p>
                    </div>

                </div>
            </div>

            <div class="col-12 abox p-5">
                <div class="row justify-content-center  ">
                    

                    <div class="col-12 col-lg-4 form d-block">
                        <div class="row g-2">
                            <div class="col-12">
                                <p class=" text-center title02">Sign In To Your Account.</p>
                            </div>
                            <div class="col-12">
                                <label class="form-label d-flex fs-5">Email</label>
                                <input type="email" class="form-control" placeholder="ex : john@gmail.com" id="e" />
                            </div>
                            <div class="col-12 col-lg-6 d-grid">
                                <button class="btn" style="background-color: #48cfad;" onclick="adminVerification();">Send Verification Code</button>
                            </div>
                            <div class="col-12 col-lg-6 d-grid">
                                <button class="btn" style="background-color: #fc6e51;" onclick="window.location='index.php';">Back to Customer Log In</button>
                            </div>
                        </div>
                        <div class="drops">
                            <div class="drop drop-1"></div>
                            <div class="drop drop-2"></div>
                            <div class="drop drop-3"></div>
                            <div class="drop drop-4"></div>
                            <div class="drop drop-5"></div>
                            <div class="drop drop-6"></div>
                            <div class="drop drop-7"></div>
                            <div class="drop drop-8"></div>
                        </div>
                    </div>
                </div>


            </div>

            <!-- model -->

            <div class="modal" tabindex="-1" id="verificationModal">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Admin Verification</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <label class="form-label">Enter Your Verification Code</label>
                            <input type="text" class="form-control" id="vcode">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary" onclick="verify();">Verify</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- model -->

            <div class="col-12 fixed-bottom text-center">
                <p>&copy; 2024 onlinestore.lk | All Rights Reserved</p>
            </div>

        </div>
    </div>

    <script src="bootstrap.bundle.js"></script>
    <script src="script.js"></script>
</body>

</html>