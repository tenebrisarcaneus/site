document.addEventListener("DOMContentLoaded", function() {
  // Toggle do menu móvel
  const navToggle = document.querySelector(".mobile-nav-toggle");
  const navMenu = document.querySelector("nav ul");
  if (navToggle) {
    navToggle.addEventListener("click", function() {
      navMenu.classList.toggle("show");
    });
  }

  // Botão "Voltar ao Topo"
  const backToTop = document.getElementById("back-to-top");
  window.addEventListener("scroll", function() {
    if (window.pageYOffset > 300) {
      backToTop.style.display = "block";
    } else {
      backToTop.style.display = "none";
    }
  });
  backToTop.addEventListener("click", function() {
    window.scrollTo({ top: 0, behavior: "smooth" });
  });

  // Alternância de tema (claro/escuro)
  const themeToggleBtn = document.createElement('button');
  themeToggleBtn.textContent = "Toggle Theme";
  themeToggleBtn.classList.add("btn");
  themeToggleBtn.style.position = "fixed";
  themeToggleBtn.style.top = "80px";
  themeToggleBtn.style.right = "30px";
  document.body.appendChild(themeToggleBtn);
  themeToggleBtn.addEventListener("click", function() {
    document.body.classList.toggle("dark");
  });

  // Efeito de digitação no título
  const typingElement = document.querySelector(".typing");
  if (typingElement) {
    const text = "Tenebris Arcaneus";
    let index = 0;
    function type() {
      if (index < text.length) {
        typingElement.textContent += text.charAt(index);
        index++;
        setTimeout(type, 150);
      }
    }
    type();
  }

  // Modal de compra
  const modal = document.getElementById("purchase-modal");
  const closeModalBtn = document.querySelector(".close-modal");
  const buyButtons = document.querySelectorAll(".buy-btn");
  const modalProductInfo = document.getElementById("modal-product-info");
  const productIdInput = document.getElementById("product_id");
  const purchaseForm = document.getElementById("purchase-form");
  const purchaseResponse = document.getElementById("purchase-response");

  function openModal(productId, productName, productPrice) {
    modal.style.display = "block";
    modalProductInfo.innerHTML = `<p><strong>Produto:</strong> ${productName}</p><p><strong>Preço:</strong> R$ ${productPrice}</p>`;
    productIdInput.value = productId;
  }
  buyButtons.forEach(function(button) {
    button.addEventListener("click", function() {
      const productId = button.getAttribute("data-product-id");
      const productName = button.getAttribute("data-product-name");
      const productPrice = button.getAttribute("data-product-price");
      openModal(productId, productName, productPrice);
    });
  });
  closeModalBtn.addEventListener("click", function() {
    modal.style.display = "none";
    purchaseResponse.innerHTML = "";
    purchaseForm.reset();
  });
  window.addEventListener("click", function(event) {
    if (event.target == modal) {
      modal.style.display = "none";
      purchaseResponse.innerHTML = "";
      purchaseForm.reset();
    }
  });
  purchaseForm.addEventListener("submit", function(e) {
    e.preventDefault();
    const formData = new FormData(purchaseForm);
    fetch("buy.php", { method: "POST", body: formData })
      .then(response => response.json())
      .then(data => {
        purchaseResponse.style.color = data.success ? "green" : "red";
        purchaseResponse.textContent = data.message;
        if (data.success) {
          setTimeout(() => {
            modal.style.display = "none";
            purchaseResponse.innerHTML = "";
            purchaseForm.reset();
          }, 3000);
        }
      })
      .catch(error => {
        purchaseResponse.style.color = "red";
        purchaseResponse.textContent = "Erro ao processar a compra.";
        console.error("Erro:", error);
      });
  });

  // Fundo dinâmico (efeito de código binário)
  const binaryCanvas = document.createElement("canvas");
  binaryCanvas.id = "binaryCanvas";
  binaryCanvas.style.position = "fixed";
  binaryCanvas.style.top = "0";
  binaryCanvas.style.left = "0";
  binaryCanvas.style.zIndex = "-1";
  binaryCanvas.style.pointerEvents = "none";
  document.body.appendChild(binaryCanvas);
  const ctx = binaryCanvas.getContext("2d");
  binaryCanvas.width = window.innerWidth;
  binaryCanvas.height = window.innerHeight;
  const binaryChars = "01";
  let fontSize = 16;
  let columns = binaryCanvas.width / fontSize;
  let drops = [];
  for (let x = 0; x < columns; x++) {
    drops[x] = 1;
  }
  function drawBinary() {
    ctx.fillStyle = "rgba(0, 0, 0, 0.05)";
    ctx.fillRect(0, 0, binaryCanvas.width, binaryCanvas.height);
    ctx.fillStyle = "#0f0";
    ctx.font = fontSize + "px monospace";
    for (let i = 0; i < drops.length; i++) {
      let text = binaryChars.charAt(Math.floor(Math.random() * binaryChars.length));
      ctx.fillText(text, i * fontSize, drops[i] * fontSize);
      if (drops[i] * fontSize > binaryCanvas.height && Math.random() > 0.975) {
        drops[i] = 0;
      }
      drops[i]++;
    }
  }
  setInterval(drawBinary, 50);
});
