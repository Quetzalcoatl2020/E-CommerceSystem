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
function firstnamevalidate(){
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

function showpassformat() {
    document.getElementById("pass8Char").style.display='block';
    document.getElementById("passSpecialChar").style.display='block';
    document.getElementById("passNumber").style.display='block';
}
function hidepassformat() {
    document.getElementById("pass8Char").style.display='none';
    document.getElementById("passSpecialChar").style.display='none';
    document.getElementById("passNumber").style.display='none';
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

    if (pass1 != pass2) {
        document.getElementById("passwordError").style.display= 'block';
    }
    else {
        document.getElementById("passwordError").style.display = 'none';
    }
}

