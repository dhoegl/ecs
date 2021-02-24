<?php
// Send Mail scripts
// Updated 2021/02/23
// This function will send email to users and admins
session_start();
if(!$_SESSION['logged in']) {
	header("location:../welcome.php");
	exit();
}
require_once('../dbconnect.php');
$text = array();
$mailtype = $_POST['Mailtype'];
$domain = $_POST['Domain'];
$customer = $_POST['Customer'];
$headercolorvalue = $_POST['HeaderColor'];
$headerforecolorvalue = $_POST['Headerforecolorvalue'];
$login = $_POST['Login']; //UserName
$firstname = $_POST['First'];
$lastname = $_POST['Last'];
$email = $_POST['Email'];
$key = $_POST['ResetKey'];

if($mailtype){
    Switch ($mailtype){
        case 'password_reset':
            $maillink = $domain;
            $mailto = $email;
            $mailsubject = "Password Reset Request for " . $login . "." . "\n..";
            $mailmessage = "<html><body>";
            $mailmessage .= "<p>(This was sent from an unmonitored mailbox)</p>";
            $mailmessage .= "<p style='background-color: " .  $headercolorvalue . "; font-size: 30px; font-weight: bold; color: " . $headerforecolorvalue . "; padding: 25px; width=100%;'>";
            $mailmessage .= $customer . "</p>";
            $mailmessage .= "<p>Hello <strong>" . $login . "</strong></p>";
            $mailmessage .= "<p>A request to reset your password has been submitted to Ourfamilyconnections.</p>";
            $mailmessage .= "<p>If you did not submit this request, please notify your " . $customer . " Administrators immediately. Otherwise, within the next 3 days click on the link below to be taken to the Password Reset page.</p>";
            $domain_url = "<p>" . $maillink . "/pass_renew.php?a=recover@email=";
            $passwordLink = $domain_url . $key . "&u=" . urlencode(base64_encode($login));
            $mailmessage .= $passwordLink . "</p><br /><br />";
            $mailmessage .= "<p>NOTE: The link above will expire 3 days from now. If you do not reset your password within this timeframe, you must return to the home page and reset your password again.</p>";
            $mailmessage .= "<p><br />Thank you!<br />The OurFamilyConnections team.</p>";            
            $mailmessage .= "</body></html>";
            $mailfrom = "passwordreset@ourfamilyconnections.org";
            $mailheaders = "From:" . $mailfrom . "\r\n";
            $mailheaders .= "Reply-To:" . $mailfrom . "\r\n";
            $mailheaders .= "MIME-Version: 1.0\r\n";
            $mailheaders .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
            mail($mailto,$mailsubject,$mailmessage,$mailheaders);
            $response = "Mailtype received" . " = " . $mailtype;
            break;
        case 'register_request':
            // Send notification email to All registration admins (admin_regnotify = 1) for them to ACCEPT/REJECT the request
            $mailadmins = "SELECT email_addr FROM " . $_SESSION['logintablename'] . " WHERE admin_regnotify = '1'";
            $mailquery = $mysql->query($mailadmins) or die("A database error occurred when trying to select registration admins in Login Table. See register_submit.php. Error : " . $mysql->errno . " : " . $mysql->error);
            while ($mailrow = $mailquery->fetch_assoc())
            {
                $mailtest = $mailrow['email_addr'];
                $mailto = $mailtest . " , " . $mailto;
            }
            $maillink = $domain;
            $mailsubject = "Registration Request to " . $customer . " family directory" . "\n..";
            $mailmessage = "<html><body>";
            $mailmessage .= "<p>(This was sent from an unmonitored mailbox)</p>";
            $mailmessage .= "<p style='background-color: " .  $headercolorvalue . "; font-size: 30px; font-weight: bold; color: " . $headerforecolorvalue . "; padding: 25px; width=100%;'>";
            $mailmessage .= $customer . "</p>";
            $mailmessage .= "<p>Hello <strong>" . $customer . "</strong> Administrators</p>";
            $mailmessage .= "<p>" . $firstname . " " . $lastname . " has reqeuested to be added to <strong>" . $customer . "'s</strong> family directory.</p>";
            $mailmessage .= "<p>Login to our site using your admin credentials, select the <strong>Registration Admin</strong> menu item, and accept or reject this request.</p>";
            $mailmessage .= "<p><a href='" . $maillink . "'>" . $customer . "</a></p>";
            $mailmessage .= "<p><br />Thank you!<br />The OurFamilyConnections team.</p>";            
            $mailmessage .= "</body></html>";
            $mailfrom = "newfamilyrequest@ourfamilyconnections.org";
            $mailheaders = "From:" . $mailfrom . "\r\n";
            $mailheaders .= "Reply-To:" . $mailfrom . "\r\n";
            $mailheaders .= "MIME-Version: 1.0\r\n";
            $mailheaders .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
            mail($mailto,$mailsubject,$mailmessage,$mailheaders);
            $response = "Mailtype received" . " = " . $mailtype;
            break;
        case 'approved_member':
            $maillink = $domain;
            $mailto = $email;
            $mailsubject = "Approved access to the " . $customer . " family directory" . "\n..";
            $mailmessage = "<html><body>";
            $mailmessage .= "<p>(This was sent from an unmonitored mailbox)</p>";
            $mailmessage .= "<p style='background-color: " .  $headercolorvalue . "; font-size: 30px; font-weight: bold; color: " . $headerforecolorvalue . "; padding: 25px; width=100%;'>";
            $mailmessage .= $customer . "</p>";
            $mailmessage .= "<p>Hello <strong>" . $firstname . " " . $lastname . "</strong></p>";
            $mailmessage .= "<p>You have been approved to access " . $customer . "'s directory site!</p>";
            $mailmessage .= "<p>Click on the link below to login<br /></p>";
            $mailmessage .= "<p><a href='" . $maillink . "'>" . $customer . "</a></p>";
            $mailmessage .= "<p><br />Thank you!<br />The OurFamilyConnections team.</p>";            
            $mailmessage .= "</body></html>";
            $mailfrom = "noreply@ourfamilyconnections.org";
            $mailheaders = "From:" . $mailfrom . "\r\n";
            $mailheaders .= "Reply-To:" . $mailfrom . "\r\n";
            $mailheaders .= "MIME-Version: 1.0\r\n";
            $mailheaders .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
            mail($mailto,$mailsubject,$mailmessage,$mailheaders);
            $response = "Mailtype received" . " = " . $mailtype;
            break;
        
            };
}
else {
    $response = "ERROR on Mailtype at sendmail.php";
};

echo $response;

?>