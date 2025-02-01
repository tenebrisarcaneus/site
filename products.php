<?php
require_once 'config.php';
$stmt = $pdo->query("SELECT * FROM products ORDER BY id DESC");
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Tenebris Arcaneus - Produtos</title>
  <meta name="description" content="Produtos e scripts avançados para pentesting e hacking ético.">
  <link rel="stylesheet" href="advanced.css">
</head>
<body>
  <header>
    <div class="container header-container">
      <span class="mobile-nav-toggle">&#8230;</span>
      <h1 class="typing"></h1>
      <nav>
        <ul>
          <li><a href="index.php">Início</a></li>
          <li><a href="about.php">Sobre</a></li>
          <li><a href="products.php">Produtos</a></li>
          <li><a href="services.php">Serviços</a></li>
          <li><a href="testimonials.php">Depoimentos</a></li>
          <li><a href="blog.php">Blog</a></li>
          <li><a href="investors.php">Investidores</a></li>
          <li><a href="contact.php">Contato</a></li>
        </ul>
      </nav>
    </div>
  </header>
  <div class="content">
    <section id="products">
      <div class="container">
        <h2>Nossos Produtos</h2>
        <div class="product-list">
          <?php foreach ($products as $product): ?>
          <div class="product">
            <h3><?php echo htmlspecialchars($product['name']); ?></h3>
            <p><?php echo htmlspecialchars($product['description']); ?></p>
            <p class="price">R$ <?php echo number_format($product['price'], 2, ',', '.'); ?></p>
            <button class="btn buy-btn" data-product-id="<?php echo $product['id']; ?>" data-product-name="<?php echo htmlspecialchars($product['name']); ?>" data-product-price="<?php echo $product['price']; ?>">Comprar</button>
          </div>
          <?php endforeach; ?>
        </div>
      </div>
    </section>
  </div>
  <!-- Modal de Compra -->
  <div id="purchase-modal" class="modal">
    <div class="modal-content">
      <span class="close-modal">&times;</span>
      <h2>Finalizar Compra</h2>
      <div id="modal-product-info"></div>
      <form id="purchase-form">
        <input type="hidden" name="product_id" id="product_id">
        <label for="buyer_name">Seu Nome:</label>
        <input type="text" name="buyer_name" id="buyer_name" required>
        <label for="buyer_email">Seu E-mail:</label>
        <input type="email" name="buyer_email" id="buyer_email" required>
        <button type="submit" class="btn">Comprar</button>
      </form>
      <div id="purchase-response"></div>
    </div>
  </div>
  <button id="back-to-top">&#8679;</button>
  <footer>
    <div class="container">
      <p>&copy; 2025 Tenebris Arcaneus. <a href="rights.php">Todos os Direitos Reservados</a>.</p>
      <p><a href="https://github.com/tenebrisarcaneus" target="_blank">GitHub</a></p>
    </div>
  </footer>
  <script src="script.js" defer></script>
</body>
</html>
