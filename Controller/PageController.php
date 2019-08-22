<?php

namespace Controller;

use Modele\User;

require_once '../View/Template/header.php';

if ($page === 'profil')
{
	$user = new User();
}
elseif
	($page === 'accueil')
{
	
}
elseif ($page === 'galerie')
{
	
}


require_once '../View/' . $page . '.php';

require_once '../View/Template/footer.php';