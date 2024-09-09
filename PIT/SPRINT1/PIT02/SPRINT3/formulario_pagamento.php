<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulário de Pagamento</title>
    <link rel="stylesheet" href="estilo.css">
</head>
<body>
    <style>
        
    </style>
        <header>
        <img src="logo.png" alt="Logo" class="logo">
    </header>

    <div class="container">
        <h1>Formulário de Pagamento</h1>
        <form action="processar_pagamento.php" method="post">
            <div class="form-group">
                <label for="nome">Nome:</label>
                <input type="text" id="nome" name="nome" required>
            </div>
            <div class="form-group">
                <label for="email">E-mail:</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="valor">Valor:</label>
                <input type="text" id="valor" name="valor" required>
            </div>
            <div class="form-group">
                <label for="chave_pix">Chave Pix:</label>
                <input type="text" id="chave_pix" name="chave_pix" required>
            </div>
            <div class="form-group">
                <label for="identificador">Identificador:</label>
                <input type="text" id="identificador" name="identificador">
            </div>
            <div class="form-group">
                <button type="submit">Enviar Pagamento</button>
            </div>
        </form>
    </div>

    <footer class="footer">
        <p> Esqueci Minha Senha. <a href="recuperar_senha.php">Cadastrar Nova</a></p>
        <nav>
            <!-- Links do footer -->
            <a href="#"></a>
            <a href="#"></a>
            <a href="#"></a>
        </nav>
    </footer>
</body>
</html>
