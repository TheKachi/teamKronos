
import {baseUrl} from "./baseurl.js";
//Get the sign up form

$(document).on('submit', '#sign-in-form', function (e) {
    e.preventDefault();
    //Get the all error fields from the form and map through to diaplay as none 
    //Use Array.from() to convert from a nodelist to an array so i can iterate through as an array
    const errors = Array.from(document.querySelectorAll('.error_field'));
    errors.map(error => error.style.display = "none");

    const username = $("#user1").val();
    const password = $("#psw1").val();

    //validated the input values from the form
    if(username == "") {
        document.querySelectorAll('.error_field')[0].style.display = "block";
		document.querySelectorAll('.error_field')[0].textContent = "Username field is required!";	
    }else 
    if( password == ""){
        document.querySelectorAll('.error_field')[1].style.display = "block";
		document.querySelectorAll('.error_field')[1].textContent = "Password field is required(secure password should be used)!";
	}else {
   
        //this the web api link or directory (it was imported into this script)
        const url = `${baseUrl}/signin.php`;
        const  data = {
            'user_permit': username,
            'password': password
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
              const {ok} = JSON.parse(response);
              if(ok) {
                    localStorage.setItem('user_data', response);
                    location.replace('dashboard.html');
                }           
          }).fail(function (err) {
            if (err) {
                const {message} = JSON.parse(err.responseText);
                console.log(message)
                Swal.fire(`<p style="font-size:15px; color:red;">${message}</p>`)
            }
          });
    }
});
