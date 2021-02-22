<?php
// Send Mail scripts
// Updated 2020/12/09
// Getting error when this script is 'include'd in ajax_update_new_registrant.php
session_start();
if(!$_SESSION['logged in']) {
	header("location:../welcome.php");
	exit();
}
// This function will send email to alert users and admins
$mailtype = $_POST['Mailtype'];
// header('Content-Type: application/json');
echo "<script language='javascript'>";
echo "alert('Made it to sendmail for " . $mailtype . "');";
echo "</script>";

$aResult = array();

if( !isset($_POST['Mailtype']) ) { $aResult['error'] = 'No mailtype!'; }

if( !isset($aResult['error']) ) {

    switch($_POST['Mailtype']) {
        case 'approved_member':
        echo "<script language='javascript'>";
        echo "alert('Made it into sendmail for " . $mailtype . "');";
        echo "</script>";
        break;

        default:
           $aResult['error'] = 'Not found function '.$_POST['Mailtype'].'!';
           break;
    }

};

echo json_encode($aResult);





// 12/27 Test Script to validate arrival into this code
//include('../includes/event_logs_update.php');
// eventLogUpdate('admin_update', "Admin ID: " .  $_SESSION['idDirectory'], "Email sent using sendmail", "LoginID: " . "empty");

// function sendmail($mailtype, $param1, $param2, $param3, $param4, $param5, $param6, $param7, $param8) { // params based on each call to sendmail
    //$mailtype = type of email to send
    //$param1 = 'Customer Name' - Name of church/school (email banner)
    //$param2 = 'Domain' - Site domain - used to insert domain information into login email
    //$param3 = 'headercolor' - brand banner color for email header
    //$param4 = 'headerforecolor' - brand text color for email header
    //$param5 = 'Login' - approved member's user login id
    //$param6 = 'FirstName' - approved member's first name
    //$param7 = 'LastName' - approved member's last name
    //$param8 = 'Email' - approved member's email address
    // Switch ($mailtype){
        // case 'approved_member':
            //$cookie_name = "reg_notify_from";
            //if(!isset($_COOKIE[$cookie_name])) {
                //echo "Cookie named '" . $cookie_name . "' is not set!";
            //} else {
                //echo "Cookie '" . $cookie_name . "' is set!<br>";
                //$regmailfrom = $_COOKIE[$cookie_name];
            //}
            //$cookie_name = "reg_notify_link";
            //if(!isset($_COOKIE[$cookie_name])) {
                //echo "Cookie named '" . $cookie_name . "' is not set!";
            //} else {
                //echo "Cookie '" . $cookie_name . "' is set!<br>";
            //    $regmaillink = "http://" . $_COOKIE[$cookie_name];
            //}
            //$regmaillink = "http://" . $_COOKIE[$cookie_name];
            // $regmaillink = "https://tec.ourfamilyconnections.org";
            // $regmaillink = "//" . $param2;
            // $regmailto = $param6;
            // $regmailsubject = "Approved access to the " . $param1 . " family directory" . "\n..";
            // $regmailmessage = "<html><body>";
            // $regmailmessage .= "<p style='background-color: " .  #ff6933; font-size: 30px; font-weight: bold; color: white; padding: 25px; width=100%;'> Trinity Evangel Church</p>";
            // $regmailmessage .= "<p>Hello <strong>" . $param6 . " " . $param7 . "</strong></p>";
            // $regmailmessage .= "<p>You have been approved to access the " . $param1 . "'s directory site!</p>";
            // $regmailmessage .= "<p>Click on the link below to login<br /></p>";
            // $regmailmessage .= "<p><a href='" . $regmaillink . "'>" . $regmaillink . "</a></p>";
            // $regmailmessage .= "<p><br />Thank you!<br />The OurFamilyConnections team.</p>";            
            // $regmailmessage .= "</body></html>";
            // $regmailfrom = "noreply@ourfamilyconnections.org";
            // $regmailheaders = "From:" . $regmailfrom . "\r\n";
            // $regmailheaders .= "Reply-To:" . $regmailfrom . "\r\n";
            // $regmailheaders .= "MIME-Version: 1.0\r\n";
            // $regmailheaders .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
            // mail($regmailto,$regmailsubject,$regmailmessage,$regmailheaders);

        //     break;
        // default:
    // }
// };


?>