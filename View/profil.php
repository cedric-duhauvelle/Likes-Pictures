<div id="content_profil" class="container">

    <div class="row" id="content_profil">
        <ul class="tabs">
            <li class="active"><a href="#profil">Profil</a></li>
            <li><a href="#photos">Photos</a></li>
            <li><a href="#update">Update</a></li>
        </ul>
        <div class="tabs_content">
            <div id="profil" class="tab_content active">
                <h1>Profil</h1>
                <div id="profil_info" class="col-lg-9">
                    <p><?= $user->getName(); ?></p>
                    <p><?= $user->getEmail(); ?></p>
                    <p>Inscrit depuis le <?= date_format(date_create($user->getInscription()), 'd/m/Y à H:i:s');;  ?></p>
                </div>
                <div class="col-lg-3">
                    <img src="../Public/img/upload/avatar/avatar<?= $_SESSION['id']; ?>.jpg" id="avatar_profil" />
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
            <div class="tab_content" id="photos">
                <h1>Photos</h1>
                <?php
                foreach ($pictures as $picture) {
                    ?>
                    <img src="img/upload/picture/<?= $picture->getTitle() . $picture->getId(); ?>.jpg" class="picture_profil" />
                    <?php
                }
                ?>
            </div>
            <div class="tab_content" id="update">
                <h1>Update</h1>
                <p>Bientôt ici sera placé la modification de profil</p>
            </div>
        </div>
    </div>

</div>
<script src="../Public/js/tabs.js"></script>
