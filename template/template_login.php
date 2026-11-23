<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/style_login.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Atkinson+Hyperlegible:ital,wght@0,400;0,700;1,400;1,700&display=swap" rel="stylesheet">
    <script src="script/script_login.js" defer></script>
    <title>Se Connecter</title>
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

    <section class="login">

        <form id="loginForm" action="#" method="post">

            <fieldset>

                <p><strong>Connexion</strong></p>

                <label for="Identifiant">Identifiant</label>
                <input type="text" id="Identifiant" name="nickname" placeholder="Choissisez votre identifiant" maxlength="20" minlength="4">
                <label for="Password">Mot de Passe</label>
                <input type="password" id="Password" name="password" placeholder="Entrez votre mot de passe" maxlength="24" minlength="6">
            
                <button>Se Connecter</button>

                <p class="signup-link"> Pas encore de compte ? <a href="index.php?page=signup"> Créer un compte </a></p>

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