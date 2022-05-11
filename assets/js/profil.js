let updateProfilBtn = document.querySelector('.updateProfil');
let inputList = document.querySelectorAll('.formField');
let submitBtn = document.querySelector('.submitBtn');
console.log(updateProfilBtn);

updateProfilBtn.addEventListener('click', () => {

    inputList.forEach(element => {
    
    if (element.type != 'email') {
        element.disabled = false;
        element.classList.add('fieldActive');
    }
    console.log(element);


    if (element.placeholder == 'non renseigné'){
        element.placeholder = '';
    }

    });

    submitBtn.style.display = "block";
})