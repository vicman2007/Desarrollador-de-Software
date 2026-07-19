document.addEventListener("DOMContentLoaded", () => {
  const navHamb = document.getElementById("navHamb")
  const navMenu = document.getElementById("navMenu")
  const addToCartButtons = document.querySelectorAll(".add-to-cart")
  const productCards = document.querySelectorAll(".product-card")

  // Crear contenedor de notificaciones
  createNotificationContainer()

  // Crear modal para ampliar imágenes
  createImageModal()

  // Mobile menu toggle
  navHamb.addEventListener("click", () => {
    navMenu.classList.toggle("active")
  })

  // Add to cart notificación
  addToCartButtons.forEach((button) => {
    button.addEventListener("click", (e) => {
      const product = e.target.closest(".product-card")
      const productName = product.querySelector("h2").textContent
      const productPrice = product.querySelector("h3").textContent

      // Usar la nueva notificación en lugar de alert
      showNotification(`${productName} añadido al carrito`, `Precio: ${productPrice}`, "success")

    })
  })

  // Funcionalidad para ampliar imágenes
  const productImages = document.querySelectorAll(".product-image, .photo-gallery img")
  productImages.forEach((img) => {
    img.addEventListener("click", () => {
      openImageModal(img.src, img.alt)
    })
  })

  // Initialize Vanilla Tilt for product cards
  if (typeof VanillaTilt !== "undefined") {
    VanillaTilt.init(productCards, {
      max: 25,
      speed: 400,
      glare: true,
      "max-glare": 0.5,
    })
  } else {
    console.warn("VanillaTilt is not defined. Make sure the library is included.")
  }

  // Smooth scrolling for anchor links
  document.querySelectorAll('a[href^="#"]').forEach((anchor) => {
    anchor.addEventListener("click", function (e) {
      e.preventDefault()
      const target = document.querySelector(this.getAttribute("href"))
      if (target) {
        target.scrollIntoView({
          behavior: "smooth",
        })
      }
    })
  })

  // Form submission handling
  const forms = document.querySelectorAll("form")
  forms.forEach((form) => {
    form.addEventListener("submit", (e) => {
      e.preventDefault()
      // Usar la nueva notificación
      showNotification("¡Éxito!", "Formulario enviado correctamente", "success")
    })
  })

  // Lazy loading for images
  if ("IntersectionObserver" in window) {
    const imageObserver = new IntersectionObserver((entries, observer) => {
      entries.forEach((entry) => {
        if (entry.isIntersecting) {
          const image = entry.target
          image.src = image.dataset.src
          image.classList.remove("lazy")
          imageObserver.unobserve(image)
        }
      })
    })

    document.querySelectorAll("img.lazy").forEach((img) => imageObserver.observe(img))
  }
})

// Función para crear el contenedor de notificaciones
function createNotificationContainer() {
  const container = document.createElement("div")
  container.id = "notification-container"
  container.className = "notification-container"
  document.body.appendChild(container)
}

// Función para crear el modal de imágenes
function createImageModal() {
  const modal = document.createElement("div")
  modal.id = "image-modal"
  modal.className = "image-modal"

  modal.innerHTML = `
    <div class="image-modal-close">&times;</div>
    <div class="image-modal-content">
      <img id="modal-image" src="/placeholder.svg" alt="">
    </div>
  `

  document.body.appendChild(modal)

  // Cerrar modal al hacer click en la X
  modal.querySelector(".image-modal-close").addEventListener("click", closeImageModal)

  // Cerrar modal al hacer click fuera de la imagen
  modal.addEventListener("click", (e) => {
    if (e.target === modal) {
      closeImageModal()
    }
  })

  // Cerrar modal con la tecla Escape
  document.addEventListener("keydown", (e) => {
    if (e.key === "Escape" && modal.style.display === "block") {
      closeImageModal()
    }
  })
}

// Función para abrir  imagen
function openImageModal(src, alt) {
  const modal = document.getElementById("image-modal")
  const modalImage = document.getElementById("modal-image")

  modalImage.src = src
  modalImage.alt = alt
  modal.style.display = "block"

  // Prevenir scroll del body
  document.body.style.overflow = "hidden"
}

// Función para cerrar imagen
function closeImageModal() {
  const modal = document.getElementById("image-modal")
  modal.style.display = "none"

  // Restaurar scroll del body
  document.body.style.overflow = "auto"
}

// Función para mostrar notificaciones bonitas
function showNotification(title, message, type = "info") {
  const container = document.getElementById("notification-container")

  const notification = document.createElement("div")
  notification.className = `notification notification-${type}`

  // Icono según el tipo
  let icon = ""
  switch (type) {
    case "success":
      icon = '<i class="fas fa-check-circle"></i>'
      break
    case "error":
      icon = '<i class="fas fa-exclamation-circle"></i>'
      break
    case "warning":
      icon = '<i class="fas fa-exclamation-triangle"></i>'
      break
    default:
      icon = '<i class="fas fa-info-circle"></i>'
  }

  notification.innerHTML = `
        <div class="notification-icon">${icon}</div>
        <div class="notification-content">
            <div class="notification-title">${title}</div>
            <div class="notification-message">${message}</div>
        </div>
        <button class="notification-close" onclick="closeNotification(this)">
            <i class="fas fa-times"></i>
        </button>
    `

  container.appendChild(notification)

  // Animación de entrada
  setTimeout(() => {
    notification.classList.add("show")
  }, 100)

  // Auto-cerrar después de 5 segundos
  setTimeout(() => {
    closeNotification(notification.querySelector(".notification-close"))
  }, 5000)
}

// Función para cerrar notificación
function closeNotification(button) {
  const notification = button.closest(".notification")
  notification.classList.remove("show")
  notification.classList.add("hide")

  setTimeout(() => {
    notification.remove()
  }, 300)
}

// Cart functionality
const cart = []

function addToCart(product) {
  cart.push(product)
  updateCartDisplay()
  showNotification("Producto añadido", `${product.name} se agregó al carrito`, "success")
}

function removeFromCart(index) {
  const removedItem = cart[index]
  cart.splice(index, 1)
  updateCartDisplay()
  showNotification("Producto eliminado", `${removedItem.name} se eliminó del carrito`, "warning")
}

function updateCartDisplay() {
  const cartElement = document.getElementById("cart")
  if (cartElement) {
    cartElement.innerHTML = ""
    cart.forEach((item, index) => {
      const itemElement = document.createElement("div")
      itemElement.textContent = `${item.name} - ${item.price}`
      const removeButton = document.createElement("button")
      removeButton.textContent = "Eliminar"
      removeButton.onclick = () => removeFromCart(index)
      itemElement.appendChild(removeButton)
      cartElement.appendChild(itemElement)
    })
  }
}

// Example of how to use the cart functionality
document.addEventListener("DOMContentLoaded", () => {
  document.querySelectorAll(".add-to-cart").forEach((button) => {
    button.addEventListener("click", (e) => {
      const product = e.target.closest(".product-card")
      const productName = product.querySelector("h2").textContent
      const productPrice = product.querySelector("h3").textContent
      addToCart({ name: productName, price: productPrice })
    })
  })
})
