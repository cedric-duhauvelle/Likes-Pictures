<?php

use Model\User;
$user = new User();

?>
<div id="content_profil" class="container">
    <h1>Profil</h1>
    <div class="row">
        <div id="profil">
            <div id="profil_info" class="col-lg-9">
                <p><?= $user->returnData($this->_db, 'id', $_SESSION['id'], 'name') ?></p>
                <p><?= $user->returnData($this->_db, 'id', $_SESSION['id'], 'email') ?></p>
                <p><?= $user->returnData($this->_db, 'id', $_SESSION['id'], 'inscription') ?></p>
            </div>
            <div class="col-lg-3">
                <img src="img/upload/avatar/avatar<?= $_SESSION['id']; ?>" id="avatar_profil" alt="Photo de profil" />
            </div>
        </div>
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
</div>
<?php var_dump($_SESSION); ?>