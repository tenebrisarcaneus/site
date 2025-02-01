<?php
// contact.php

header("Content-Type: application/json");

function sanitize($data) {
  return htmlspecialchars(stripslashes(trim($data)));
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $errors = [];

  $name = sanitize($_POST['name'] ?? '');
  $email = sanitize($_POST['email'] ?? '');
  $message = sanitize($_POST['message'] ?? '');

  if (empty($name)) {
    $errors['name'] = "O nome é obrigatório.";
  }
  if (empty($email)) {
    $errors['email'] = "O e-mail é obrigatório.";
  } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors['email'] = "Formato de e-mail inválido.";
  }
  if (empty($message)) {
    $errors['message'] = "A mensagem é obrigatória.";
  }

  if (!empty($errors)) {
    echo json_encode([
      "success" => false,
      "message" => "Por favor, corrija os erros.",
      "errors" => $errors
    ]);
    exit;
  }

  $to = "contato@tenebrisarcaneus.com"; // Configure conforme necessário
  $subject = "Contato do Site - $name";
  $body = "Nome: $name\nE-mail: $email\n\nMensagem:\n$message";
  $headers = "From: $email\r\nReply-To: $email\r\nX-Mailer: PHP/" . phpversion();

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
  exit;
} else {
  echo json_encode([
    "success" => false,
    "message" => "Método de requisição inválido."
  ]);
  exit;
}
?>
