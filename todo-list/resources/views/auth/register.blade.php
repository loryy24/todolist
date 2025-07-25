<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Inscription</title>
    <style>
        body {
            background: #f3f4f6;
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .card {
            background: white;
            padding: 30px;
            border-radius: 10px;
            width: 350px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }

        input {
            width: 100%;
            padding: 10px;
            margin-top: 10px;
            margin-bottom: 5px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        button {
            width: 100%;
            background-color: #10b981;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 5px;
            margin-top: 15px;
            cursor: pointer;
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
        }

        p {
            color: red;
            font-size: 0.9em;
            margin: 0 0 10px 0;
        }
    </style>
</head>
<body>

    <div class="card">
        <h1>Créer un compte</h1>

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <input name="name" placeholder="Nom" value="{{ old('name') }}">
            @error('name')
                <p>{{ $message }}</p>
            @enderror

            <input name="email" type="email" placeholder="Email" value="{{ old('email') }}">
            @error('email')
                <p>{{ $message }}</p>
            @enderror

            <input name="password" type="password" placeholder="Mot de passe">
            @error('password')
                <p>{{ $message }}</p>
            @enderror

            <input name="password_confirmation" type="password" placeholder="Confirmation">

            <button type="submit">S'inscrire</button>
        </form>
        <p style='{text-align: center}'>vous avez deja un compte? <a href="{{ route('login') }}">Connectez-vous</a></p>
    </div>

</body>
</html>
