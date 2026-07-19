document.addEventListener("DOMContentLoaded", () => {
  const navHamb = document.getElementById("navHamb")
  const navMenu = document.getElementById("navMenu")

  // Mobile menu toggle
  if (navHamb && navMenu) {
    navHamb.addEventListener("click", () => {
      navMenu.classList.toggle("active")
    })
  }

  // Datos de estadísticas diarias (últimos 30 días)
  const dailyStats = generateDailyStats()

  function generateDailyStats() {
    const stats = []
    const today = new Date()

    for (let i = 29; i >= 0; i--) {
      const date = new Date(today)
      date.setDate(date.getDate() - i)

      const deliveries = Math.floor(Math.random() * 20) + 5 // 5-25 domicilios
      const avgOrder = Math.floor(Math.random() * 20000) + 15000 // 15k-35k promedio
      const income = deliveries * avgOrder

      stats.push({
        date: date.toLocaleDateString("es-CO"),
        deliveries: deliveries,
        income: income,
        avgOrder: avgOrder,
      })
    }

    return stats
  }

  function updateDailyStatsTable() {
    const tbody = document.getElementById("daily-stats-tbody")
    tbody.innerHTML = ""

    dailyStats.forEach((stat) => {
      const row = document.createElement("tr")
      row.innerHTML = `
                <td>${stat.date}</td>
                <td>${stat.deliveries}</td>
                <td>$${stat.income.toLocaleString()}</td>
                <td>$${stat.avgOrder.toLocaleString()}</td>
            `
      tbody.appendChild(row)
    })
  }

  function drawDeliveryChart() {
    const canvas = document.getElementById("deliveryChart")
    const ctx = canvas.getContext("2d")

    // Limpiar canvas
    ctx.clearRect(0, 0, canvas.width, canvas.height)

    // Configuración del gráfico
    const padding = 40
    const chartWidth = canvas.width - padding * 2
    const chartHeight = canvas.height - padding * 2

    // Tomar solo los últimos 7 días para el gráfico
    const last7Days = dailyStats.slice(-7)
    const maxDeliveries = Math.max(...last7Days.map((s) => s.deliveries))

    // Dibujar línea de tendencia
    ctx.strokeStyle = "#f70c5b"
    ctx.lineWidth = 3
    ctx.beginPath()

    last7Days.forEach((stat, index) => {
      const x = padding + (index * chartWidth) / (last7Days.length - 1)
      const y = canvas.height - padding - (stat.deliveries / maxDeliveries) * chartHeight

      if (index === 0) {
        ctx.moveTo(x, y)
      } else {
        ctx.lineTo(x, y)
      }

      // Puntos
      ctx.fillStyle = "#f70c5b"
      ctx.beginPath()
      ctx.arc(x, y, 4, 0, 2 * Math.PI)
      ctx.fill()

      // Etiquetas
      ctx.fillStyle = "#333"
      ctx.font = "12px Arial"
      ctx.textAlign = "center"
      ctx.fillText(stat.deliveries, x, y - 10)
    })

    ctx.stroke()

    // Ejes
    ctx.strokeStyle = "#ccc"
    ctx.lineWidth = 1
    ctx.beginPath()
    ctx.moveTo(padding, padding)
    ctx.lineTo(padding, canvas.height - padding)
    ctx.lineTo(canvas.width - padding, canvas.height - padding)
    ctx.stroke()
  }

  // Inicializar
  updateDailyStatsTable()
  drawDeliveryChart()

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
})
