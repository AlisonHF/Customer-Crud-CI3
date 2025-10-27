// API Busca CEP
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

// API Busca CNPJ
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
			telefoneInput.val(data.ddd_telefone_1).trigger("input");
			console.log(data);
		})
		.catch((error) => {
			// Caso for encontrado algum erro
			console.error("Erro na requisição, status: ", error);
		});
}

// Aplica mascaras nos campos do formulário
function applyMasks() {
	let telefone = $("#telefone");
	let telefoneValue = telefone.val();
	let cpfCnpj = $("#cpf_cnpj");
	let cpfCnpjValue = cpfCnpj.val();
	let cep = $("#cep");
	let cepValue = cep.val();

	// Telefone
	if (telefoneValue.length > 1 && telefoneValue.length <= 10) {
		telefone.mask("(00) 0000-0000");
	} else if (telefoneValue.length > 1 && telefoneValue.length <= 11) {
		telefone.mask("(00) 00000-0000");
	}

	telefone.on("blur", () => {
		if (telefone.val().trim().length == 10) {
			telefone.mask("(00) 0000-0000");
		} else if (telefone.val().trim().length == 11) {
			telefone.mask("(00) 00000-0000");
		}
	});

	telefone.on("focus", () => {
		telefone.unmask();
		telefone.attr("maxlength", 11);
	});

	// CPF - CNPJ
	if (cpfCnpjValue.length > 1 && cpfCnpjValue.length <= 11) {
		cpfCnpj.mask("000.000.000-00");
	} else if (cpfCnpjValue.length > 1 && cpfCnpjValue.length <= 14) {
		cpfCnpj.mask("00.000.000/0000-00");
	}

	cpfCnpj.on("blur", () => {
		if (cpfCnpj.val().trim().length === 11) {
			cpfCnpj.mask("000.000.000-00");
		} else if (cpfCnpj.val().trim().length == 14) {
			cpfCnpj.mask("00.000.000/0000-00");
		}
	});

	cpfCnpj.on("focus", () => {
		cpfCnpj.unmask();
		cpfCnpj.attr("maxlength", 14);
	});

	// CEP
	if (cepValue.length > 1 && cepValue.length <= 8) {
		cep.mask("00000-000");
	}

	cep.on("blur", () => {
		cep.mask("00000-000");
	});

	cep.on("focus", () => {
		cep.unmask();
		cep.attr("maxlength", 8);
	});
}

// Retira as mascaras dos campos para enviar os valores ao bd
function removeMasks() {
	$("#form").submit(() => {
		$("#cpf_cnpj").val($("#cpf_cnpj").cleanVal());
		$("#telefone").val($("#telefone").cleanVal());
		$("#cep").val($("#cep").cleanVal());
	});
}
