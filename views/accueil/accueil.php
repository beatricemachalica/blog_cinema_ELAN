<?php

ob_start()

?>

<p style="text-align: center;">Bonjour à tous ! Je vous souhaite la bienvenue sur mon blog où vous pouvez consulter mes articles. Amusez-vous bien !
  <br>
  Voici un blog où j'ai utilisé une base de donnée et différentes classes en PHP 7 pour vous afficher des informations :)
  <br>
  J'ai également utilisé Bootstrap pour me faire un peu la main.
  <br>
  Soyez indulgents s'il vous plait, c'est la toute première fois !
  <br>
  Chaleureusement, Béa ♥
</p>

<?php

$titreOnglet = "Accueil";
$contenu = ob_get_clean();
require "./views/template.php";
