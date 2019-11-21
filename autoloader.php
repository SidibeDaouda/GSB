<?php
//permet d'inclure un fichier dans un fichier php s'il existe
function loadFile($file)
{
	if (file_exists($file)) {
		require_once $file;
		return TRUE;
	}
	return FALSE;
}

function chargerclasse($classe)
{
	//on passe comme parametre au tableau $dirs tous les dossiers
	//dans lequels on doit rechercher des fichier php a inclure
	//dans les fichier php de notre application

	$dirs[]='model/'.$classe.'.php';
	$dirs[]=$classe.'.php';

	//le tableau $dir est parcouru et chaque fois que l'on trouve
	//un fichier php dans un dossier il est inclu dans le fichier php
	//courant.
	foreach ($dirs as $start) {
		if (loadFile($start)) {
			$success = TRUE;
			break;
		}

	}
}
//permet de declancher la fonction chargerclasse
spl_autoload_register('chargerclasse');
