<div id="content_accueil">
    <div class="starter-template">
        <?php
        foreach ($pictures as $picture) {
            $likeNumber = $pictureLikeManager->getPicturesLikesNumberByPictureId($picture->getPictureId());
            $reportsNumber = $pictureReportManager->getPicturesReportsNumberByPictureId($picture->getPictureId());
        ?>
            <div class="col-ms-8 content_new_post">
                <div class="content_avatar_post">
                    <figure>
                        <img src="../Public/img/upload/avatar/avatar<?= $picture->getUserId()->getUserId(); ?>.jpg" class="avatar_post" />
                    </figure>
                    <p><?= $picture->getUserId()->getName(); ?></p>
                </div>
                <div class="content_info_post">
                    <p>Publiée le <?= $picture->getUpload(); ?></p>
                </div>
                <div class="content_picture_post">
                    <figure class="picture_post">
                        <a class="fancybox" rel="group" href="img/upload/picture/<?= $picture->getTitle() . $picture->getPictureId(); ?>.jpg">
                            <img src="img/upload/picture/<?= $picture->getTitle() . $picture->getPictureId(); ?>.jpg" alt = "<?= $picture->getTitle(); ?>" class="picture_post"/>
                        </a>
                    </figure>
                </div>
                <?php if(array_key_exists('id', $_SESSION)) { ?>
                <div class="content_icone">
                    <form method="POST" class="like_form_post" id="like_form<?= $picture->getPictureId(); ?>">
                        <label for="element<?= $picture->getPictureId(); ?>"></label>
                        <input type="text" name="element" id="element<?= $picture->getPictureId(); ?>" value="picture" class="hidden_input" />
                        <label for="elementId<?= $picture->getPictureId(); ?>"></label>
                        <input type="text" name="elementId" id="elementId<?= $picture->getPictureId(); ?>" value="<?= $picture->getPictureId(); ?>" class="hidden_input" />
                        <label for="userId<?= $picture->getUserId()->getUserId(); ?>"></label>
                        <input type="text" name="userId" id="userId<?= $picture->getPictureId(); ?>" value="<?= $_SESSION['id']; ?>" class="hidden_input" />
                        <button type="submit" class="button_icone" onclick="callAjax('like_form<?= $picture->getPictureId(); ?>', 'pictureLike')"><span class="far fa-thumbs-up"></span></button>
                    </form>
                    <form method="POST" class="report_form_post" id="report_form<?= $picture->getPictureId(); ?>">
                        <label for="elementReport<?= $picture->getPictureId(); ?>"></label>
                        <input type="text" name="elementReport" id="elementReport<?= $picture->getPictureId(); ?>" value="picture" class="hidden_input" />
                        <label for="elementIdReport<?= $picture->getPictureId(); ?>"></label>
                        <input type="text" name="elementIdReport" id="elementIdReport<?= $picture->getPictureId(); ?>" value="<?= $picture->getPictureId(); ?>" class="hidden_input" />
                        <label for="userIdReport<?= $picture->getUserId()->getUserId(); ?>"></label>
                        <input type="text" name="userIdReport" id="userIdReport<?= $picture->getPictureId(); ?>" value="<?= $_SESSION['id']; ?>" class="hidden_input" />
                        <button type="submit" class="button_icone" onclick="callAjax('report_form<?= $picture->getPictureId(); ?>', 'pictureReport')"><span class="fas fa-flag"></span></button>
                    </form>
                </div>
                <?php } ?>
                <?php
                $comments = $commentManager->getCommentByPictureId($picture->getPictureId());
                if(!empty($comments) || array_key_exists('id', $_SESSION)) {
                ?>
                <p id="content_like<?= $picture->getPictureId(); ?>"><?= $likeNumber; ?> personnes aiment cette photo.</p>

                <p id="content_report<?= $picture->getPictureId(); ?>">
                    <?php if ($reportsNumber != 0) { ?>
                    <?= $reportsNumber; ?> personnes ont signalées cette photo.
                    <?php } ?>
                </p>
                <button class="comment_button_post btn btn-primary" type="button" onclick="displayContentComment(<?= $picture->getPictureId(); ?>)">commentaires</button>
                <?php } ?>
                <div class="comment_content_post post<?= $picture->getPictureId(); ?>">
                    <div id="container_comment<?= $picture->getPictureId(); ?>">
                        <?php foreach ($comments as $comment) { ?>
                            <?php if ($comment) {
                                $likeCommentNumber = $commentLikeManager->getCommentsLikesNumberByCommentId($comment->getCommentId());
                                $reportCommentNumber = $commentReportManager->getCommentsReportsNumberByCommentId($comment->getCommentId());
                            ?>
                        <div class="comment_picture_post">
                            <figure class="comment_user">
                                <img src="../Public/img/upload/avatar/avatar<?= $comment->getUserId()->getUserId(); ?>.jpg" alt="avatar" class="picture_comment" />
                                <p><?= $comment->getUserId()->getName(); ?></p>
                            </figure>
                            <div class="comment_content">
                                <div class="arrow-left"></div>
                                <p>Le <?= $comment->getPublished(); ?></p>
                                <p id="comment_post<?= $comment->getCommentId(); ?>"><?= $comment->getContent(); ?></p>
                                <?php if (array_key_exists('id', $_SESSION)) { ?>
                                <div class="content_form_like_report_comment">
                                    <form method="POST" id="like_form_comment<?= $comment->getCommentId(); ?>">
                                        <label for="elementComment<?= $comment->getCommentId(); ?>"></label>
                                        <input type="text" name="element" id="elementComment<?= $comment->getCommentId(); ?>" value="comment" class="hidden_input" />
                                        <label for="elementIdComment<?= $comment->getCommentId(); ?>"></label>
                                        <input type="text" name="elementId" id="elementIdComment<?= $comment->getCommentId(); ?>" value="<?= $comment->getCommentId(); ?>" class="hidden_input" />
                                        <label for="userIdComment<?= $comment->getUserId()->getUserId(); ?>"></label>
                                        <input type="text" name="userId" id="userIdComment<?= $comment->getCommentId() ?>" value="<?= $_SESSION['id']; ?>" class="hidden_input" />
                                        <button type="submit" class="button_icone" onclick="callAjax('like_form_comment<?= $comment->getCommentId(); ?>', 'commentLike')"><span class="far fa-thumbs-up"></span></button>
                                    </form>
                                    <p id="like_comment_content<?= $comment->getCommentId() ?>">
                                        <?php if ($likeCommentNumber != 0) { ?>
                                        <?= $likeCommentNumber; ?>
                                        <?php } ?>
                                    </p>
                                    <form method="POST" id="report_form_comment<?= $comment->getCommentId(); ?>">
                                        <label for="elementReportComment<?= $comment->getCommentId(); ?>"></label>
                                        <input type="text" name="elementReport" id="elementReportComment<?= $comment->getCommentId(); ?>" value="comment" class="hidden_input" />
                                        <label for="elementIdReportComment<?= $comment->getCommentId(); ?>"></label>
                                        <input type="text" name="elementIdReport" id="elementIdReportComment<?= $comment->getCommentId(); ?>" value="<?= $comment->getCommentId(); ?>" class="hidden_input" />
                                        <label for="userIdReportComment<?= $comment->getUserId()->getUserId(); ?>"></label>
                                        <input type="text" name="userIdReport" id="userIdReportComment<?= $comment->getCommentId(); ?>" value="<?= $_SESSION['id']; ?>" class="hidden_input" />
                                        <button type="submit" class="button_icone" onclick="callAjax('report_form_comment<?= $comment->getCommentId(); ?>', 'commentReport')"><span class="fas fa-flag"></span></button>
                                    </form>
                                    <p id="report_comment_content<?= $comment->getCommentId(); ?>">
                                        <?php if ($reportCommentNumber != 0) { ?>
                                        <?= $reportCommentNumber; ?>
                                        <?php } ?>
                                    </p>
                                </div>
                                <?php } ?>
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
<script src ="../Public/js/displayComment.js" ></script>