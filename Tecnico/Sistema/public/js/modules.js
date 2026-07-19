// Archivo: modules.js
document.addEventListener('DOMContentLoaded', () => {
  initializeOnlineOrders();
  initializeProductReservation();
  initializePhotoGallery();
  initializeReviewsAndRatings();
});

function initializeOnlineOrders() {
  const orderForm = document.getElementById('order-form');
  if (orderForm) {
      orderForm.addEventListener('submit', (e) => {
          e.preventDefault();
          const formData = new FormData(orderForm);
          // Aquí iría la lógica para procesar el pedido
          alert('Pedido realizado con éxito!');
      });
  }
}

function initializeProductReservation() {
  const reserveButtons = document.querySelectorAll('.reserve-product');
  reserveButtons.forEach(button => {
      button.addEventListener('click', (e) => {
          const productId = e.target.dataset.productId;
          // Aquí iría la lógica para reservar el producto
          alert(`Producto ${productId} reservado con éxito!`);
      });
  });
}

function initializePhotoGallery() {
  const gallery = document.querySelector('.photo-gallery');
  if (gallery) {
      const images = gallery.querySelectorAll('img');
      images.forEach(img => {
          img.addEventListener('click', () => {
              // Lógica para mostrar la imagen en tamaño completo
              const fullscreen = document.createElement('div');
              fullscreen.classList.add('fullscreen-image');
              fullscreen.innerHTML = `<img src="${img.src}" alt="${img.alt}">`;
              document.body.appendChild(fullscreen);
              fullscreen.addEventListener('click', () => fullscreen.remove());
          });
      });
  }
}

function initializeReviewsAndRatings() {
  const reviewForm = document.getElementById('review-form');
  if (reviewForm) {
      reviewForm.addEventListener('submit', (e) => {
          e.preventDefault();
          const formData = new FormData(reviewForm);
          // Aquí iría la lógica para enviar la reseña
          alert('Reseña enviada con éxito!');
      });
  }
}