import {baseUrl} from './baseurl.js';

const get_user_info = JSON.parse(localStorage.getItem('user_data'));
console.log(get_user_info);
//Clientside confirmation of user from the localstorage
const {user} = get_user_info;
if(user.token) {
    //Serverside Confirming using ajax
        const url = `${baseUrl}/dashboard.php`;
        //The token is the user jwt token gotten from the backend and stored in the localstorage
        const token = user.token;
        var settings = {
            "url": url,
            "method": "GET",
            "headers": {
            "key": "verifying_user",
            "Authourization": "Bearer "+ token
            }
        };
        $.ajax(settings).done(function (response) {
            const {ok, message, user} = JSON.parse(response);
            console.log(user, message);
        }).fail(function (err) {
           //Redirect to login page there is any sort of error
           if(err){
            const {key, message} = JSON.parse(err.responseText);
            if(err.status == 401 && key == "verifying_user") {
                Swal.fire(`<p style="font-size:15px; color:red;">${message}</p>`);
                setTimeout( () => {
                    location.replace('signin.html');
                }, 2000);  
            }
           }
        });
        //Input the user data from loaction into the DOM
        document.querySelector('[data-fullname]').textContent = user.fullname;
        document.querySelector('[data-username]').textContent = user.username;
        document.querySelector('[data-email]').textContent = user.email;

        }else {
            //Redirect to login page if no token was found in the localstorage
            location.replace('signin.html');
        }



