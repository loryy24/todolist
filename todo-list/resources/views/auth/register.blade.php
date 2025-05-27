<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Inscription</title>
</head>
<body>

    <h1>Créer un compte</h1>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <div>
            <label for="name">Nom</label><br>
            <input name="name" placeholder="Nom" value="{{ old('name') }}">
            @error('name')
                <p style="color:red;">{{ $message }}</p>
            @enderror
        </div>

        <br>

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
            @error('password')
                <p style="color:red;">{{ $message }}</p>
            @enderror
        </div>

        <br>

        <div>
            <label for="password_confirmation">Confirmation du mot de passe</label><br>
            <input name="password_confirmation" type="password" placeholder="Confirmation">
        </div>

        <br>

        <button type="submit">S'inscrire</button>
    </form>

</body>
</html>
