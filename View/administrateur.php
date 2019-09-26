<?php
if (!array_key_exists('admin', $_SESSION)) {
    header('Location: accueil');
}
?>
<div class="container">
    <div class="row" id="content_admin">
        <ul class="tabs">
            <li class="active"><a href="#comment">Commentaire</a></li>
            <li><a href="#picture">Photos</a></li>
            <li><a href="#user">Utilisateur</a></li>
        </ul>
        <div class="tabs_content">
            <div id="comment" class="tab_content active">
                <h1>Commentaires</h1>
                <?php
                $commentReports = $reportManager->getReportsByElement('comment');
                foreach ($commentReports as $commentReport) {
                    if ($commentReport) {
                ?>

                <div class="report_comment_admin">
                    <p>Signalé le <?= $commentReport->getPublished(); ?></p>
                    <p>Par <?= $commentReport->getUser()->getName(); ?></p>
                    <p>Commentaire publié par <?= $commentReport->getElement()->getUser()->getName(); ?></p>
                    <p><?= $commentReport->getElement()->getcontent(); ?></p>
                </div>
                <?php
                    }
                }
                ?>
            </div>
            <div class="tab_content" id="picture">
                <h1>Photos</h1>
                <?php
                $pictureReports = $reportManager->getReportsByElement('picture');
                foreach ($pictureReports as $pictureReport) {
                    if ($pictureReport) {
                        var_dump($pictureReport->getElement());
                ?>
                <div class="picture_content_admin">
                    <img class="picture_report_admin" src="../Public/img/upload/picture/<?= $pictureReport->getElement()->getTitle() . $pictureReport->getElementId(); ?>.jpg" alt="<?= $pictureReport->getElement()->getTitle(); ?>" />
                    <div class="picture_report_admin_info">
                        <div class="picture_report_admin_info_user">
                            <p>Signalé par <?= $pictureReport->getUser()->getName(); ?></p>
                            <p>Le <?= $pictureReport->getPublished(); ?></p>
                        </div>
                        <div class="content_form_report_admin">
                            <form method="POST" id="form_delete_report<?= $pictureReport->getId(); ?>" class="form_report_admin">
                                <label for="report_id_admin<?= $pictureReport->getId(); ?>"></label>
                                <input type="text" name="report_id_admin" value="<?= $pictureReport->getId(); ?>" class="hidden_input" id="report_id_admin<?= $pictureReport->getId(); ?>" />
                                <button type="submit" onclick="callAjax('form_delete_report<?= $pictureReport->getId(); ?>', 'Admin')">report</button>
                            </form>
                            <form method="POST" id="form_delete_picture<?= $pictureReport->getId(); ?>" class="form_report_admin">
                                <label for="report_id_admin<?= $pictureReport->getId(); ?>"></label>
                                <input type="text" name="report_id_admin" value="<?= $pictureReport->getId(); ?>" class="hidden_input" id="report_id_admin<?= $pictureReport->getId(); ?>" />
                                <label for="picture_id_admin<?= $pictureReport->getId(); ?>"></label>
                                <input type="text" name="picture_id_admin" value="<?= $pictureReport->getElement()->getId(); ?>" class="hidden_input" id="picture_id_admin<?= $pictureReport->getId(); ?>" />
                                <label for="picture_title_admin<?= $pictureReport->getId(); ?>"></label>
                                <input type="text" name="picture_title_admin" value="<?= $pictureReport->getElement()->getTitle(); ?>" class="hidden_input" id="picture_title_admin<?= $pictureReport->getId(); ?>" />
                                <button type="submit" onclick="callAjax('form_delete_picture<?= $pictureReport->getId(); ?>', 'Admin')">picture</button>
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
                <div class="user_content_admin">
                    <p><?= $user->getName(); ?> / <?= $user->getEmail(); ?> / <?= $user->getInscription(); ?></p>
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