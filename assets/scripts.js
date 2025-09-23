async function buscarCep() {

    cepInput = $('#cep').val();
    resultadoDiv = $('#resultado');
    enderecoInput = $('#endereco');
    cidadeInput = $('#cidade');
    ufInput = $('#uf');


    if (!cepInput) {
        resultadoDiv.innerHTML = '<p>Por favor, digite um CEP.</p>';
        return;
    }

    try {
        const response = await fetch(`https://viacep.com.br/ws/${cepInput}/json/`);
        const data = await response.json();

        if (data.erro)
        {
            
        }

        else 
        {
            resultadoDiv.html( `
                <p>CEP: ${data.cep}</p>
                <p>Logradouro: ${data.logradouro}</p>
                <p>Bairro: ${data.bairro}</p>
                <p>Localidade: ${data.localidade}</p>
                <p>UF: ${data.uf}</p>
            `
            )

            let endereco = data.logradouro + ', ' + data.bairro;

            enderecoInput.val(endereco);
            cidadeInput.val(data.localidade);
            ufInput.val(data.uf)

            console.log('Deu certo');
        }
    } 
    catch (error)
    {
        console.error("Erro ao buscar CEP:", error);
    }
}
