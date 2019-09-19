
import {baseUrl} from "./baseurl.js";
//Get the sign up form

$(document).on('submit', '#sign-up-form', function (e) {
    e.preventDefault();
    console.log(e);
    //Get the all error fields from the form and map through to diaplay as none 
    //Use Array.from() to convert from a nodelist to an array so i can iterate through as an array
    const errors = Array.from(document.querySelectorAll('.error_field'));
    errors.map(error => error.style.display = "none");

    //we use formdata class to get form values through the name attribute
    const fullname = $("#fullname").val();
    const username = $("#username").val();
    const email = $("#email").val();
    const password = $("#password").val();
    const repeat_password = $("#repeat-password").val();

    //validated the input values from the form
    if (fullname == "") {
        document.querySelectorAll('.error_field')[0].style.display = "block";
		document.querySelectorAll('.error_field')[0].textContent = "Fullname field is required!";
    }
    // else if(username == "") {
    //     document.querySelectorAll('.error_field')[1].style.display = "block";
	// 	document.querySelectorAll('.error_field')[1].textContent = "Username field is required!";	
    // }
    else if(email == "") {
        document.querySelectorAll('.error_field')[2].style.display = "block";
		document.querySelectorAll('.error_field')[2].textContent = "Email field is required(a valid email should be used)!";	
	}else if( password == ""){
        document.querySelectorAll('.error_field')[3].style.display = "block";
		document.querySelectorAll('.error_field')[3].textContent = "Password field is required(secure password should be used)!";
	}else if( password !=  repeat_password){
        document.querySelectorAll('.error_field')[3].style.display = "block";
		document.querySelectorAll('.error_field')[3].textContent = "Password do not match!";
	}else {
   
        //this the web api link or directory (it was imported into this script)
        const url = `${baseUrl}/signup.php`;
        const  data = {
            'fullname':  fullname,
            'username': username,
            'email': email,
            'password': password,
            'repeat_password':  repeat_password 
        }
        console.log(data)
        var settings = {
            "url": url,
            "method": "POST",
            "timeout": 0,
            "headers": {
              "Content-Type": "application/x-www-form-urlencoded"
            },
            "data": data
          };
          $.ajax(settings).done(function (response) {
              console.log(response)
              const {ok, message} = JSON.parse(response);
              if(ok) {
                Swal.fire(`<p style="font-size:15px; color:green;">${message}</p>`)
                setTimeout( () => {
                    location.replace('signin.html');
                }, 2000);              }

          }).fail(function (err) {
            if (err) {
                const {message} = JSON.parse(err.responseText);
                console.log(message)
                Swal.fire(`<p style="font-size:15px; color:red;">${message}</p>`)
            }
          });
    }
});
