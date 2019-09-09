<?php

if (array_key_exists('errorMessage', $_SESSION) && array_key_exists('errorCode', $_SESSION)) {
    $message = $_SESSION['errorMessage'];
    $code = $_SESSION['errorCode'];
    unset($_SESSION['errorMessage']);
    unset($_SESSION['errorCode']);
} else {
    header('Location: accueil');
}
?>
<div id="content">
	<div id="error_page_content">
		<h2 class="error_message"><?= $code; ?></h2>
        <p class="error_message"><?= $message; ?></p>
        <a href="accueil">Retour à l'accueil</a>
	</div>
</div>