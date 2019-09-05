<div id="content_profil" class="container">
    <h1>Profil</h1>
    <div class="row">
        <div id="profil">
            <div id="profil_info" class="col-lg-9">
                <p><?= $user->getName(); ?></p>
                <p><?= $user->getEmail(); ?></p>
                <p>Inscrit depuis le <?= date_format(date_create($user->getInscription()), 'd/m/Y à H:i:s');;  ?></p>
            </div>
            <div class="col-lg-3">
                <img src="../Public/img/upload/avatar/avatar<?= $_SESSION['id']; ?>.jpg" id="avatar_profil" />
            </div>
        </div>
        <div>
            <form action="PictureController" method="POST" enctype="multipart/form-data">
                <label for="file">Sélectionner un Avatar: </label>
                <input type="hidden" name="MAX_FILE_SIZE" value="2097152" />
                <input type="file" id="file" name="file" />
                <input type="submit" />
            </form>
        </div>
        <p><a href="DeconnexionController">Déconnexion</a></p>
    </div>
    <div>

    </div>
</div>
