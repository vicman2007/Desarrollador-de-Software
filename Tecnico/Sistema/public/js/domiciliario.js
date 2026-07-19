document.addEventListener("DOMContentLoaded", () => {
  const navHamb = document.getElementById("navHamb")
  const navMenu = document.getElementById("navMenu")

  // Mobile menu toggle
  if (navHamb && navMenu) {
    navHamb.addEventListener("click", () => {
      navMenu.classList.toggle("active")
    })
  }

  // Datos de ejemplo
  let deliveries = [
    {
      idCarrito: 2,
      pedido: "001",
      cliente: "Esteban Castro",
      direccion: "kra11 #9-56, Bogotá",
      productos: ["Postre de Maracuya"],
      cantidad: 1,
      total: 4000,
      estado: "disponible",
    },
    {
      idCarrito: 3,
      pedido: "002",
      cliente: "Angel Feliciano",
      direccion: "cll 21#95-52, Bogotá",
      productos: ["Torta de M&M´S"],
      cantidad: 1,
      total: 50000,
      estado: "disponible",
    },
    {
      idCarrito: 4,
      pedido: "003",
      cliente: "Juan Pardo",
      direccion: "cll 05#52-55, Bogotá",
      productos: ["Trota de barquillos", "Postre de Maracuya"],
      cantidad: 2,
      total: 54000,
      estado: "disponible",
    },
    {
      idCarrito: 5,
      pedido: "004",
      cliente: "Kevin Niño",
      direccion: "cra 1c#47c-38sur, Bogotá",
      productos: ["Postre de Mora", "Postre de Maracuya"],
      cantidad: 2,
      total: 8000,
      estado: "disponible",
    },
  ]

  let activeDeliveries = []

  // Aceptar domicilio
  window.acceptDelivery = (deliveryId) => {
    const delivery = deliveries.find((d) => d.id === deliveryId)
    if (delivery) {
      delivery.estado = "en_curso"
      activeDeliveries.push(delivery)
      deliveries = deliveries.filter((d) => d.id !== deliveryId)

      updateDeliveriesDisplay()
      updateActiveDeliveriesDisplay()
      showAlert("Domicilio aceptado exitosamente", "success")
    }
  }

  // Marcar como entregado
  window.markAsDelivered = (deliveryId) => {
    if (confirm("¿Confirmas que el pedido ha sido entregado?")) {
      activeDeliveries = activeDeliveries.filter((d) => d.id !== deliveryId)
      updateActiveDeliveriesDisplay()
      showAlert("Domicilio marcado como entregado", "success")
    }
  }

  function updateDeliveriesDisplay() {
    const deliveriesList = document.getElementById("deliveries-list")
    if (!deliveriesList) return

    const availableDeliveries = deliveries.filter((d) => d.estado === "disponible")

    deliveriesList.innerHTML = ""
    availableDeliveries.forEach((delivery) => {
      const deliveryCard = document.createElement("div")
      deliveryCard.className = "delivery-card"
      deliveryCard.innerHTML = `
                <div class="delivery-info">
                    <h3>Pedido #${delivery.pedido}</h3>
                    <p><strong>Cliente:</strong> ${delivery.cliente}</p>
                    <p><strong>Dirección:</strong> ${delivery.direccion}</p>
                    <p><strong>Cantidad de productos:</strong> ${delivery.cantidad}</p>
                    <p><strong>Productos:</strong> ${delivery.productos.join(", ")}</p>
                    <p><strong>Total:</strong> $${delivery.total.toLocaleString()}</p>
                </div>
                <div class="delivery-actions">
                    <button class="btn-accept" onclick="acceptDelivery(${delivery.id})">Aceptar Domicilio</button>
                </div>
            `
      deliveriesList.appendChild(deliveryCard)
    })
  }

  function updateActiveDeliveriesDisplay() {
    const activeDeliveriesContainer = document.getElementById("active-deliveries")
    if (!activeDeliveriesContainer) return

    activeDeliveriesContainer.innerHTML = ""

    if (activeDeliveries.length === 0) {
      activeDeliveriesContainer.innerHTML = "<p>No tienes entregas en curso.</p>"
      return
    }

    activeDeliveries.forEach((delivery) => {
      const deliveryCard = document.createElement("div")
      deliveryCard.className = "delivery-card"
      deliveryCard.innerHTML = `
                <div class="delivery-info">
                    <h3>Pedido #${delivery.pedido} - EN CURSO</h3>
                    <p><strong>Cliente:</strong> ${delivery.cliente}</p>
                    <p><strong>Dirección:</strong> ${delivery.direccion}</p>
                    <p><strong>Cantidad de productos:</strong> ${delivery.cantidad}</p>
                    <p><strong>Productos:</strong> ${delivery.productos.join(", ")}</p>
                    <p><strong>Total:</strong> $${delivery.total.toLocaleString()}</p>
                </div>
                <div class="delivery-actions">
                    <button class="btn-delivered" onclick="markAsDelivered(${delivery.id})">Domicilio Entregado</button>
                </div>
            `
      activeDeliveriesContainer.appendChild(deliveryCard)
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

  // Inicializar displays
  updateDeliveriesDisplay()
  updateActiveDeliveriesDisplay()
})
