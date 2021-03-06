<?php
session_start();
require_once('../dbconnect.php');
// Updated 20210130
//Tenant Configuration JavaScript Call
// Called from forgot_password_submit.js
// echo "<script type='text/javascript' src='../js/config_ajax_call.js'></script>";
// Enable sendmail script to send outbound email
include('../services/sendmail.php');

$emailaddr3 = "";
$username3 = "";
$login3 = "";
$dateFormat = "";
$dateSeed = "";
$key = "";
?>

<?php
if( isset($_POST[email_address]) && isset($_POST[first_name]) && isset($_POST[last_name]) && isset($_POST[login_id]))
{
	define(password_SALT,'(+3%_');
	$emailaddr3 = $_POST[email_address];
    $firstname = $_POST[first_name];
    $lastname = $_POST[last_name];
	$username3 = $_POST[user_name];
	$login3 = $_POST[login_id];
    //Get COOKIE from config_ajax_call.js
    $cookie_name = "domain_value";
    if(!isset($_COOKIE[$cookie_name])) {
        echo "Cookie named '" . $cookie_name . "' is not set!";
        exit;
    } else {
        $passwordmaillink = $_COOKIE[$cookie_name];
    }
    //$passwordmaillink = "https://trinityevangel.ourfamilyconnections.org";
	$dateFormat = mktime(date("H"),date("i"),date("s"),date("m"),date("d")+3,date("Y"));
	$dateSeed = date("Y-m-d H:i:s",$dateFormat); //get date 3 days from now (max allowed time to reset password after request)
	$key = md5($username3 . '_' . $emailaddr3 . rand(0,10000) .$dateSeed . password_SALT);

    //Insert password reset key onto user's Login entry
    //$passwordresetkeyupdate = "UPDATE " . $_SESSION['logintablename'] . " SET temp_pass_key = '" . $key . "', temp_pass_expire = '" . $dateSeed . "' WHERE login_ID = '$login3'";
    //$passwordresetkeyquery = @mysql_query($passwordresetkeyupdate)or die("A database error has occurred while setting password key. Please notify your administrator with the following. Error : " . mysql_errno() . mysql_error());

    try 
    {
        $stmt = $mysql->prepare("UPDATE " . $_SESSION['logintablename'] . " SET temp_pass_key = '" . $key . "', temp_pass_expire = '" . $dateSeed . "' WHERE login_ID = ?");
        $stmt->bind_param("s", $login3);
        $stmt->execute();
        $result = $stmt->get_result();
        $text[] = array('Status' => 'Password Seed Success');
	    header('Content-type: application/json');
        echo json_encode($text);
    
    }
    catch(Exception $e)
    {
        echo "<script language='javascript'>";
        echo "alert('ERROR IN password_reset_seed.php');";
        echo "</script>";
        $text[] = array('Status' => 'Password Seed Failed');
	    header('Content-type: application/json');
        echo json_encode($text);
    }

// Extract email theme elements from config.xml
    $xml=simplexml_load_file("../_tenant/Config.xml");
    $themename = $xml->customer->name;
    $themedomain = $xml->customer->domain;
    $themetitle = $xml->customer->hometitle;
    $themecolor = $xml->customer->banner_color;
    $themeforecolor = $xml->customer->banner_forecolor;
    
//    sendmail($mailtype, $customer, $domain, $headercolor, $headerforecolor, $family_select, $admin_dir, $login, $first, $last, $email, $reset);
    //$mailtype = type of email to send
    //$customer = 'Customer Name' - Name of church/school (email banner)
    //$domain = 'Domain' - Site domain - used to insert domain information into login email
    //$headercolor = 'headercolor' - brand banner color for email header
    //$headerforecolor = 'headerforecolor' - brand text color for email header
    //$family_select = 'Selected' - which family the approved member is being added to
    //$admin_dir = 'Directory' - Registration Admin's idDirectory entry
    //$login/$Login2 = 'Login' - approved member's user login id
    //$first/$FirstNane2 = 'FirstName' - approved member's first name
    //$last/$LastName2 = 'LastName' - approved member's last name
    //$email/$Email2 = 'Email' - approved member's email address
    //$reset = 'ResetKey' - key credential for password reset
// Send password reset email
sendmail('password_reset', $themename, $themedomain, $themecolor, $themeforecolor, '', '', $login3, $firstname, $lastname, $username3, $emailaddr3, $key);



    // $passwordmailto = $emailaddr3;
    // $passwordmailtest = "";
    // $passwordmessage = "<html><body>";
    // $passwordmessage .= "<p style='background-color: " . $themecolor . "; font-size: 30px; font-weight: bold; color: " . $themeforecolor . "; padding: 25px; width=100%;'> " . $themename . "</p>";
    // $passwordmessage .= "<p>(this message has been sent from an unmonitored mailbox)</p>";
    // $passwordmessage .= "<p>Hello <strong>" . $username3 . "</strong></p>";
    // $passwordmessage .= "<p>A request to reset your password has been submitted to Ourfamilyconnections.</p>";
    // $passwordmessage .= "<p>If you did not submit this request, please notify your admins immediately. Otherwise, <strong>within the next 3 days</strong> click on the link below to be taken to the Password Reset page.</p>";
    // $domain_url = "http://" . $_SERVER['HTTP_HOST'] . "/pass_renew.php?a=recover&email=";
    // $passwordLink = $domain_url . $key . "&u=" . urlencode(base64_encode($username3));
    // $passwordmessage .= $passwordLink . "<br /><br />";
    // $passwordmessage .= "<p><strong>NOTE: </strong>The link above will expire 3 days from now. If you do not reset your password within this timeframe, you must return to the <a href=" . $passwordmaillink . ">home page</a> and reset your password again.</p><br />";
    // $passwordmessage .= "<p>Thank you!<br />The OurFamilyConnections team.</p></body></html>";
    // $passwordsubject = "Password Reset Request for " . $username3 . ".\n..";
    // $passwordfrom = "passwordreset@ourfamilyconnections.org";
    // $passwordheaders = "From:" . $passwordfrom . "\r\n";
    // $passwordheaders .= "MIME-Version: 1.0\r\n";
    // $passwordheaders .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
    // mail($passwordmailto,$passwordsubject,$passwordmessage,$passwordheaders);

    // echo "<script language='javascript'>";
    // echo "console.log('Password Reset Seed');";
    // echo "alert('Passwordmessage = '' . $passwordmessage);";
    // echo "</script>";


}
else {
    // header('Location: //' . $_SESSION['domainname'] . '/welcome.php');
    header('Location: ../welcome.php');
}
// echo "<script language='javascript'>";
// echo "src='../js/config_ajax_call.js'>;";
// echo "</script>";

?>
