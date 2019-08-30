<div id="content_profil" class="container">
    <h1>Profil</h1>
    <div class="row">
        <div id="profil">
            <div id="profil_info" class="col-lg-9">

            </div>
            <div class="col-lg-3">

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