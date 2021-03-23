// Perform AJAX forget password on password reset submit
//JQuery
//Called from recover_submit.php
// Last Updated 20210223

function resetrequest(reset_submit, first_submit, last_submit, user_submit, login_ID, themename, themedomain, themetitle, themecolor, themeforecolor) {
    // console.log("Made it to forgot_password_submit script ");
    // console.log("email address = " + reset_submit);
    // console.log("first name = " + first_submit);
    // console.log("last name = " + last_submit);
    // console.log("user name = " + user_submit);
    // console.log("login ID = " + login_ID);
    // console.log("Theme Name = " + themename);
    // console.log("Theme Domain = " + themedomain);
    // console.log("Theme Title = " + themetitle);
    // console.log("Theme Color = " + themecolor);
    // console.log("Theme ForeColor = " + themeforecolor);

    // console.log("Made it to forgot_password, just prior to ajax call to sendmail");

    //Updated
    var jQpwr = jQuery.noConflict();
    var request = jQpwr.ajax({
        url: '../services/sendmail.php',
        type: 'POST',
        dataType: 'json',
        data: { mailtype: 'password_reset', email_address: reset_submit, first_name: first_submit, last_name: last_submit, user_name: user_submit, login_id: login_ID, theme_name: themename, theme_domain: themedomain, theme_title: themetitle, theme_color: themecolor, theme_forecolor: themeforecolor}
    });
    request.done(function (data, textStatus, jqXHR) {
        //  Get the result
        var result = "success";
        var testdata = data;
        var teststat = textStatus;
        teststat2 = jqXHR.responseText;
        console.log("ajax response data for password reset = " + teststat);
        console.log("ajax response text for password reset = " + teststat2);
        alert("Check your email and follow the instructions to reset your password.");
        $welcomepage = window.location.hostname;
        window.locaation = $welcomepage;
        // window.location = "//tec.ourfamilyconnections.org/welcome.php";
        // location.reload();
        return result;
    });
    request.fail(function (jqXHR, textStatus) {
            //  Get the result
            //result = (rtnData === undefined) ? null : rtnData.d;
            var result = "fail";
            var teststat = textStatus;
            var teststat2 = jqXHR.responseText;
            console.log("ajax fail response data for password reset = " + teststat);
            console.log("ajax fail response text for password reset = " + teststat2);
            alert("Password Reset Failure: " + teststat + " at " + teststat2);
            // reportError(teststat);
            //alert("A problem has occurred with your approval - ofc_approve_registrant. Please copy this error and contact your OurFamilyConnections administrator for details.");
            // location.reload();
            return result;
        });
}
