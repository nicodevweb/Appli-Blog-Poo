<?php
// Représentatioin de la requête client

namespace OCFram;

class HTTPRequest
{
	// Méthode permettant de récupérer un COOKIE
	public function cookieData($key)
	{
		return isset($_COOKIE[$key]) ? $_COOKIE[$key] : null;
	}

	// Méthode permettant de savoir si un COOKIE existe
	public function cookieExists($key)
	{
		return isset($_COOKIE[$key]);
	}

	// Méthode permettant de récupérer une variable GET
	public function getData($key)
	{
		return isset($_GET[$key]) ? $_GET[$key] : null;
	}

	// Méthode permettant de savoir si une variable GET existe
	public function getExists($key)
	{
		return isset($_GET[$key]);
	}

	// Méthode permettant de récupérer la méthode d'envoi des données
	public function method()
	{
		return $_SERVER['REQUEST_METHOD'];
	}

	// Méthode permettant de récupérer une variable POST
	public function postData($key)
	{
		return isset($_POST[$key]) ? $_POST[$key] : null;
	}

	// Méthode permettant de savoir si une variable POST existe
	public function postExists($key)
	{
		return isset($_POST[$key]);
	}

	// Méthode permettant de récupérer l'URL demandée
	public function requestURI()
	{
		return $_SERVER['REQUEST_URI'];
	}
}