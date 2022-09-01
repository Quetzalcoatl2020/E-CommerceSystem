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
    document.getElementById("pass8Char").style.visibility = 'visible';
    document.getElementById("passSpecialChar").style.visibility = 'visible';
    document.getElementById("passNumber").style.visibility = 'visible';
    ;
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
    }
    else {
        document.getElementById("pass8Char").style.color='#d9534f';
    }

    //checking if the password has at least 1 number
    if (password.match(passnumber)){
        document.getElementById("passNumber").style.color='#5cb85c';
    }
    else {
        document.getElementById("passNumber").style.color='#d9534f';
    }

    //checking if the password has at least 1 speciall character
    if (password.match(passspecial)){
        document.getElementById("passSpecialChar").style.color='#5cb85c';
    }
    else {
        document.getElementById("passSpecialChar").style.color='#d9534f';
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