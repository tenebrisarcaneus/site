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
  
    // Scroll Suave para Links de Navegação
    const navLinks = document.querySelectorAll("nav ul li a");
    navLinks.forEach(function(link) {
      link.addEventListener("click", function(e) {
        // Verifica se o link possui âncora
        if (link.hash !== "") {
          e.preventDefault();
          const targetElement = document.querySelector(link.hash);
          if (targetElement) {
            window.scrollTo({
              top: targetElement.offsetTop,
              behavior: "smooth"
            });
          }
          // Fecha o menu mobile após o clique (em telas pequenas)
          if (navMenu.classList.contains("show")) {
            navMenu.classList.remove("show");
          }
        }
      });
    });
  
    // Outras funcionalidades JS podem ser adicionadas aqui.
  });  