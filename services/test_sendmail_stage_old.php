<!-- Test_sendmail_stage -->
<!-- Testing the launch of sendmail_stage.php -->
<?php
echo "<script language='javascript'>";
echo "alert('Arrived at test_sendmail_stage');";
echo "</script>";
require($_SERVER["DOCUMENT_ROOT"] . '/dbconnect.php');
// include($_SERVER["DOCUMENT_ROOT"] . '/includes/event_logs_update.php');
// include('../services/sendmail.php');
echo "<script language='javascript'>";
echo "alert('Got past Sendmail include');";
echo "</script>";

        $themename = "Evangel Classical School";
        $themetitle = "ECS Family Connections";
        $themedomain = "ecs.ourfamilyconnections.org";
        $themecolor = "Black";
        $themeforecolor = "White";
        $family_select = "0";
        $admin_dir = "20";
        // $Selected2 = "1";
        // $Directory2 = "1";
        $LoginID = "20";
        $user_name = "alt_whoever";
        // $Gender2 = "M";
        $First = "DanTest";
        $Last = "LastTest";
        $Email = "firebird@hoeglund.com";
        $reset = "";
        $text = array();
        // regsendmailnotify('approved_member', $Email, $First, $Last, $user_name, $LoginID, $themename, $themedomain, $themetitle, $themecolor, $themeforecolor);

        $mailtype = 'approved_member';
        $domain = $themedomain;
        $customer = $themename;
        $title = $themetitle;
        $headercolorvalue = $themecolor;
        $headerforecolorvalue = $themeforecolor;
        // $family_select = $_POST['Family']; //family select for new registrants (possibly unused for email comms)
        // $admin_dir = $_POST['Admin']; //Administrator's Directory ID (possibly unused for email comms)
        $login = $LoginID; //UserName
        $firstname = $First;
        $lastname = $Last;
        $username = $user_name;
        $email = $Email;
    
        // Sendmail copy into this PHP flow...
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
        $mailmessage .= "<p><a href=http://" . $maillink . ">" . $customer . "</a></p>";
        $mailmessage .= "<p><br />Thank you!<br />The OurFamilyConnections team.</p>";            
        $mailmessage .= "</body></html>";
        $mailfrom = "noreply@ourfamilyconnections.org";
        $mailheaders = "From:" . $mailfrom . "\r\n";
        $mailheaders .= "Reply-To:" . $mailfrom . "\r\n";
        $mailheaders .= "MIME-Version: 1.0\r\n";
        $mailheaders .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
        mail($mailto,$mailsubject,$mailmessage,$mailheaders);
    
?>