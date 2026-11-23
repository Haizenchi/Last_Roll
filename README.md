# Last Roll — inscription PHP / MySQL

Projet structuré comme en cours : `public`, `src/Controller`, `src/Database`, `src/Entity`, `src/Repository`, `src/Service`, `template`, Composer et `.env`.

## Installation

1. Ouvrir le dossier dans VS Code.
2. Vérifier que la base `last_roll` et sa table `user` existent dans MySQL. Ne pas réexécuter `bdd.sql` si la base existe déjà.
3. Copier `.env.example` sous le nom `.env`, puis renseigner les identifiants MySQL. Si le mot de passe MySQL contient des caractères spéciaux, l'entourer de guillemets doubles dans `.env`.
4. Dans un terminal à la racine du projet, exécuter `composer install` (ou `composer dump-autoload` si `vendor/` existe déjà).
5. Vérifier que l'extension PHP `pdo_mysql` est active (`php -m`).
6. Démarrer le serveur :

   ```bash
   php -S 127.0.0.1:8000 -t public
   ```

7. Ouvrir `http://127.0.0.1:8000/`, puis créer un compte.
8. Vérifier dans MySQL Workbench :

   ```sql
   SELECT id_user, nickname, email, password FROM `user`;
   ```

Les mots de passe doivent être enregistrés sous forme de hash. Les pseudonymes et les adresses e-mail sont uniques.

## Périmètre

Seule l'inscription PHP / MySQL est implémentée. La page de connexion est conservée, mais ne connecte pas les utilisateurs.

## Après les tests

Le code PHP et JavaScript a été laissé sans commentaires : ils seront ajoutés pendant la relecture.
