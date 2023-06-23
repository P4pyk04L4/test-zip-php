#!/bin/python
import sys
import pyzipper

secret_password = b'lost art of keeping a secret'

# Récupérer la valeur de la variable depuis les arguments de ligne de commande
variable_python = sys.argv[0]
# Chemin du fichier zip à ajouter à l'archive

fichier_zip_a_ajouter = './uploads/POIROT_Hercule_2023_06_23_123926.zip'

with pyzipper.AESZipFile('./uploads/chiffre/POIROT_Hercule_2023_06_23_123926.zip',
                        'w',
                        compression=pyzipper.ZIP_LZMA,
                        encryption=pyzipper.WZ_AES) as zf:
    zf.setpassword(secret_password)

    # Ajouter le fichier zip à l'archive
    zf.write(fichier_zip_a_ajouter, arcname='POIROT_Hercule_2023_06_23_123926.zip')

# with pyzipper.AESZipFile('./uploads/chiffre/new_test.zip') as zf:
#     zf.setpassword(secret_password)

#     # Extraire le contenu du fichier zip ajouté depuis l'archive
#     zf.extractall('./uploads/chiffre/extracted_files')



# Utiliser la valeur de la variable dans votre script Python
# print("Valeur de la variable Python :", variable_python)