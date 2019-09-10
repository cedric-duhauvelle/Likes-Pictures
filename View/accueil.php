<div id="content_accueil">
    <div class="starter-template">
        <h1>Accueil</h1>
        <p class="lead">Nouveautés</p>
        <div>
            <?php
            foreach ($pictures as $picture) {
            ?>
            <div class="col-ms-8 content_new_post">
                <div class="content_avatar_post">
                    <figure>
                        <img src="../Public/img/upload/avatar/avatar<?= $picture->getUser()->getId(); ?>.jpg" class="avatar_post" />
                    </figure>
                    <p><?= $picture->getUser()->getName(); ?></p>
                </div>
                <div class="content_picture_post">
                    <figure class="picture_post">
                        <a class="fancybox" rel="group" href="img/upload/picture/<?= $picture->getTitle() . $picture->getId(); ?>.jpg">
                            <img src="img/upload/picture/<?= $picture->getTitle() . $picture->getId(); ?>.jpg" alt = "<?= $picture->getTitle(); ?>" class="picture_post"/>
                        </a>
                    </figure>
                    <div class="content_icone_post">
                        <span class="far fa-thumbs-up"></span>
                        <span class="fas fa-flag"></span>
                    </div>
                </div>
                <div class="content_info_post">
                    <p>commentaires</p>
                    <p>Publiée le <?= date_format(date_create($picture->getUpload()), 'd/m/Y à H:i:s'); ?> </p>
                </div>
            </div>
            <?php
            }
            ?>
        </div>
    </div>
</div>
<script type = "text / javascript" src = "/fancybox/lib/jquery.mousewheel-3.0.6.pack.js" ></script>