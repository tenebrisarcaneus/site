<?php
// buy.php

header("Content-Type: application/json");

function sanitize($data) {
  return htmlspecialchars(stripslashes(trim($data)));
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $errors = [];

  $product_id = sanitize($_POST['product_id'] ?? '');
  $buyer_name = sanitize($_POST['buyer_name'] ?? '');
  $buyer_email = sanitize($_POST['buyer_email'] ?? '');

  if (empty($product_id)) {
    $errors['product'] = "Produto inválido.";
  }
  if (empty($buyer_name)) {
    $errors['buyer_name'] = "O nome é obrigatório.";
  }
  if (empty($buyer_email)) {
    $errors['buyer_email'] = "O e-mail é obrigatório.";
  } elseif (!filter_var($buyer_email, FILTER_VALIDATE_EMAIL)) {
    $errors['buyer_email'] = "Formato de e-mail inválido.";
  }

  if (!empty($errors)) {
    echo json_encode([
      "success" => false,
      "message" => "Por favor, corrija os erros.",
      "errors" => $errors
    ]);
    exit;
  }

  sleep(1); // Simula tempo de processamento

  echo json_encode([
    "success" => true,
    "message" => "Obrigado, $buyer_name! Sua compra do produto (ID: $product_id) foi processada com sucesso."
  ]);
  exit;
} else {
  echo json_encode([
    "success" => false,
    "message" => "Método de requisição inválido."
  ]);
  exit;
}
?>
