<form method="POST" action="{{ route('login') }}">
    @csrf
    <input name="email" type="email" placeholder="Email">
    <input name="password" type="password" placeholder="Mot de passe">
    <button type="submit">Se connecter</button>
</form>
