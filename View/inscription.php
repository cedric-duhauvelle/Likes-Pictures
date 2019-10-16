<div id="content_inscription" class="content">
    <h1>Inscription</h1>
    <div id="content_form_inscription">
        <form action="InscriptionController" method="POST" id="form_inscription">
            <div class="form-group form-inscription">
                <label for="name_inscription">Nom</label>
                <?php
                if (array_key_exists('errorName', $_SESSION)) {
                ?>
                <p class="text-danger"><?= $_SESSION['errorName'] ?></p>
                <?php
                unset($_SESSION['errorName']);
                }
                ?>
                <input type="text" name="name" id="name_inscription" placeholder="Nom" required />
            </div>
            <div class="form-group form-inscription">
                <label for="email_connexion">Email</label>
                <?php
                if (array_key_exists('errorEmail', $_SESSION)) {
                ?>
                <p class="text-danger"><?= $_SESSION['errorEmail'] ?></p>
                <?php
                unset($_SESSION['errorEmail']);
                }
                ?>
                <input type="email" name="email" id="email_inscription" placeholder="Email" required />
            </div>
            <div class="form-group form-inscription">
                <label for="password_connexion">Mot de passe</label>
                <input type="password" name="password" id="password_inscription" placeholder="Mot de passe" required />
            </div>
            <div class="form-group form-inscription">
                <label for="confirm_password_inscription">Confirmez mot de passe</label>
                <?php
                if (array_key_exists('errorPassword', $_SESSION)) {
                ?>
                <p class="text-danger"><?= $_SESSION['errorPassword'] ?></p>
                <?php
                unset($_SESSION['errorPassword']);
                }
                ?>
                <input type="password" name="confirm_password" id="confirm_password_inscription" placeholder="Confirmez mot de passe" required />
            </div>
            <div id="content_button_inscription">
                <input type="submit" class="btn btn-primary" name="connexion" id="button_inscription" value="Inscription" />
            </div>
        </form>
    </div>
</div>