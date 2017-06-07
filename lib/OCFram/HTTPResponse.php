<?php
// Représentation de la réponse envoyée au client

namespace OCRFram

class HTTPResponse
{
	protected $page;

	// Méthode permettant d'ajouter le Header
	public function addHeader($header)
	{
		header($header);
	}

	// Méthode permettant de rediriger l'utilisateur
	public function redirect($location)
	{
		header('Location: ' . $location);
		exit;
	}

	// Méthode permettant de rediriger l'utilisateur vers une erreur 404
	public function redirect404()
	{

	}

	// Méthode permettant d'envoyer la page demandée
	public function send()
	{
		exit($this->page->getGeneratedPage());
	}

	// Méthode permettant d'ajouter un COOKIE, le dernier argument est par défaut à TRUE (au lieu de FALSE lors de l'appel à la fonction PHP setcookie())
	public function setCookie($name, $value = '', $expire = 0, $path = null, $domain = null, $secure = FALSE, $httpOnly = TRUE)
	{
		setcookie($name, $value, $expire, $path, $domain, $secure, $httpOnly);
	}

	// Méthode permettant d'ajouter la page à afficher
	public function setPage(Page $page)
	{
		$this->page = $page;
	}
}