<?php
// Obtention du contrôleur grâce à la méthode parente getController().
// Exécution du contrôleur.
// Assignation de la page créée par le contrôleur à la réponse.
// Envoi de la réponse.

class FrontendApplication extends Application
{
  public function __construct()
  {
    parent::__construct();

    $this->name = 'Frontend';
  }

  public function run()
  {
    $controller = $this->getController();
    $controller->execute();

    $this->httpResponse->setPage($controller->page());
    $this->httpResponse->send();
  }
}