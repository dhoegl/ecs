<?php 
    //Version 20210402 - Enable session variable: password_reset
    session_start();
    require_once 'dbconnect.php';
    // One-Time Session variable set - used for event_logs_update check at recover_submit.php
    $_SESSION['password_reset'] = TRUE;
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN""http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel='icon' href='/_tenant/images/favicon.ico' type='image/x-icon' >
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Recover Password</title>

    <!-- Bootstrap 4 BETA CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">    
    
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <link href="css/ie10-viewport-bug-workaround.css" rel="stylesheet">

    <!-- Custom styles for this template -->
<!--    <link href="css/signin.css" rel="stylesheet">-->
    <!-- Custom styles for this template -->
    <!-- <link href="css/jumbotron.css" rel="stylesheet"> -->
    <!-- Extended styles for this page -->
    <!-- <link href="css/css_style.css" rel="stylesheet"> -->

<!-- Font Awesome -->
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
<!-- Bootstrap core CSS -->
    <link href="css/bootstrap453/bootstrap.min.css" rel="stylesheet">
<!-- Material Design Bootstrap -->
    <link href="css/MDBootstrap4191/mdb.min.css" rel="stylesheet">
<!-- Your custom styles (optional) -->
    <link href="css/MDBootstrap4191/style.css" rel="stylesheet">

<link href="css/css_style.css" rel="stylesheet">
    <!-- Tenant-specific stylesheet -->
<link href="_tenant/css/tenant.css" rel="stylesheet">

<!-- Initialize jquery js script -->
    <script type="text/javascript" language="javascript" src="//code.jquery.com/jquery-1.12.4.js"></script>

<!-- jQuery (necessary for Bootstrap's (BOOTSTRAP 4 BETA) JavaScript plugins) -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>
    
<!-- Registration submission check script -->
<!--<script type="text/javascript" src="js/ofc_register_submit_check.js"></script>-->

</head>

<body>
<?php
    $firstname = "";
    $lastname = "";
    $gender = "";
    $emailaddr = "";
    $repeatemailaddr = "";
    $username = "";
    $password = "";
    $repeatpassword = "";
    require_once('includes/footer.php');

?>
<!-- <nav class="navbar navbar-expand-lg fixed-top navbar-dark orange darken-4">
    <a class="navbar-brand" href="welcome.php">
        <img id="nav_logo" width="30" height="30" class="d-inline-block align-top" alt="Logo" />
        <span id="navbar_brand"></span> -->

<!-- <nav class="navbar navbar-dark orange darken-4 fixed-top"> -->
<nav class="navbar navbar-expand-lg fixed-top" id="headercolor">
<a class="navbar-brand" href="welcome.php">
        <img id="nav_logo" width="30" height="30" class="d-inline-block align-top" alt="Logo" />
        <span id="navbar_brand"></span>
    </a>
</nav>
<div class="container-fluid profile_bg">
    <div class="row">
        <p>
            <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                Click here for password reset details
            </button>
        </p>
    </div> <!-- row -->
    <div class="collapse" id="collapseExample">
        <div class="row">
            <div class="col-sm-12">
                    <div class="card card-body">
                        <h4 class="card-title">Password Reset</h4>
                        <ul class="card-text">
                            <li>In the box below, enter your username, and click the 'Reset Password' button. An email will be sent to the address associated with your username and a link to reset your password.</li>
                            <li>Check your mailbox for the email requesting you to reset your password (don't forget to check your Junk or Spam folder).</li>
                            <li>Click on the hyperlink in the email and enter a new password at the Password Reset page.</li>
                            <li>If you don't receive an email notification within a few minutes, please contact one of your administrators for assistance.</li>
                            <br />
                            <li><strong>NOTE: </strong>Password must be at least 7 characters, contain one uppercase letter, one lowercase letter, and one number (0-9) or one special character.</li>
                        </ul>
                    </div>
            </div> <!-- col-sm-6 -->
        </div> <!-- row -->
        <br>
    </div> <!-- collapse --> 
    <div class="row">
        <div class="col-sm-6">
            <div class="card bg-light border-primary p-3">
                <h3 class="text-center">Please enter your username below</h3>
                <form name='passwordreset' id="reset" action='services/recover_submit.php' method="POST">
                    <div class="form-group">
                        <label for="emailaddress">
                            Enter your username:
                            <strong>
                                <font color="red">*</font>
                            </strong>
                            <span id="username_unconfirmed"></span>
                            <span id="username_confirmed"></span>
                            <!--<span id="unique_user"></span>-->
                        </label>
                        <input type="text" class="form-control" name="username" id="usernameID" aria-describedby="username" placeholder="Username" />
                    </div>
                    <div class="form-group">
                        <input type="submit" class="btn btn-secondary" name="clear" value="Clear" />
                        <input type="submit" class="btn btn-primary" name="password_reset" id="reset_username_submit" value="Reset Password" />
                    </div>
                </form>
            </div> <!--card-->
        </div> <!--col-sm-6-->
        <div class="col-sm-6">
            <div class="card bg-light border-primary text-center p-3">
                <div class="card-body">
                    <h3 class="card-title">What happens next</h3>
                    <p>After entering your username, you will receive a notification in the email mailbox of the address associated with your username.</p>
                    <p>If you don't receive an email notification within a few minutes <strong>(don't forget to check your Junk or Spam folder)</strong>, please contact one of your administrators for assistance.</p>
                </div> <!-- card-body -->
            </div> <!-- card -->
        </div> <!-- col-sm-6 -->
    </div> <!-- row -->
</div> <!-- container -->
<!-- Bug workaround due to service choice model -->
<div id="directory_service"></div>
<div id="calendar_service"></div>
<div id="prayer_service"></div>
<div id="events_service"></div>

<?php
		
    $submit = $_POST['submit'];
    $clear = $_POST['clear'];
    $login = $_POST['login'];

    // $username = $_POST['username'];
    if($clear)
    {
        $username = "";
    }
    if($login)
    {
        $username = "";
    }
    if ($submit)
    {
        if(all_req_fields == 'Y'){
            echo '<script language="javascript">';
            echo 'alert("All Required Fields are correct")';
            echo '</script>';
        }
        else {
            echo '<script language="javascript">';
            echo 'alert("Missing Required Fields")';
            echo '</script>';
        }

    }
?>
    <!-- Tenant Configuration JavaScript Call in nav -->
    <script type="text/javascript" src="/js/config_ajax_call.js"></script>

</body>
</html>
