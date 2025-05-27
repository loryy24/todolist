<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Déconnexion</title>
</head>
<body>

    <h1>Bienvenue, vous êtes connecté</h1>

    <form method="POST" action="/logout">
        @csrf
        <button type="submit">Se déconnecter</button>
    </form>

</body>
</html>
