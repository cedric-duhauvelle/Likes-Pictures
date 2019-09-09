<div id="content_accueil">
    <div class="starter-template">
        <h1>Accueil</h1>
        <p class="lead">Nouveautés</p>
        <div>
            <?php
            foreach ($pictures as $picture) {
            ?>
            <div class="col-ms-8 content_new_home">
                <div>
                    <figure class="col-ms-8">
                        <img src="../Public/img/upload/avatar/avatar<?= $picture->getUser()->getId(); ?>.jpg" class="avatar_home" />
                    </figure>
                    <p class="col-ms-4"><?= $picture->getUser()->getName(); ?></p>
                </div>

                <figure>
                    <img src="img/upload/picture/<?= $picture->getTitle() . $picture->getId(); ?>.jpg" class="picture_home" />
                </figure>
                <div>
                    <p>Publiée le <?= date_format(date_create($picture->getUpload()), 'd/m/Y à H:i:s'); ?> </p>
                </div>
            </div>
            <?php
            }
            ?>
        </div>
    </div>
</div>