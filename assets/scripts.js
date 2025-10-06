async function buscarCep()
{
    // Variaveis
    let cepInput = $('#cep').val();
    cepInput = cepInput.trim();

    let enderecoInput = $('#endereco');
    let cidadeInput = $('#cidade');
    let ufInput = $('#uf');

    const resultadoDiv = $('#div-cep');

    let regex = /^\d+$/; // Somente numeros

    // Verifica se o campo digitado é valido
    if (!cepInput) {
        resultadoDiv.html("Digite um CEP!");
        return;
    }

    else if (cepInput.length != 8)
    {
        resultadoDiv.html("O CEP deve conter 8 números!");
        return;
    }

    else if (!regex.test(cepInput))
    {
        resultadoDiv.html("Digite somente os números!");
        return;
    }

    // Realiza a requisição
    try
    {
        const response = await fetch(`https://viacep.com.br/ws/${cepInput}/json/`);
        const data = await response.json();

        if (!data.erro) 
        {
            let endereco = data.logradouro + ', ' + data.bairro;

            enderecoInput.val(endereco);
            cidadeInput.val(data.localidade);
            ufInput.val(data.uf);
        }

        else
        {
            resultadoDiv.html("CEP não encontrado no banco de dados!", error);
            return;
        }
       
    }
    
    catch (error) // Caso for retornado um erro pela requisicao
    {
        resultadoDiv.html("Erro ao buscar o CEP, digite os dados manualmente...", error);
        return;
    }

}


/*
async function buscaCnpj(cpf_cnpj)
{
    const response = await fetch('https://brasilapi.com.br/api/cnpj/v1/' + cpf_cnpj);
    const data = response.json();
    console.log(data);
}
*/