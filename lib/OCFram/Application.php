<?php
// Classe mère Application dont héritent HTTPRequest et HTTPResponse

namespace OCRFram

abstract class Application
{
	protected	$HTTPRequest,
				$HTTPResponse,
				$name;

	// Le constructeur se contente juste d'instancier ses classes filles
	public function __construct()
	{
		$this->HTTPRequest = new HTTPRequest;
		$this->HTTPResponse = new HTTPResponse;
		$this->name = '';
	}

	// Méthode d'éxecution de l'application
	abstract public function run();

	// Getter d'une instance HTTPRequest
	public function httpRequest()
	{
		return $this->HTTPRequest;
	}

	// Getter d'une instance de HTTPResponse
	public function httpResponse()
	{
		return $this->HTTPResponse;
	}

	// Getter du nom de m'application
	public function name()
	{
		return $this->name;
	}
}