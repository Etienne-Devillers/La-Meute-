<section class="getCoaching">


    <div id="calendar"></div>
    <div class="rightSideGetCoaching">
        <h5>Disponibilités - <span class="coachName"><?=$coachName ?? ''?></span></h5>
        <div id="coachingSlots">
        <div class="displayCoachingMsg">
            <?=SessionFlash::display('message') ?? ''
        ?>
        </div>
                

    </div>
</section>

<script src="/assets/library/fullCalendar/main.min.js"></script>
<script src="/assets/library/fullCalendar/locales-all.min.js"></script>

<script src="/assets/js/calendar.js"></script>