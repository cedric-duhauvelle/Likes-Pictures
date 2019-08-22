<?php use Modele\DataRecover; ?>

<div id="content_accueil">
    <div class="starter-template">
        <h1>Accueil</h1>
        <p class="lead">Nouveautés</p>
    </div>   
</div>
<?php

$data = new DataRecover($this->_db);
$data->allData('picture');