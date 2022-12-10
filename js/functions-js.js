//checking the format of both first and last name when the cursor focused-out the name fields (sign up)
function checknameformat() {
    var regexname=/^([a-zA-Z ]{2,20})$/;
    var fname = document.getElementById("FirstName").value;
    var lname = document.getElementById("LastName").value;

    if (fname != "") {
        if (!fname.match(regexname)){
            // there is a mismatch, hence show the error message
            document.getElementById("nameError").style.display='block';
            document.getElementById("FirstName").style.borderColor='#d9534f';
            document.getElementById("FirstName").style.borderColor='#d9534f';
        }
        else {
            document.getElementById("FirstName").style.borderColor='dimgray';
        }
    }
    else {
        document.getElementById("FirstName").style.borderColor='dimgray';
    }

    if (lname != "") {
        if (!lname.match(regexname)){
            // there is a mismatch, hence show the error message
            document.getElementById("nameError").style.display='block';
            document.getElementById("LastName").style.borderColor='#d9534f';
        }
        else {
            document.getElementById("LastName").style.borderColor='dimgray';
        }
    }
    else {
        document.getElementById("LastName").style.borderColor='dimgray';
    }
}

//validation of first name format on key up (sign up)
    function firstnamevalidate (){
        var regexname=/^([a-zA-Z ]{2,20})$/;
        var name = document.getElementById("FirstName").value;
        if (!name.match(regexname)){
            // there is a mismatch, hence show the error message
            document.getElementById("nameError").style.display='block';
        }
        else{
            // else, do not display message
            document.getElementById("nameError").style.display='none';
        }
    }

//validation of last name format on key up (sign up)
    function lastnamevalidate(){
        var regexname=/^([a-zA-Z ]{2,20})$/;
        var name = document.getElementById("LastName").value;
        if (!name.match(regexname)){
            // there is a mismatch, hence show the error message
            document.getElementById("nameError").style.display='block';
        }
        else{
            // else, do not display message
            document.getElementById("nameError").style.display='none';
        }
    }
    //shows password format guide
    function showpassformat() {
        document.getElementById("pass8Char").style.display='block';
        document.getElementById("passSpecialChar").style.display='block';
        document.getElementById("passNumber").style.display='block';
    }

    //hides password format guide
    function hidepassformat(){
        document.getElementById("pass8Char").style.display='none';
        document.getElementById("passSpecialChar").style.display='none';
        document.getElementById("passNumber").style.display='none';
    }

    //this function double-checks the password format once the password and confirm password input loses cursor focus
    function otherpassformatmechanics() {
        function hidepassformat(){
            document.getElementById("pass8Char").style.display='none';
            document.getElementById("passSpecialChar").style.display='none';
            document.getElementById("passNumber").style.display='none';
        }

        function showpassformat(){
            document.getElementById("pass8Char").style.display='block';
            document.getElementById("passSpecialChar").style.display='block';
            document.getElementById("passNumber").style.display='block';
        }

        var password1 = document.getElementById("Password1").value;
        var password2 = document.getElementById("Password2").value;

        if (password2 != ""){
            if (password1 != password2){
                document.getElementById("passwordError").style.display= 'block';
                document.getElementById("Password1").style.borderColor='#d9534f';
                document.getElementById("Password2").style.borderColor='#d9534f';
            }
            else {
                document.getElementById("passwordError").style.display = 'none';
                document.getElementById("Password1").style.borderColor='dimgray';
                document.getElementById("Password2").style.borderColor='dimgray';
            }
        }

        var passnumber = new RegExp("(?=.*[0-9])");
        var passspecial = new RegExp("(?=.*[.,'`~!@#$%^&*])");
        var pass8char = new RegExp("(?=.{8,})");

        if(password1 != ""){
            //checking if the password is at least 8 characters long
            if (password1.match(pass8char)){
                document.getElementById("Password1").style.borderColor='dimgray';
                hidepassformat();
            }
            else {
                document.getElementById("Password1").style.borderColor='#d9534f';
                showpassformat();
            }

            //checking if the password has at least 1 number
            if (password1.match(passnumber)){
                document.getElementById("Password1").style.borderColor='dimgray';
                hidepassformat();
            }
            else {
                document.getElementById("Password1").style.borderColor='#d9534f';
                showpassformat();
            }

            //checking if the password has at least 1 special character
            if (password1.match(passspecial)){
                document.getElementById("Password1").style.borderColor='dimgray';
                hidepassformat();
            }
            else {
                document.getElementById("Password1").style.borderColor='#d9534f';
                showpassformat();
            }
        }

    }

