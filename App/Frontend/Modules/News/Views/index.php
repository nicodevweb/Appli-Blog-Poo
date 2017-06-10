<?php
// Affiche la liste des news
// On parcourt l'objet comme un tableau grace à l'interface ArrayAccess
foreach ($listeNews as $news)
{
?>
  <h2><a href="news-<?= $news['id'] ?>.html"><?= $news['titre'] ?></a></h2>
  <p><?= nl2br($news['contenu']) ?></p>
<?php
}