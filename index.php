<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <style>
        body {
            background-color: orange;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        h1 {
            text-align: center;
            margin-top: 50px;
            color: white;
        }

        .login-container {
            width: 400px;
            margin: 30px auto;
            background-color: rgb(60, 97, 219);
            border: 2px solid black;
            border-radius: 10px;
            padding: 30px;
            color: white;
            box-shadow: 0 0 10px rgba(0,0,0,0.3);
        }

        .login-container label {
            display: block;
            text-align: left;
            margin-bottom: 5px;
        }

        .login-container input[type="text"],
        .login-container input[type="password"] {
            width: 100%;
            padding: 8px;
            border: none;
            border-radius: 5px;
            margin-bottom: 15px;
        }

        .login-container input[type="submit"] {
            width: 100%;
            padding: 10px;
            background-color: white;
            color: rgb(60, 97, 219);
            border: none;
            border-radius: 5px;
            font-weight: bold;
            cursor: pointer;
            transition: 0.3s ease;
        }

        .login-container input[type="submit"]:hover {
            background-color: #f0f0f0;
        }

        footer {
            text-align: center;
            padding: 20px;
            color: white;
            font-size: 14px;
        }
    </style>
</head>
<body>

    <h1>Seja bem-vindo</h1>


<div class="login-container">
    <form action="login.php" method="post" autocomplete="off" onsubmit="return validarFormulario()">
        <label for="cpf">CPF:</label>
        <input type="text" id="cpf" name="cpf" required>

        <label for="senha">Senha:</label>
        <input type="password" id="senha" name="senha" required>

        <input type="submit" value="Entrar">
    </form>
</div>
<script>
function validarFormulario() {
    const cpf = document.getElementById("cpf").value.trim();
    const senha = document.getElementById("senha").value;

    // --- Validação do CPF: deve conter exatamente 11 dígitos ---
    const cpfNumeros = cpf.replace(/\D/g, ""); // remove tudo que não for número
    if (cpfNumeros.length !== 11) {
        alert("O CPF deve conter exatamente 11 dígitos.");
        return false; // impede o envio
    }

    // --- Validação da senha ---
    // Exige: mínimo de 6 caracteres, 1 letra maiúscula, 1 número e 1 caractere especial
    const senhaRegex = /^(?=.*[A-Z])(?=.*\d)(?=.*[^A-Za-z0-9]).{6,}$/;

    if (!senhaRegex.test(senha)) {
        alert("A senha deve ter no mínimo 6 caracteres e conter:\n- 1 letra maiúscula\n- 1 número\n- 1 caractere especial");
        return false; // impede o envio
    }

    // Se passou em tudo, pode enviar
    return true;
}
</script>

    <footer>
        &copy; 2025 Projeto Login PHP. Todos os direitos reservados.
    </footer>

</body>
</html>