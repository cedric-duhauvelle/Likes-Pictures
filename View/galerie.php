<div id="content_galerie">
    <div class="starter-template">
        <h1>Galerie</h1>
        <p class="lead">Nouveautés</p>
    </div>
    <div id="slider_container">
        <div id="slider">
            <?php
            foreach ($pictures as $picture) {
                if ($picture) {
            ?>

            <figure class="slider_content">
                <img src="img/upload/picture/<?= $picture->getTitle() . $picture->getId(); ?>.jpg" />
            </figure>


            <?php
                }
            }
            ?>

        </div>
    </div>
    <div id="content_comments">
        <p>Ici sera placé prochainement les commentaires</p>
    </div>
</div>

<script src="../Public/js/slider.js"></script>
<script src="../Public/js/main.js"></script>