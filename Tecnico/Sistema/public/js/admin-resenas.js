document.addEventListener("DOMContentLoaded", () => {
  const navHamb = document.getElementById("navHamb")
  const navMenu = document.getElementById("navMenu")

  // Mobile menu toggle
  if (navHamb && navMenu) {
    navHamb.addEventListener("click", () => {
      navMenu.classList.toggle("active")
    })
  }

  // Datos de reseñas
  const reviews = [
    {
      id: 1,
      cliente: "Juan Pérez",
      producto: "Cheesecake de durazno",
      rating: 5,
      comentario: "Excelente sabor, muy fresco y delicioso. Lo recomiendo totalmente.",
      fecha: "2024-01-15",
      estado: "pending",
    },
    {
      id: 2,
      cliente: "María García",
      producto: "Postre de maracuyá",
      rating: 4,
      comentario: "Muy bueno, aunque podría tener un poco más de dulce.",
      fecha: "2024-01-14",
      estado: "pending",
    },
    {
      id: 3,
      cliente: "Carlos Mendoza",
      producto: "Torta de chocolate",
      rating: 5,
      comentario: "La mejor torta de chocolate que he probado. Perfecta para celebraciones.",
      fecha: "2024-01-13",
      estado: "approved",
    },
    {
      id: 4,
      cliente: "Ana Rodríguez",
      producto: "Postre de mora",
      rating: 3,
      comentario: "Está bien, pero esperaba un sabor más intenso a mora.",
      fecha: "2024-01-12",
      estado: "pending",
    },
    {
      id: 5,
      cliente: "Luis Martínez",
      producto: "Gelatina de colores",
      rating: 5,
      comentario: "Perfecta para los niños, muy colorida y sabrosa.",
      fecha: "2024-01-11",
      estado: "approved",
    },
  ]

  // Función para filtrar reseñas
  window.filterReviews = () => {
    const statusFilter = document.getElementById("review-status").value
    const ratingFilter = document.getElementById("rating-filter").value

    let filteredReviews = reviews

    if (statusFilter !== "all") {
      filteredReviews = filteredReviews.filter((r) => r.estado === statusFilter)
    }

    if (ratingFilter !== "all") {
      filteredReviews = filteredReviews.filter((r) => r.rating === Number.parseInt(ratingFilter))
    }

    updateReviewsDisplay(filteredReviews)
  }

  function updateReviewsDisplay(reviewsToShow = reviews) {
    const pendingReviews = reviewsToShow.filter((r) => r.estado === "pending")
    const approvedReviews = reviewsToShow.filter((r) => r.estado === "approved")

    updatePendingReviews(pendingReviews)
    updateApprovedReviews(approvedReviews)
  }

  function updatePendingReviews(pendingReviews) {
    const reviewsGrid = document.getElementById("reviews-grid")
    reviewsGrid.innerHTML = ""

    if (pendingReviews.length === 0) {
      reviewsGrid.innerHTML = "<p>No hay reseñas pendientes de moderación.</p>"
      return
    }

    pendingReviews.forEach((review) => {
      const reviewCard = document.createElement("div")
      reviewCard.className = "review-card pending"
      reviewCard.innerHTML = `
                <div class="review-header">
                    <h3>${review.cliente}</h3>
                    <div class="rating">
                        ${generateStars(review.rating)}
                    </div>
                    <span class="review-date">${review.fecha}</span>
                </div>
                <div class="review-content">
                    <p><strong>Producto:</strong> ${review.producto}</p>
                    <p class="review-comment">"${review.comentario}"</p>
                </div>
                <div class="review-actions">
                    <button class="btn-approve" onclick="approveReview(${review.id})">
                        <i class="fas fa-check"></i> Aprobar
                    </button>
                    <button class="btn-reject" onclick="rejectReview(${review.id})">
                        <i class="fas fa-times"></i> Rechazar
                    </button>
                </div>
            `
      reviewsGrid.appendChild(reviewCard)
    })
  }

  function updateApprovedReviews(approvedReviews) {
    const approvedGrid = document.getElementById("approved-reviews-grid")
    approvedGrid.innerHTML = ""

    if (approvedReviews.length === 0) {
      approvedGrid.innerHTML = "<p>No hay reseñas aprobadas.</p>"
      return
    }

    approvedReviews.forEach((review) => {
      const reviewCard = document.createElement("div")
      reviewCard.className = "review-card approved"
      reviewCard.innerHTML = `
                <div class="review-header">
                    <h3>${review.cliente}</h3>
                    <div class="rating">
                        ${generateStars(review.rating)}
                    </div>
                    <span class="review-date">${review.fecha}</span>
                </div>
                <div class="review-content">
                    <p><strong>Producto:</strong> ${review.producto}</p>
                    <p class="review-comment">"${review.comentario}"</p>
                </div>
                <div class="review-actions">
                    <button class="btn-unpublish" onclick="unpublishReview(${review.id})">
                        <i class="fas fa-eye-slash"></i> Despublicar
                    </button>
                </div>
            `
      approvedGrid.appendChild(reviewCard)
    })
  }

  function generateStars(rating) {
    let stars = ""
    for (let i = 1; i <= 5; i++) {
      if (i <= rating) {
        stars += '<i class="fas fa-star filled"></i>'
      } else {
        stars += '<i class="fas fa-star"></i>'
      }
    }
    return stars
  }

  // Aprobar reseña
  window.approveReview = (reviewId) => {
    const review = reviews.find((r) => r.id === reviewId)
    if (review) {
      review.estado = "approved"
      updateReviewsDisplay()
      updateStats()
      showAlert("Reseña aprobada y publicada", "success")
    }
  }

  // Rechazar reseña
  window.rejectReview = (reviewId) => {
    if (confirm("¿Está seguro de rechazar esta reseña?")) {
      const review = reviews.find((r) => r.id === reviewId)
      if (review) {
        review.estado = "rejected"
        updateReviewsDisplay()
        updateStats()
        showAlert("Reseña rechazada", "warning")
      }
    }
  }

  // Despublicar reseña
  window.unpublishReview = (reviewId) => {
    if (confirm("¿Está seguro de despublicar esta reseña?")) {
      const review = reviews.find((r) => r.id === reviewId)
      if (review) {
        review.estado = "rejected"
        updateReviewsDisplay()
        updateStats()
        showAlert("Reseña despublicada", "info")
      }
    }
  }

  function updateStats() {
    const pending = reviews.filter((r) => r.estado === "pending").length
    const approved = reviews.filter((r) => r.estado === "approved").length
    const approvedReviews = reviews.filter((r) => r.estado === "approved")
    const average =
      approvedReviews.length > 0
        ? (approvedReviews.reduce((sum, r) => sum + r.rating, 0) / approvedReviews.length).toFixed(1)
        : 0

    document.querySelector(".reviews-stats .stat-card:nth-child(1) .stat-number").textContent = pending
    document.querySelector(".reviews-stats .stat-card:nth-child(2) .stat-number").textContent = approved
    document.querySelector(".reviews-stats .stat-card:nth-child(3) .stat-number").textContent = average
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
  updateReviewsDisplay()
  updateStats()
})
