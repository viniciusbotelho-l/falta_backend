<?php
include("valida.php");
?>
<html>
<head>    
    <title>Página Principal</title>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f5f5f5;
        }

        #menu-toggle {
            display: none;
        }

        .menu-btn {
            position: fixed;
            top: 20px;
            left: 20px;
            width: 30px;
            height: 22px;
            cursor: pointer;
            z-index: 1002;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .menu-btn span {
            display: block;
            height: 3px;
            width: 100%;
            background-color: black;
            border-radius: 3px;
            transition: 0.3s;
        }

        .slide-menu {
            position: fixed;
            top: 0;
            left: -250px;
            width: 250px;
            height: 100vh;
            background: #1a2041;
            color: white;
            transition: left 0.3s ease;
            padding: 60px 0;
            z-index: 1001;
        }

        .slide-menu ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .slide-menu li {
            padding: 15px 20px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.2);
            transition: background 0.3s ease;
            cursor: pointer;
        }

        .slide-menu li:hover {
            background: rgba(255, 255, 255, 0.1);
        }


        .overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.4);
            opacity: 0;
            pointer-events: none;
            transition: opacity 0.3s ease;
            z-index: 1000;
        }

        #menu-toggle:checked ~ .slide-menu {
            left: 0;
        }

        #menu-toggle:checked ~ .overlay {
            opacity: 1;
            pointer-events: auto;
        }

        #menu-toggle:checked + .menu-btn span:nth-child(1) {
            transform: rotate(45deg) translateY(10px);
            background: #fff;
        }

        #menu-toggle:checked + .menu-btn span:nth-child(2) {
            opacity: 0;
        }

        #menu-toggle:checked + .menu-btn span:nth-child(3) {
            transform: rotate(-45deg) translateY(-10px);
            background: #fff;
        }
        .fundo{
            background-color: #a82500;
        }


        .conteudo-class{
            height: 100%;
            background-color: #b78323;
            color: white;
            padding: 20px;
            box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);
        }

        .slide-menu a{
            color: white;
            text-decoration: none;
        }

    </style>
</head>
<body class="fundo">
    <input type="checkbox" id="menu-toggle">

    <label for="menu-toggle" class="menu-btn">
        <span></span>
        <span></span>
        <span></span>    
    </label>

    <div class="slide-menu">
        <ul>
           <a href="inicio.php"><li>Inicio</li></a>
           <a href="cadastroUsuarios.php"><li>Cadastro</li></a>
           <a href="sobre.php"> <li>Sobre</li></a>
            <a href="contato.php"><li>Contato</li></a>
           <a href="servico.php"><li>Serviços</li></a>
        </ul>
    </div>

    <div class="overlay"></div>

    <div style="width:1000px; margin: 0 auto;">
        <div style="width= 90%; min-heigth: 100px; background-color: rgba(239, 130, 6, 0.96);">
            <span style="padding-left: 10px;">Ola <?=$_SESSION['nome'];?></span>

           <div style="width= 10%; float:right;"><span style="background-color: #6aea33ff; margin: right 10px;"><a href="sair.php"><font color="black">SAIR</font></a></span>
            </div>
        </div>
        

        <div class="conteudo-class">
            <h2>Cadastrar Usuários</h2>
            <form method="post" action="inserirUsuarios.php" autocomplete="off" onsubmit="return validarCadastro()">
         CPF: <input type="text" name="cpf"><br>
         SENHA: <input type="text" name="senha"><br>
        NOME: <input type="text" name="nome"><br>
        <input type="submit" value="inserir">
        </form>

        <script>
function validarCadastro() {
    const cpfInput = document.querySelector('form[action="inserirUsuarios.php"] input[name="cpf"]');
    const senhaInput = document.querySelector('form[action="inserirUsuarios.php"] input[name="senha"]');
    const nomeInput = document.querySelector('form[action="inserirUsuarios.php"] input[name="nome"]');

    const cpf = cpfInput.value.trim();
    const senha = senhaInput.value;
    const nome = nomeInput.value.trim();

    // --- Validação CPF: deve conter 11 dígitos ---
    const cpfNumeros = cpf.replace(/\D/g, '');
    if (cpfNumeros.length !== 11) {
        alert("O CPF deve conter exatamente 11 dígitos.");
        cpfInput.focus();
        return false;
    }

    // --- Validação da senha ---
    // Mínimo 6 caracteres, 1 maiúscula, 1 número, 1 caractere especial
    const senhaRegex = /^(?=.*[A-Z])(?=.*\d)(?=.*[^A-Za-z0-9]).{6,}$/;
    if (!senhaRegex.test(senha)) {
        alert("A senha deve ter no mínimo 6 caracteres e conter:\n- 1 letra maiúscula\n- 1 número\n- 1 caractere especial");
        senhaInput.focus();
        return false;
    }

    // --- Validação do nome ---
    if (nome.length === 0) {
        alert("O campo Nome não pode ficar vazio.");
        nomeInput.focus();
        return false;
    }

    // Tudo ok, pode enviar
    return true;
}
</script>

        <br><br><hr>
        <?php
        
        include("conexao.php");
        
        $sql = "select nome,cpf,senha from usuarios";
        if(!$resultado = $conn->query($sql)){
            die("erro");
        }
        ?>
    <table>
        <tr>
            <td>CPF</td>
            <td>SENHA</td>
            <td>NOME</td>    
            <td>ALTERAR</td>
            <td>EXCLUIR</td>
        </tr>
<?php
while($row = $resultado->fetch_assoc()){
?>

        <tr>
            <form method="post" action="alterarUsuario.php" onsubmit="return validarAlteracao(this)">
            <input type="hidden" name="cpfAnterior" value="<?=$row['cpf'];?>">
            <td><input type="text" name="cpf" value="<?=$row['cpf'];?>"></td>
            <td><input type="text" name="senha" value="<?=$row['senha'];?>"></td>
            <td><input type="text" name="nome" value="<?=$row['nome'];?>"></td>    
            <td><input type="submit" value="alterar"></td>
</form>



<form method="post" action="apagarUsuario.php">
    <input type="hidden" name="cpf" value="<?=$row['cpf'];?>">
            <td><input type="submit" value="apagar"></td>
</form>
        </tr>
<script>
function validarAlteracao(form) {
    // VALIDAÇÃO DO CPF: precisa ter 11 dígitos
    const cpf = form.cpf.value.replace(/\D/g, '');
    if(cpf.length !== 11) {
        alert("CPF deve ter 11 dígitos.");
        form.cpf.focus();
        return false;
    }

    // VALIDAÇÃO DA SENHA: pelo menos 1 letra maiúscula, 1 número, 1 caractere especial e mínimo 6 caracteres
    const senha = form.senha.value;
    if(senha.length < 6) {
        alert("Senha deve ter no mínimo 6 caracteres.");
        form.senha.focus();
        return false;
    }
    const regexSenha = /^(?=.*[A-Z])(?=.*\d)(?=.*[!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]).+$/;
    if(!regexSenha.test(senha)) {
        alert("Senha deve conter pelo menos uma letra maiúscula, um número e um caractere especial.");
        form.senha.focus();
        return false;
    }

    return true;
}
</script>
        <?php
}
?>
    </table>
        </div>
    </div>
</body>
</html>