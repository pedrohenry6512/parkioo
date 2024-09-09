<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="index.php">
    <title>Site de Estacionamento</title>
    <style>
 body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    display: grid;
    grid-template-rows: auto 1fr auto; /* Define as linhas do grid: cabeçalho, conteúdo e rodapé */
   
    background-color: #ffa500; /* Laranja */
    
    background-repeat: no-repeat;
    background-position: right bottom;
    background-size: 100px auto; /* Reduzindo o tamanho da imagem */
}

header {
    text-align: center;
    padding: 20px 0;
}

.container {
    text-align: center;
    grid-row: 2; /* Faz com que este elemento ocupe a segunda linha do grid (conteúdo) */
}

.logo {
    max-width: 100%;
    height: auto;
    margin-bottom: 30px;
}

.btn {
    padding: 15px 30px; /* Aumentando o padding para aumentar o tamanho dos botões */
    font-size: 16px;
    background-color: #383bec; /* Azul */
    color: white;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    margin: 0 10px;
    text-decoration: none;
    display: inline-block;
}

.btn:hover {
    background-color: #000ff0; /* Tom mais escuro de azul ao passar o mouse */
}

.btn.email {
    background-color: transparent;
    color: white; /* Laranja */
    border: 2px solid white; /* Laranja */
}

.btn.email:hover {
    background-color: #FFA500; /* Laranja ao passar o mouse */
    color: white;
}

@media (max-width: 768px) {
    .btn {
        padding: 12px 24px; /* Ajustando o padding para telas menores */
        font-size: 14px;
    }
}

.footer {
    text-align: center;
    grid-row: 3; /* Faz com que este elemento ocupe a terceira linha do grid (rodapé) */
    font-size: 14px;
    padding: 20px 0;
    color: aliceblue;
}

.footer a {
    color: #333;
    text-decoration: none;
    margin: 0 10px;
}

.footer a:hover {
    text-decoration: underline;
}
    </style>
</head>
<body>

    <header>
        <img src="logo.png" alt="Logo" class="logo">
    </header>
    <div class="container">
        <a href="login.php" class="btn email">Entrar com E-mail</a>
        <a href="cadastro.php" class="btn">Cadastrar</a>
    </div>
    <footer class="footer">
        <p> Esqueci Minha Senha.Cadastra Nova</p>
        <nav>
            <a href="#"></a>
            <a href="#"></a>
            <a href="#"></a>
        </nav>
    </footer>
</body>
</html>
