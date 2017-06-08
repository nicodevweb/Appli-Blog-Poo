<?php
// Classe permettant la recherche des routes

namespace OCRFram;

class Router
{
	protected $routes = [];

	const NO_ROUTE = 1:

	// Méthode d'ajout de route
	function addRoute(Route $route)
	{
		if (!in_array($route, $this->routes))
		{
			$this->routes[] = $route;
		}
	}

	public function getRoute($url)
	{
		foreach ($this->routes as $route)
		{
			// Si la route correspond à l'URL
			if (($varsValues = $route->match($url)) !== false)
			{
				// Si elle possède des variables
				if ($route->hasVars())
				{
					$varsNames = $route->varsNames();
					$listVars =[];

					// On créé un nouveau tableau clé/valeur
					// (Clé = nom de la variable, valeur = sa valeur)
					foreach ($varsValues as $key => $match)
					{
						// La première valeur contient entièrement la chaîne de caractère capturée (cf doc preg_match)
						if ($key !== 0)
						{
							$listVars[$varsNames[$key-1]] = $match;
						}
					}

					// On assigne ce tableau de variables à la route
					$route->setVars($listVars);
				}

				return $route;
			}
		}

		throw new \RunTimeException('Aucune route ne correspond à l\'URL ' . self::NO_ROUTE);
	}
}