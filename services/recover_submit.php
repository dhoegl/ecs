<?php
// Last Updated: 20210402: Consolidated all recover password scripts into recover.php and recover_submit.php
// why does this script force a redirect to welcome.php??
// Because event_logs_update.php forces a check whether logged in. If not, shut down and go back to Welcome page!!!

require_once('../dbconnect.php');
include('../includes/event_logs_update.php');
// echo "<script type='text/javascript' src='../js/forgot_password_submit.js'></script>";

if(isset($_POST['password_reset']))
{
    echo "<script language='javascript'>";
    echo "console.log('Arrived in Isset Post password_reset.');";
    echo "</script>";
$user_name = filter_input(INPUT_POST, 'username');
    echo "<script type='text/javascript' src='//code.jquery.com/jquery-latest.min.js'></script>";
    // echo "<script type='text/javascript' src='../js/error_handler.js'></script>";
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
        $stmt->close();

        $dateFormat = mktime(date("H"),date("i"),date("s"),date("m"),date("d")+3,date("Y"));
        $dateSeed = date("Y-m-d H:i:s",$dateFormat); //get date 3 days from now (max allowed time to reset password after request)
        $key = md5($username . '_' . $email . rand(0,10000) .$dateSeed . password_SALT);

        try 
        {
            $stmt = $mysql->prepare("UPDATE " . $_SESSION['logintablename'] . " SET temp_pass_key = '" . $key . "', temp_pass_expire = '" . $dateSeed . "' WHERE login_ID = ?");
            $stmt->bind_param("s", $LoginID);
            $stmt->execute();
            $result = $stmt->get_result();
            $text[] = array('Status' => 'Password Seed Success');
            // header('Content-type: application/json');
            // echo json_encode($text);
            $stmt->close();

        }
        catch(Exception $e)
        {
            echo "<script language='javascript'>";
            echo "alert('ERROR IN sendmail.php for password reset');";
            echo "</script>";
            // $text[] = array('Status' => 'Password Seed Failed');
            // header('Content-type: application/json');
        }
        ?>    
        <script language='javascript'>
            console.log('Inside the email script')
            console.log('login ID = ' + '<?php echo $LoginID; ?>')
            console.log('username = ' + '<?php echo $username; ?>')
            console.log('email address = ' + '<?php echo $emailaddr; ?>')
            console.log('first name = ' + '<?php echo $firstname; ?>')
            console.log('last name = ' + '<?php echo $lastname; ?>')
            console.log('username = ' + '<?php echo $username; ?>')
            console.log('domain = ' + '<?php echo $themedomain; ?>')
            console.log('name = ' + '<?php echo $themename; ?>')
            console.log('title = ' + '<?php echo $themetitle; ?>')
            console.log('color = ' + '<?php echo $themecolor; ?>')
            console.log('forecolor = ' + '<?php echo $themeforecolor; ?>')
        </script>
        <?php

        $maillink = $themedomain;
        $mailto = $emailaddr;
        $mailsubject = "Password Reset Request for " . $username . "." . "\n..";
        $mailmessage = "<html><body>";
        $mailmessage .= "<p>(This was sent from an unmonitored mailbox)</p>";
        $mailmessage .= "<p style='background-color: " .  $themecolor . "; font-size: 30px; font-weight: bold; color: " . $themeforecolor . "; padding: 25px; width=100%;'>";
        $mailmessage .= $themename . "</p>";
        $mailmessage .= "<p>Hello <strong>" . $username . "</strong></p>";
        $mailmessage .= "<p>A request to reset your password has been submitted to Ourfamilyconnections.</p>";
        $mailmessage .= "<p>If you did not submit this request, please notify your " . $themename . " Administrators immediately. Otherwise, within the next 3 days click on the link below to be taken to the Password Reset page.</p>";
        $domain_url = "<p>http://" . $maillink . "/pass_renew.php?a=recover&email=";
        $passwordLink = $domain_url . $key . "&u=" . urlencode(base64_encode($username));
        $mailmessage .= $passwordLink . "</p><br /><br />";
        $mailmessage .= "<p>NOTE: The link above will expire 3 days from now. If you do not reset your password within this timeframe, you must return to the home page and reset your password again.</p>";
        $mailmessage .= "<p><br />Thank you!<br />The OurFamilyConnections team.</p>";            
        $mailmessage .= "</body></html>";
        $mailfrom = "passwordreset@ourfamilyconnections.org";
        $mailheaders = "From:" . $mailfrom . "\r\n";
        $mailheaders .= "Reply-To:" . $mailfrom . "\r\n";
        $mailheaders .= "MIME-Version: 1.0\r\n";
        $mailheaders .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
        $emailworks = mail($mailto,$mailsubject,$mailmessage,$mailheaders);
        if($emailworks){
            ?>
                <script language='javascript'>
                    alert("Your password reset has been received.\nCheck your email and follow the instructions to reset your password.")
                </script>
            <?php
            eventLogUpdate('mail', "User: " .  $username, " Password Reset email sent", "SUCCESS");
        }
        else {
            eventLogUpdate('mail', "User: " .  $username, "Password Reset email sent", "FAILED");
        }
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
<a class="navbar-brand" href="../welcome.php">
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