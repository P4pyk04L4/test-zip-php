<?php
// Vérifier si le formulaire a été soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Répertoire de destination pour enregistrer les fichiers
    $targetDir = 'uploads/';
    // Répertoire pour les fichiers temporaires
    $tempDir = 'temp/';

    // Vérifier si les répertoires de destination existent, sinon les créer
    if (!is_dir($targetDir)) {
        mkdir($targetDir, 0777, true);
    }
    if (!is_dir($tempDir)) {
        mkdir($tempDir, 0777, true);
    }

    // Chemin complet du fichier ZIP
    $zipFilePath = $targetDir . 'files.zip';

    // Créer une instance de ZipArchive
    $zip = new ZipArchive();

    // Ouvrir l'archive ZIP
    if ($zip->open($zipFilePath, ZipArchive::CREATE | ZipArchive::OVERWRITE) === true) {
        // Parcourir tous les fichiers reçus
        foreach ($_FILES['uploadFile']['name'] as $index => $fileName) {
            $fileTmpPath = $_FILES['uploadFile']['tmp_name'][$index];

            if (!empty($fileTmpPath) && file_exists($fileTmpPath)) {
                // Vérifier l'existence du fichier avant de l'ajouter à l'archive ZIP
                if (is_readable($fileTmpPath)) {
                    // Générer un nom unique pour le fichier pour éviter les conflits
                    $uniqueFileName = uniqid() . '_' . $fileName;

                    // Déplacer le fichier téléchargé vers le répertoire temporaire
                    $tempFilePath = $tempDir . $uniqueFileName;

                    if (move_uploaded_file($fileTmpPath, $tempFilePath)) {
                        // Ajouter le fichier temporaire au fichier ZIP
                        $zip->addFile($tempFilePath, $fileName);
                    }
                }
            }
        }

        // Fermer le fichier ZIP
        $zip->close();

        // Supprimer les fichiers temporaires
        $tempFiles = glob($tempDir . '*');
        foreach ($tempFiles as $tempFile) {
            if (is_file($tempFile)) {
                unlink($tempFile);
            }
        }

        echo 'Les fichiers ont été téléchargés et enregistrés dans un fichier ZIP avec succès.';
    } else {
        echo 'Impossible de créer ou d\'ouvrir le fichier ZIP.';
    }
}
?>
