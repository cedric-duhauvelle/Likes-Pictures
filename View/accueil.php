<div id="content_accueil" class="content">
    <?php
    foreach ($pictures as $picture) {
        $numberPost++;
        $likeNumber = $pictureLikeManager->getPicturesLikesNumberByPictureId($picture->getPictureId());
        $reportsNumber = $pictureReportManager->getPicturesReportsNumberByPictureId($picture->getPictureId());
        if ($likeNumber != 0) {
            $classActiveLikePicture = 'active';
        } else {
            $classActiveLikePicture = '';
        }
        if ($reportsNumber != 0) {
            $classActiveReportPicture = 'active';
        } else {
            $classActiveReportPicture = '';
        }
    ?>
        <div class="content_new_post">
            <div class="content_avatar_post">
                <figure>
                <?php if(is_file('../Public/img/upload/avatar/avatar' . $picture->getUserId()->getUserId() . '.jpg')) { ?>
                    <img src="img/upload/avatar/avatar<?= $picture->getUserId()->getUserId(); ?>.jpg" class="avatar_post" alt="avatar" />
                <?php } else { ?>
                    <img src="img/avatar-default.jpg" class="avatar_post" alt="avatar" />
                <?php } ?>
                </figure>
                <p><strong><?= $picture->getUserId()->getName(); ?></strong></p>
                <p>Publiée le <?= $picture->getUpload(); ?></p>
            </div>
            <div class="content_picture_post">
                <figure class="picture_post">
                    <a class="fancybox" href="img/upload/picture/<?= $picture->getTitle() . $picture->getPictureId(); ?>.jpg">
                        <img src="img/upload/picture/<?= $picture->getTitle() . $picture->getPictureId(); ?>.jpg" alt="<?= $picture->getTitle(); ?>" class="picture_post"/>
                    </a>
                </figure>
            </div>
            <?php if((array_key_exists('id', $_SESSION)) && ($_SESSION['id'] !== $picture->getUserId()->getUserId())) { ?>
            <div class="content_icone">
                <form method="POST" class="like_form_post" id="like_form<?= $picture->getPictureId(); ?>">
                    <input type="hidden" name="element" id="element<?= $picture->getPictureId(); ?>" value="picture" />
                    <input type="hidden" name="elementId" id="elementId<?= $picture->getPictureId(); ?>" value="<?= $picture->getPictureId(); ?>" />
                    <input type="hidden" name="userId" id="userId<?= $picture->getPictureId(); ?>" value="<?= $_SESSION['id']; ?>" />
                    <button type="submit" class="button_icone" onclick="callAjax('like_form<?= $picture->getPictureId(); ?>', 'pictureLike')" title="Like photo"><span id="icone_like<?= $picture->getPictureId(); ?>" class="far fa-thumbs-up icone_like <?= $classActiveLikePicture; ?>"></span></button>
                </form>
                <form method="POST" class="report_form_post" id="report_form<?= $picture->getPictureId(); ?>">
                    <input type="hidden" name="elementReport" id="elementReport<?= $picture->getPictureId(); ?>" value="picture" />
                    <input type="hidden" name="elementIdReport" id="elementIdReport<?= $picture->getPictureId(); ?>" value="<?= $picture->getPictureId(); ?>" />
                    <input type="hidden" name="userIdReport" id="userIdReport<?= $picture->getPictureId(); ?>" value="<?= $_SESSION['id']; ?>" />
                    <button type="submit" class="button_icone" onclick="callAjax('report_form<?= $picture->getPictureId(); ?>', 'pictureReport')" title="Report photo"><span id="icone_report<?= $picture->getPictureId(); ?>" class="far fa-flag icone_report <?= $classActiveReportPicture; ?>"></span></button>
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
            <button class="comment_button_post btn btn-primary" type="button" onclick="displayContentComment(<?= $picture->getPictureId(); ?>)" title="Afficher commentaires">Commentaires</button>
            <?php } ?>
            <div class="comment_content_post post<?= $picture->getPictureId(); ?>">
                <div id="container_comment<?= $picture->getPictureId(); ?>">
                    <?php foreach ($comments as $comment) { ?>
                        <?php if ($comment) {
                            $likeCommentNumber = $commentLikeManager->getCommentsLikesNumberByCommentId($comment->getCommentId());
                            $reportCommentNumber = $commentReportManager->getCommentsReportsNumberByCommentId($comment->getCommentId());
                            if ($likeCommentNumber != 0) {
                                $classActiveLikeComment = 'active';
                            } else {
                                $classActiveLikeComment = '';
                            }
                            if ($reportCommentNumber != 0) {
                                $classActiveReportComment = 'active';
                            } else {
                                $classActiveReportComment = '';
                            }
                        ?>
                    <div class="comment_picture_post">
                        <figure class="comment_user">
                        <?php if(is_file('../Public/img/upload/avatar/avatar' . $comment->getUserId()->getUserId() . '.jpg')) { ?>
                            <img src="img/upload/avatar/avatar<?= $comment->getUserId()->getUserId(); ?>.jpg" class="picture_comment" alt="avatar" />
                        <?php } else { ?>
                            <img src="img/avatar-default.jpg" class="picture_comment" alt="avatar" />
                        <?php } ?>
                            <p><?= $comment->getUserId()->getName(); ?></p>
                        </figure>
                        <div class="comment_content">
                            <div class="arrow-left"></div>
                            <p>Le <?= $comment->getPublished(); ?></p>
                            <p id="comment_post<?= $comment->getCommentId(); ?>"><?= $comment->getContent(); ?></p>
                            <?php if (array_key_exists('id', $_SESSION) && ($_SESSION['id'] !== $comment->getUserId()->getUserId())) { ?>
                            <div class="content_form_like_report_comment">
                                <form method="POST" id="like_form_comment<?= $comment->getCommentId(); ?>">
                                    <input type="hidden" name="element" id="elementComment<?= $comment->getCommentId(); ?>" value="comment" />
                                    <input type="hidden" name="elementId" id="elementIdComment<?= $comment->getCommentId(); ?>" value="<?= $comment->getCommentId(); ?>" />
                                    <input type="hidden" name="userId" id="userIdComment<?= $comment->getCommentId() ?>" value="<?= $_SESSION['id']; ?>" />
                                    <button type="submit" class="button_icone" onclick="callAjax('like_form_comment<?= $comment->getCommentId(); ?>', 'commentLike')" title="Like commentaire"><span id="icone_like<?= $comment->getCommentId(); ?>" class="far fa-thumbs-up icone_like <?= $classActiveLikeComment; ?>"></span></button>
                                </form>
                                <p id="like_comment_content<?= $comment->getCommentId() ?>">
                                    <?php if ($likeCommentNumber != 0) { ?>
                                    <?= $likeCommentNumber; ?>
                                    <?php } ?>
                                </p>
                                <form method="POST" id="report_form_comment<?= $comment->getCommentId(); ?>">
                                    <input type="hidden" name="elementReport" id="elementReportComment<?= $comment->getCommentId(); ?>" value="comment" />
                                    <input type="hidden" name="elementIdReport" id="elementIdReportComment<?= $comment->getCommentId(); ?>" value="<?= $comment->getCommentId(); ?>" />
                                    <input type="hidden" name="userIdReport" id="userIdReportComment<?= $comment->getCommentId(); ?>" value="<?= $_SESSION['id']; ?>" />
                                    <button type="submit" class="button_icone" onclick="callAjax('report_form_comment<?= $comment->getCommentId(); ?>', 'commentReport')" title="Report commentaire"><span id="icone_report<?= $comment->getCommentId(); ?>" class="far fa-flag icone_report <?= $classActiveReportComment; ?>"></span></button>
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
    <div id="content_pagination">
    <?php for ($i=1; $i<=$pageTotal; $i++) {
        if ($i == $currentPage) {
    ?>
        <?= $i; ?>
    <?php
        } else {
    ?>
        <a href="accueil?page=<?= $i ?>"><?= $i; ?></a>
    <?php
        }
    } ?>
    </div>
</div>
<script src="./js/tools.js" async></script>