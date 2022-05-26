// {/* <script> */ }
const form = document.getElementById('form');
const fname = document.getElementById('username');
const lname = document.getElementById('lname');
const pnum = document.getElementById('pnum');
const Nnum = document.getElementById('Nnum');
const email = document.getElementById('email');
const password = document.getElementById('password');
const password2 = document.getElementById('password2');
const btn = document.getElementById('btn');

var ons;

function retons() {
    return ons;
}

function setErrorFor(input, message) {
    const formControl = input.parentElement;
    const small = formControl.querySelector('small');
    formControl.className = 'form-control error';
    small.innerText = message;
    // btn.addEventListener("click", function (event) {
    //     event.preventDefault();
    // });
    return false;
}

function setSuccessFor(input) {
    const formControl = input.parentElement;
    formControl.className = 'form-control success';
    const small = formControl.querySelector('small');
    small.innerText = "";
    return true;
}

function checkInputs() {
    // trim to remove the whitespaces
    const fnamevalue = fname.value.trim();
    const lnameValue = lname.value.trim();
    const pnumValue = pnum.value.trim();
    const NnumValue = Nnum.value.trim();
    const emailValue = email.value.trim();
    const passwordValue = password.value.trim();
    const password2Value = password2.value.trim();

    if (fnamevalue == '') {
        setErrorFor(fname, 'First Name cannot be blank');
    } else {
        setSuccessFor(fname);
    }

    if (lnameValue === '') {
        setErrorFor(lname, 'Last Name cannot be blank');
    } else {
        setSuccessFor(lname);
    }

    if (pnumValue === '') {
        setErrorFor(pnum, 'Phone Number cannot be blank');
    } else {
        setSuccessFor(pnum);
    }

    if (NnumValue === '') {
        setErrorFor(Nnum, 'National Number cannot be blank');
    } else {
        setSuccessFor(Nnum);
    }

    if (emailValue === '') {
        setErrorFor(email, 'Email cannot be blank');
    } else {
        setSuccessFor(email);
    }

    if (passwordValue === '') {
        setErrorFor(password, 'Password cannot be blank');
    } else {
        setSuccessFor(password);
    }

    if (password2Value === '') {
        setErrorFor(password2, 'Confirm Password cannot be blank');
    } else {
        setSuccessFor(password2);
    }

    if (passwordValue !== password2Value) {
        setErrorFor(password2, 'Passwords does not match');
        return false;
    } else {
        setSuccessFor(password2);
    }
}
// {/* </script> */ }