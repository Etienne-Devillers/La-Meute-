const playLearnImprove = document.querySelectorAll('span h6')
let functionToggler = 'go'










// Partie NAvBar 


navBarAttached()  // On lance ces fonctions à l'initialisation au cas ou le visiteur n'est pas en haut de page

if (document.querySelector('.gameCollectionSection')){
appearText()
}


window.addEventListener('scroll', () => {
    navBarAttached()
})

document.querySelector('.burgerMenu').addEventListener('click', () => {
    console.log('bonjour')
    document.querySelector('.sideNavBarContainer').classList.add('active');
    document.querySelector('.sideNavBar').classList.add('sideNavBarActive');
})

document.querySelector('.sideNavBarContainer').addEventListener('click', () => {
    document.querySelector('.sideNavBar').classList.remove('sideNavBarActive');

    document.querySelector('.sideNavBarContainer').classList.remove('active');

})

document.querySelector('.sideNavBarContainer').addEventListener('click', () => {
    document.querySelector('.sideNavBarContainer').classList.remove('active');
})


// Apparition du texte "jouez, apprennez, progressez"





window.addEventListener('scroll', () => {
    appearText()
});

let gameChoice = document.querySelectorAll('.gameDisplay');


for (let index = 1; index <= gameChoice.length; index++) {
    gameChoice[index-1].addEventListener('mouseenter', ()=>{
        document.querySelector('.playLearnImproveContainer+a').href = '/choix-du-jeu?game='+index
    })
    


}
