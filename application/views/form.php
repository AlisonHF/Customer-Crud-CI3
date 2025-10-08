<h1 class="title mt-3"><?= isset($cliente) ? 'Editar Cliente' : 'Novo Cliente' ?></h1>

<form method="POST" class="form-control bg-dark mt-3 mb-5" id="form" data-bs-theme="dark">

    <label class="form-label">Nome/Razão:</label>
    <input class="form-control" type="text" id="nome" name="nome" value="<?= isset($cliente) ? $cliente->nome_razao : set_value('nome') ?>" maxlength="255">
    <div class="form-invalid">
        <?php echo form_error('nome') ?>
    </div>

    <label class="form-label">CPF/CNPJ:</label>
    <input class="form-control" type="text" id="cpf_cnpj" name="cpf_cnpj" value="<?= isset($cliente) ? $cliente->cpf_cnpj : set_value('cpf_cnpj') ?>" onblur="searchCnpj()" maxlength="14">
    <div class="form-invalid" id="div-error-cnpj">
        <?php echo form_error('cpf_cnpj') ?>
        <?php if(isset($data['error_cpf_cnpj'])){
            echo $data['error_cpf_cnpj'];
        }
        ?>
    </div>

    <label class="form-label">E-mail</label>
    <input class="form-control" type="email" name="email" value="<?= isset($cliente) ? $cliente->email : set_value('email') ?>" maxlength="255">
        <div class="form-invalid">
        <?php echo form_error('email') ?>
    </div>

    <label class="form-label">Telefone</label>
    <input class="form-control" type="text" id="telefone" name="telefone" value="<?= isset($cliente) ? $cliente->telefone : set_value('telefone') ?>" maxlength="19">
    <div class="form-invalid">
        <?php echo form_error('telefone') ?>
    </div>

    <label class="form-label">CEP</label>
    <input class="form-control" type="text" id="cep" name="cep" value="<?= isset($cliente) ? $cliente->cep : set_value('cep') ?>" onblur="searchCep()" maxlength="8">
    <div class="form-invalid" id="div-error-cep">
        <?php echo form_error('cep') ?>
    </div>

    <label class="form-label">Endereço</label>
    <input class="form-control" type="text" id="endereco" name="endereco" value="<?= isset($cliente) ? $cliente->endereco : set_value('endereco') ?>" maxlength="255">
    <div class="form-invalid">
        <?php echo form_error('endereco') ?>
    </div>

    <label class="form-label">Cidade</label>
    <input class="form-control" type="text" id="cidade" name="cidade" value="<?= isset($cliente) ? $cliente->cidade : set_value('cidade') ?>" maxlength="100">
    <div class="form-invalid">
        <?php echo form_error('cidade') ?>
    </div>

    <label class="form-label">UF</label>
    <input class="form-control type="text" id="uf" name="uf" value="<?= isset($cliente) ? $cliente->uf : set_value('uf') ?>" maxlength="2">
    <div class="form-invalid">
        <?php echo form_error('uf') ?>
    </div>

    <button class="btn btn-success mt-3" type="submit">Salvar</button>
</form>

<a href="/Cliente" class="mt-3 mb-3 btn btn-primary" id="link-list">Voltar a listagem</a>
