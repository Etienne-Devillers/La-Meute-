
<section class="adminListUserContainer">

<a href="<?=$_SERVER['HTTP_REFERER'] ?? '/admin'?>" class="returnLink">&larr; Retour</a>
<h1 class="userListTitle">Liste des utilisateurs</h1>

<form class="optionField" action="<?=$_SERVER['PHP_SELF']?>"> 
    <label for="userPerPage">Utilisateur à afficher :</label>
    <select name="userPerPage" id="userPerPage">
        <option value="25">25</option>
        <option value="50">50</option>
        <option value="75">75</option>
    </select>

    <?php if ($pages > 1) { ?>

        <a href="#">&laquo;</a>

        <?php for ($i=1; $i <= $pages; $i++) { ?> 

                <a href="#" <?= ($i == $pages)? 'class="active" ':'';?>> <?=$i?> </a>

        <?php } ?>

                <a href="#">&raquo;</a>

    <?php } ?>

    <input type="text" name="search"> 
    <button type="submit">Chercher</button></form>
<table>
    <thead> 
        <tr>
            <th>id</th>
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
                <td> <?=$value->lastname?> </td>
                <td> <?=$value->firstname?> </td>
                <td> <?=$value->mail?> </td>
                <td> <?=$value->username?> </td>
                <td> <?=$value->phonenumber?> </td>
                <td> <?=$value->registered_at?> </td>
                <td> <?=($value->validated_at !== null) ? 'Validé': '---';?> </td>
                <td> <?=$value->connected_at?> </td>
                <td><button>Voir</button> </td>
                <td><a href="/controllers/admin/delete-user-controller.php?id=<?=$value->id?>"><button>supprimer</button></a> </td>
            </tr>
        
        <?php } ?>
    </tbody>
</table>
</section>