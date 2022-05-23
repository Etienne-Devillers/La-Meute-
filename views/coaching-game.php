<section id="pickGame">


    <div class="pickGameHeader">
        <div class="separatorGameSelection"></div>
        <div class="chooseYourCoach" >Choisissez votre jeu</div>
        <div class="separatorGameSelection"></div>
    </div>

    <div class="gameSelector">

        <div class="game1 gameChoice <?=($gameId == 1)? 'selectedGame' : '' ?>"></div>
        <div class="game2 gameChoice <?=($gameId == 2)? 'selectedGame' : '' ?>"></div>
        <div class="game3 gameChoice <?=($gameId == 3)? 'selectedGame' : '' ?>"></div>
        <div class="game4 gameChoice <?=($gameId == 4)? 'selectedGame' : '' ?>"></div>
        <div class="game5 gameChoice <?=($gameId == 5)? 'selectedGame' : '' ?>"></div>
    </div>
</section>

<section id="gameImg" >

</section>



<section id="pickCoach">

    <div class="pickCoachHeader">
        <div class="separatorGameSelection"></div>
        <div class="chooseYourCoach">Choisissez votre coach</div>
        <div class="separatorGameSelection"></div>
    </div>


    <div class="coachSelection">

        

    </div>

</section>

<script src="/assets/js/gameChoice.js"></script>