


<!DOCTYPE html>
    <html>

    <head>
        <title> OTP Verification </title>
    </head>
    <link rel="shortcut icon" type="image/png" href="assets/img/P.png.png">
    <link rel="stylesheet" type="text/css" href="assets/css/customerlogin.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="assets/w3css/w3.css">
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,700,400italic,700italic" rel="stylesheet" type="text/css">
    <link href="http://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">

    <body background="assets/img/blank.png">
                 <!-- Navigation -->
    <nav class="navbar navbar-custom navbar-fixed-top" role="navigation" style="color: black">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-main-collapse">
                    <i class="fa fa-bars"></i>
                    </button>
                <a class="navbar-brand page-scroll" href="index.php">
                   Car Charter </a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->

            <?php
                if(isset($_SESSION['login_client'])){
            ?>
                <div class="collapse navbar-collapse navbar-right navbar-main-collapse">
                    <ul class="nav navbar-nav">
                        <li>
                            <a href="index.php">Home</a>
                        </li>
                        <li>
                            <a href="#"><span class="glyphicon glyphicon-user"></span> Welcome <?php echo $_SESSION['login_client']; ?></a>
                        </li>
                        <li>
                            <ul class="nav navbar-nav navbar-right">
                                <li><a href="#" class="dropdown-toggle active" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-user"></span> Control Panel <span class="caret"></span> </a>
                                    <ul class="dropdown-menu">
                                        <li> <a href="entercar.php">Add Car</a></li>
                                        <li> <a href="enterdriver.php"> Add Driver</a></li>
                                        <li> <a href="clientview.php">View</a></li>

                                    </ul>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a>
                        </li>
                    </ul>
                </div>

                <?php
                }
                else if (isset($_SESSION['login_customer'])){
            ?>
                    <div class="collapse navbar-collapse navbar-right navbar-main-collapse">
                        <ul class="nav navbar-nav">
                            <li>
                                <a href="index.php">Home</a>
                            </li>
                            <li>
                                <a href="#"><span class="glyphicon glyphicon-user"></span> Welcome <?php echo $_SESSION['login_customer']; ?></a>
                            </li>
                            <li>
                                <a href="#">History</a>
                            </li>
                            <li>
                                <a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a>
                            </li>
                        </ul>
                    </div>

                    <?php
            }
                else {
            ?>

                        <div class="collapse navbar-collapse navbar-right navbar-main-collapse">
                            <ul class="nav navbar-nav">
                                <li>
                                    <a href="index.php">Home</a>
                                </li>
                                <li>
                                    <a href="clientlogin.php">Employee</a>
                                </li>
                                <li>
                                    <a href="otp.php">Customer</a>
                                </li>
                                <li>
                                    <a href="faq/index.php"> FAQ </a>
                                </li>
                            </ul>
                        </div>
                        <?php   }
                ?>
                        <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>

        <div class="container">
            <div class="jumbotron">
            <h1 class="text-center">OTP Verification </span>
                </h1>
                <br>
                <p class="text-center">Please Verify to continue.</p>
            </div>
        </div>

        

        <div class="container" style="margin-top: -2%; margin-bottom: 2%;">
            <div class="col-md-5 col-md-offset-4">
                <label style="margin-left: 5px;color: red;"><span> <?php ?> </span></label>
                <div class="panel panel-primary">
                    <div class="panel-heading"> CarCharter <?php
			if(isset($_POST['sendopt'])) {

                $otp = mt_rand(10000, 99999);
                $numbers =$_POST['mobile'];
                if(preg_match('/^[0-9]{10}+$/', $numbers)) {
                    setcookie('otp', $otp);
                                $fields = array(
                                    "sender_id" => "TXTIND",
                                    "message" => $otp,
                                    "route" => "v3",
                                    "numbers" => $numbers,
                                );

                                $curl = curl_init();

                                curl_setopt_array($curl, array(
                                CURLOPT_URL => "https://www.fast2sms.com/dev/bulkV2",
                                CURLOPT_RETURNTRANSFER => true,
                                CURLOPT_ENCODING => "",
                                CURLOPT_MAXREDIRS => 10,
                                CURLOPT_TIMEOUT => 30,
                                CURLOPT_SSL_VERIFYHOST => 0,
                                CURLOPT_SSL_VERIFYPEER => 0,
                                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                                CURLOPT_CUSTOMREQUEST => "POST",
                                CURLOPT_POSTFIELDS => json_encode($fields),
                                CURLOPT_HTTPHEADER => array(
                                    "authorization: vhj7k6zW350m1MdRYBEocQlTsZC2eDFVHUaANtL8SIKbniqPXy8WYI6wNu2T0H7xeEPvKoSsd1yCOF9m",
                                    "accept: */*",
                                    "cache-control: no-cache",
                                    "content-type: application/json"
                                ),
                                ));
                                $response = curl_exec($curl);
                                $err = curl_error($curl);

                                curl_close($curl);
                                echo " - OTP sent successfully";
                    } 
                    else {
                        echo " - Invalid Phone Number";
                    }
                 
			}

			if(isset($_POST['verifyotp'])) { 
				$otp = $_POST['otp'];
				if($_COOKIE['otp'] == $otp) {
					echo " - Congratulation, Your mobile is verified.";
                    sleep(2);
                    header("location: customerlogin.php");
				} else {
					echo " - Please enter correct otp.";
				}
			}
	?> </div>
                    <div class="panel-body">

                    <form role="form" method="post" enctype="multipart/form-data">

                            <div class="row">
                                <div class="form-group col-xs-12">
                                    <label for="mobile"><span class="text-danger" style="margin-right: 5px;">*</span> Mobile Number: </label>
                                    <div class="input-group">
                                        <input class="form-control" id="mobile" type="text" name="mobile" placeholder="Enter Valid Number" maxlength="10" required="" autofocus="">
                                        
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-xs-4">
                                <button type="submit" name="sendopt" class="btn btn-primary">Send OTP</button>
                                </div>
                            </div>
                        </form>
                    <form method="POST" action="">
                            <div class="row">
                                <div class="form-group col-xs-12">
                                    <label for="opt"><span class="text-danger" style="margin-right: 5px;">*</span> OTP: </label>
                                    <div class="input-group">
                                        <input class="form-control" id="otp" type="otp" name="otp" maxlength="5" placeholder="5-digit OTP" required="">
                                        
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-xs-4">
                                    <button class="btn btn-primary" name="verifyotp" type="submit" value=" Verify ">Verify</button>

                                </div>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </body>
    <footer class="site-footer">
        <div class="container">
            <hr>
            <div class="row">
                <div class="col-sm-6">
                    <h5>© <?php echo date("Y"); ?> Car Rentals</h5>
                </div>
            </div>
        </div>
    </footer>

    </html>