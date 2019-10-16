<div id="content_connexion" class="content">
    <h1>Connexion</h1>
    <div id="content_form_connexion">
        <form action="ConnexionController" method="POST" id="form_connexion">
            <div class="form-group form-connexion">
                <label for="name_connection">Nom</label>
                <?php
                if (array_key_exists('errorName', $_SESSION)) {
                ?>
                <p class="text-danger"><?= $_SESSION['errorName'] ?></p>
                <?php
                unset($_SESSION['errorName']);
                }
                ?>
                <input type="text" name="name" id="name_connection" placeholder="Nom" required />
            </div>
            <div class="form-group form-connexion">
                <label for="password_connexion">Mot de passe</label>
                <?php
                if (array_key_exists('errorPassword', $_SESSION)) {
                ?>
                <p class="text-danger"><?= $_SESSION['errorPassword'] ?></p>
                <?php
                unset($_SESSION['errorPassword']);
                }
                ?>
                <input type="password" name="password" id="password_connexion" placeholder="Mot de passe" required />
            </div>
            <input type="submit" class="btn btn-primary" name="connexion" id="button_connexion" value="Connexion" />
        </form>
    </div>
    <p id="container_inscription"><a href="inscription">Inscription</a></p>
</div>
