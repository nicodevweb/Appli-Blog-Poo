<?php
// Classe permettant d'enregistrer temporairement l'utilisateur en mémoire
// Démarre une session
// Elle permet :
// 1- D'assigner un attribut à l'utilisateur
// 2- D'obtenir la valeur d'un attribut
// 3- D'authentifier l'utilisateur
// 4- Savoir si l'utilisateur est authentifié
// 5- Assigner un message informatif à l'utilisateur et l'afficher sur la page
// 6- Savoir si l'utilisateur a un tel message
// 7- Récupérer ce message

namespace OCFram;

session_start();

class User
{
  public function getAttribute($attr)
  {
    return isset($_SESSION[$attr]) ? $_SESSION[$attr] : null;
  }

  public function getFlash()
  {
    $flash = $_SESSION['flash'];
    unset($_SESSION['flash']);

    return $flash;
  }

  public function hasFlash()
  {
    return isset($_SESSION['flash']);
  }

  public function isAuthenticated()
  {
    return isset($_SESSION['auth']) && $_SESSION['auth'] === true;
  }

  public function setAttribute($attr, $value)
  {
    $_SESSION[$attr] = $value;
  }

  public function setAuthenticated($authenticated = true)
  {
    if (!is_bool($authenticated))
    {
      throw new \InvalidArgumentException('La valeur spécifiée à la méthode User::setAuthenticated() doit être un boolean');
    }

    $_SESSION['auth'] = $authenticated;
  }

  public function setFlash($value)
  {
    $_SESSION['flash'] = $value;
  }
}