// script.js

document.addEventListener("DOMContentLoaded", function() {
  // Toggle do Menu Mobile
  const navToggle = document.querySelector(".mobile-nav-toggle");
  const navMenu = document.querySelector("nav ul");

  if (navToggle) {
    navToggle.addEventListener("click", function() {
      navMenu.classList.toggle("show");
    });
  }

  // Modal de Compra
  const modal = document.getElementById("purchase-modal");
  const closeModalBtn = document.querySelector(".close-modal");
  const buyButtons = document.querySelectorAll(".buy-btn");
  const modalProductInfo = document.getElementById("modal-product-info");
  const productIdInput = document.getElementById("product_id");
  const purchaseForm = document.getElementById("purchase-form");
  const purchaseResponse = document.getElementById("purchase-response");

  function openModal(productId, productName, productPrice) {
    modal.style.display = "block";
    modalProductInfo.innerHTML = `
      <p><strong>Produto:</strong> ${productName}</p>
      <p><strong>Preço:</strong> R$ ${productPrice}</p>
    `;
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
    fetch("buy.php", {
      method: "POST",
      body: formData
    })
    .then(response => response.json())
    .then(data => {
      if (data.success) {
        purchaseResponse.style.color = "green";
      } else {
        purchaseResponse.style.color = "red";
      }
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
      purchaseResponse.textContent = "Ocorreu um erro ao processar sua compra.";
      console.error("Erro:", error);
    });
  });

  // Processamento do formulário de contato, se presente
  const contactForm = document.getElementById("contact-form");
  if (contactForm) {
    contactForm.addEventListener("submit", function(e) {
      e.preventDefault();
      const formData = new FormData(contactForm);
      fetch("contact.php", {
        method: "POST",
        body: formData
      })
      .then(response => response.json())
      .then(data => {
        const contactResponse = document.getElementById("contact-response");
        if (data.success) {
          contactResponse.style.color = "green";
        } else {
          contactResponse.style.color = "red";
        }
        contactResponse.textContent = data.message;
        if (data.success) {
          contactForm.reset();
        }
      })
      .catch(error => {
        const contactResponse = document.getElementById("contact-response");
        contactResponse.style.color = "red";
        contactResponse.textContent = "Ocorreu um erro ao enviar sua mensagem.";
        console.error("Erro:", error);
      });
    });
  }
});
