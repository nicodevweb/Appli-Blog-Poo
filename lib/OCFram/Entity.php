<?php
// Classe mère Entity gérant toutes les entités
// Objectif :
// - Vérifier si l'enregistrement est nouveau ou pas
// - Implémenter les getters/setters
// - Implémenter l'interface ArrayAccess
namespace OCFram;

abstract class Entity implements \ArrayAccess
{
  protected $erreurs = [],
            $id;

  // Le constructeur hydratera l'objet uniquement si un tableau de valeurs lui est fourni
  public function __construct(array $donnees = [])
  {
    if (!empty($donnees))
    {
      $this->hydrate($donnees);
    }
  }

  // Hydratateur de la classe Entity  
  public function hydrate(array $donnees)
  {
    foreach ($donnees as $attribut => $valeur)
    {
      $methode = 'set'.ucfirst($attribut);

      if (is_callable([$this, $methode]))
      {
        $this->$methode($valeur);
      }
    }
  }

  // Méthode vérifiant si l'entrée est nouvelle
  // On vérifie pour cela si l'attribut $id est vide ou non
  public function isNew()
  {
    return empty($this->id);
  }

  // Getters de la classe Entity
  public function erreurs()
  {
    return $this->erreurs;
  }

  public function id()
  {
    return $this->id;
  }

  // Setters de la classe Entity
  public function setId($id)
  {
    $this->id = (int) $id;
  }

  // Méthodes de l'interface ArrayAccess
  public function offsetGet($var)
  {
    if (isset($this->$var) && is_callable([$this, $var]))
    {
      return $this->$var();
    }
  }

  public function offsetSet($var, $value)
  {
    $method = 'set'.ucfirst($var);

    if (isset($this->$var) && is_callable([$this, $method]))
    {
      $this->$method($value);
    }
  }

  public function offsetExists($var)
  {
    return isset($this->$var) && is_callable([$this, $var]);
  }

  public function offsetUnset($var)
  {
    throw new \Exception('Impossible de supprimer une quelconque valeur');
  }
}