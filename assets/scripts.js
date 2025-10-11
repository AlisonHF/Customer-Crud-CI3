function searchCep() {
	// Variaveis
	let cepInput = $("#cep").val();
	cepInput = cepInput.trim().replaceAll("-", "");

	let enderecoInput = $("#endereco");
	let cidadeInput = $("#cidade");
	let ufInput = $("#uf");

	const resultadoDiv = $("#div-error-cep");
	resultadoDiv.html("");

	let regex = /^\d+$/; // Somente numeros

	// Verifica se o campo digitado é valido
	if (!cepInput) {
		resultadoDiv.html("Digite um CEP!");
		return null;
	} else if (cepInput.length != 8) {
		resultadoDiv.html("O CEP deve conter 8 números!");
		return null;
	} else if (!regex.test(cepInput)) {
		resultadoDiv.html("Digite somente os números!");
		return null;
	}

	// Realiza a requisição
	fetch(`https://viacep.com.br/ws/${cepInput}/json/`)
		.then((response) => {
			if (response.status === 404 || response.status === 400) {
				resultadoDiv.html("CEP não encontrado!");

				return null;
			}
			return response.json();
		})
		.then((data) => {
			if (data.erro) {
				resultadoDiv.html("CEP não encontrado!");

				return null;
			}
			let endereco = data.logradouro + ", " + data.bairro;

			enderecoInput.val(endereco);
			cidadeInput.val(data.localidade);
			ufInput.val(data.uf);
		})
		.catch((error) => {
			resultadoDiv.html(`A requisição falhou! (status: ${error})`);
		});
}

function searchCnpj() {
	let cnpjInput = $("#cpf_cnpj")
		.val()
		.replaceAll(/[.\-\/\s]/g, "")
		.trim();

	let resultDiv = $("#div-error-cnpj");
	resultDiv.html("");

	if (cnpjInput.length != 14) {
		return null;
	}

	let razaoSocialInput = $("#nome");
	let telefoneInput = $("#telefone");

	fetch("https://brasilapi.com.br/api/cnpj/v1/" + cnpjInput)
		.then((response) => {
			if (!response.ok) {
				// Caso for retornado um erro pela requisicao
				if (response.status === 404 || response.status === 400) {
					resultDiv.html("CNPJ não encontrado!");
				} else {
					resultDiv.html(
						"Não foi possível buscar o CNPJ, digite os dados manualmente!"
					);
				}
				return null;
			}
			return response.json(); // Retorna os dados caso o CNPJ for válido
		})
		.then((data) => {
			if (!data) {
				return null;
			}
			// Caso os dados sejam válidos
			razaoSocialInput.val(data.razao_social);
			telefoneInput.val(data.ddd_telefone_1);
			console.log(data);
		})
		.catch((error) => {
			// Caso for encontrado algum erro
			console.error("Erro na requisição, status: ", error);
		});
}

// Realizar a exclusão das máscaras ao enviar o formulário
function applyMasks() {
	$("#telefone").mask("(00) 00000-0000");
	$("#cep").mask("00000-000");

	let options = {
		onKeyPress: function (cpf_cnpj, e, field, options) {
			let masks = ["000.000.000-009", "00.000.000/0000-00"];
			let mask = cpf_cnpj.length > 14 ? masks[1] : masks[0];
			field.mask(mask, options);
		},
	};

	$("#cpf_cnpj").mask("000.000.000-009", options);

	$("#cpf_cnpj").on("paste", function () {
		var input = $(this);
		setTimeout(function () {
			input.trigger("input"); // força atualização da máscara
		}, 100);
	});
}

function removeMasks() {
	$(document).ready(() => {
		$("#form").submit(() => {
			$("#cpf_cnpj").val($("#cpf_cnpj").cleanVal());
			$("#telefone").val($("#telefone").cleanVal());
			$("#cep").val($("#cep").cleanVal());
		});
	});
}
