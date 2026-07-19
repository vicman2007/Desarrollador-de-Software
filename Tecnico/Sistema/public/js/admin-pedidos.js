document.addEventListener("DOMContentLoaded", () => {
  const navHamb = document.getElementById("navHamb")
  const navMenu = document.getElementById("navMenu")

  // Mobile menu toggle
  if (navHamb && navMenu) {
    navHamb.addEventListener("click", () => {
      navMenu.classList.toggle("active")
    })
  }

  // Datos de pedidos
  const orders = [
    {
      id: 1,
      numero: "PED-001",
      cliente: "Juan Pérez",
      productos: [
        { nombre: "Cheesecake de durazno", cantidad: 2, precio: 4000 },
        { nombre: "Postre de maracuyá", cantidad: 1, precio: 4000 },
      ],
      total: 12000,
      direccion: "Calle 123 #45-67, Bogotá",
      telefono: "3001234567",
      fecha: "2024-01-15",
      hora: "14:30",
      estado: "pending",
      formaPago: "efectivo",
    },
    {
      id: 2,
      numero: "PED-002",
      cliente: "María García",
      productos: [{ nombre: "Torta de chocolate", cantidad: 1, precio: 50000 }],
      total: 50000,
      direccion: "Carrera 45 #12-34, Bogotá",
      telefono: "3009876543",
      fecha: "2024-01-15",
      hora: "15:00",
      estado: "preparing",
      formaPago: "tarjeta",
    },
    {
      id: 3,
      numero: "PED-003",
      cliente: "Carlos Mendoza",
      productos: [
        { nombre: "Postre de mora", cantidad: 3, precio: 4000 },
        { nombre: "Gelatina de colores", cantidad: 2, precio: 4000 },
      ],
      total: 20000,
      direccion: "Avenida 68 #25-30, Bogotá",
      telefono: "3005551234",
      fecha: "2024-01-15",
      hora: "16:15",
      estado: "ready",
      formaPago: "transferencia",
    },
    {
      id: 4,
      numero: "PED-004",
      cliente: "Ana Rodríguez",
      productos: [
        { nombre: "Cheesecake de durazno", cantidad: 1, precio: 4000 },
        { nombre: "Postre de limón", cantidad: 1, precio: 4000 },
      ],
      total: 8000,
      direccion: "Calle 72 #15-20, Bogotá",
      telefono: "3007778888",
      fecha: "2024-01-15",
      hora: "17:00",
      estado: "pending",
      formaPago: "efectivo",
    },
  ]

  // Función para filtrar pedidos
  window.filterOrders = () => {
    const statusFilter = document.getElementById("order-status").value
    const dateFilter = document.getElementById("order-date").value

    let filteredOrders = orders

    if (statusFilter !== "all") {
      filteredOrders = filteredOrders.filter((o) => o.estado === statusFilter)
    }

    if (dateFilter) {
      filteredOrders = filteredOrders.filter((o) => o.fecha === dateFilter)
    }

    updateOrdersDisplay(filteredOrders)
  }

  // Función para actualizar pedidos
  window.refreshOrders = () => {
    updateOrdersDisplay()
    updateSummary()
    showAlert("Pedidos actualizados", "info")
  }

  function updateOrdersDisplay(ordersToShow = orders) {
    const ordersGrid = document.getElementById("orders-grid")
    ordersGrid.innerHTML = ""

    // Filtrar solo pedidos listos para entrega
    const readyOrders = ordersToShow.filter(
      (o) => o.estado === "ready" || o.estado === "pending" || o.estado === "preparing",
    )

    if (readyOrders.length === 0) {
      ordersGrid.innerHTML = "<p>No hay pedidos pendientes de entrega.</p>"
      return
    }

    readyOrders.forEach((order) => {
      const orderCard = document.createElement("div")
      orderCard.className = `order-card ${order.estado}`
      orderCard.innerHTML = `
                <div class="order-header">
                    <h3>${order.numero}</h3>
                    <span class="status-badge ${order.estado}">${getStatusText(order.estado)}</span>
                </div>
                <div class="order-info">
                    <div class="customer-info">
                        <p><strong>Cliente:</strong> ${order.cliente}</p>
                        <p><strong>Teléfono:</strong> ${order.telefono}</p>
                        <p><strong>Dirección:</strong> ${order.direccion}</p>
                        <p><strong>Hora de entrega:</strong> ${order.hora}</p>
                        <p><strong>Forma de pago:</strong> ${order.formaPago}</p>
                    </div>
                    <div class="products-info">
                        <h4>Productos:</h4>
                        <ul>
                            ${order.productos.map((p) => `<li>${p.cantidad}x ${p.nombre} - $${(p.precio * p.cantidad).toLocaleString()}</li>`).join("")}
                        </ul>
                        <p class="order-total"><strong>Total: $${order.total.toLocaleString()}</strong></p>
                    </div>
                </div>
                <div class="order-actions">
                    ${getOrderActionButtons(order)}
                </div>
            `
      ordersGrid.appendChild(orderCard)
    })
  }

  function getStatusText(status) {
    const statusMap = {
      pending: "Pendiente",
      preparing: "En Preparación",
      ready: "Listo para Entrega",
      delivered: "Entregado",
      cancelled: "Cancelado",
    }
    return statusMap[status] || status
  }

  function getOrderActionButtons(order) {
    switch (order.estado) {
      case "pending":
        return `
                    <button class="btn-start" onclick="startPreparing(${order.id})">
                        <i class="fas fa-play"></i> Iniciar Preparación
                    </button>
                    <button class="btn-cancel" onclick="cancelOrder(${order.id})">
                        <i class="fas fa-times"></i> Cancelar
                    </button>
                `
      case "preparing":
        return `
                    <button class="btn-ready" onclick="markAsReady(${order.id})">
                        <i class="fas fa-check"></i> Marcar como Listo
                    </button>
                    <button class="btn-cancel" onclick="cancelOrder(${order.id})">
                        <i class="fas fa-times"></i> Cancelar
                    </button>
                `
      case "ready":
        return `
                    <button class="btn-deliver" onclick="assignDelivery(${order.id})">
                        <i class="fas fa-truck"></i> Asignar Domiciliario
                    </button>
                    <button class="btn-cancel" onclick="cancelOrder(${order.id})">
                        <i class="fas fa-times"></i> Cancelar
                    </button>
                `
      default:
        return ""
    }
  }

  // Iniciar preparación
  window.startPreparing = (orderId) => {
    const order = orders.find((o) => o.id === orderId)
    if (order) {
      order.estado = "preparing"
      updateOrdersDisplay()
      updateSummary()
      showAlert(`Preparación iniciada para ${order.numero}`, "success")
    }
  }

  // Marcar como listo
  window.markAsReady = (orderId) => {
    const order = orders.find((o) => o.id === orderId)
    if (order) {
      order.estado = "ready"
      updateOrdersDisplay()
      updateSummary()
      showAlert(`${order.numero} está listo para entrega`, "success")
    }
  }

  // Asignar domiciliario
  window.assignDelivery = (orderId) => {
    const order = orders.find((o) => o.id === orderId)
    if (order) {
      // Aquí se podría abrir para seleccionar domiciliario
      const domiciliarios = ["Carlos Rodríguez", "María López", "Juan Martínez"]
      const selectedDeliveryPerson = prompt(
        `Seleccionar domiciliario para ${order.numero}:\n${domiciliarios.map((d, i) => `${i + 1}. ${d}`).join("\n")}`,
      )

      if (selectedDeliveryPerson && selectedDeliveryPerson >= 1 && selectedDeliveryPerson <= 3) {
        order.estado = "delivered"
        order.domiciliario = domiciliarios[selectedDeliveryPerson - 1]
        updateOrdersDisplay()
        updateSummary()
        showAlert(`${order.numero} asignado a ${order.domiciliario}`, "success")
      }
    }
  }

  // Cancelar pedido
  window.cancelOrder = (orderId) => {
    if (confirm("¿Está seguro de cancelar este pedido?")) {
      const order = orders.find((o) => o.id === orderId)
      if (order) {
        order.estado = "cancelled"
        updateOrdersDisplay()
        updateSummary()
        showAlert(`Pedido ${order.numero} cancelado`, "warning")
      }
    }
  }

  function updateSummary() {
    const pending = orders.filter((o) => o.estado === "pending").length
    const preparing = orders.filter((o) => o.estado === "preparing").length
    const ready = orders.filter((o) => o.estado === "ready").length
    const delivered = orders.filter(
      (o) => o.estado === "delivered" && o.fecha === new Date().toISOString().split("T")[0],
    ).length

    document.querySelector(".summary-card.pending .summary-number").textContent = pending
    document.querySelector(".summary-card.preparing .summary-number").textContent = preparing
    document.querySelector(".summary-card.ready .summary-number").textContent = ready
    document.querySelector(".summary-card.delivered .summary-number").textContent = delivered
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
  updateOrdersDisplay()
  updateSummary()
})
