<?php
// Classe mètre ApplicationComponent dont héritent HTTPRequest et HTTPResponse, stockant l'instance de l'application exécutée pendant la construction de l'objet

namespace OCRFram;

abstract class ApplicationComponent
{
	protected $app;

	// Le constructeur se contente d'hydrater l'instance avec celle de l'application exécutée
	public function __construct(Application $app)
	{
		$this->app = $app;
	}

	// Getter de l'instance d'application
	public function app()
	{
		return $this->app;
	}
}