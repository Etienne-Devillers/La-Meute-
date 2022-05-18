const gameChoiceList = document.querySelectorAll('.gameChoice');
const gameBanner = document.getElementById('gameImg');
const coachContainer = document.querySelector('.coachSelection');

for (let i = 1; i <= gameChoiceList.length; i++) {

    gameChoiceList[i - 1].addEventListener('click', function () {

        this.classList.add('selectedGame');
        let imgUrl = window.getComputedStyle(this);
        imgUrl = imgUrl.getPropertyValue('background-image');


        for (let j = 1; j <= gameChoiceList.length; j++) {
            if (j != i) {
                gameChoiceList[j - 1].classList.remove('selectedGame');
            }
        }

        gameBanner.style.backgroundImage = imgUrl;

        coachContainer.innerHTML = ''

        fetch('/controllers/ajax/coach-choice-ajax-controller.php?game=' + i)
            .then(function (response) {
                return response.json()
            })

            .then(function (datas) {
                console.log(datas);

                datas.forEach(element => {

                    coachContainer.innerHTML +=

                        `<div class="coachBox">
            <div class="leftSideCoachBox">
                <div class="coachImg"><img src="/assets/img/profil-img/${element.username}.jpg" alt=""></div>
                <div class="coachBtn">
                    <a href="/reserver-un-coaching?coachId=${element.id}"><button>Réserver</button></a>
                </div>
            </div>
    
            <div class="rightSideCoachBox">
                <div class="coachName">${element.username}</div>
                <div class="coachDesc">
                    Lorem ipsum, dolor sit amet consectetur adipisicing elit. Perspiciatis iste laboriosam, vel omnis
                    dicta magnam fugit nemo tempore, beatae quisquam quaerat pariatur libero veniam corrupti facere
                    veritatis totam nostrum numquam?
                </div>
            </div>
    
        </div>`

                });
            })

    })
}