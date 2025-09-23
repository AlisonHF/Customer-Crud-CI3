<h1 class="titulo mt-3"><?= isset($cliente) ? 'Editar Cliente' : 'Novo Cliente' ?></h1>

<?php if (isset(($_GET['msg']))): ?>
    <div class="alert alert-danger mt-3 mb-3" role="alert">
        <?= $_GET['msg'] ?>
    </div>

<?php endif; ?>

<form method="POST" class="form-control mt-3 mb-5" id="form">
    <label class="form-label">Nome:</label>
    <input class="form-control type="text" name="nome" value="<?= isset($cliente) ? $cliente->nome_razao : '' ?>">

    <label class="form-label">CPF/CNPJ:</label>
    <input class="form-control type="text" name="cpf_cnpj" value="<?= isset($cliente) ? $cliente->cpf_cnpj : '' ?>" required>
    
    <label class="form-label">E-mail</label>
    <input class="form-control type="email" name="email" value="<?= isset($cliente) ? $cliente->email : '' ?>" required>
    
    <label class="form-label">Telefone</label>
    <input class="form-control type="number" name="telefone" value="<?= isset($cliente) ? $cliente->telefone : '' ?>">

    <label class="form-label">CEP</label>
    <input class="form-control type="number" id="cep" name="cep" value="<?= isset($cliente) ? $cliente->cep : '' ?>" onblur="buscarCep()" required>

    <label class="form-label">Endereço</label>
    <input class="form-control type="text" id="endereco" name="endereco" value="<?= isset($cliente) ? $cliente->endereco : '' ?>" required>
    
    <label class="form-label">Cidade</label>
    <input class="form-control type="text" id="cidade" name="cidade" value="<?= isset($cliente) ? $cliente->cidade : '' ?>" required>

    <label class="form-label">UF</label>
    <input class="form-control type="text" id="uf" name="uf" value="<?= isset($cliente) ? $cliente->uf : '' ?>" required>

    <button class="btn btn-success mt-3" type="submit">Salvar</button>
</form>

<a href="/Cliente" class="mt-5 mb-5" id="link-create">Voltar a listagem</a>
