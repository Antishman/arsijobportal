<form method="POST" action="/login">
    @csrf
    <input type="text" name="username" placeholder="Username (admin/employer/email)">
    <input type="password" name="password" placeholder="Password">
    <button type="submit">Login</button>
</form>
