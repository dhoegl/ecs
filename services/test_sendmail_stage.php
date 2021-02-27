Test_sendmail_stage
<!-- Testing the launch of sendmail_stage.php -->
<?php
echo "<script language='javascript'>";
echo "alert('Arrived at test_sendmail_stage');";
echo "</script>";
require($_SERVER["DOCUMENT_ROOT"] . '/dbconnect.php');
include($_SERVER["DOCUMENT_ROOT"] . '/includes/event_logs_update.php');
include($_SERVER["DOCUMENT_ROOT"] . '/services/sendmail_stage.php');

        $customer = "Test School";
        $domain = "ecs.ourfamilyconnections.org";
        $headercolor = "Black";
        $headerforecolor = "White";
        $family_select = "0";
        $admin_dir = "20";
        $Selected2 = "1";
        $Directory2 = "1";
        $Login2 = "20";
        $Gender2 = "M";
        $FirstName2 = "DanTest";
        $LastName2 = "LastTest";
        $Email2 = "firebird@hoeglund.com";
        $reset = "";
        $text = array();
    // sendmail_stage('approved_member', $customer, $domain, $headercolor, $headerforecolor, $family_select, $admin_dir, $Login2, $FirstName2, $LastName2, $Email2, $reset);

?>