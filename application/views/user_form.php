<h1><?= isset($user) ? 'Editar Usuário' : 'Novo Usuário' ?></h1>
<form method="POST" class="form-control">
    <label class="form-label">Nome:</label>
    <input class="form-control type="text" name="name" value="<?= isset($user) ? $user->name : '' ?>"><br>

    <label class="form-label">Username:</label>
    <input class="form-control type="text" name="username" value="<?= isset($user) ? $user->username : '' ?>"><br>

    <label class="form-label">Sobrenome:</label>
    <input class="form-control type="text" name="lastname" value="<?= isset($user) ? $user->lastname : '' ?>"><br>

    <label class="form-label">Email:</label>
    <input class="form-control type="email" name="email" value="<?= isset($user) ? $user->email : '' ?>"><br>

    <button class="btn btn-success" type="submit">Salvar</button>
</form>
