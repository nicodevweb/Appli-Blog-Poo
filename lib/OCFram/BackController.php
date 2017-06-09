<?php
// Classe de base dont héritera chaque contrôleur
// C'est un composant de l'application, donc a un lien de parenté avec ApplicationComponent
// Permet :
// - D'exécuter une action
// - D'btenir la page associée au contrôleur
// - De modifier le module, l'action et la vue associés au contrôleur
namespace OCRFram;

abstract class BackController extends ApplicationComponent
{
	protected	$action = '',
				$managers = null,
				$module = '',
				$page = null,
				$view = '';

	// Le constructeur se charge d'appeler le constructeur de son parent
	// Puis de créer une instance de la classe Page qu'il stockera l'attribut correspondant
	// Enfin il assigne les valeurs au module, à l'action et à la vue (par défaut vue = action)
	public function __construct(Application $app, $module, $action)
	{
		parent::__construct($app);

		$this->managers = new Managers('PDO', PDOFactory::getMysqlConnexion());
		$this->page = new Page($app);

		$this->setAction($action);
		$this->setModule($module);
		$this->setView($action);
	}

	// Méthode permettant d'invoquer la méthode correspondant à l'action assignée à l'objet
	// La méthode appellée doit être au format executeNomdelaction()
	public function execute()
	{
		$method = 'execute' . ucfirst($this->action);

		if (!is_callable([$this, $method]))
		{
			throw new \RuntimeException('L\'action "' . $this->action . '" n\'est pas définie sur ce module');
		}

		$this->$method($this->app->httpRequest());
	}

	// Getters du BackController
	public function page()
	{
		return $this->page;
	}

	// Setters du BackController
	public function setAction($action)
	{
		if (!is_string($action) || empty($action))
		{
			throw new \InvalidArgumentException('L\'action doit être une chaîne de caractères valide');
		}

		$this->action = $action;
	}

	public function setModule($module)
	{
		if (!is_string($module) || empty($module))
		{
			throw new \InvalidArgumentException('Le module doit être une chaîne de caractères valide');
		}

		$this->module = $module;
	}

	public function setView($view)
	{
		if (!is_string($view) || empty($view))
		{
			throw new \InvalidArgumentException('La vue doit être une chaîne de caractères valide');
		}

		$this->view = $view;

		$this->page->setContentFile(__DIR__.'/../../App/'.$this->app->name().'/Modules/'.$this->module.'/Views/'.$this->view.'.php');
	}
}