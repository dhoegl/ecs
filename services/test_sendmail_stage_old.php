<!-- Test_sendmail_stage -->
<!-- Testing the launch of sendmail_stage.php -->
<?php
echo "<script language='javascript'>";
echo "alert('Arrived at test_sendmail_stage');";
echo "</script>";
require($_SERVER["DOCUMENT_ROOT"] . '/dbconnect.php');
// include($_SERVER["DOCUMENT_ROOT"] . '/includes/event_logs_update.php');
include('../services/sendmail.php');
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
        regsendmailnotify('approved_member', $Email, $First, $Last, $user_name, $LoginID, $themename, $themedomain, $themetitle, $themecolor, $themeforecolor);
    // sendmail_stage('approved_member', $customer, $domain, $headercolor, $headerforecolor, $family_select, $admin_dir, $Login2, $FirstName2, $LastName2, $Email2, $reset);
    // echo "<script language='javascript'>";
    // echo "alert('Reached the end of test_sendmail_stage - Errors?');";
    // echo "</script>";
    
?>