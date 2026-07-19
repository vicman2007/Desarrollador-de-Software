document.addEventListener("DOMContentLoaded", () => {
  const profileForm = document.getElementById("profile-form")
  const deleteAccountBtn = document.getElementById("delete-account")
  const cartIcon = document.getElementById("cart-icon")
  const cartModal = document.getElementById("cart-modal")
  const closeModal = document.querySelector(".close")
  const navHamb = document.getElementById("navHamb")
  const navMenu = document.getElementById("navMenu")

  // Carrito de compras
  let cart = [
    {
      name: "Cheesecake de durazno",
      price: 4000,
      quantity: 1,
      unitPrice: 4000,
    },
    {
      name: "Postre de maracuyá",
      price: 4000,
      quantity: 2,
      unitPrice: 4000,
    },
  ]

  // Mobile menu toggle
  if (navHamb && navMenu) {
    navHamb.addEventListener("click", () => {
      navMenu.classList.toggle("active")
    })
  }

  // Guardar cambios del perfil
  if (profileForm) {
    profileForm.addEventListener("submit", (e) => {
      e.preventDefault()

      const formData = new FormData(profileForm)
      const userData = {
        nombre: formData.get("nombre"),
        correo: formData.get("correo"),
        direccion: formData.get("direccion"),
        telefono: formData.get("telefono"),
        tarjeta: formData.get("tarjeta"),
      }

      // Simular guardado
      localStorage.setItem("userData", JSON.stringify(userData))

      showAlert("Datos actualizados correctamente", "success")
    })
  }

  // Cerrar cuenta
  if (deleteAccountBtn) {
    deleteAccountBtn.addEventListener("click", () => {
      if (confirm("¿Estás seguro de que deseas cerrar tu cuenta?")) {
        localStorage.removeItem("userData")
        showAlert("Cuenta cerrada exitosamente", "info")
        setTimeout(() => {
          window.location.href = "index homesytem"
        }, 2000)
      }
    })
  }

  // Mostrar carrito
  if (cartIcon) {
    cartIcon.addEventListener("click", (e) => {
      e.preventDefault()
      showCart()
    })
  }

  // Cerrar modal
  if (closeModal) {
    closeModal.addEventListener("click", () => {
      cartModal.style.display = "none"
    })
  }

  // Cerrar modal al hacer clic fuera
  window.addEventListener("click", (e) => {
    if (e.target === cartModal) {
      cartModal.style.display = "none"
    }
  })

  function showCart() {
    updateCartDisplay()
    cartModal.style.display = "block"
  }

  function updateCartDisplay() {
    const cartProducts = document.getElementById("cart-products")
    const subtotalElement = document.getElementById("subtotal")
    const totalElement = document.getElementById("total")

    // Limpiar productos anteriores
    cartProducts.innerHTML = ""

    let subtotal = 0

    cart.forEach((item, index) => {
      const itemElement = document.createElement("div")
      itemElement.className = "cart-item"
      itemElement.innerHTML = `
                <div>
                    <strong>${item.name}</strong><br>
                    Precio unitario: $${item.unitPrice.toLocaleString()}<br>
                    Cantidad: ${item.quantity}
                </div>
                <div>
                    <strong>$${item.price.toLocaleString()}</strong>
                    <button onclick="removeFromCart(${index})" class="btn-delete" style="margin-left: 10px; padding: 5px 10px;">Eliminar</button>
                </div>
            `
      cartProducts.appendChild(itemElement)
      subtotal += item.price
    })

    subtotalElement.textContent = subtotal.toLocaleString()
    totalElement.textContent = subtotal.toLocaleString()

    // Actualizar información del cliente
    const userData = JSON.parse(localStorage.getItem("userData")) || {
      nombre: "Juan Pérez",
      direccion: "Calle 123 #45-67, Bogotá",
    }

    document.getElementById("cart-cliente").textContent = userData.nombre
    document.getElementById("cart-direccion").textContent = userData.direccion
  }

  // Función global para eliminar del carrito
  window.removeFromCart = (index) => {
    cart.splice(index, 1)
    updateCartDisplay()
    showAlert("Producto eliminado del carrito", "info")
  }

  // Realizar pedido
  const checkoutBtn = document.querySelector(".btn-checkout")
  if (checkoutBtn) {
    checkoutBtn.addEventListener("click", () => {
      if (cart.length === 0) {
        showAlert("El carrito está vacío", "warning")
        return
      }

      const horario = document.getElementById("horario-entrega").value
      const formaPago = document.getElementById("forma-pago").value

      // Simular envío del pedido
      showAlert("Pedido realizado exitosamente", "success")
      cart = []
      updateCartDisplay()
      cartModal.style.display = "none"
    })
  }

  function showAlert(message, type) {
    const alertBox = document.createElement("div")
    alertBox.className = `alert alert-${type}`
    alertBox.style.cssText = `
            position: fixed;
            top: 20px;
            right: 20px;
            padding: 15px 20px;
            border-radius: 5px;
            color: white;
            font-weight: bold;
            z-index: 10000;
            animation: slideIn 0.3s ease;
        `

    switch (type) {
      case "success":
        alertBox.style.backgroundColor = "#28a745"
        break
      case "error":
        alertBox.style.backgroundColor = "#dc3545"
        break
      case "warning":
        alertBox.style.backgroundColor = "#ffc107"
        alertBox.style.color = "#333"
        break
      case "info":
        alertBox.style.backgroundColor = "#17a2b8"
        break
    }

    alertBox.textContent = message
    document.body.appendChild(alertBox)

    setTimeout(() => {
      alertBox.remove()
    }, 3000)
  }

  // Cargar datos del usuario si existen
  const savedUserData = localStorage.getItem("userData")
  if (savedUserData && profileForm) {
    const userData = JSON.parse(savedUserData)
    document.getElementById("nombre").value = userData.nombre || ""
    document.getElementById("correo").value = userData.correo || ""
    document.getElementById("direccion").value = userData.direccion || ""
    document.getElementById("telefono").value = userData.telefono || ""
    document.getElementById("tarjeta").value = userData.tarjeta || ""
  }
})

// Agregar estilos para las alertas
const style = document.createElement("style")
style.textContent = `
    @keyframes slideIn {
        from {
            transform: translateX(100%);
            opacity: 0;
        }
        to {
            transform: translateX(0);
            opacity: 1;
        }
    }
    
    .alert {
        animation: slideIn 0.3s ease;
    }
`
document.head.appendChild(style)
