<!DOCTYPE html>
<html lang="fr-FR">
<head>
    <title>Title</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">

    <link rel="stylesheet" href="style.css">
</head>

<body class="bg-dark">
    <div class="container-fluid" id="container">
        <div class="mx-auto col-sm-12 col-md-10 col-lg-8 bg-white" id="formulaire">
            
        <h1>Envoi de fichiers multiples</h1>
            
            <form action="upload.php" method="post" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="prenom" class="form-label">Prénom</label>
                    <input type="text" class="form-control" name="prenom" id="prenom" placeholder="Entrez votre prénom">
                </div>

                <div class="mb-3">
                    <label for="nom" class="form-label">Nom</label>
                    <input type="text" class="form-control" name="nom" id="nom" placeholder="Entrez votre nom">
                </div>

                <div class="mb-3">
                    <label for="uploadFile" class="form-label my-3">Choisir un ou plusieurs fichiers à nous transmettre, puis cliquer sur "Envoyer".</label>
                    <input type="file" class="form-control my-2" name="uploadFile[]" multiple>
                </div>
                
                <div class="text-center py-2">
                    <button type="submit" class="btn btn-primary ">Envoyer</button>
                </div>
                </form>
        </div>
    </div>
        


    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
        integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js"
        integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
    </script>
</body>

</html>