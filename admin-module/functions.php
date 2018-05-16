<?php

function get_header() {
	include_once 'header.php';
}

function get_footer() {
	include_once 'footer.php';
}

function escape($string) {
	return htmlentities($string, ENT_QUOTES, 'UTF-8');
}

function show_errors($errors) {
	echo '<ul class="errors">';
		foreach ($errors as $error)
			echo '<li>' . $error . '</li>';
	echo '</ul>';
}
