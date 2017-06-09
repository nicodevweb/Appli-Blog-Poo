<?php
// Classe traitant des routes : une URL associée à un module et une action

namespace OCFram;

class Route
{
	protected	$action,
				$module,
				$url,
				$varsNames,
				$vars = [];

	// Le constructeur s'occupe d'hydrater les attributs de son instance
	public function __construct($url, $module, $action, array $varsNames)
	{
		$this->setUrl($url);
		$this->setModule($module);
		$this->setAction($action);
		$this->setVarsNames($varsNames);
	}

	// Méthode vérfiant l'existance des variables
	public function hasVars()
	{
		return !empty($this->varsNames);
	}

	// Méthode permettant de retourner l'existance de l'url entrée dans la liste des urls de l'application
	public function match($url)
	{
		if (preg_match('`^' . $this->url . '$`', $url, $matches))
		{
			return $matches;
		}
		else
		{
			return false;
		}
	}

	// Getters de la classe Route
	public function action()
	{
		return $this->action;
	}

	public function module()
	{
		return $this->module;
	}

	public function url()
	{
		return $this->url;
	}

	public function varsNames()
	{
		return $this->varsNames;
	}

	public function vars()
	{
		return $this->vars;
	}

	// Setters de la classe Route
	public function setAction($action)
	{
		if (is_string($action))
		{
			$this->action = $action;
		}
	}

	public function setModule($module)
	{
		if (is_string($module))
		{
			$this->module = $module;
		}
	}

	public function setUrl($url)
	{
		if (is_string($url))
		{
			$this->url = $url;
		}
	}

	public function setVarsNames(array $varsNames)
	{
		$this->varsNames = $varsNames;
	}

	public function setVars(array $vars)
	{
		$this->vars = $vars;
	}
}