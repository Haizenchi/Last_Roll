<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/style_signup.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Atkinson+Hyperlegible:ital,wght@0,400;0,700;1,400;1,700&display=swap" rel="stylesheet">
    <script src="script/script_signup.js" defer></script>
    <title>Créer un Compte</title>
</head>

<body>

    <header>

        <img id="logo" src="img/logo_lastroll.webp" alt="logo_lastroll">

        <button id="menuButton" aria-label="Ouvrir le menu">☰</button>

        <nav id="mainNav">
            <a href="#">Trouver une Table</a>
            <a href="index.php?page=signup">Créer un Compte</a>
            <a href="index.php?page=login">Se Connecter</a>
        </nav>

    </header>

    <section class="signup">

        <form id="signupForm" action="index.php?page=register" method="post">

            <fieldset>

                <h1>Inscription</h1>

                <label for="Identifiant">Identifiant</label>
                <input type="text" id="Identifiant" name="nickname" required autocomplete="username" placeholder="Choissisez votre identifiant" maxlength="20" minlength="4">
                <label for="Mail">E-Mail</label>
                <input type="email" id="Mail" name="email" required autocomplete="email" maxlength="255" placeholder="Entrez votre adresse mail">
                <label for="Password">Mot de Passe</label>
                <input type="password" id="Password" name="password" required autocomplete="new-password" placeholder="Entrez votre mot de passe" maxlength="24" minlength="6">
                <label for="ConfirmPassword">Confirmation de Mot de Passe</label>
                <input type="password" id="ConfirmPassword" name="confirm_password" required autocomplete="new-password" placeholder="Confirmez votre mot de passe" maxlength="24" minlength="6">
            
                <button type="submit">Créer un Compte</button>

                <?php
                $status = $_GET['status'] ?? '';
                if ($status === 'success') {
                    echo '<p role="status">Compte créé avec succès.</p>';
                } elseif ($status === 'duplicate') {
                    echo '<p role="status">Ce pseudo ou cet e-mail est déjà utilisé.</p>';
                } elseif ($status === 'password_mismatch') {
                    echo '<p role="status">Les mots de passe ne correspondent pas.</p>';
                } elseif ($status === 'invalid') {
                    echo '<p role="status">Les informations du formulaire sont invalides.</p>';
                } elseif ($status === 'error') {
                    echo '<p role="status">Échec de la création du compte. Vérifie la connexion à MySQL.</p>';
                }
                ?>

            </fieldset>

        </form> 

    </section>

    <footer>

        <nav>
            <a href="#">Trouver une Table</a>
            <a href="#">À Propos</a>
            <a href="#">Mentions légales</a>
        </nav>

        <p>Last Roll© 2026</p>

    </footer>
    
</body>

</html>