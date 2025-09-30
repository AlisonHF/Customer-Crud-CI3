<table border="1" cellpadding="5" class="table mt-3">

    <?php if (isset(($_GET['update'])) && $_GET['update'] == 'true'): ?>
        <div class="alert alert-success mt-3 mb-3 text-center" role="alert">
            Registro atualizado com sucesso!
        </div>

    <?php elseif(isset(($_GET['insert'])) && $_GET['insert'] == 'true'): ?>
        <div class="alert alert-success mt-3 mb-3 text-center" role="alert">
            Registro incluído com sucesso!
        </div>

    <?php elseif(isset(($_GET['delete'])) && $_GET['delete'] == 'true'): ?>
        <div class="alert alert-success mt-3 mb-3 text-center" role="alert">
            Registro excluído com sucesso!
        </div>

    <?php endif; ?>

    <?php if(empty($clientes)): ?>
        <h1>Sem registros!</h1>
    <?php else: ?>

        <tr>
            <th>ID</th><th>Nome/Razão</th><th>CPF/CNPJ</th><th>Email</th><th>Telefone</th><th>CEP</th><th>Endereço</th><th>Cidade</th><th>UF</th><th>Ações</th>
        </tr>

        <?php foreach ($clientes as $cliente): ?>
        <tr>
            <td><?= $cliente->id ?></td>
            <td><?= $cliente->nome_razao ?></td>
            <td><?= $cliente->cpf_cnpj ?></td>
            <td><?= $cliente->email ?></td>
            <td><?= $cliente->telefone ?></td>
            <td><?= $cliente->cep ?></td>
            <td><?= $cliente->endereco ?></td>
            <td><?= $cliente->cidade ?></td>
            <td><?= $cliente->uf ?></td>
            <td>
                <a href="<?= site_url('Cliente/update/'.$cliente->id) ?>">Editar</a> |
                <a href="<?= site_url('Cliente/delete/'.$cliente->id) ?>" onclick="return confirm('Tem certeza?')">Excluir</a>
            </td>
        </tr>
        <?php endforeach; ?>

    <?php endif; ?>
</table>

<a href="/Cliente/insert" class="mt-5">Clique aqui para adicionar um cliente</a>
