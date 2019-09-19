const get_user_info = JSON.parse(localStorage.getItem('user_data'));
console.log(get_user_info);
const {user} = get_user_info;
if(user.token) {
    document.querySelector('[data-fullname]').textContent = user.fullname;
    document.querySelector('[data-username]').textContent = user.username;
    document.querySelector('[data-email]').textContent = user.email;
}else {
    location.replace('signin.html')
}


