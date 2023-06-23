<?php
// Vérifier si le formulaire a été soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Verifications de base
    date_default_timezone_set('Europe/Paris');

    $nom = strtoupper(htmlspecialchars($_POST['nom']));
    $prenom = htmlspecialchars($_POST['prenom']);
    $today = date("Y_m_d_His");

    $zipFileName = $nom . '_' . $prenom . '_' . $today . '.zip';

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
    // $zipFilePath = $targetDir . 'files.zip';
    $zipFilePath = $targetDir . $zipFileName;


    // Créer une instance de ZipArchive
    $zip = new ZipArchive();

    // Ouvrir l'archive ZIP
    if ($zip->open($zipFilePath, ZipArchive::CREATE | ZipArchive::OVERWRITE) === true) {
        // Mot de passe


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
        $zip->setPassword('passW0rd');    

        $zip->close();

        // Supprimer les fichiers temporaires
        $tempFiles = glob($tempDir . '*');
        foreach ($tempFiles as $tempFile) {
            if (is_file($tempFile)) {
                unlink($tempFile);
            }
        }

        include 'reussite.php';
        // echo 'Les fichiers ont été téléchargés et enregistrés dans un fichier ZIP avec succès.';

        // Exécuter le script Python
        $command = "python ./encrypt.py";
        $output = shell_exec($command);
        echo $output;

        // $command = "python ./test.py";
        // $output = shell_exec($command);
        // echo $output;
    } else {
        echo 'Impossible de créer ou d\'ouvrir le fichier ZIP.';
    }
}
?>