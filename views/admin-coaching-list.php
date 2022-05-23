
<section class="adminListUserContainer">

<span><a href="<?=$_SERVER['HTTP_REFERER'] ?? '/admin'?>" class="returnLink">&larr; Retour</a></span>
<h1 class="userListTitle">Liste des coaching</h1>

<form class="optionField" action="<?=$_SERVER['PHP_SELF']?>"> 
    <label for="userPerPage">coaching à afficher :</label>
    <select name="userPerPage" id="userPerPage">
        <option value="25">25</option>
        <option value="50">50</option>
        <option value="75">75</option>
    </select>

    <input type="text" name="search"> 
    <button type="submit">Chercher</button>
    <span class="pageSelector">
        <?php if ($pages > 1) { ?>
        <a href="/controllers/admin/admin-coaching-list-controller.php?userPerPage=<?=$perPage?>&search=<?=$search?>&page=<?=($currentPage>1)?$currentPage-1:$currentPage;?>">&laquo;</a>
        <?php for ($i=1; $i <= $pages; $i++) { ?> 

        <a href="/controllers/admin/admin-coaching-list-controller.php?userPerPage=<?=$perPage?>&search=<?=$search?>&page=<?=$i?>"<?= ($i == $currentPage)? 'class="actualPage" ':'';?>> <?=$i?> </a>

        <?php } ?>

        <a href="/controllers/admin/admin-coaching-list-controller.php?userPerPage=<?=$perPage?>&search=<?=$search?>&page=<?=($currentPage<$pages)?$currentPage+1:$currentPage;?>">&raquo;</a>

        <?php } ?>
    </span>
    </form>
    <table class="coachingTable">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Horaire</th>
                            <th>Jeu</th>
                            <th>Utilisateur</th>
                            <th>Coach</th>
                            <th></th>
                            
                        </tr>
                
                    </thead>
                
                    <tbody>

                        <?php foreach ($coachingList as $key => $value) { ?>

                            <tr class="<?=(isset($value->datePast))?'outdated':'';?>">
                                <th><?=$value->date?></th>
                                <th><?=$value->slot?></th>
                                <th><?=$value->gamename?></th>
                                <th><?=$value->username?></th>
                                <th><?=$value->coachname?></th>
                                <th><button>voir le détail</button></th>
                            </tr>
                        <?php  } ?>
                        


                    </tbody>
                </table>
</section>