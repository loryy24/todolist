<form method="POST" action="{{ route('register') }}">
    @csrf
    <input name="name" placeholder="Nom">
    <input name="email" type="email" placeholder="Email">
    <input name="password" type="password" placeholder="Mot de passe">
    <input name="password_confirmation" type="password" placeholder="Confirmation">
    <button type="submit">S'inscrire</button>
</form>
