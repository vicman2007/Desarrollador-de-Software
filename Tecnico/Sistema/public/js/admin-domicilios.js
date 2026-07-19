document.addEventListener("DOMContentLoaded", () => {
  const navHamb = document.getElementById("navHamb")
  const navMenu = document.getElementById("navMenu")

  // Mobile menu toggle
  if (navHamb && navMenu) {
    navHamb.addEventListener("click", () => {
      navMenu.classList.toggle("active")
    })
  }

  // Datos de domicilios
  const deliveries = [
    {
      id: 1,
      pedido: "001",
      cliente: "Juan Pérez",
      direccion: "Calle 123 #45-67, Bogotá",
      productos: ["Cheesecake de durazno", "Postre de maracuyá"],
      total: 8000,
      estado: "en_curso",
      domiciliario: "Carlos Rodríguez",
      tarjetaDeCuidadania: "1.231.567.890",
      hora: "14:30",
    },
    {
      id: 2,
      pedido: "002",
      cliente: "María García",
      direccion: "Carrera 45 #12-34, Bogotá",
      productos: ["Torta de chocolate"],
      total: 50000,
      estado: "en_curso",
      domiciliario: "María López",
      tarjetaDeCuidadania: "1.876.543.210",
      hora: "15:15",
    },
    {
      id: 3,
      pedido: "003",
      cliente: "Carlos Mendoza",
      direccion: "Avenida 68 #25-30, Bogotá",
      productos: ["Postre de mora", "Gelatina de colores"],
      total: 8000,
      estado: "entregado",
      domiciliario: "Juan Martínez",
      tarjetaDeCuidadania: "1.112.223.334",
      hora: "13:45",
    },
    {
      id: 4,
      pedido: "004",
      cliente: "Ana Rodríguez",
      direccion: "Calle 72 #15-20, Bogotá",
      productos: ["Cheesecake de durazno", "Postre de limón"],
      total: 8000,
      estado: "en_curso",
      domiciliario: "Carlos Rodríguez",
      tarjetaDeCuidadania: "1.528.748.954",
      hora: "16:00",
    },
  ]

  // Función para filtrar domicilios
  window.filterDeliveries = () => {
    const statusFilter = document.getElementById("status-filter").value
    const deliveryPersonFilter = document.getElementById("delivery-person-filter").value

    let filteredDeliveries = deliveries

    if (statusFilter !== "all") {
      filteredDeliveries = filteredDeliveries.filter((d) => d.estado === statusFilter)
    }

    if (deliveryPersonFilter !== "all") {
      const deliveryPersonMap = {
        carlos: "Carlos Rodríguez",
        maria: "María López",
        juan: "Juan Martínez",
      }
      filteredDeliveries = filteredDeliveries.filter((d) => d.domiciliario === deliveryPersonMap[deliveryPersonFilter])
    }

    updateDeliveriesDisplay(filteredDeliveries)
  }

  function updateDeliveriesDisplay(deliveriesToShow = deliveries) {
    const deliveriesGrid = document.getElementById("deliveries-grid")
    deliveriesGrid.innerHTML = ""

    deliveriesToShow.forEach((delivery) => {
      const deliveryCard = document.createElement("div")
      deliveryCard.className = `delivery-card ${delivery.estado}`
      deliveryCard.innerHTML = `
                <div class="delivery-header">
                    <h3>Pedido #${delivery.pedido}</h3>
                    <span class="status-badge ${delivery.estado}">${getStatusText(delivery.estado)}</span>
                </div>
                <div class="delivery-info">
                    <p><strong>Cliente:</strong> ${delivery.cliente}</p>
                    <p><strong>Dirección:</strong> ${delivery.direccion}</p>
                    <p><strong>Productos:</strong> ${delivery.productos.join(", ")}</p>
                    <p><strong>Total:</strong> $${delivery.total.toLocaleString()}</p>
                    <p><strong>Domiciliario:</strong> ${delivery.domiciliario}</p>
                    <p><strong>Tarjeta De Cuidadania:</strong> ${delivery.tarjetaDeCuidadania}</p>
                    <p><strong>Hora:</strong> ${delivery.hora}</p>
                </div>
                <div class="delivery-actions">
                    ${getActionButtons(delivery)}
                </div>
            `
      deliveriesGrid.appendChild(deliveryCard)
    })
  }

  function getStatusText(status) {
    const statusMap = {
      en_curso: "En Curso",
      entregado: "Entregado",
      cancelado: "Cancelado",
    }
    return statusMap[status] || status
  }

  function getActionButtons(delivery) {
    if (delivery.estado === "en_curso") {
      return `
                <button class="btn-success" onclick="markAsDelivered(${delivery.id})">
                    <i class="fas fa-check"></i> Marcar como Entregado
                </button>
                <button class="btn-danger" onclick="cancelDelivery(${delivery.id})">
                    <i class="fas fa-times"></i> Cancelar
                </button>
            `
    } else if (delivery.estado === "entregado") {
      return `<span class="delivered-text"><i class="fas fa-check-circle"></i> Entregado</span>`
    } else {
      return `<span class="cancelled-text"><i class="fas fa-times-circle"></i> Cancelado</span>`
    }
  }

  // Marcar como entregado
  window.markAsDelivered = (deliveryId) => {
    if (confirm("¿Confirmar que el pedido ha sido entregado?")) {
      const delivery = deliveries.find((d) => d.id === deliveryId)
      if (delivery) {
        delivery.estado = "entregado"
        updateDeliveriesDisplay()
        updateSummary()
        showAlert("Pedido marcado como entregado", "success")
      }
    }
  }

  // Cancelar domicilio
  window.cancelDelivery = (deliveryId) => {
    if (confirm("¿Está seguro de cancelar este domicilio?")) {
      const delivery = deliveries.find((d) => d.id === deliveryId)
      if (delivery) {
        delivery.estado = "cancelado"
        updateDeliveriesDisplay()
        updateSummary()
        showAlert("Domicilio cancelado", "warning")
      }
    }
  }

  function updateSummary() {
    const totalDeliveries = deliveries.length
    const activeDeliveries = deliveries.filter((d) => d.estado === "en_curso").length
    const completedDeliveries = deliveries.filter((d) => d.estado === "entregado").length
    const dailyIncome = deliveries.filter((d) => d.estado === "entregado").reduce((sum, d) => sum + d.total, 0)

    document.getElementById("total-deliveries").textContent = totalDeliveries
    document.getElementById("active-deliveries").textContent = activeDeliveries
    document.getElementById("completed-deliveries").textContent = completedDeliveries
    document.getElementById("daily-income").textContent = `$${dailyIncome.toLocaleString()}`
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

  // Inicializar
  updateDeliveriesDisplay()
  updateSummary()
})
