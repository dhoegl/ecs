<?php
// Send Mail scripts
// Updated 2021/03/21
// This function will send email to users and admins
// session_start();
// if(!$_SESSION['logged in']) {
// 	header("location:../welcome.php");
// 	exit();
// }
require_once('../dbconnect.php');
$text = array();

// function sendmail($mailtype, $customer, $domain, $headercolor, $headerforecolor, $family_select, $admin_dir, $login, $first, $last, $username, $email, $reset) 
// { // params based on each call to sendmail
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
// AJAX data
    // data: {
    //     "Mailtype": $mailtype,
    //     "Domain": domain,
    //     "Customer": customer,
    //     "HeaderColor": headercolorvalue,
    //     "Headerforecolorvalue": headerforecolorvalue,
    //     "Login": $login,
    //     "First": $first,
    //     "Last": $last,
    //     "Email": $email,
    //     "ResetKey": $reset

    // data: { mailtype: 'password_reset', email_address: reset_submit, first_name: first_submit, last_name: last_submit, user_name: user_submit, login_id: login_ID, theme_name: themename, theme_domain: themedomain, theme_title: themetitle, theme_color: themecolor, theme_forecolor: themeforecolor}


$mailtype = $_POST['mailtype'];
$domain = $_POST['theme_domain'];
$customer = $_POST['theme_name'];
$headercolorvalue = $_POST['theme_color'];
$headerforecolorvalue = $_POST['theme_forecolor'];
// $family_select = $_POST['Family']; //family select for new registrants (possibly unused for email comms)
// $admin_dir = $_POST['Admin']; //Administrator's Directory ID (possibly unused for email comms)
$login = $_POST['login_id']; //UserName
$firstname = $_POST['first_name'];
$lastname = $_POST['last_name'];
$username = $_POST['user_name'];
$email = $_POST['email_address'];
// $key = $_POST['ResetKey'];

// echo "<script language='javascript'>";
// echo "console.log('Made it to sendmail - just prior to switch');";
// echo "</script>";



    if($mailtype){
        Switch ($mailtype){
            case 'password_reset':
                // sendmail('password_reset', $themename, $themedomain, $themecolor, $themeforecolor, '', '', $login3, $firstname, $lastname, $username3, $emailaddr3, $key);
                // Generate Password Reset Key
                $dateFormat = mktime(date("H"),date("i"),date("s"),date("m"),date("d")+3,date("Y"));
                $dateSeed = date("Y-m-d H:i:s",$dateFormat); //get date 3 days from now (max allowed time to reset password after request)
                $key = md5($username . '_' . $email . rand(0,10000) .$dateSeed . password_SALT);

                try 
                {
                    $stmt = $mysql->prepare("UPDATE " . $_SESSION['logintablename'] . " SET temp_pass_key = '" . $key . "', temp_pass_expire = '" . $dateSeed . "' WHERE login_ID = ?");
                    $stmt->bind_param("s", $login);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    $text[] = array('Status' => 'Password Seed Success');
                    header('Content-type: application/json');
                    echo json_encode($text);
                    $stmt->close();

                }
                catch(Exception $e)
                {
                    echo "<script language='javascript'>";
                    echo "alert('ERROR IN sendmail.php for password reset');";
                    echo "</script>";
                    $text[] = array('Status' => 'Password Seed Failed');
                    header('Content-type: application/json');
                    echo json_encode($text);
                }

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
                $domain_url = "<p>http://" . $maillink . "/pass_renew.php?a=recover&email=";
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
                // mail($mailto,$mailsubject,$mailmessage,$mailheaders);
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
                $mailmessage .= "<p><strong>" . $firstname . " " . $lastname . "</strong> has reqeuested to be added to <strong>" . $customer . "'s</strong> family directory.</p>";
                $mailmessage .= "<p>Login to our site using your admin credentials, select the <strong>Registration Admin</strong> menu item, and accept or reject this request.</p>";
                $mailmessage .= "<p><a href='" . $maillink . "'>" . $customer . "</a></p>";
                $mailmessage .= "<p><br />Thank you!<br />The OurFamilyConnections team.</p>";            
                $mailmessage .= "</body></html>";
                $mailfrom = "newfamilyrequest@ourfamilyconnections.org";
                $mailheaders = "From:" . $mailfrom . "\r\n";
                $mailheaders .= "Reply-To:" . $mailfrom . "\r\n";
                $mailheaders .= "MIME-Version: 1.0\r\n";
                $mailheaders .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
                // mail($mailto,$mailsubject,$mailmessage,$mailheaders);
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
                // mail($mailto,$mailsubject,$mailmessage,$mailheaders);
                $response = "Mailtype received" . " = " . $mailtype;
                break;
        };
    }
    else
    {
        $response = "ERROR on Mailtype at sendmail.php";
    };
// echo $response;
?>