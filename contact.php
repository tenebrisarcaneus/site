<?php
// contact.php

header("Content-Type: application/json");

// Array para armazenar erros
$errors = [];

// Verifica se o método de envio é POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitiza e atribui os dados
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $message = trim($_POST['message'] ?? '');

    // Validação do nome
    if (empty($name)) {
        $errors['name'] = "O nome é obrigatório.";
    }

    // Validação do e-mail
    if (empty($email)) {
        $errors['email'] = "O e-mail é obrigatório.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = "Formato de e-mail inválido.";
    }

    // Validação da mensagem
    if (empty($message)) {
        $errors['message'] = "A mensagem é obrigatória.";
    }

    // Se não houver erros, envia o e-mail
    if (count($errors) === 0) {
        $to = "contato@tenebrisarcaneus.com";  // Altere para o e-mail de destino
        $subject = "Contato do Site - $name";
        $body = "Nome: $name\nE-mail: $email\n\nMensagem:\n$message";
        $headers = "From: $email" . "\r\n" .
                   "Reply-To: $email" . "\r\n" .
                   "X-Mailer: PHP/" . phpversion();

        if (mail($to, $subject, $body, $headers)) {
            echo json_encode([
                "success" => true,
                "message" => "Sua mensagem foi enviada com sucesso!"
            ]);
        } else {
            echo json_encode([
                "success" => false,
                "message" => "Houve um erro ao enviar sua mensagem. Tente novamente mais tarde."
            ]);
        }
    } else {
        // Retorna os erros de validação
        echo json_encode([
            "success" => false,
            "errors" => $errors
        ]);
    }
} else {
    echo json_encode([
        "success" => false,
        "message" => "Método de requisição inválido."
    ]);
}