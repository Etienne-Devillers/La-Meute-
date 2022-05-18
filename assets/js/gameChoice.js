const gameChoiceList = document.querySelectorAll('.gameChoice');
const gameBanner = document.getElementById('gameImg');

for (let i = 1; i <= gameChoiceList.length; i++) {

    gameChoiceList[i-1].addEventListener('click', function () {

    this.classList.add('selectedGame');
    let imgUrl = window.getComputedStyle(this);
    imgUrl = imgUrl.getPropertyValue('background-image');


    for (let j = 1; j <= gameChoiceList.length; j++) {
        if (j !=i ) {
            gameChoiceList[j-1].classList.remove('selectedGame');
        }
    }

    gameBanner.style.backgroundImage = imgUrl;
    })
}