<?php
if (!array_key_exists('admin', $_SESSION)) {
    header('Location: accueil');
}
?>
<div class="container">
    <div class="row" id="content_admin">
        <ul class="tabs">
            <li class="active"><a href="#comment_report">Commentaire</a></li>
            <li><a href="#picture_report">Photos</a></li>
            <li><a href="#user">Utilisateur</a></li>
        </ul>
        <div class="tabs_content">
            <div id="comment_report" class="tab_content active">
                <div class="comment_container_report">
                <h1>Commentaires</h1>
                    <?php
                    $commentReports = $commentReportManager->getCommentsReports();
                    foreach ($commentReports as $commentReport) {
                        if ($commentReport) {
                    ?>
                    <div class="report_comment_admin" id="report_comment_admin<?= $commentReport->getCommentReportId(); ?>">
                        <div class="content_comment_report">
                            <p>Signalé le <?= $commentReport->getPublished(); ?> - Par <?= $commentReport->getUserId()->getName(); ?></p>
                            <p></p>
                            <p>Publié par <?= $commentReport->getCommentId()->getUserId()->getName(); ?></p>
                            <p class="comment_report_display"><?= $commentReport->getCommentId()->getContent(); ?></p>
                        </div>
                        <div class="content_form_comment_report">
                            <p>Effacer :</p>
                            <form method="post" class="form_report_admin" id="form_delete_report_admin<?= $commentReport->getCommentReportId(); ?>">
                                <label for="comment_report_id<?= $commentReport->getCommentReportId(); ?>"></label>
                                <input type="text" name="comment_report_id" value="<?= $commentReport->getCommentReportId(); ?>" class="hidden_input" id="comment_report_id<?= $commentReport->getCommentReportId(); ?>" />
                                <label for="comment_report_element<?= $commentReport->getCommentReportId(); ?>"></label>
                                <input type="text" name="element" value="comment" class="hidden_input" id="comment_report_element<?= $commentReport->getCommentReportId(); ?>" />
                                <button type="submit" class="btn btn-danger" onclick="callAjax('form_delete_report_admin<?= $commentReport->getCommentReportId(); ?>', 'Admin')">Signalement</button>
                            </form>
                            <form method="post" class="form_report_admin" id="form_delete_comment_admin<?= $commentReport->getCommentReportId(); ?>">
                                <label for="comment_report_id<?= $commentReport->getCommentReportId(); ?>"></label>
                                <input type="text" name="comment_report_id" value="<?= $commentReport->getCommentReportId(); ?>" class="hidden_input" />
                                <label for="commentId_report_id<?= $commentReport->getCommentReportId(); ?>"></label>
                                <input type="text" name="commentId_report_id" value="<?= $commentReport->getCommentId()->getCommentId(); ?>" id="commentId_report_id<?= $commentReport->getCommentReportId(); ?>" class="hidden_input">
                                <label for="comment_report_element<?= $commentReport->getCommentReportId(); ?>"></label>
                                <input type="text" name="element" value="comment" class="hidden_input" id="comment_report_element<?= $commentReport->getCommentReportId(); ?>" />
                                <button type="submit" class="btn btn-danger" onclick="callAjax('form_delete_comment_admin<?= $commentReport->getCommentReportId(); ?>', 'Admin')">Commentaire</button>
                            </form>
                        </div>
                    </div>
                    <?php
                        }
                    }
                    ?>
                </div>
            </div>
            <div class="tab_content" id="picture_report">
                <h1>Photos</h1>
                <?php
                $pictureReports = $pictureReportManager->getPicturesReports();
                foreach ($pictureReports as $pictureReport) {
                    if ($pictureReport) {
                ?>
                <div class="picture_content_admin" id="picture_admin<?= $pictureReport->getPictureReportId(); ?>">
                    <img class="picture_report_admin" src="img/upload/picture/<?= $pictureReport->getPictureId()->getTitle() . $pictureReport->getPictureId()->getPictureId(); ?>.jpg" alt="<?= $pictureReport->getPictureId()->getTitle(); ?>" />
                    <div class="picture_report_admin_info">
                        <div class="picture_report_admin_info_user">
                            <p>Signalé par <?= $pictureReport->getUserId()->getName(); ?></p>
                            <p>Le <?= $pictureReport->getPublished(); ?></p>
                        </div>
                        <div class="content_form_report_admin">
                            <p>Effacer :</p>
                            <form method="POST" id="form_delete_report<?= $pictureReport->getPictureReportId(); ?>" class="form_report_admin">
                                <label for="report_id_admin<?= $pictureReport->getPictureReportId(); ?>"></label>
                                <input type="text" name="report_id_admin" value="<?= $pictureReport->getPictureReportId(); ?>" class="hidden_input" id="report_id_admin<?= $pictureReport->getPictureReportId(); ?>" />
                                <label for="report_element_admin<?= $pictureReport->getPictureReportId(); ?>"></label>
                                <input type="text" name="element" value="picture" class="hidden_input" id="report_element_admin<?= $pictureReport->getPictureReportId(); ?>" />
                                <button type="submit" class="btn btn-danger" onclick="callAjax('form_delete_report<?= $pictureReport->getPictureReportId(); ?>', 'Admin')">Signalement</button>
                            </form>
                            <form method="POST" id="form_delete_picture<?= $pictureReport->getPictureReportId(); ?>" class="form_report_admin">
                                <label for="report_id_admin<?= $pictureReport->getPictureReportId(); ?>"></label>
                                <input type="text" name="report_id_admin" value="<?= $pictureReport->getPictureReportId(); ?>" class="hidden_input" id="report_id_admin<?= $pictureReport->getPictureReportId(); ?>" />
                                <label for="picture_id_admin<?= $pictureReport->getPictureReportId(); ?>"></label>
                                <input type="text" name="picture_id_admin" value="<?= $pictureReport->getPictureId()->getPictureId(); ?>" class="hidden_input" id="picture_id_admin<?= $pictureReport->getPictureReportId(); ?>" />
                                <label for="picture_title_admin<?= $pictureReport->getPictureReportId(); ?>"></label>
                                <input type="text" name="picture_title_admin" value="<?= $pictureReport->getPictureId()->getTitle(); ?>" class="hidden_input" id="picture_title_admin<?= $pictureReport->getPictureReportId(); ?>" />
                                <label for="report_element_admin<?= $pictureReport->getPictureReportId(); ?>"></label>
                                <input type="text" name="element" value="picture" class="hidden_input" id="report_element_admin<?= $pictureReport->getPictureReportId(); ?>" />
                                <button type="submit" class="btn btn-danger" onclick="callAjax('form_delete_picture<?= $pictureReport->getPictureReportId(); ?>', 'Admin')">Photo</button>
                            </form>
                        </div>
                    </div>
                </div>
                <?php
                    }
                }
                ?>
            </div>
            <div class="tab_content" id="user">
                <h1>Utilisateurs</h1>
                <?php
                $users = $userManager->getUsers();
                foreach ($users as $user) {
                    if ($user) {
                ?>
                <div class="user_content_admin" id="container_user_info<?= $user->getUserId(); ?>">
                    <p><?= $user->getName(); ?> / <?= $user->getEmail(); ?> / <?= $user->getInscription(); ?></p>
                    <div class="content_form_user_admin">
                        <form method="POST" id="form_delete_user<?= $user->getUserId(); ?>" class="form_user_admin">
                            <label for="usert_id_admin<?= $user->getUserId(); ?>"></label>
                            <input type="text" name="user_id_admin" value="<?= $user->getUserId(); ?>" class="hidden_input" id="user_id_admin<?= $user->getUserId(); ?>" />
                            <label for="user_element_admin<?= $user->getUserId(); ?>"></label>
                            <input type="text" name="element" value="user" class="hidden_input" id="user_element_admin<?= $user->getUserId(); ?>" />
                            <button type="submit" class="btn btn-danger" onclick="callAjax('form_delete_user<?= $user->getUserId(); ?>', 'Admin')">Effacer</button>
                        </form>
                    </div>
                </div>
                <?php
                    }
                }
                ?>
            </div>
        </div>
    </div>
</div>
<script src="./js/callAjax.js" async></script>
<script src="./js/tabs.js"></script>