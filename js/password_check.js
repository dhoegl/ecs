//Version 01/11/2021 - Check Password Strength for Password Reset
var passresetJQ = jQuery.noConflict();
passresetJQ(document).ready(function()
{
    var passwordset = 'N';
    var repeatpasswordset = 'N';
    var all_req_fields = 'N'
    passresetJQ('#reset_submit').prop('disabled', true); 




// <editor-fold desc="Validate Password Strength - from pass_renew.js">
//Check for correct password strength
//Password strength criteria is as follows
//-- Length must be greater than 6 characters
//-- Characters shall include at least the following:
//---- Use lower case and upper case characters
//---- Use numbers and special characters
//  If password is less than 6 characters, don’t accept.
//  If the length of password is more than 6 characters, increase the strength value by +1.
//  If the password contains lower and uppercase characters, increase the strength value by +1.
//  If the password contains characters and numbers, increase the strength value by +1.
//  If the password contains one special character, increase the strength value by +1.
//  If the password contains two special characters, increase the strength value by +1.
// ---- Allow Passwords whose Strength is either "Good" or "Strong" (Strenght = 2 or greater)

passresetJQ('#password').keyup(function(e){
        var code = e.keyCode || e.which; //Check for Tab key - don't call checkStrength until actual key is pressed
        if(code == '9'){
            console.log('Tab Key Pressed');
        }
        else {
            passresetJQ('#repeatpassword').val(""); 
            passresetJQ('#password_match').removeClass(); 
            passresetJQ('#password_match').addClass('nomatch'); 
            passresetJQ('#password_match').html('No Match'); 
            repeatpasswordset = 'N';
            passresetJQ('#password_result').html(checkStrength(passresetJQ('#password').val()));
        }

        if(passresetJQ('#password_result').html() == 'Good' || passresetJQ('#password_result').html() == 'Strong') {
            passwordset = 'Y';
            // console.log("passwordset = " + passwordset);
            // console.log('all_req_fields = ' + all_req_fields);
        }
        else
        {
            passwordset = 'N';
            // console.log("passwordset = " + passwordset);
            // console.log('all_req_fields = ' + all_req_fields);
        }
        if (passwordset == 'Y' && repeatpasswordset == 'Y') {
            all_req_fields = 'Y';
            passresetJQ('#reset_submit').removeClass('disabled'); 
            passresetJQ('#reset_submit').prop('disabled', false); 
            // console.log("passwordset = " + passwordset);
            // console.log('all_req_fields = ' + all_req_fields);
        }
        else {
            all_req_fields = 'N';
            passresetJQ('#reset_submit').addClass('disabled'); 
            passresetJQ('#reset_submit').prop('disabled', true); 
            // console.log("passwordset = " + passwordset);
            // console.log('all_req_fields = ' + all_req_fields);
        }
    

    function checkStrength(password){
        //initial strength 
        var strength = 0; 
        //if the password length is less than 6, return message. 
        if (password.length < 6) { 
            passresetJQ('#password_result').removeClass(); 
            passresetJQ('#password_result').addClass('short'); 
    //        passresetJQ('#register_submit').prop('disabled', true);
            return 'Too short'; 
        } 
    //length is ok, lets continue. 
        //if length is 8 characters or more, increase strength value 
        if (password.length > 7) strength += 1; 
    
        //if password contains both lower and uppercase characters, increase strength value 
        if (password.match(/([a-z].*[A-Z])|([A-Z].*[a-z])/)) strength += 1; 
    
        //if it has numbers and characters, increase strength value 
        if (password.match(/([a-zA-Z])/) && password.match(/([0-9])/)) strength += 1; 
        
        //if it has one special character, increase strength value 
        if (password.match(/([!,%,&,@,#,$,^,*,?,_,~])/)) strength += 1; 
        
        //if it has two special characters, increase strength value 
        if (password.match(/(.*[!,%,&,@,#,$,^,*,?,_,~].*[!,",%,&,@,#,$,^,*,?,_,~])/)) strength += 1; 
         
        //now we have calculated strength value, we can return messages 
        //if value is less than 2 
        if (strength < 2 ) {
            passresetJQ('#password_result').removeClass(); 
            passresetJQ('#password_result').addClass('weak');
            // console.log("passwordset = " + passwordset);
            // console.log('all_req_fields = ' + all_req_fields);
            return 'Weak'; 
        } 
        else if (strength == 2 ) { 
            passresetJQ('#password_result').removeClass(); 
            passresetJQ('#password_result').addClass('good'); 
            // console.log("passwordset = " + passwordset);
            // console.log('all_req_fields = ' + all_req_fields);
            return 'Good'; 
        } 
        else { 
            passresetJQ('#password_result').removeClass(); 
            passresetJQ('#password_result').addClass('strong'); 
            // console.log("passwordset = " + passwordset);
            // console.log('all_req_fields = ' + all_req_fields);
            return 'Strong'; 
        }; 
    };
});
    
passresetJQ('#repeatpassword').keyup(function(e){
        var code = e.keyCode || e.which; //Check for Tab key - don't call checkStrength until actual key is pressed
        if(code == '9'){
            // console.log('Tab Key Pressed');
        }
        else {
            passresetJQ('#password_match').html(checkMatch(passresetJQ('#repeatpassword').val(), passresetJQ('#password').val()));
        }
    
        function checkMatch(repeatpassword, password){
            //initial check 
            var check = 0; 
            //if the password check does not match, return message. 
            if (repeatpassword == password) { 
                passresetJQ('#password_match').removeClass(); 
                passresetJQ('#password_match').addClass('match'); 
                repeatpasswordset = 'Y';
                // console.log("passwordset = " + passwordset);
                // console.log("repeatpasswordset = " + repeatpasswordset);
                // console.log('all_req_fields = ' + all_req_fields);
                return 'Match'; 
            } 
            else { 
                passresetJQ('#password_match').removeClass(); 
                passresetJQ('#password_match').addClass('nomatch'); 
                repeatpasswordset = 'N';
                // console.log("passwordset = " + passwordset);
                // console.log("repeatpasswordset = " + repeatpasswordset);
                // console.log('all_req_fields = ' + all_req_fields);
            return 'No Match'; 
            }; 
        };

        if (passwordset == 'Y' && repeatpasswordset == 'Y') {
            all_req_fields = 'Y';
            passresetJQ('#reset_submit').removeClass('disabled'); 
            passresetJQ('#reset_submit').prop('disabled', false); 
            // console.log("passwordset = " + passwordset);
            // console.log("repeatpasswordset = " + repeatpasswordset);
            // console.log('all_req_fields = ' + all_req_fields);
        }
        else {
            all_req_fields = 'N';
            passresetJQ('#reset_submit').addClass('disabled'); 
            passresetJQ('#reset_submit').prop('disabled', true); 
            // console.log("passwordset = " + passwordset);
            // console.log("repeatpasswordset = " + repeatpasswordset);
            // console.log('all_req_fields = ' + all_req_fields);
        }
    });
});
