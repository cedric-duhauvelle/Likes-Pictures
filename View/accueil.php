<div id="content_accueil">
    <div class="starter-template">
        <h1>Accueil</h1>
        <p class="lead">Nouveautés</p>

        <?php
        foreach ($pictures as $picture) {
            $likeNumber = $likeManager->getLikesNumberByElementId($picture->getId(), 'picture');
            $reportsNumber = $reportManager->getReportsNumberByElementId($picture->getId(), 'picture');
        ?>
            <div class="col-ms-8 content_new_post">
                <div class="content_avatar_post">
                    <figure>
                        <img src="../Public/img/upload/avatar/avatar<?= $picture->getUser()->getId(); ?>.jpg" class="avatar_post" />
                    </figure>
                    <p><?= $picture->getUser()->getName(); ?></p>
                </div>

                <div class="content_info_post">
                    <p>Publiée le <?= $picture->getUpload(); ?></p>
                </div>

                <div class="content_picture_post">
                    <figure class="picture_post">
                        <a class="fancybox" rel="group" href="img/upload/picture/<?= $picture->getTitle() . $picture->getId(); ?>.jpg">
                            <img src="img/upload/picture/<?= $picture->getTitle() . $picture->getId(); ?>.jpg" alt = "<?= $picture->getTitle(); ?>" class="picture_post"/>
                        </a>
                    </figure>
                </div>
                <?php if(array_key_exists('id', $_SESSION)) { ?>
                <div class="content_icone">
                    <form method="POST" class="like_form_post" id="like_form<?= $picture->getId(); ?>">
                        <label for="element<?= $picture->getId() ?>"></label>
                        <input type="text" name="element" id="element<?= $picture->getId() ?>" value="picture" class="hidden_input" />
                        <label for="elementId<?= $picture->getId() ?>"></label>
                        <input type="text" name="elementId" id="elementId<?= $picture->getId() ?>" value="<?= $picture->getId(); ?>" class="hidden_input" />
                        <label for="userId<?= $picture->getUser()->getId() ?>"></label>
                        <input type="text" name="userId" id="userId<?= $picture->getId() ?>" value="<?= $_SESSION['id']; ?>" class="hidden_input" />
                        <button type="submit" class="button_icone" onclick="callAjax('like_form<?= $picture->getId(); ?>', 'Like')"><span class="far fa-thumbs-up"></span></button>
                    </form>
                    <form method="POST" class="report_form_post" id="report_form<?= $picture->getId(); ?>">
                        <label for="elementReport<?= $picture->getId() ?>"></label>
                        <input type="text" name="elementReport" id="elementReport<?= $picture->getId() ?>" value="picture" class="hidden_input" />
                        <label for="elementIdReport<?= $picture->getId() ?>"></label>
                        <input type="text" name="elementIdReport" id="elementIdReport<?= $picture->getId() ?>" value="<?= $picture->getId(); ?>" class="hidden_input" />
                        <label for="userIdReport<?= $picture->getUser()->getId() ?>"></label>
                        <input type="text" name="userIdReport" id="userIdReport<?= $picture->getId() ?>" value="<?= $_SESSION['id']; ?>" class="hidden_input" />
                        <button type="submit" class="button_icone" onclick="callAjax('report_form<?= $picture->getId(); ?>', 'Report')"><span class="fas fa-flag"></span></button>
                    </form>
                </div>
                <?php } ?>
                <?php
                $comments = $commentManager->getCommentByPicture($picture->getId());
                if(!empty($comments) || array_key_exists('id', $_SESSION)) {
                ?>
                <p id="content_like<?= $picture->getId(); ?>"><?= $likeNumber; ?> personnes aiment cette photo.</p>

                <p id="content_report<?= $picture->getId(); ?>">
                    <?php if ($reportsNumber != 0) { ?>
                    <?= $reportsNumber; ?> personnes ont signalées cette photo.
                    <?php } ?>
                </p>


                <button class="comment_button_post btn btn-primary" type="button" onclick="displayContentComment(<?= $picture->getId(); ?>)">commentaires</button>

                <?php } ?>
                <div class="comment_content_post post<?= $picture->getId() ?>">
                    <div id="container_comment<?= $picture->getId() ?>">
                        <?php foreach ($comments as $comment) { ?>
                            <?php if ($comment) {
                                $likeCommentNumber = $likeManager->getLikesNumberByElementId($comment->getId(), 'comment');
                                $reportCommentNumber = $reportManager->getReportsNumberByElementId($comment->getId(), 'comment');
                            ?>
                        <div class="comment_picture_post">
                            <figure class="comment_user">
                                <img src="../Public/img/upload/avatar/avatar<?= $comment->getUser()->getId(); ?>.jpg" alt="avatar" class="picture_comment" />
                                <p><?= $comment->getUser()->getName(); ?></p>
                            </figure>
                            <div class="comment_content">
                                <div class="arrow-left"></div>
                                <p>Le <?= $comment->getPublished(); ?></p>
                                <p id="comment_post<?= $comment->getId(); ?>"><?= $comment->getContent(); ?></p>
                                <div class="content_form_like_report_comment">
                                    <form method="POST" id="like_form_comment<?= $comment->getId(); ?>">
                                        <label for="elementComment<?= $comment->getId() ?>"></label>
                                        <input type="text" name="element" id="elementComment<?= $comment->getId() ?>" value="comment" class="hidden_input" />
                                        <label for="elementIdComment<?= $comment->getId() ?>"></label>
                                        <input type="text" name="elementId" id="elementIdComment<?= $comment->getId() ?>" value="<?= $comment->getId(); ?>" class="hidden_input" />
                                        <label for="userIdComment<?= $comment->getUser()->getId() ?>"></label>
                                        <input type="text" name="userId" id="userIdComment<?= $comment->getId() ?>" value="<?= $_SESSION['id']; ?>" class="hidden_input" />
                                        <button type="submit" class="button_icone" onclick="callAjax('like_form_comment<?= $comment->getId(); ?>', 'Like')"><span class="far fa-thumbs-up"></span></button>
                                    </form>
                                    <form method="POST" id="report_form_comment<?= $comment->getId(); ?>">
                                        <label for="elementReportComment<?= $comment->getId() ?>"></label>
                                        <input type="text" name="elementReport" id="elementReportComment<?= $comment->getId() ?>" value="comment" class="hidden_input" />
                                        <label for="elementIdReportComment<?= $comment->getId() ?>"></label>
                                        <input type="text" name="elementIdReport" id="elementIdReportComment<?= $comment->getId() ?>" value="<?= $comment->getId(); ?>" class="hidden_input" />
                                        <label for="userIdReportComment<?= $comment->getUser()->getId() ?>"></label>
                                        <input type="text" name="userIdReport" id="userIdReportComment<?= $comment->getId() ?>" value="<?= $_SESSION['id']; ?>" class="hidden_input" />
                                        <button type="submit" class="button_icone" onclick="callAjax('report_form_comment<?= $comment->getId(); ?>', 'Report')"><span class="fas fa-flag"></span></button>
                                    </form>
                                    <p id="like_comment_content<?= $comment->getId() ?>">
                                        <?php if ($likeCommentNumber != 0) { ?>
                                        <?= $likeCommentNumber; ?>
                                        <?php } ?>
                                    </p>
                                    <p id="report_comment_content<?= $comment->getId() ?>">
                                        <?php if ($reportCommentNumber != 0) { ?>
                                        <?= $reportCommentNumber; ?>
                                        <?php } ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                            <?php } ?>
                        <?php } ?>
                    </div>
                    <?php
                    if (array_key_exists('id', $_SESSION)) {
                        include('Template/comment.php');
                    } ?>
                </div>

            </div>
        <?php } ?>
    </div>
</div>
<div>
<?php

?>

</div>
<script src = "../Public/js/displayComment.js" ></script>
<script type = "text / javascript" src = "/fancybox/lib/jquery.mousewheel-3.0.6.pack.js" ></script>