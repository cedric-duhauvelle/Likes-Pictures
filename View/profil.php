<div id="content_profil" class="container">
    <div id="content_profil">
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
                    <p>Inscrit depuis le <?= $user->getInscription();  ?></p>
                </div>
                <img src="../Public/img/upload/avatar/avatar<?= $_SESSION['id']; ?>.jpg" id="avatar_profil" />
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
                    <div id="container_info_profil">
                        <figure>
                            <img src="img/upload/picture/<?= $picture->getTitle() . $picture->getId(); ?>.jpg" class="picture_profil" />
                        </figure>
                        <form method="post" id="form_delete_picture_user<?= $picture->getId(); ?>">
                            <label for="pictureId<?= $picture->getId(); ?>"></label>
                            <input type="text" name="pictureId" id="pictureId<?= $picture->getId(); ?>" value="<?= $picture->getId(); ?>" class="hidden_input" />
                            <label for="pictureName<?= $picture->getId(); ?>"></label>
                            <input type="text" name="pictureName" id="pictureName<?= $picture->getId(); ?>" value="<?= $picture->getTitle(); ?>" class="hidden_input" />
                            <label for="element<?= $picture->getId(); ?>"></label>
                            <input type="text" name="element" id="element<?= $picture->getId(); ?>" value="picture" class="hidden_input" />
                            <button type="submit" onclick="callAjax('form_delete_picture_user<?= $picture->getId(); ?>', 'Profil')">Effacer</button>
                        </form>
                    </div>

                <?php
                }
                ?>
            </div>
            <div class="tab_content" id="update">
                <h1>Update</h1>
                <div id="container_update_profil">
                    <form method="post" id="form_update_user_name<?= $picture->getId(); ?>">
                        <label for="new_name<?= $_SESSION['id']; ?>">Nom</label>
                        <input type="text" name="new_name" id="new_name<?= $_SESSION['id']; ?>" required />
                        <label for="element_name<?= $_SESSION['id']; ?>"></label>
                        <input type="text" name="element" id="element_name<?= $_SESSION['id']; ?>" value="update" class="hidden_input" />
                        <label for="element_update_name<?= $_SESSION['id']; ?>"></label>
                        <input type="text" name="element_update" id="element_update_name<?= $_SESSION['id']; ?>" value="name" class="hidden_input" />
                        <label for="user_id_name<?= $_SESSION['id']; ?>"></label>
                        <input type="text" name="user_id" id="user_id_name<?= $_SESSION['id']; ?>" value="<?= $_SESSION['id']; ?>" class="hidden_input" />
                        <button type="submit" onclick="callAjax('form_update_user_name<?= $picture->getId(); ?>', 'Profil')">validé</button>
                    </form>
                    <form method="post" id="form_update_user_email<?= $picture->getId(); ?>">
                        <label for="new_email<?= $_SESSION['id']; ?>">Email</label>
                        <input type="text" name="new_email" id="new_email<?= $_SESSION['id']; ?>" required />
                        <label for="element_email<?= $_SESSION['id']; ?>"></label>
                        <input type="text" name="element" id="element_email<?= $_SESSION['id']; ?>" value="update" class="hidden_input" />
                        <label for="element_update_email<?= $_SESSION['id']; ?>"></label>
                        <input type="text" name="element_update" id="element_update_email<?= $_SESSION['id']; ?>" value="email" class="hidden_input" />
                        <label for="user_id_email<?= $_SESSION['id']; ?>"></label>
                        <input type="text" name="user_id" id="user_id_email<?= $_SESSION['id']; ?>" value="<?= $_SESSION['id']; ?>" class="hidden_input" />
                        <button type="submit" onclick="callAjax('form_update_user_email<?= $picture->getId(); ?>', 'Profil')">validé</button>
                    </form>
                    <form method="post" id="form_update_user_password<?= $picture->getId(); ?>">
                        <label for="new_password<?= $_SESSION['id']; ?>">Mot de passe</label>
                        <input type="text" name="new_password" id="new_password<?= $_SESSION['id']; ?>" required />
                        <label for="password_confirm<?= $_SESSION['id']; ?>">Retapez votre mot de passe</label>
                        <input type="text" name="password_confirm" id="password_confirm<?= $_SESSION['id']; ?>" required />
                        <label for="element_password<?= $_SESSION['id']; ?>"></label>
                        <input type="text" name="element" id="element_password<?= $_SESSION['id']; ?>" value="update" class="hidden_input" />
                        <label for="element_update_password<?= $_SESSION['id']; ?>"></label>
                        <input type="text" name="element_update" id="element_update_password<?= $_SESSION['id']; ?>" value="password" class="hidden_input" />
                        <label for="user_id_password<?= $_SESSION['id']; ?>"></label>
                        <input type="text" name="user_id" id="user_id_password<?= $_SESSION['id']; ?>" value="<?= $_SESSION['id']; ?>" class="hidden_input" />
                        <button type="submit" onclick="callAjax('form_update_user_password<?= $picture->getId(); ?>', 'Profil')">validé</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="../Public/js/displayComment.js"></script>
<script src="../Public/js/tabs.js"></script>