<?php

// fonctions de validation
//elles sont appeles à partir d'une autre fonction de validation qui reportent les erreurs
// 
//
// Par exemple:
//
// $errors = [];
// function validate_presence_on($required_fields) {
//   global $errors;
//   foreach($required_fields as $field) {
//     if (!has_presence($_POST[$field])) {
//       $errors[$field] = "'" . $field . "' can't be blank";
//     }
//   }
// }

// * valide l'existence de la valeur
// utiliser trim() ainsi les espaces vides sont supprimées
// utiliser === pour un test exact des valeurs
// empty() supose que "0" est vide
function has_presence($value) {
	$trimmed_value = trim($value);
  return ((isset($trimmed_value)) && (!empty($trimmed_value)));
}

// * valide la longueur des valeurs
// les espaces comptent
// options: exact, max, min
// has_length($first_name, ['exact' => 20])
// has_length($first_name, ['min' => 5, 'max' => 100])
function has_length($value, $options=[]) {
	if(isset($options['max']) && (strlen($value) > (int)$options['max'])) {
		return false;
	}
	if(isset($options['min']) && (strlen($value) < (int)$options['min'])) {
		return false;
	}
	if(isset($options['exact']) && (strlen($value) != (int)$options['exact'])) {
		return false;
	}
	return true;
}



// Example:
// has_format_matching('1234', '/\d{4}/') is true
function has_format_matching($value, $regex='//') {
	return preg_match($regex, $value);
}

// * valide que la valeur est un nombre
// les valeurs soumises sont des  chaines, on utilise is_numeric au lieu de is_int
// options: max, min
// has_number($items_to_order, ['min' => 1, 'max' => 5])
function has_number($value, $options=[]) {
	if(!is_numeric($value)) {
		return false;
	}
	if(isset($options['max']) && ($value > (int)$options['max'])) {
		return false;
	}
	if(isset($options['min']) && ($value < (int)$options['min'])) {
		return false;
	}
	return true;
}

// * valide qu'une valeur est dans un ensemble
function has_inclusion_in($value, $set=[]) {
  return in_array($value, $set);
}

// * valide qu'une valeur est exclue d'un ensemble.
function has_exclusion_from($value, $set=[]) {
  return !in_array($value, $set);
}

// * verifier l'unicite dans une table


//   sql = "SELECT COUNT(*) as count FROM {$table} WHERE condition';"
//   if count > 0 alors la valeur est déja présente dans la table est n'est pas unnique.
// }

?>
