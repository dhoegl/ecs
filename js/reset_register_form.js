// JavaScript source code
// If back button used to return to this form, reset all form fields
var resetJQ = jQuery.noConflict();
resetJQ(window).bind("pageshow", function () {
    resetJQ("#register")[0].reset();
});
