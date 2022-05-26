const mail = document.getElementById('email');
const username = document.getElementById('username');
const pwd1 = document.getElementById('pwd');
const pwd2 = document.getElementById('confirmPwd');
const pwdImg = document.querySelector('.pwdImg');
const regexPwd = /.*^(?=.{8,30})(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*\W).*$/ ;
const regexUsername = /^[A-Za-z-éèêëàâäôöûüç'_0-9 -]{3,20}$/ ;


pwd1.addEventListener('input', () => {
    console.log(pwd1.value.length)
    if (pwd1.value == pwd2.value && pwd1.value.match(regexPwd) != null) {
        document.documentElement.style.setProperty('--borderColor', 'rgba(10, 255, 2, 1)');
        } else {
        document.documentElement.style.setProperty('--borderColor', '#e8303d');
        }
        if (pwd1.value.length == 0) {
            document.documentElement.style.setProperty('--borderColor', 'transparent');
        }
    }
)

pwd2.addEventListener('input', () => {
    console.log(pwd1.value.length)
    if (pwd1.value == pwd2.value && pwd2.value.match(regexPwd) != null) {
        document.documentElement.style.setProperty('--borderColor', 'rgba(10, 255, 2, 1)');
        } else {
        document.documentElement.style.setProperty('--borderColor', '#e8303d');
        }
        if (pwd2.value.length == 0) {
            document.documentElement.style.setProperty('--borderColor', 'transparent');
        }
    })

mail.addEventListener('input', () =>{

    if( mail.value.length > 6){

        fetch(`/controllers/ajax/register-ajax-controller.php?mail=${mail.value}`)

        
        .then(function(response){
            return response.json();
        })

        .then(function(datas){
        
                if (datas == 'mail available') {
                    document.documentElement.style.setProperty('--mailBorderColor', 'rgba(10, 255, 2, 1)');
                } else {
                    document.documentElement.style.setProperty('--mailBorderColor', '#e8303d');
                }
        });
    }
    if (mail.value.length == 0) {
        document.documentElement.style.setProperty('--mailBorderColor', 'transparent');
    }
})

username.addEventListener('input', () =>{

    if( username.value.match(regexUsername) != null){
console.log(username.value.match(regexUsername));
        fetch(`/controllers/ajax/register-ajax-controller.php?username=${username.value}`)

        .then(function(response){
            return response.json();
        })

        .then(function(datas){
        
                if (datas == 'username available') {
                    document.documentElement.style.setProperty('--usernameBorderColor', 'rgba(10, 255, 2, 1)');
                } else {
                    document.documentElement.style.setProperty('--usernameBorderColor', '#e8303d');
                }
        });
    } else {
        document.documentElement.style.setProperty('--usernameBorderColor', '#e8303d');
    }

    if (username.value.length == 0) {
        document.documentElement.style.setProperty('--usernameBorderColor', 'transparent');
    }
})

pwdImg.addEventListener('click', () => {

    if (pwd1.type == 'password') {
        pwd1.type = 'text';
        pwd2.type = 'text';
        pwdImg.src = '/assets/img/eye-slash-solid.svg';
    } else {
        pwd1.type = 'password';
        pwd2.type = 'password';
        pwdImg.src = '/assets/img/eye-solid.svg';
    }
})





