<?php
// Função para enviar e-mail
function enviarEmail($para, $assunto, $mensagem) {
    $headers = 'From: seuemail@dominio.com' . "\r\n" .
               'Reply-To: seuemail@dominio.com' . "\r\n" .
               'X-Mailer: PHP/' . phpversion();

    mail($para, $assunto, $mensagem, $headers);
}

// Exemplo de uso
$email = 'usuario@dominio.com';
$assunto = 'Teste de E-mail';
$mensagem = 'Este é um teste de envio de e-mail.';

enviarEmail($email, $assunto, $mensagem);
?>
