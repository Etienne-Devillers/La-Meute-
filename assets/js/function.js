// Fonction qui s'occupe de la navbar qui change au scroll
function navBarAttached() {
    if (document.documentElement.scrollTop > 50) {
        document.querySelector('.navBar').classList.add('fixed')
        document.querySelector('.logoNavBar').classList.add('logoNavBarFixed')
    } else {
        document.querySelector('.navBar').classList.remove('fixed')
        document.querySelector('.logoNavBar').classList.remove('logoNavBarFixed')
    }
}

//Fonction qui calcul la position de la section et qui affiche le texte en fonction.

function appearText() {
    if (functionToggler === 'stopfunction') {    //création d'un if pour empecher les executions suivantes de la fonction
        return;
    } else {
        var gameCollectionOffset = document.querySelector('.gameCollectionSection')?.getBoundingClientRect();
    }
    if (gameCollectionOffset?.top < window.screen.availHeight * 0.40) {
        let delay = 0;
        playLearnImprove.forEach(element => {

            element.style.animation = 'appearingText 400ms ease forwards';
            element.style.animationDelay = delay + 'ms';
            delay += 200;
        });
        functionToggler = 'stopfunction'  // on change la valeur du toggler pour empecher les prochaines executions de la fonction
    }
}