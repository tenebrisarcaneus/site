<?php
header("Content-Type: application/json");
require_once 'config.php';

$product_id = isset($_POST['product_id']) ? intval($_POST['product_id']) : 0;
$buyer_name = trim($_POST['buyer_name'] ?? '');
$buyer_email = trim($_POST['buyer_email'] ?? '');

if (!$product_id || !$buyer_name || !$buyer_email) {
    echo json_encode(["success" => false, "message" => "Todos os campos são obrigatórios."]);
    exit;
}

// Inserir compra na tabela 'purchases'
$stmt = $pdo->prepare("INSERT INTO purchases (product_id, buyer_name, buyer_email, purchase_date) VALUES (?, ?, ?, NOW())");
if ($stmt->execute([$product_id, $buyer_name, $buyer_email])) {
    echo json_encode(["success" => true, "message" => "Compra realizada com sucesso!"]);
} else {
    echo json_encode(["success" => false, "message" => "Erro ao processar a compra."]);
}
?>
