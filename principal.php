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
            conteúdo
        </div>
    </div>
</body>
</html>