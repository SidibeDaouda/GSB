<?php
// on doit appeler session_start() avant le chargement

// on genere un token pour l'utiliser avec la protection CSRF.
// on ne stocke pas le token.
function csrf_token() {
	return md5(uniqid(rand(), TRUE));
}

// on genere et on stocke le token CSRF dans la session utilisateur.
// la session doit avoir deja commence.
//on creer un token (une valeur généré aleatoirement avec la fonction md5 et rand )
//on stock ce token dans une variable de session ainsi que son heure de creation
// cela va permetre de comparer le token qui sera envoyé a partir du champ caché sur formulaire avec le token stocké dans la varibke de session et de s'assurer que le token
//soit encore valide
function create_csrf_token() {
	$token = csrf_token();
  $_SESSION['csrf_token'] = $token;
 	$_SESSION['csrf_token_time'] = time();
	return $token;
}

// on detruit un token en le supprimant de la session.
function destroy_csrf_token() {
  $_SESSION['csrf_token'] = null;
 	$_SESSION['csrf_token_time'] = null;
	return true;
}

// on retourne un tag HTML qui inclut le token 
// à utiliser dans un formulaire.
// utilisation: echo csrf_token_tag();
function csrf_token_tag() {
	$token = create_csrf_token();
	return "<input type=\"hidden\" name=\"csrf_token\" value=\"".$token."\">";
}

// retourne vrai sil'utilisateur a retourne le token
// qui doit être identique au token stocke dans la session.
// retourne faux sinon.
function csrf_token_is_valid() {
	if(isset($_POST['csrf_token'])) {
		$user_token = $_POST['csrf_token'];
		$stored_token = $_SESSION['csrf_token'];
		return $user_token === $stored_token;
	} else {
		return false;
	}
}

// on peut verifier la validite du token 
// gerer l'erreur 
function die_on_csrf_token_failure() {
	if(!csrf_token_is_valid()) {
		die("CSRF token validation failed.");
	}
}

// on verifie que le tocken est recent
//
function csrf_token_is_recent() {
	$max_elapsed = 60 * 60 * 24; // 1 jour
        $max_elapsed=60*2;
	if(isset($_SESSION['csrf_token_time'])) {
		$stored_time = $_SESSION['csrf_token_time'];
		return ($stored_time + $max_elapsed) >= time();
	} else {
		// on supprime le tocken qui a exipre
		destroy_csrf_token();
		return false;
	}
}

?>
