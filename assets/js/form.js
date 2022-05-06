let mail = document.getElementById('email');
let username = document.getElementById('username');
let pwd1 = document.getElementById('pwd');
let pwd2 = document.getElementById('confirmPwd');
const regexpwd = new RegExp('/.*^(?=.{8,30})(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*\W).*$/');
pwd1.addEventListener('input', () => {
    console.log(pwd1.value.length)
    if (pwd1.value == pwd2.value && pwd1.value.length >= 8 && pwd2.value.length >=8) {
        document.documentElement.style.setProperty('--borderColor', 'rgba(10, 255, 2, 1)');
        } else {
        document.documentElement.style.setProperty('--borderColor', '#e8303d');
        }
    }
)

pwd2.addEventListener('input', () => {
    console.log(pwd1.value.length)
    if (pwd1.value == pwd2.value && pwd1.value.length >= 8 && pwd2.value.length >=8) {
        document.documentElement.style.setProperty('--borderColor', 'rgba(10, 255, 2, 1)');
        } else {
        document.documentElement.style.setProperty('--borderColor', '#e8303d');
        }
    }
)

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

})




