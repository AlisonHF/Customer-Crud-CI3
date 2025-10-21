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

function applyMasks() {
	let telefone = $("#telefone");
	let cpf_cnpj = $("#cpf_cnpj");
	let cep = $("#cep");

	telefone.on("blur", () => {
		if (telefone.val().trim().length == 10) {
			telefone.mask("(00) 0000-0000");
		} else if (telefone.val().trim().length == 11) {
			telefone.mask("(00) 00000-0000");
		}
	});

	telefone.on("focus", () => {
		telefone.unmask();
	});

	cpf_cnpj.on("blur", () => {
		if (cpf_cnpj.val().trim().length === 11) {
			cpf_cnpj.mask("000.000.000-00");
		} else if (cpf_cnpj.val().trim().length == 14) {
			cpf_cnpj.mask("00.000.000/0000-00");
		}
	});

	cpf_cnpj.on("focus", () => {
		cpf_cnpj.unmask();
	});

	cep.on("blur", () => {
		cep.mask("00000-000");
	});

	cep.on("focus", () => {
		cep.unmask();
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
