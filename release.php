<?php
header("Content-Type: text/html; charset=utf-8");

// Em uma implementação real, o token seria verificado com dados do gateway de pagamento.
$paymentToken = $_GET['payment_token'] ?? '';
$githubUsername = $_GET['username'] ?? '';

if ($paymentToken === "VALID_PAYMENT_TOKEN") {
    $repoLink = "https://github.com/tenebrisarcaneus/AutoExploit.git";
    echo "<h1>Pagamento Verificado!</h1>";
    echo "<p>Obrigado pelo seu pagamento. Para acessar os scripts, clique no link abaixo:</p>";
    echo "<p><a href='$repoLink' target='_blank'>$repoLink</a></p>";
    // Aqui, você pode integrar a API do GitHub para adicionar o usuário como colaborador.
} else {
    echo "<h1>Pagamento não verificado</h1>";
    echo "<p>Por favor, realize o pagamento com criptomoeda para obter acesso aos scripts.</p>";
}
?>
