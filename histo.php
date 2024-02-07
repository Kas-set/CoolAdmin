<?php 

include('../admin/config/connexion.php');
$sql2 = "SELECT `nationalité`, COUNT(*) AS nombre_inscrits FROM `etudiant` GROUP BY nationalité";
// Exécution de la requête
$resultat2 = $conn->query($sql2);
$data = [];
while ($a = $resultat2->fetch_assoc()) {
    $nationalite = $a["nationalité"];
    $nombre_inscrits = $a["nombre_inscrits"];
    // Ajouter les informations à la tableau
    $data[$nationalite] = $nombre_inscrits;
}

$largeurImage = 800;
$hauteurImage = 500;
$espaceEnBas = 20; // Espace en pixels entre l'axe des abscisses et la bordure en bas
$espaceEntreBandes = 20; // Espace en pixels entre les bandes
$im = imagecreate($largeurImage, $hauteurImage + $espaceEnBas);
$blanc = ImageColorAllocate($im, 255, 255, 255);
$noir = ImageColorAllocate($im, 0, 0, 0);
$bleu = ImageColorAllocate($im, 0, 0, 255);

// Dessiner l'axe des ordonnées
ImageLine($im, 80, 10, 80, $hauteurImage - $espaceEnBas, $noir);

// Dessiner l'axe des abscisses
ImageLine($im, 80, $hauteurImage - $espaceEnBas, $largeurImage - 10, $hauteurImage - $espaceEnBas, $noir);

// Dessiner les barres pour chaque nationalité
$positionX = 120;
$fontSize = 12; // Taille de la police
$fontPath = './BALLW___.TTF'; // Remplacez par le chemin vers une police TrueType (TTF)

// Trouver le nombre maximum d'inscrits pour ajuster l'échelle des barres
$nombreMax = max($data);

// Calculer la hauteur maximale des barres
$hauteurMax = $hauteurImage - $espaceEnBas - 20; // Vous pouvez ajuster ce nombre selon vos besoins

// Dessiner les barres pour chaque nationalité
foreach ($data as $nationalite => $nombre) {
    $hauteurBarre = ($nombre / $nombreMax) * $hauteurMax;
    
    // Dessiner une barre pour chaque nationalité
    imagefilledrectangle($im, $positionX, $hauteurImage - $espaceEnBas - $hauteurBarre, $positionX + 40, $hauteurImage - $espaceEnBas, $bleu);

    // Écrire le nombre d'inscrits au-dessus de la barre
    imagettftext($im, $fontSize, 0, $positionX + 10, $hauteurImage - $espaceEnBas - $hauteurBarre - 5, $noir, $fontPath, $nombre);

    // Écrire le nom de la nationalité sous la barre
    imagettftext($im, $fontSize, 0, $positionX + 10, $hauteurImage + 15, $noir, $fontPath, $nationalite);

    // Mettre à jour la position X pour la prochaine barre
    $positionX += 60;
}

// Affichage de l'image
header("Content-type: image/png");
ImagePng($im);
ImageDestroy($im);
?>
