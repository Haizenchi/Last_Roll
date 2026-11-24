<?php

// Défini l'espace de noms auquel appartient la classe RegistrationService.
namespace App\Service;

// Importation des classes necessaires au service d'inscription.
use App\Entity\User;
use App\Repository\UserRepository;
use Lemmon\Validator\Validator;

// Déclaration de la classe RegistrationService,
// chargée de gérer la logique métier de l'inscription.
class RegistrationService
{
    public function register(array $data): string
    {
        // Définition des règles du schéma de validation et de nettoyage
        // des données du formulaire d'inscription avec Lemmon.
        $schema = Validator::isAssociative([
            'nickname' => Validator::isString()->pipe('trim')->between(4, 20)->required(),
            'email' => Validator::isString()->pipe('trim')->maxLength(255)->email()->required(),
            'password' => Validator::isString()->between(6, 24)->required(),
            'confirm_password' => Validator::isString()->required(),
        ]);

        // Vérifie les données du formulaire selon les règles du schéma.
        // $valid indique si la validation a réussi.
        // $validatedData contient les données validées et nettoyées.
        [$valid, $validatedData] = $schema->tryValidate($data);

        // Arrête l'inscription si une règle de validation n'est pas respectée.
        if (!$valid) {
            return 'invalid';
        }

        // Récupération des données validées par Lemmon dans des variables
        // individuelles pour leur utilisation dans la suite de l'inscription.
        $nickname = $validatedData['nickname'];
        $email = $validatedData['email'];
        $password = $validatedData['password'];
        $confirmation = $validatedData['confirm_password'];

        // Vérifie que les deux mots de passe correspondent.
        // Si ce n'est pas le cas, interrompt l'inscription.
        if ($password !== $confirmation) {
            return 'password_mismatch';
        }

        // Instanciation du Repository pour interagir avec la BDD.
        $repository = new UserRepository();

        // Vérification de l'existence du pseudo ou de l'email en BDD.
        // Interruption de l'inscription en cas de doublon.
        if ($repository->exists($nickname, $email)) {
            return 'duplicate';
        }

        // Instanciation et hydratation de l'objet User
        // avec les données validées et le mot de passe haché.
        $user = new User();
        $user->setNickname($nickname);
        $user->setEmail($email);
        $user->setPassword(password_hash($password, PASSWORD_DEFAULT));

        // Transmission de l'objet User au Repository
        // pour son enregistrement en BDD.
        $repository->create($user);

        // Retour du statut de réussite au Controller.
        return 'success';
    }
}
