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

<h1 class="title">Listagem de clientes</h1>

<a href="/Cliente/insert" class="btn btn-primary mt-5 btn-add-cliente"><i class="bi bi-person-add"></i> Adicionar cliente</a>

<table border="1" cellpadding="5" class="table table-bordered table-hover mt-3">
    <?php if(empty($clientes)): ?>
        <h1>Sem registros!</h1>
    <?php else: ?>

        <tr class="text-center">
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
                <a href="<?= site_url('Cliente/update/'.$cliente->id) ?>" class="btn btn-primary btn-action">Editar</a>
                <a href="<?= site_url('Cliente/delete/'.$cliente->id) ?>" onclick="return confirm('Tem certeza?')" class="btn btn-danger btn-action">Excluir</a>
            </td>
        </tr>
        <?php endforeach; ?>

    <?php endif; ?>
</table>