//validation of password format (sign up)
    function passwordformat() {
        var passnumber = new RegExp("(?=.*[0-9])");
        var passspecial = new RegExp("(?=.*[.,'`~!@#$%^&*])");
        var password = document.getElementById("Password1").value;
        var pass8char = new RegExp("(?=.{8,})");

        //checking if the password is at least 8 characters long
        if (password.match(pass8char)){
            document.getElementById("pass8Char").style.color='#5cb85c';
            document.getElementById("pass8char_checkcircle").style.display = 'none';
            document.getElementById("pass8char_circlefill").style.display = 'inline-block';
        }
        else {
            document.getElementById("pass8Char").style.color='#d9534f';
            document.getElementById("pass8char_checkcircle").style.display = 'inline-block';
            document.getElementById("pass8char_circlefill").style.display = 'none';
        }

        //checking if the password has at least 1 number
        if (password.match(passnumber)){
            document.getElementById("passNumber").style.color='#5cb85c';
            document.getElementById("passNumber_checkcircle").style.display = 'none';
            document.getElementById("passNumber_circlefill").style.display = 'inline-block';
        }
        else {
            document.getElementById("passNumber").style.color='#d9534f';
            document.getElementById("passNumber_checkcircle").style.display = 'inline-block';
            document.getElementById("passNumber_circlefill").style.display = 'none';
        }

        //checking if the password has at least 1 special character
        if (password.match(passspecial)){
            document.getElementById("passSpecialChar").style.color='#5cb85c';
            document.getElementById("passSpecialChar_checkcircle").style.display = 'none';
            document.getElementById("passSpecialChar_circlefill").style.display = 'inline-block';
        }
        else {
            document.getElementById("passSpecialChar").style.color='#d9534f';
            document.getElementById("passSpecialChar_checkcircle").style.display = 'inline-block';
            document.getElementById("passSpecialChar_circlefill").style.display = 'none';
        }
    }

    //checking if two passwords matches
    function passwordchecking() {
        var pass1 = document.getElementById("Password1").value;
        var pass2 = document.getElementById("Password2").value;

        if (pass1 != pass2){
            document.getElementById("passwordError").style.display= 'block';
            document.getElementById("Password1").style.borderColor='#d9534f';
            document.getElementById("Password2").style.borderColor='#d9534f';
        }
        else {
            document.getElementById("passwordError").style.display = 'none';
            document.getElementById("Password1").style.borderColor='dimgray';
            document.getElementById("Password2").style.borderColor='dimgray';
        }
    }

//summarized form input validation on sign up form submit
function SignUp_onSubmitInputValidation () {
    event.preventDefault();

    var regexname=/^([a-zA-Z ]{2,20})$/;
    var fname = document.getElementById("FirstName").value;
    var lname = document.getElementById("LastName").value;
    var password1 = document.getElementById("Password1").value;
    var password2 = document.getElementById("Password2").value;
    var passnumber = new RegExp("(?=.*[0-9])");
    var passspecial = new RegExp("(?=.*[.,'`~!@#$%^&*])");
    var pass8char = new RegExp("(?=.{8,})");
    var hasNoError = true;


    if (fname != "") {
        if (!fname.match(regexname)){
            hasNoError = false;
            document.getElementById("FormInput-ErrorText").innerText="Please follow correct first name format.";
            document.getElementById("FormInput-ErrorContainer").style.display = 'block';
            return hasNoError;
        }
    }
    else if (lname != "") {
        if (!lname.match(regexname)){
            hasNoError = false;
            document.getElementById("FormInput-ErrorText").innerText="Please follow correct last name format.";
            document.getElementById("FormInput-ErrorContainer").style.display = 'block';
            return hasNoError;
        }
    }
    else if (!password1.match(pass8char) && !password2.match(pass8char)){
        hasNoError = false;
        document.getElementById("FormInput-ErrorText").innerText="Please follow correct password format.";
        document.getElementById("FormInput-ErrorContainer").style.display = 'block';
        return hasNoError;
    }
    else if (!password1.match(passnumber) && !password2.match(passnumber)){
        hasNoError = false;
        document.getElementById("FormInput-ErrorText").innerText="Please follow correct password format.";
        document.getElementById("FormInput-ErrorContainer").style.display = 'block';
        return hasNoError;
    }
    else if (!password1.match(passspecial) && !password2.match(passspecial)){
        hasNoError = false;
        document.getElementById("FormInput-ErrorText").innerText="Please follow correct password format.";
        document.getElementById("FormInput-ErrorContainer").style.display = 'block';
        return hasNoError;
    }
    else if (password1 != password2){
        hasNoError = false;
        document.getElementById("FormInput-ErrorText").innerText="Password mismatch. Please check.";
        document.getElementById("FormInput-ErrorContainer").style.display = 'block';
        return hasNoError;
    }
    if (hasNoError == true) {
        hasNoError = true;
        event.currentTarget.submit();
        return hasNoError;
    }
}

