<?php
header("Content-Type: application/json");
require_once 'config.php';

$name = trim($_POST['name'] ?? '');
$email = trim($_POST['email'] ?? '');
$message = trim($_POST['message'] ?? '');

$errors = [];
if (!$name) { $errors['name'] = "O nome é obrigatório."; }
if (!$email) { $errors['email'] = "O e-mail é obrigatório."; }
elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) { $errors['email'] = "Formato de e-mail inválido."; }
if (!$message) { $errors['message'] = "A mensagem é obrigatória."; }

if (!empty($errors)) {
    echo json_encode(["success" => false, "message" => "Por favor, corrija os erros.", "errors" => $errors]);
    exit;
}

$to = "contato@tenebrisarcaneus.com"; // Altere conforme necessário
$subject = "Contato do Site - $name";
$body = "Nome: $name\nE-mail: $email\n\nMensagem:\n$message";
$headers = "From: $email\r\nReply-To: $email\r\nX-Mailer: PHP/" . phpversion();

if (mail($to, $subject, $body, $headers)) {
    echo json_encode(["success" => true, "message" => "Sua mensagem foi enviada com sucesso!"]);
} else {
    echo json_encode(["success" => false, "message" => "Erro ao enviar a mensagem."]);
}
?>
