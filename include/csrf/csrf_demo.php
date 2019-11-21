<?php
session_start();
require_once 'csrf_request_type_functions.php';
require_once 'csrf_token_functions.php';

// on s'assure que  la méthode http qui soummet le formulaire est de type post 
if(request_is_post()) {
	// on verifier que le token est valide c'est a dire que le token envoyé a partir du champ caché du formulaire est indentique a celui stocké dans la variable de session
	if(csrf_token_is_valid()) {
		$message = "LE FORMULAIRE DE SOUMISSION EST VALIDE";
		// on va tester si le token est récent
		if(csrf_token_is_recent()) {
			$message .= " (recent)";
                        //on fait le traitement

		} else {
			$message .= " (not recent)";
                        //formulaire invalide
		}
	} else {
		$message = "CSRF TOKEN MISSING OR MISMATCHED";
		// on interdit le traitement avec la bdd par exemple
	}
} else {
	// form not submitted or was GET request
	$message = "Please login.";
}

?>
<html>
	<head>
		<title>CSRF Demo</title>
	</head>
	<body>
		<?php echo $message; ?><br />
		<form action="" method="post">
			<!-- cette fonction va afficher un champ caché qui va prendre la valeur d'un toke, (jeton) généré aleatoirement pour une durée donnée -->
			<?php  echo csrf_token_tag(); ?>
			Username: <input type="text" name="username" /><br />
			Password: <input type="password" name="password"><br />
			<input type="submit" value="Submit" />
		</form>
	</body>
</html>
