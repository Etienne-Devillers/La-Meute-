
<section class="adminListUserContainer">

<span><a href="<?=$_SERVER['HTTP_REFERER'] ?? '/admin'?>" class="returnLink">&larr; Retour</a></span>
<h1 class="userListTitle">Liste des utilisateurs</h1>

<form class="optionField" action="<?=$_SERVER['PHP_SELF']?>"> 
    <label for="userPerPage">Utilisateur à afficher :</label>
    <select name="userPerPage" id="userPerPage">
        <option value="25">25</option>
        <option value="50">50</option>
        <option value="75">75</option>
    </select>

    <input type="text" name="search"> 
    <button type="submit">Chercher</button>
    <span class="pageSelector">
        <?php if ($pages > 1) { ?>
        <a href="/controllers/admin/admin-list-user-controller.php?userPerPage=<?=$perPage?>&search=<?=$search?>&page=<?=($currentPage>1)?$currentPage-1:$currentPage;?>">&laquo;</a>
        <?php for ($i=1; $i <= $pages; $i++) { ?> 

        <a href="/controllers/admin/admin-list-user-controller.php?userPerPage=<?=$perPage?>&search=<?=$search?>&page=<?=$i?>"<?= ($i == $currentPage)? 'class="actualPage" ':'';?>> <?=$i?> </a>

        <?php } ?>

        <a href="/controllers/admin/admin-list-user-controller.php?userPerPage=<?=$perPage?>&search=<?=$search?>&page=<?=($currentPage<$pages)?$currentPage+1:$currentPage;?>">&raquo;</a>

        <?php } ?>
    </span>
    </form>
<table>
    <thead> 
        <tr>
            <th>id</th>
            <th>role</th>
            <th>Nom</th>
            <th>Prénom</th>
            <th>Mail</th>
            <th>Username</th>
            <th>N° de tél</th>
            <th>inscris depuis</th>
            <th>mail validé</th>
            <th>dernière connexion</th>
            <th></th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?php  foreach ($userList as $key => $value) { ?>

            <tr>
                <td> <?=$value->id?> </td>
                <td> <?=$value->role?> </td>
                <td> <?=$value->lastname?> </td>
                <td> <?=$value->firstname?> </td>
                <td> <?=$value->mail?> </td>
                <td> <?=$value->username?> </td>
                <td> <?=$value->phonenumber?> </td>
                <td> <?=$value->registered_at?> </td>
                <td> <?=($value->validated_at !== null) ? 'Validé': '---';?> </td>
                <td> <?=$value->connected_at?> </td>
                <td><a href="/controllers/admin/admin-show-profil-controller.php?mail=<?=$value->mail?>"><button>Voir</button></a> </td>
                <td><a href="/controllers/admin/delete-user-controller.php?id=<?=$value->id?>"><button>Supprimer</button></a> </td>
            </tr>
        
        <?php } ?>
    </tbody>
</table>
</section>