//summarized form input validation on edit profile form submit
function EditProfile_onSubmitInputValidation () {
    event.preventDefault();

    var regexname=/^([a-zA-Z ]{2,20})$/;
    var fname = document.getElementById("Edit-FirstName").value;
    var lname = document.getElementById("Edit-LastName").value;
    var password1 = document.getElementById("Edit-CurrentPassword").value;
    var password2 = document.getElementById("Edit-NewPassword").value;
    var postalcode = document.getElementById("Edit-ZipCode").value;
    var phonenumber = document.getElementById("Edit-ContactNumber").value;
    var passnumber = new RegExp("(?=.*[0-9])");
    var passspecial = new RegExp("(?=.*[.,'`~!@#$%^&*])");
    var pass8char = new RegExp("(?=.{8,})");
    var hasNoError = true;

    //name checking
    if (fname != "") {
        if (!fname.match(regexname)){
            hasNoError = false;
            document.getElementById("EditProfileInput-ErrorText").innerText="Please follow correct first name format.";
            document.getElementById("EditProfileInput-ErrorContainer").style.display = 'block';
            return hasNoError;
        }
    }
    if (lname != "") {
        if (!lname.match(regexname)){
            hasNoError = false;
            document.getElementById("EditProfileInput-ErrorText").innerText="Please follow correct last name format.";
            document.getElementById("EditProfileInput-ErrorContainer").style.display = 'block';
            return hasNoError;
        }
    }

    //postal code checking
    if(postalcode.toString().length != 4 ) {
        hasNoError = false;
        document.getElementById("EditProfileInput-ErrorText").innerText="Postal code must be exactly 4 digits.";
        document.getElementById("EditProfileInput-ErrorContainer").style.display = 'block';
        return hasNoError;
    }

    //phone number checking
    if(phonenumber.toString().length != 11 ) {
        hasNoError = false;
        document.getElementById("EditProfileInput-ErrorText").innerText="Contact Number must be exactly 11 digits.";
        document.getElementById("EditProfileInput-ErrorContainer").style.display = 'block';
        return hasNoError;
    }

    //input checking for password changing
    if (password1 != "" && password2 == "" ){
        hasNoError = false;
        document.getElementById("EditProfileInput-ErrorText").innerText="Enter your new password.";
        document.getElementById("EditProfileInput-ErrorContainer").style.display = 'block';
        return hasNoError;
    }
    else if(password1 == "" && password2 !=""){
        hasNoError = false;
        document.getElementById("EditProfileInput-ErrorText").innerText="Enter your current password.";
        document.getElementById("EditProfileInput-ErrorContainer").style.display = 'block';
        return hasNoError;
    }
    else if (password1 != "" && password2 !=""){
            if (!password2.match(pass8char)){
                hasNoError = false;
                document.getElementById("EditProfileInput-ErrorText").innerText="Please follow correct password format.";
                document.getElementById("EditProfileInput-ErrorContainer").style.display = 'block';
                return hasNoError;
            }
            if (!password2.match(passnumber)){
                hasNoError = false;
                document.getElementById("EditProfileInput-ErrorText").innerText="Please follow correct password format.";
                document.getElementById("EditProfileInput-ErrorContainer").style.display = 'block';
                return hasNoError;
            }
            if (!password2.match(passspecial)){
                hasNoError = false;
                document.getElementById("EditProfileInput-ErrorText").innerText="Please follow correct password format.";
                document.getElementById("EditProfileInput-ErrorContainer").style.display = 'block';
                return hasNoError;
            }
    }

    //if no input errors has been detected, form submission will proceed
    if (hasNoError == true) {
        hasNoError = true;
        event.currentTarget.submit();
        return hasNoError;
    }
}

