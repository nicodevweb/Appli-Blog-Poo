<?php
// Classe mère Application

namespace OCFram;

abstract class Application
{
	protected	$httpRequest,
				$httpResponse,
				$name,
				$user,
				$config;

	// Le constructeur se contente juste d'instancier ses classes filles
	public function __construct()
	{
		$this->httpRequest = new httpRequest($this);
		$this->httpResponse = new httpResponse($this);
		$this->name = '';
		$this->user = new User($this);
	}

	// Méthode permettant de récupérer le controller du router
	public function getController()
	{
		$router = new Router;

		$xml = new \DomDocument;
		$xml->load(__DIR__ . '/../../App/' . $this->name . '/Config/routes.xml');

		$routes = $xml->getElementsByTagName('route');

		// On parcourt les routes du fichier XML
		foreach ($routes as $route)
		{
			$vars = [];

			// On regarde si des variables sont présentes dans l'URL
			if ($route->hasAttribute('vars'))
			{
				$vars = explode(',', $route->getAttribute('vars'));
			}

			// On ajoute la route au routeur
			$router->addRoute(new Route($route->getAttribute('url'), $route->getAttribute('module'), $route->getAttribute('action'), $vars));
		}

		try
		{
			// On récupère la route correspondante à l'URL
			$matchedRoute = $router->getRoute($this->httpRequest->requestURI());
		}
		catch (\RuntimeException $e)
		{
			if ($e->getCode() == Router::NO_ROUTE)
			{
				// Si aucune route ne correspond, c'est que la page demandée n'existe pas
				$this->httpResponse->redirect404();
			}
		}

		// On ajoute les variables de l'URL au tableau $_GET
		$_GET = array_merge($_GET, $matchedRoute->vars());

		// On instancie le controller
		$controllerClass = 'App\\' . $this->name . '\\Modules\\' . $matchedRoute->module() . '\\' . $matchedRoute->module() . 'Controller';

		return new $controllerClass($this, $matchedRoute->module(), $matchedRoute->action());
	}

	// Méthode d'éxecution de l'application
	abstract public function run();

	// Getter de la configuration
	public function config()
	{
		return $this->config;
	}

	// Getter d'une instance HTTPRequest
	public function httpRequest()
	{
		return $this->httpRequest;
	}

	// Getter d'une instance de HTTPResponse
	public function httpResponse()
	{
		return $this->httpResponse;
	}

	// Getter du nom de l'application
	public function name()
	{
		return $this->name;
	}

	// Getter de l'utilisateur
	public function user()
	{
		return $this->user;
	}
}