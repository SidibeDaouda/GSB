<?php
// Les requetes GET ne doivent pas faire de changement elles sont idempotentes
// Les requetes POST Peuvent faire des changements

function request_is_get() {
	return $_SERVER['REQUEST_METHOD'] === 'GET';
}

function request_is_post() {
	return $_SERVER['REQUEST_METHOD'] === 'POST';
}

// uTILISATION:
// if(request_is_post()) {
//   ... traitement de formulaire, mise a jour de base de donnee, etc.
// } else {
//   ... requete de recherche, redirection, page erreur, etc.
// }
?>
