document.addEventListener("DOMContentLoaded", () => {
  const navHamb = document.getElementById("navHamb")
  const navMenu = document.getElementById("navMenu")
  const productForm = document.getElementById("product-form")

  // Mobile menu toggle
  if (navHamb && navMenu) {
    navHamb.addEventListener("click", () => {
      navMenu.classList.toggle("active")
    })
  }

  // Crear modal para editar usuario
  createEditUserModal()

  // Datos de ejemplo
  let users = [
    {
      id: 1,
      nombre: "Juan Pérez",
      correo: "juan.perez@gmail.com",
      telefono: "3001234567",
      direccion: "Calle 123 #45-67",
      tarjeta: "1.231.567.890",
    },
    {
      id: 2,
      nombre: "María García",
      correo: "maria.garcia@gmail.com",
      telefono: "3009876543",
      direccion: "Carrera 45 #12-34",
      tarjeta: "1.876.543.210",
    },
  ]

  let products = [
    {
      id: 1,
      codigo: "CHD001",
      nombre: "Cheesecake de durazno",
      descripcion: "Delicioso cheesecake con durazno natural",
      precio: 4000,
      cantidad: 10,
      estado: "disponible",
      imagen: "/ASSETS/img/durazno chees.jpg",
    },
  ]

  // Agregar producto
  if (productForm) {
    productForm.addEventListener("submit", (e) => {
      e.preventDefault()

      const formData = new FormData(productForm)
      const newProduct = {
        id: products.length + 1,
        codigo: formData.get("codigo"),
        nombre: formData.get("nombre"),
        descripcion: formData.get("descripcion"),
        precio: Number.parseInt(formData.get("precio")),
        cantidad: Number.parseInt(formData.get("cantidad")),
        estado: formData.get("estado"),
        imagen: "/placeholder.svg?height=200&width=200",
      }

      products.push(newProduct)
      updateProductsDisplay()
      productForm.reset()
      showAlert("Producto agregado exitosamente", "success")
    })
  }

  // Buscar usuario
  window.searchUser = () => {
    const searchTerm = document.getElementById("search-cc").value
    const tbody = document.getElementById("users-tbody")

    if (!searchTerm) {
      updateUsersDisplay()
      return
    }

    const filteredUsers = users.filter((user) => user.tarjeta.includes(searchTerm))

    tbody.innerHTML = ""
    filteredUsers.forEach((user) => {
      const row = document.createElement("tr")
      row.innerHTML = `
                <td>${user.nombre}</td>
                <td>${user.correo}</td>
                <td>${user.telefono}</td>
                <td>${user.direccion}</td>
                <td>${user.tarjeta}</td>
                <td>
                    <button class="btn-edit" onclick="editUser(${user.id})">Editar</button>
                    <button class="btn-delete" onclick="deleteUser(${user.id})">Eliminar</button>
                </td>
            `
      tbody.appendChild(row)
    })
  }

  // Función para crear el modal de edición de usuario
  function createEditUserModal() {
    const modal = document.createElement("div")
    modal.id = "edit-user-modal"
    modal.className = "modal"
    modal.style.display = "none"

    modal.innerHTML = `
      <div class="modal-content" style="max-width: 600px;">
        <span class="close" onclick="closeEditUserModal()">&times;</span>
        <h2 style="color: var(--color-primary); margin-bottom: 20px; text-align: center;">Editar Usuario</h2>
        
        <form id="edit-user-form" class="profile-form">
          <div class="form-group">
            <label for="edit-nombre">Nombre Completo:</label>
            <input type="text" id="edit-nombre" name="nombre" required>
          </div>
          
          <div class="form-group">
            <label for="edit-correo">Correo Electrónico:</label>
            <input type="email" id="edit-correo" name="correo" required>
          </div>
          
          <div class="form-group">
            <label for="edit-telefono">Teléfono:</label>
            <input type="tel" id="edit-telefono" name="telefono" required>
          </div>
          
          <div class="form-group">
            <label for="edit-direccion">Dirección:</label>
            <input type="text" id="edit-direccion" name="direccion" required>
          </div>
          
          <div class="form-group">
            <label for="edit-tarjeta">Cédula:</label>
            <input type="text" id="edit-tarjeta" name="tarjeta" required>
          </div>
          
          <div class="form-buttons">
            <button type="submit" class="btn-save">
              <i class="fas fa-save"></i> Guardar Cambios
            </button>
            <button type="button" class="btn-delete" onclick="closeEditUserModal()">
              <i class="fas fa-times"></i> Cancelar
            </button>
          </div>
        </form>
      </div>
    `

    document.body.appendChild(modal)

    // Manejar envío del formulario
    const editForm = document.getElementById("edit-user-form")
    editForm.addEventListener("submit", (e) => {
      e.preventDefault()
      saveUserChanges()
    })

    // Cerrar modal al hacer click fuera
    modal.addEventListener("click", (e) => {
      if (e.target === modal) {
        closeEditUserModal()
      }
    })
  }

  // Variable para almacenar el ID del usuario que se está editando
  let currentEditingUserId = null

  // Editar usuario - nueva función mejorada
  window.editUser = (userId) => {
    const user = users.find((u) => u.id === userId)
    if (user) {
      currentEditingUserId = userId

      // Llenar el formulario con los datos actuales
      document.getElementById("edit-nombre").value = user.nombre
      document.getElementById("edit-correo").value = user.correo
      document.getElementById("edit-telefono").value = user.telefono
      document.getElementById("edit-direccion").value = user.direccion
      document.getElementById("edit-tarjeta").value = user.tarjeta

      // Mostrar el modal
      document.getElementById("edit-user-modal").style.display = "block"
      document.body.style.overflow = "hidden" // Prevenir scroll del body
    }
  }

  // Cerrar modal de edición
  window.closeEditUserModal = () => {
    document.getElementById("edit-user-modal").style.display = "none"
    document.body.style.overflow = "auto" // Restaurar scroll del body
    currentEditingUserId = null
  }

  // Guardar cambios del usuario
  window.saveUserChanges = () => {
    if (currentEditingUserId) {
      const user = users.find((u) => u.id === currentEditingUserId)
      if (user) {
        // Obtener los nuevos valores del formulario
        user.nombre = document.getElementById("edit-nombre").value.trim()
        user.correo = document.getElementById("edit-correo").value.trim()
        user.telefono = document.getElementById("edit-telefono").value.trim()
        user.direccion = document.getElementById("edit-direccion").value.trim()
        user.tarjeta = document.getElementById("edit-tarjeta").value.trim()

        // Validar que todos los campos estén llenos
        if (!user.nombre || !user.correo || !user.telefono || !user.direccion || !user.tarjeta) {
          showAlert("Por favor, complete todos los campos", "warning")
          return
        }

        // Validar formato de correo
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/
        if (!emailRegex.test(user.correo)) {
          showAlert("Por favor, ingrese un correo válido", "warning")
          return
        }

        // Validar que la cédula no esté duplicada
        const duplicateUser = users.find((u) => u.id !== currentEditingUserId && u.tarjeta === user.tarjeta)
        if (duplicateUser) {
          showAlert("Ya existe un usuario con esta cédula", "warning")
          return
        }

        // Actualizar la tabla y cerrar modal
        updateUsersDisplay()
        closeEditUserModal()
        showAlert("Usuario actualizado exitosamente", "success")
      }
    }
  }

  // Cerrar modal con tecla Escape
  document.addEventListener("keydown", (e) => {
    if (e.key === "Escape") {
      const modal = document.getElementById("edit-user-modal")
      if (modal && modal.style.display === "block") {
        closeEditUserModal()
      }
    }
  })

  // Eliminar usuario
  window.deleteUser = (userId) => {
    const user = users.find((u) => u.id === userId)
    if (user && confirm(`¿Estás seguro de eliminar al usuario "${user.nombre}"?`)) {
      users = users.filter((u) => u.id !== userId)
      updateUsersDisplay()
      showAlert("Usuario eliminado exitosamente", "info")
    }
  }

  function updateUsersDisplay() {
    const tbody = document.getElementById("users-tbody")
    if (!tbody) return

    tbody.innerHTML = ""
    users.forEach((user) => {
      const row = document.createElement("tr")
      row.innerHTML = `
                <td>${user.nombre}</td>
                <td>${user.correo}</td>
                <td>${user.telefono}</td>
                <td>${user.direccion}</td>
                <td>${user.tarjeta}</td>
                <td>
                    <button class="btn-edit" onclick="editUser(${user.id})" title="Editar usuario">
                        <i class="fas fa-edit"></i> Editar
                    </button>
                    <button class="btn-delete" onclick="deleteUser(${user.id})" title="Eliminar usuario">
                        <i class="fas fa-trash"></i> Eliminar
                    </button>
                </td>
            `
      tbody.appendChild(row)
    })
  }

  function updateProductsDisplay() {
    const productsGrid = document.getElementById("products-grid")
    if (!productsGrid) return

    productsGrid.innerHTML = ""
    products.forEach((product) => {
      const productCard = document.createElement("div")
      productCard.className = "product-card"
      productCard.innerHTML = `
                <img src="${product.imagen}" alt="${product.nombre}" class="product-image">
                <h3>${product.nombre}</h3>
                <p><strong>Código:</strong> ${product.codigo}</p>
                <p><strong>Precio:</strong> $${product.precio.toLocaleString()}</p>
                <p><strong>Cantidad:</strong> ${product.cantidad}</p>
                <p><strong>Estado:</strong> ${product.estado}</p>
                <div style="margin-top: 10px;">
                    <button class="btn-edit" onclick="editProduct(${product.id})" title="Editar producto">
                        <i class="fas fa-edit"></i> Editar
                    </button>
                    <button class="btn-delete" onclick="deleteProduct(${product.id})" title="Eliminar producto">
                        <i class="fas fa-trash"></i> Eliminar
                    </button>
                </div>
            `
      productsGrid.appendChild(productCard)
    })
  }

  // Editar producto
  window.editProduct = (productId) => {
    const product = products.find((p) => p.id === productId)
    if (product) {
      const newPrice = prompt("Nuevo precio:", product.precio)
      if (newPrice && !isNaN(newPrice)) {
        product.precio = Number.parseInt(newPrice)
        updateProductsDisplay()
        showAlert("Producto actualizado exitosamente", "success")
      }
    }
  }

  // Eliminar producto
  window.deleteProduct = (productId) => {
    const product = products.find((p) => p.id === productId)
    if (product && confirm(`¿Estás seguro de eliminar el producto "${product.nombre}"?`)) {
      products = products.filter((p) => p.id !== productId)
      updateProductsDisplay()
      showAlert("Producto eliminado exitosamente", "info")
    }
  }

  function showAlert(message, type) {
    const alertBox = document.createElement("div")
    alertBox.className = `alert alert-${type}`
    alertBox.style.cssText = `
            position: fixed;
            top: 20px;
            right: 20px;
            padding: 15px 20px;
            border-radius: 8px;
            color: white;
            font-weight: bold;
            z-index: 10000;
            animation: slideIn 0.3s ease;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            max-width: 300px;
            word-wrap: break-word;
        `

    switch (type) {
      case "success":
        alertBox.style.backgroundColor = "#28a745"
        alertBox.innerHTML = `<i class="fas fa-check-circle"></i> ${message}`
        break
      case "error":
        alertBox.style.backgroundColor = "#dc3545"
        alertBox.innerHTML = `<i class="fas fa-exclamation-circle"></i> ${message}`
        break
      case "warning":
        alertBox.style.backgroundColor = "#ffc107"
        alertBox.style.color = "#333"
        alertBox.innerHTML = `<i class="fas fa-exclamation-triangle"></i> ${message}`
        break
      case "info":
        alertBox.style.backgroundColor = "#17a2b8"
        alertBox.innerHTML = `<i class="fas fa-info-circle"></i> ${message}`
        break
    }

    document.body.appendChild(alertBox)

    // Agregar animación CSS
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
    `
    document.head.appendChild(style)

    setTimeout(() => {
      alertBox.style.animation = "slideIn 0.3s ease reverse"
      setTimeout(() => {
        alertBox.remove()
      }, 300)
    }, 3000)
  }

  // Manejar formulario de perfil del administrador
  const profileForm = document.getElementById("profile-form")
  if (profileForm) {
    profileForm.addEventListener("submit", (e) => {
      e.preventDefault()

      // Obtener los valores del formulario
      const formData = new FormData(profileForm)
      const profileData = {
        nombre: formData.get("nombre").trim(),
        correo: formData.get("correo").trim(),
        direccion: formData.get("direccion").trim(),
        telefono: formData.get("telefono").trim(),
        tarjeta: formData.get("tarjeta").trim(),
      }

      // Validar que todos los campos estén llenos
      if (
        !profileData.nombre ||
        !profileData.correo ||
        !profileData.direccion ||
        !profileData.telefono ||
        !profileData.tarjeta
      ) {
        showAlert("Por favor, complete todos los campos", "warning")
        return
      }

      // Validar formato de correo
      const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/
      if (!emailRegex.test(profileData.correo)) {
        showAlert("Por favor, ingrese un correo válido", "warning")
        return
      }

      // Validar formato de teléfono (solo números y espacios)
      const phoneRegex = /^[0-9\s\-+$$$$]+$/
      if (!phoneRegex.test(profileData.telefono)) {
        showAlert("Por favor, ingrese un teléfono válido", "warning")
        return
      }

      // Validar formato de cédula (números, puntos y espacios)
      const cedulaRegex = /^[0-9.\s]+$/
      if (!cedulaRegex.test(profileData.tarjeta)) {
        showAlert("Por favor, ingrese una cédula válida", "warning")
        return
      }

      // Simular guardado de datos (en una aplicación real, aquí se enviarían al servidor)
      // Los datos ya están en el formulario, así que solo mostramos confirmación
      showAlert("Perfil actualizado exitosamente", "success")

      // Opcional: Deshabilitar temporalmente el botón para evitar múltiples envíos
      const submitButton = profileForm.querySelector('button[type="submit"]')
      const originalText = submitButton.textContent
      submitButton.disabled = true
      submitButton.textContent = "Guardando..."

      setTimeout(() => {
        submitButton.disabled = false
        submitButton.textContent = originalText
      }, 1500)
    })
  }

  // Inicializar displays
  updateUsersDisplay()
  updateProductsDisplay()
})