//validation of password format (edit profile)
function newpasswordformat() {
    var passnumber = new RegExp("(?=.*[0-9])");
    var passspecial = new RegExp("(?=.*[.,'`~!@#$%^&*])");
    var password = document.getElementById("Edit-NewPassword").value;
    var pass8char = new RegExp("(?=.{8,})");

    //checking if the password is at least 8 characters long
    if (password.match(pass8char)){
        document.getElementById("pass8Char").style.color='#5cb85c';
        document.getElementById("pass8char_checkcircle").style.display = 'none';
        document.getElementById("pass8char_circlefill").style.display = 'inline-block';
    }
    else {
        document.getElementById("pass8Char").style.color='#d9534f';
        document.getElementById("pass8char_checkcircle").style.display = 'inline-block';
        document.getElementById("pass8char_circlefill").style.display = 'none';
    }

    //checking if the password has at least 1 number
    if (password.match(passnumber)){
        document.getElementById("passNumber").style.color='#5cb85c';
        document.getElementById("passNumber_checkcircle").style.display = 'none';
        document.getElementById("passNumber_circlefill").style.display = 'inline-block';
    }
    else {
        document.getElementById("passNumber").style.color='#d9534f';
        document.getElementById("passNumber_checkcircle").style.display = 'inline-block';
        document.getElementById("passNumber_circlefill").style.display = 'none';
    }

    //checking if the password has at least 1 special character
    if (password.match(passspecial)){
        document.getElementById("passSpecialChar").style.color='#5cb85c';
        document.getElementById("passSpecialChar_checkcircle").style.display = 'none';
        document.getElementById("passSpecialChar_circlefill").style.display = 'inline-block';
    }
    else {
        document.getElementById("passSpecialChar").style.color='#d9534f';
        document.getElementById("passSpecialChar_checkcircle").style.display = 'inline-block';
        document.getElementById("passSpecialChar_circlefill").style.display = 'none';
    }
}



//Showing the container for user product cart and hiding pending and completed orders
function showproductcart(){
    //containers
    document.getElementById("productcartcontainer").style.display='block';
    document.getElementById("pendingorderscontainer").style.display='none';
    document.getElementById("completedorderscontainer").style.display='none';

    //tab design changes for product cart tab
    document.getElementById('cart-tab').style.paddingBottom='10px';
    document.getElementById('cart-tab').style.borderBottom='3px solid black';
    document.getElementById('cart-tab').style.color='black';
    document.getElementById('pendingorders-tab').style.paddingBottom='0px';
    document.getElementById('pendingorders-tab').style.borderBottom='0px';
    document.getElementById('pendingorders-tab').style.color='gray';
    document.getElementById('completedorders-tab').style.paddingBottom='0px';
    document.getElementById('completedorders-tab').style.borderBottom='0px';
    document.getElementById('completedorders-tab').style.color='gray';

}

//Showing the container for user pending orders and hiding product cart and completed orders
function showppendingorders(){
    document.getElementById("productcartcontainer").style.display='none';
    document.getElementById("pendingorderscontainer").style.display='block';
    document.getElementById("completedorderscontainer").style.display='none';

    //tab design changes for pending orders tab
    document.getElementById('cart-tab').style.paddingBottom='0px';
    document.getElementById('cart-tab').style.borderBottom='0px';
    document.getElementById('cart-tab').style.color='gray';
    document.getElementById('pendingorders-tab').style.paddingBottom='10px';
    document.getElementById('pendingorders-tab').style.borderBottom='3px solid black';
    document.getElementById('pendingorders-tab').style.color='black';
    document.getElementById('completedorders-tab').style.paddingBottom='0px';
    document.getElementById('completedorders-tab').style.borderBottom='0px';
    document.getElementById('completedorders-tab').style.color='gray';
}

//Showing the container for user completed orders and hiding product cart and pending orders
function showpcompletedorders(){
    document.getElementById("productcartcontainer").style.display='none';
    document.getElementById("pendingorderscontainer").style.display='none';
    document.getElementById("completedorderscontainer").style.display='block';

    //tab design changes for completed orders tab
    document.getElementById('cart-tab').style.paddingBottom='0px';
    document.getElementById('cart-tab').style.borderBottom='0px';
    document.getElementById('cart-tab').style.color='gray';
    document.getElementById('pendingorders-tab').style.paddingBottom='0px';
    document.getElementById('pendingorders-tab').style.borderBottom='0px';
    document.getElementById('pendingorders-tab').style.color='gray';
    document.getElementById('completedorders-tab').style.paddingBottom='10px';
    document.getElementById('completedorders-tab').style.borderBottom='3px solid black';
    document.getElementById('completedorders-tab').style.color='black';
}

function hideIncompleteInfoNotice() {
    document.getElementById('IncInfoError-MainContainer').style.display='none';
}

