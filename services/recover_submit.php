<?php
// Last Updated: 20210223:

require_once('../dbconnect.php');
//include_once('/includes/event_logs_update.php');

if(isset($_POST['password_reset']))
{
    $user_name = filter_input(INPUT_POST, 'username');
    echo "<script language='javascript'>";
    echo "console.log('user_name = " . $user_name . "');";
    echo "</script>";
    echo "<script type='text/javascript' src='//code.jquery.com/jquery-latest.min.js'></script>";
    // echo "<script type='text/javascript' src='../js/error_handler.js'></script>";
    echo "<script type='text/javascript' src='../js/forgot_password_submit.js'></script>";
    // echo "<script type='text/javascript'>src='../js/forgot_password_submit.js'</script>";
    //////////////////////////////////////////////////////

// Extract email theme elements from config.xml
if (file_exists("../_tenant/Config.xml")) {
    $xml = simplexml_load_file("../_tenant/Config.xml");
    $themename = $xml->customer->name;
    $themedomain = $xml->customer->domain;
    $themetitle = $xml->customer->hometitle;
    $themecolor = $xml->customer->banner_color;
    $themeforecolor = $xml->customer->banner_forecolor;
} else {
    echo "<script language='javascript'>";
    echo "console.log('Failed to open ../_tenant/Config.xml');";
    echo "</script>";
    // exit("Failed to open ../_tenant/Config.xml.");
}    

    try {
        $stmt = $mysql->prepare("SELECT * FROM " . $_SESSION['logintablename'] . " WHERE username = ?");
        $stmt->bind_param("s", $user_name);
        $stmt->execute();
        $result = $stmt->get_result();
        if($result->num_rows === 0)
        {
            echo "<script language='javascript'>";
            echo "alert('You must select a valid username. Please re-enter your username.');";
            echo "window.location(../recover.php";
            echo "</script>";
            // exit('No rows');
            header("location:../recover.php");
        } // exit('No rows');
        while($row = $result->fetch_assoc()) {
            $LoginID = $row['login_ID'];
            $emailaddr = $row['email_addr'];
            $username = $row['username'];
            $firstname = $row['firstname'];
            $lastname = $row['lastname'];
        }
        echo "<script language='javascript'>";
        echo "console.log('Login = " . $LoginID . "');";
        echo "console.log('Email = " . $emailaddr . "');";
        echo "console.log('User Name = " . $username . "');";
        echo "console.log('First = " . $firstname . "');";
        echo "console.log('Last = " . $lastname . "');";
        echo "console.log('Theme Name = " . $themename . "');";
        echo "console.log('Theme Domain = " . $themedomain . "');";
        echo "console.log('Theme Title = " . $themetitle . "');";
        echo "console.log('Theme Color = " . $themecolor . "');";
        echo "console.log('Theme ForeColor = " . $themeforecolor . "');";
        echo "</script>";
        $stmt->close();

        // Send Reset Request to handler at forgot_password_submit.js
        echo "
		    <script type='text/javascript'>
			    resetrequest('$emailaddr', '$firstname', '$lastname', '$username', '$LoginID', '$themename', '$themedomain', '$themetitle', '$themecolor', '$themeforecolor');
		    </script>
		    ";

    }
   catch(Exception $e)
    {
        echo "<script language='javascript'>";
        echo "alert('ERROR at recover_submit.php');";
        echo "</script>";
    }
}
elseif (isset($_POST['clear'])) { // Clear button clicked
    header("location:../recover.php");
}
elseif (isset($_POST['login'])) { // Login button clicked
    header("location:../welcome.php");
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN""http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <!--<title></title>-->
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
  <!-- Bootstrap core CSS -->
  <link href="../css/MDBootstrap4191/bootstrap.min.css" rel="stylesheet">
  <!-- Material Design Bootstrap -->
  <link href="../css/MDBootstrap4191/mdb.min.css" rel="stylesheet">
  <!-- Your custom styles (optional) -->
  <link href="../css/MDBootstrap4191/style.css" rel="stylesheet">


  <!--CSS Scripts for Datatables Bootstrap 4 Responsive functions    -->
    <!-- <link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-beta/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.1.1/css/responsive.bootstrap4.min.css"> -->


<!-- Custom styles for this template -->
<link href="../css/jumbotron.css" rel="stylesheet">
<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
<link href="../css/ie10-viewport-bug-workaround.css" rel="stylesheet">
    <!-- Extended styles for this page -->
    <!-- <link href="css/ofc_css_style.css" rel="stylesheet"> -->
  <!-- Test custom styles (Includes tec style details) -->
  <link href="../css/css_style.css" rel="stylesheet">
    <!-- Tenant-specific stylesheet -->
    <link href="../_tenant/css/tenant.css" rel="stylesheet">

</head>
<body>
<nav class="navbar navbar-expand-lg fixed-top navbar-light" id="headercolor">
<a class="navbar-brand" href="welcome.php">
        <img id="nav_logo" width="30" height="30" class="d-inline-block align-top" alt="Logo" />
        <span id="navbar_brand"></span>
    </a>
</nav>
<div class="container-fluid profile_bg">
    <?php
        // header("Location: //tec.ourfamilyconnections.org");
    ?>
    <p>
    </p>
    <div class="row">
    	<div class="col-sm-12">
            <div class="card bg-light border-primary p-3">
                <h3 class="text-center">Click Login to return to the Login page</h3>
                <form name='returnhome' id="return_home" action='' method="POST">
                    <div class="form-group">
                        <input type="submit" class="btn btn-primary" name="login" value="Back to Login Page" />
                    </div>
                </form>
            </div> <!--card-->
        </div> <!--col-sm-12-->
    </div> <!-- row -->
</div> <!-- container-fluid -->
<!-- Bug workaround due to service choice model -->
<div id="directory_service"></div>
<div id="calendar_service"></div>
<div id="prayer_service"></div>
<div id="events_service"></div>

    <!-- Tenant Configuration JavaScript Call in nav -->
    <script type="text/javascript" src="/js/config_ajax_call.js"></script>
</body>
</html>