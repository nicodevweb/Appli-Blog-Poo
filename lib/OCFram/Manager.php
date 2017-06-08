<?php
// Classe Manager permettant d'implémenter un constructeur qui demandera le DAO par le biais d'un paramètre

namespace OCFram;

abstract class Manager
{
	protected $dao;

	public function __construct($dao)
	{
		$this->dao = $dao;
	}
}