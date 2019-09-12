<div id="content_accueil">
    <div class="starter-template">
        <h1>Accueil</h1>
        <p class="lead">Nouveautés</p>

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
            <div class="content_info_post">
                <p>Publiée le <?= date_format(date_create($picture->getUpload()), 'd/m/Y à H:i'); ?></p>
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
            <div>
                <?php
                $comments = $commentManager->getCommentByPicture($picture->getId());
                if(!empty($comments) || array_key_exists('id', $_SESSION)) {
                ?>
                    <button class="comment_button_post btn btn-primary" type="button" onclick="displayComment(<?= $picture->getId(); ?>)">commentaires</button>
                <?php
                }
                ?>

                <div class="comment_content_post post<?= $picture->getId() ?>">
                    <?php
                        foreach ($comments as $comment) {
                            if ($comment) {
                    ?>
                    <div class="comment_picture_post">
                        <figure class="comment_user">
                            <img src="../Public/img/upload/avatar/avatar<?= $comment->getUser()->getId(); ?>.jpg" alt="avatar" class="picture_comment" />
                            <p><?= $comment->getUser()->getName(); ?></p>
                        </figure>
                        <div class="comment_content">
                            <div class="arrow-left"></div>
                            <p>Le <?= date_format(date_create($comment->getPublished()), 'd/m/Y à H:i'); ?></p>
                            <p id="comment_post<?= $comment->getId(); ?>"><?= $comment->getContent(); ?></p>
                        </div>
                    </div>

                    <?php
                            }
                        }

                        if (array_key_exists('id', $_SESSION)) {
                            include('Template/comment.php');
                        }
                    ?>

                </div>

            </div>
        </div>
        <?php
        }
        ?>
    </div>
</div>
<script src = "../Public/js/displayComment.js" ></script>
<script type = "text / javascript" src = "/fancybox/lib/jquery.mousewheel-3.0.6.pack.js" ></script>
