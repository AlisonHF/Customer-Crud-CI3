
<table border="1" cellpadding="5" class="table mt-3">
    <tr>
        <th>ID</th><th>Nome</th><th>Username</th><th>Sobrenome</th><th>Email</th><th>Ações</th>
    </tr>
    <?php foreach ($users as $u): ?>
    <tr>
        <td><?= $u->id ?></td>
        <td><?= $u->name ?></td>
        <td><?= $u->username ?></td>
        <td><?= $u->lastname ?></td>
        <td><?= $u->email ?></td>
        <td>
            <a href="<?= site_url('userController/edit/'.$u->id) ?>">Editar</a> |
            <a href="<?= site_url('userController/delete/'.$u->id) ?>" onclick="return confirm('Tem certeza?')">Excluir</a>
        </td>
    </tr>
    <?php endforeach; ?>
</table>
<a href="UserController/create" id="link-create" class="mt-5">Clique aqui para adicionar um usuário</a>