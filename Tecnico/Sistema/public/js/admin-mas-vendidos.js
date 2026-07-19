document.addEventListener("DOMContentLoaded", () => {
  const navHamb = document.getElementById("navHamb")
  const navMenu = document.getElementById("navMenu")

  // Mobile menu toggle
  if (navHamb && navMenu) {
    navHamb.addEventListener("click", () => {
      navMenu.classList.toggle("active")
    })
  }

  // Datos de productos más vendidos
  const bestSellersData = {
    week: [
      { name: "Cheesecake de durazno", sales: 45, revenue: 180000, image: "/ASSETS/img/durazno chees.jpg" },
      { name: "Postre de maracuyá", sales: 38, revenue: 152000, image: "/ASSETS/img/maracuya pos.jpg" },
      { name: "Torta de chocolate", sales: 25, revenue: 1250000, image: "/ASSETS/img/choco.jpeg" },
      { name: "Postre de mora", sales: 22, revenue: 88000, image: "/ASSETS/img/mora pos.jpg" },
      { name: "Gelatina de colores", sales: 18, revenue: 72000, image: "/ASSETS/img/gelatina mos.jpg" },
    ],
    month: [
      { name: "Postre de maracuyá", sales: 156, revenue: 624000, image: "/ASSETS/img/maracuya pos.jpg" },
      { name: "Cheesecake de durazno", sales: 142, revenue: 568000, image: "/ASSETS/img/durazno chees.jpg" },
      { name: "Torta de chocolate", sales: 89, revenue: 4450000, image: "/ASSETS/img/choco.jpeg" },
      { name: "Postre de mora", sales: 78, revenue: 312000, image: "/ASSETS/img/mora pos.jpg" },
      { name: "Postre de limón", sales: 65, revenue: 260000, image: "/ASSETS/img/limon pos.jpg" },
    ],
    year: [
      { name: "Postre de maracuyá", sales: 1890, revenue: 7560000, image: "/ASSETS/img/maracuya pos.jpg" },
      { name: "Cheesecake de durazno", sales: 1654, revenue: 6616000, image: "/ASSETS/img/durazno chees.jpg" },
      { name: "Torta de chocolate", sales: 1234, revenue: 61700000, image: "/ASSETS/img/choco.jpeg" },
      { name: "Postre de mora", sales: 987, revenue: 3948000, image: "/ASSETS/img/mora pos.jpg" },
      { name: "Postre de limón", sales: 876, revenue: 3504000, image: "/ASSETS/img/limon pos.jpg" },
    ],
  }

  // Función para actualizar el ranking
  const updateBestSellers = () => {
    const period = document.getElementById("period").value
    const rankingList = document.getElementById("ranking-list")
    const data = bestSellersData[period]

    rankingList.innerHTML = ""

    data.forEach((product, index) => {
      const rankingItem = document.createElement("div")
      rankingItem.className = "ranking-item"
      rankingItem.innerHTML = `
                <div class="ranking-position">
                    <span class="position-number">${index + 1}</span>
                    ${index === 0 ? '<i class="fas fa-crown gold"></i>' : ""}
                    ${index === 1 ? '<i class="fas fa-medal silver"></i>' : ""}
                    ${index === 2 ? '<i class="fas fa-medal bronze"></i>' : ""}
                </div>
                <div class="product-info">
                    <img src="${product.image}" alt="${product.name}" class="product-thumbnail">
                    <div class="product-details">
                        <h3>${product.name}</h3>
                        <p><strong>Ventas:</strong> ${product.sales} unidades</p>
                        <p><strong>Ingresos:</strong> $${product.revenue.toLocaleString()}</p>
                    </div>
                </div>
                <div class="sales-bar">
                    <div class="bar-fill" style="width: ${(product.sales / data[0].sales) * 100}%"></div>
                </div>
            `
      rankingList.appendChild(rankingItem)
    })

    drawSalesChart(data)
  }

  // Función para dibujar gráfico simple
  function drawSalesChart(data) {
    const canvas = document.getElementById("salesChart")
    const ctx = canvas.getContext("2d")

    // Limpiar canvas
    ctx.clearRect(0, 0, canvas.width, canvas.height)

    // Configuración del gráfico
    const padding = 40
    const chartWidth = canvas.width - padding * 2
    const chartHeight = canvas.height - padding * 2
    const maxSales = Math.max(...data.map((p) => p.sales))

    // Dibujar barras
    data.forEach((product, index) => {
      const barWidth = chartWidth / data.length - 10
      const barHeight = (product.sales / maxSales) * chartHeight
      const x = padding + index * (chartWidth / data.length) + 5
      const y = canvas.height - padding - barHeight

      // Barra
      ctx.fillStyle = index === 0 ? "#f70c5b" : "#ffb6c1"
      ctx.fillRect(x, y, barWidth, barHeight)

      // Etiqueta
      ctx.fillStyle = "#333"
      ctx.font = "12px Arial"
      ctx.textAlign = "center"
      ctx.fillText(product.sales, x + barWidth / 2, y - 5)
    })
  }

  // Inicializar
  updateBestSellers()

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
