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
                    $commentReports = $reportManager->getReportsByElement('comment');
                    foreach ($commentReports as $commentReport) {
                        if ($commentReport) {
                    ?>
                    <div class="report_comment_admin" id="report_comment_admin<?= $commentReport->getId(); ?>">
                        <div class="content_comment_report">
                            <p>Signalé le <?= $commentReport->getPublished(); ?> - Par <?= $commentReport->getUser()->getName(); ?></p>
                            <p></p>
                            <p>Publié par <?= $commentReport->getElement()->getUser()->getName(); ?></p>
                            <p class="comment_report_display"><?= $commentReport->getElement()->getcontent(); ?></p>
                        </div>
                        <div class="content_form_comment_report">
                            <p>Effacer :</p>
                            <form method="post" class="form_report_admin" id="form_delete_report_admin<?= $commentReport->getId(); ?>">
                                <label for="comment_report_id<?= $commentReport->getId(); ?>"></label>
                                <input type="text" name="comment_report_id" value="<?= $commentReport->getId(); ?>" class="hidden_input" id="comment_report_id<?= $commentReport->getId(); ?>" />
                                <label for="comment_report_element<?= $commentReport->getId(); ?>"></label>
                                <input type="text" name="element" value="comment" class="hidden_input" id="comment_report_element<?= $commentReport->getId(); ?>" />
                                <button type="submit" class="btn btn-danger" onclick="callAjax('form_delete_report_admin<?= $commentReport->getId(); ?>', 'Admin')">Signalement</button>
                            </form>
                            <form method="post" class="form_report_admin" id="form_delete_comment_admin<?= $commentReport->getId(); ?>">
                                <label for="comment_report_id<?= $commentReport->getId(); ?>"></label>
                                <input type="text" name="comment_report_id" value="<?= $commentReport->getId(); ?>" class="hidden_input" />
                                <label for="commentId_report_id<?= $commentReport->getId(); ?>"></label>
                                <input type="text" name="commentId_report_id" value="<?= $commentReport->getElementId(); ?>" id="commentId_report_id<?= $commentReport->getId(); ?>" class="hidden_input">
                                <label for="comment_report_element<?= $commentReport->getId(); ?>"></label>
                                <input type="text" name="element" value="comment" class="hidden_input" id="comment_report_element<?= $commentReport->getId(); ?>" />
                                <button type="submit" class="btn btn-danger" onclick="callAjax('form_delete_comment_admin<?= $commentReport->getId(); ?>', 'Admin')">Commentaire</button>
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
                $pictureReports = $reportManager->getReportsByElement('picture');
                foreach ($pictureReports as $pictureReport) {
                    if ($pictureReport) {
                ?>
                <div class="picture_content_admin" id="picture_admin<?= $pictureReport->getId(); ?>">
                    <img class="picture_report_admin" src="../Public/img/upload/picture/<?= $pictureReport->getElement()->getTitle() . $pictureReport->getElementId(); ?>.jpg" alt="<?= $pictureReport->getElement()->getTitle(); ?>" />
                    <div class="picture_report_admin_info">
                        <div class="picture_report_admin_info_user">
                            <p>Signalé par <?= $pictureReport->getUser()->getName(); ?></p>
                            <p>Le <?= $pictureReport->getPublished(); ?></p>
                        </div>
                        <div class="content_form_report_admin">
                            <p>Effacer :</p>
                            <form method="POST" id="form_delete_report<?= $pictureReport->getId(); ?>" class="form_report_admin">
                                <label for="report_id_admin<?= $pictureReport->getId(); ?>"></label>
                                <input type="text" name="report_id_admin" value="<?= $pictureReport->getId(); ?>" class="hidden_input" id="report_id_admin<?= $pictureReport->getId(); ?>" />
                                <label for="report_element_admin<?= $pictureReport->getId(); ?>"></label>
                                <input type="text" name="element" value="picture" class="hidden_input" id="report_element_admin<?= $pictureReport->getId(); ?>" />
                                <button type="submit" class="btn btn-danger" onclick="callAjax('form_delete_report<?= $pictureReport->getId(); ?>', 'Admin')">Signalement</button>
                            </form>
                            <form method="POST" id="form_delete_picture<?= $pictureReport->getId(); ?>" class="form_report_admin">
                                <label for="report_id_admin<?= $pictureReport->getId(); ?>"></label>
                                <input type="text" name="report_id_admin" value="<?= $pictureReport->getId(); ?>" class="hidden_input" id="report_id_admin<?= $pictureReport->getId(); ?>" />
                                <label for="picture_id_admin<?= $pictureReport->getId(); ?>"></label>
                                <input type="text" name="picture_id_admin" value="<?= $pictureReport->getElement()->getId(); ?>" class="hidden_input" id="picture_id_admin<?= $pictureReport->getId(); ?>" />
                                <label for="picture_title_admin<?= $pictureReport->getId(); ?>"></label>
                                <input type="text" name="picture_title_admin" value="<?= $pictureReport->getElement()->getTitle(); ?>" class="hidden_input" id="picture_title_admin<?= $pictureReport->getId(); ?>" />
                                <label for="report_element_admin<?= $pictureReport->getId(); ?>"></label>
                                <input type="text" name="element" value="picture" class="hidden_input" id="report_element_admin<?= $pictureReport->getId(); ?>" />
                                <button type="submit" class="btn btn-danger" onclick="callAjax('form_delete_picture<?= $pictureReport->getId(); ?>', 'Admin')">Photo</button>
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
                <div class="user_content_admin" id="container_user_info<?= $user->getId(); ?>">
                    <p><?= $user->getName(); ?> / <?= $user->getEmail(); ?> / <?= $user->getInscription(); ?></p>
                    <div class="content_form_user_admin">
                        <form method="POST" id="form_delete_user<?= $user->getId(); ?>" class="form_user_admin">
                            <label for="usert_id_admin<?= $user->getId(); ?>"></label>
                            <input type="text" name="user_id_admin" value="<?= $user->getId(); ?>" class="hidden_input" id="user_id_admin<?= $user->getId(); ?>" />
                            <label for="user_element_admin<?= $user->getId(); ?>"></label>
                            <input type="text" name="element" value="user" class="hidden_input" id="user_element_admin<?= $user->getId(); ?>" />
                            <button type="submit" class="btn btn-danger" onclick="callAjax('form_delete_user<?= $user->getId(); ?>', 'Admin')">Effacer</button>
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


<script src="../Public/js/displayComment.js"></script>
<script src="../Public/js/tabs.js"></script>