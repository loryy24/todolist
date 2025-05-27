<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Connexion</title>
</head>
<body>

    <h1>Connexion</h1>

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div>
            <label for="email">Adresse email</label><br>
            <input name="email" type="email" placeholder="Email" value="{{ old('email') }}">
            @error('email')
                <p style="color:red;">{{ $message }}</p>
            @enderror
        </div>

        <br>

        <div>
            <label for="password">Mot de passe</label><br>
            <input name="password" type="password" placeholder="Mot de passe">
        </div>

        <br>

        <button type="submit">Se connecter</button>
    </form>

</body>
</html>
