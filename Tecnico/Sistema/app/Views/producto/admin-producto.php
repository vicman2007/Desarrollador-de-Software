<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Usuarios - Repostería Misves</title>
    <link rel="stylesheet" href="../../ASSETS/CSS/style2.css">
    <link rel="icon" type="image/x-icon" href="http://localhost/MISVES/ASSETS/img/icon.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
</head>
<style>
    :root {
  --color-primary: #f70c5b;
  --color-secondary: #ffb6c1;
  --color-complementary: #ffe6d5;
  --color-background: #f3c5c5;
  --color-text: #333;
  --color-white: #ffffff;
  --color-success: #28a745;
  --color-danger: #dc3545;
  --color-warning: #ffc107;
  --font-main: "Arial", sans-serif;
}

* {
  box-sizing: border-box;
  margin: 0;
  padding: 0;
}

body {
  background: url(../ASSETS/img/bg.jpg);
  font-family: var(--font-main);
  color: var(--color-text);
  line-height: 1.6;
}

.container {
  max-width: 1200px;
  margin: 0 auto;
  padding: 20px;
  background-color: rgba(243, 197, 197, 0.9);
  box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
}

.container-full {
  min-height: 100vh;
  background-color: rgba(243, 197, 197, 0.95);
  padding: 20px;
}

.logo {
  width: 200px;
  transition: transform 0.3s ease;
}

.logo:hover {
  transform: scale(1.05);
}

/* Navigation */
nav {
  background-color: var(--color-primary);
  padding: 10px;
  margin-bottom: 20px;
  border-radius: 10px;
}

#navHamb {
  display: none;
  color: var(--color-white);
  font-size: 24px;
  cursor: pointer;
}

#navMenu {
  display: flex;
  justify-content: center;
  gap: 20px;
  flex-wrap: wrap;
}

nav a {
  color: var(--color-white);
  text-decoration: none;
  padding: 10px 15px;
  border-radius: 5px;
  transition: background-color 0.3s ease;
}

nav a:hover {
  background-color: var(--color-complementary);
  color: var(--color-primary);
}

/* Content */
.text-center {
  text-align: center;
}

.content {
  padding: 20px;
}

.content-full {
  padding: 20px;
  min-height: calc(100vh - 200px);
}

.hero-image {
  width: 100%;
  max-height: 400px;
  object-fit: cover;
  border-radius: 10px;
  margin-bottom: 20px;
}

.slogan {
  color: var(--color-primary);
  font-size: 2.5rem;
  margin-bottom: 30px;
  text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.1);
}

.title {
  color: var(--color-primary);
  font-size: 2rem;
  margin-bottom: 20px;
  border-bottom: 2px solid var(--color-secondary);
  padding-bottom: 10px;
  text-shadow: 2px 2px 0px var(--color-secondary), 4px 4px 0px rgba(0, 0, 0, 0.1);
}

/* Centrar el título */
.title-centered {
  color: var(--color-primary);
  font-size: 2rem;
  margin-bottom: 30px;
  border-bottom: 2px solid var(--color-secondary);
  padding-bottom: 10px;
  text-shadow: 2px 2px 0px var(--color-secondary), 4px 4px 0px rgba(0, 0, 0, 0.1);
  text-align: center;
  display: inline-block;
}

.section-header-centered {
  text-align: center;
  margin-bottom: 30px;
}

/* Profile Styles */
.profile-container {
  max-width: 800px;
  margin: 0 auto;
}

.profile-section {
  background-color: var(--color-white);
  padding: 30px;
  border-radius: 15px;
  box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
}

.profile-form {
  display: grid;
  gap: 20px;
}

.form-group {
  display: flex;
  flex-direction: column;
}

.form-group label {
  font-weight: bold;
  margin-bottom: 5px;
  color: var(--color-primary);
}

.form-group input,
.form-group textarea,
.form-group select {
  padding: 12px;
  border: 2px solid var(--color-secondary);
  border-radius: 8px;
  font-size: 16px;
  transition: border-color 0.3s ease;
}

.form-group input:focus,
.form-group textarea:focus,
.form-group select:focus {
  outline: none;
  border-color: var(--color-primary);
}

.form-buttons {
  display: flex;
  gap: 15px;
  justify-content: center;
  margin-top: 20px;
}

.btn-save {
  background-color: var(--color-success);
  color: white;
  padding: 12px 30px;
  border: none;
  border-radius: 8px;
  cursor: pointer;
  font-size: 16px;
  transition: background-color 0.3s ease;
}

.btn-save:hover {
  background-color: #218838;
}

.btn-delete {
  background-color: var(--color-danger);
  color: white;
  padding: 12px 30px;
  border: none;
  border-radius: 8px;
  cursor: pointer;
  font-size: 16px;
  transition: background-color 0.3s ease;
}

.btn-delete:hover {
  background-color: #c82333;
}

/* Admin Styles */
.admin-menu {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
  gap: 25px;
  margin-top: 30px;
}

.admin-card {
  background-color: var(--color-white);
  padding: 30px;
  border-radius: 15px;
  text-align: center;
  cursor: pointer;
  transition: transform 0.3s ease, box-shadow 0.3s ease;
  box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
}

.admin-card:hover {
  transform: translateY(-5px);
  box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
}

.admin-card i {
  font-size: 3rem;
  color: var(--color-primary);
  margin-bottom: 15px;
}

.admin-card h3 {
  color: var(--color-primary);
  margin-bottom: 10px;
}

.section-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 30px;
}

.btn-back {
  background-color: var(--color-secondary);
  color: var(--color-primary);
  padding: 10px 20px;
  text-decoration: none;
  border-radius: 8px;
  transition: background-color 0.3s ease;
}

.btn-back:hover {
  background-color: var(--color-primary);
  color: white;
}

/* Table Styles */
.users-table {
  background-color: var(--color-white);
  border-radius: 15px;
  overflow: hidden;
  box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
}

.users-table table {
  width: 100%;
  border-collapse: collapse;
}

.users-table th,
.users-table td {
  padding: 15px;
  text-align: left;
  border-bottom: 1px solid var(--color-secondary);
}

.users-table th {
  background-color: var(--color-primary);
  color: white;
  font-weight: bold;
}

.btn-edit {
  background-color: var(--color-warning);
  color: white;
  padding: 8px 15px;
  border: none;
  border-radius: 5px;
  cursor: pointer;
  margin-right: 5px;
}

.btn-edit:hover {
  background-color: #e0a800;
}

/* Search Styles - Modificado para incluir el botón de agregar */
.search-container {
  display: flex;
  gap: 10px;
  margin-bottom: 20px;
  justify-content: center;
  align-items: center;
  flex-wrap: wrap;
}

.search-input {
  padding: 12px;
  border: 2px solid var(--color-secondary);
  border-radius: 8px;
  width: 300px;
  font-size: 16px;
}

.btn-search {
  background-color: var(--color-primary);
  color: white;
  padding: 12px 20px;
  border: none;
  border-radius: 8px;
  cursor: pointer;
  transition: background-color 0.3s ease;
}

.btn-search:hover {
  background-color: #d60a4f;
}

.btn-primary {
  background-color: var(--color-primary);
  color: white;
  padding: 12px 20px;
  border: none;
  border-radius: 8px;
  cursor: pointer;
  text-decoration: none;
  display: inline-flex;
  align-items: center;
  gap: 8px;
  transition: background-color 0.3s ease;
}

.btn-primary:hover {
  background-color: #d60a4f;
}

/* Botones de acción mejorados */
.action-buttons {
  display: flex;
  gap: 8px;
  justify-content: center;
  align-items: center;
}

.btn-action {
  display: inline-flex;
  align-items: center;
  justify-content: center;
  padding: 8px 12px;
  border: none;
  border-radius: 6px;
  text-decoration: none;
  font-size: 14px;
  font-weight: 500;
  cursor: pointer;
  transition: all 0.3s ease;
  min-width: 80px;
  gap: 6px;
}

.btn-action:hover {
  transform: translateY(-2px);
  box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
}

.btn-action i {
  font-size: 14px;
}

.btn-edit-new {
  background-color: #17a2b8;
  color: white;
  border: 2px solid #17a2b8;
}

.btn-edit-new:hover {
  background-color: #138496;
  border-color: #138496;
  color: white;
}

.btn-delete-new {
  background-color: #dc3545;
  color: white;
  border: 2px solid #dc3545;
}

.btn-delete-new:hover {
  background-color: #c82333;
  border-color: #c82333;
  color: white;
}

/* Responsive para botones de acción */
@media (max-width: 768px) {
  .action-buttons {
    flex-direction: column;
    gap: 4px;
  }
  
  .btn-action {
    min-width: 70px;
    padding: 6px 10px;
    font-size: 12px;
  }
  
  .btn-action i {
    font-size: 12px;
  }
}

/* Product Form Styles */
.product-form-container {
  background-color: var(--color-white);
  padding: 30px;
  border-radius: 15px;
  margin-bottom: 30px;
  box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
}

.form-row {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 20px;
}

.products-list {
  background-color: var(--color-white);
  padding: 30px;
  border-radius: 15px;
  box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
}

.products-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
  gap: 20px;
  margin-top: 20px;
}

/* Modal Styles */
.modal {
  display: none;
  position: fixed;
  z-index: 1000;
  left: 0;
  top: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(0, 0, 0, 0.5);
}

.modal-content {
  background-color: var(--color-white);
  margin: 5% auto;
  padding: 30px;
  border-radius: 15px;
  width: 90%;
  max-width: 600px;
  max-height: 80vh;
  overflow-y: auto;
}

.close {
  color: #aaa;
  float: right;
  font-size: 28px;
  font-weight: bold;
  cursor: pointer;
}

.close:hover {
  color: var(--color-primary);
}

.cart-info {
  margin-bottom: 20px;
  padding: 15px;
  background-color: var(--color-complementary);
  border-radius: 10px;
}

.cart-products {
  margin-bottom: 20px;
}

.cart-item {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 10px;
  border-bottom: 1px solid var(--color-secondary);
}

.cart-totals {
  background-color: var(--color-complementary);
  padding: 15px;
  border-radius: 10px;
  margin-bottom: 20px;
}

.btn-checkout {
  background-color: var(--color-primary);
  color: white;
  padding: 15px 30px;
  border: none;
  border-radius: 8px;
  cursor: pointer;
  width: 100%;
  font-size: 18px;
}

/* Delivery Styles */
.deliveries-container {
  max-width: 1000px;
  margin: 0 auto;
}

.deliveries-list {
  display: grid;
  gap: 20px;
  margin-bottom: 40px;
}

.delivery-card {
  background-color: var(--color-white);
  padding: 25px;
  border-radius: 15px;
  box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
  display: flex;
  justify-content: space-between;
  align-items: center;
}

.delivery-info h3 {
  color: var(--color-primary);
  margin-bottom: 10px;
}

.delivery-info p {
  margin-bottom: 5px;
}

.btn-accept {
  background-color: var(--color-success);
  color: white;
  padding: 12px 25px;
  border: none;
  border-radius: 8px;
  cursor: pointer;
  font-size: 16px;
}

.btn-accept:hover {
  background-color: #218838;
}

.btn-delivered {
  background-color: var(--color-primary);
  color: white;
  padding: 12px 25px;
  border: none;
  border-radius: 8px;
  cursor: pointer;
  font-size: 16px;
}

/* Gallery */
.gallery {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
  gap: 20px;
}

.gallery-item {
  border: 3px solid var(--color-complementary);
  border-radius: 10px;
  overflow: hidden;
  transition: transform 0.3s ease;
}

.gallery-item:hover {
  transform: translateY(-5px);
}

.gallery-item img {
  width: 100%;
  height: 200px;
  object-fit: cover;
}

.button {
  display: inline-block;
  background-color: var(--color-primary);
  color: var(--color-white);
  padding: 10px 20px;
  border-radius: 5px;
  text-decoration: none;
  transition: background-color 0.3s ease;
}

.button:hover {
  background-color: var(--color-secondary);
}

/* Products */
.productos {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
  gap: 20px;
}

.product-card {
  border: 1px solid var(--color-secondary);
  border-radius: 10px;
  padding: 15px;
  text-align: center;
  transition: transform 0.3s ease;
  background-color: var(--color-white);
}

.product-card:hover {
  transform: translateY(-5px);
}

.product-image {
  width: 100%;
  height: 200px;
  object-fit: cover;
  border-radius: 5px;
  margin-bottom: 10px;
  transition: transform 0.3s ease;
}

.product-image:hover {
  transform: scale(1.1);
}

.add-to-cart {
  background-color: var(--color-primary);
  color: var(--color-white);
  border: none;
  padding: 10px 15px;
  border-radius: 5px;
  cursor: pointer;
  transition: background-color 0.3s ease;
}

.add-to-cart:hover {
  background-color: var(--color-secondary);
}

/* Footer */
footer {
  background-color: var(--color-primary);
  color: var(--color-white);
  padding: 20px;
  text-align: center;
  margin-top: 40px;
  border-radius: 10px;
}
.nav-footer-container {
  width: 100vw;
  margin-left: calc(-50vw + 50%);
  margin-right: calc(-50vw + 50%);
  display: flex;
  align-items: stretch;
}

.nav-footer-container nav {
  width: 50%;
  float: none;
  margin: 0;
  border-radius: 0;
}

.nav-footer-container footer {
  width: 50%;
  float: none;
  margin: 0;
  border-radius: 0;
}


/* Social Icons */
.social-icons {
  position: fixed;
  left: 20px;
  top: 50%;
  transform: translateY(-50%);
  z-index: 100;
}

.social-icons a {
  display: block;
  margin-bottom: 10px;
}

.social-icons i {
  font-size: 30px;
  color: var(--color-primary);
  transition: color 0.3s ease;
}

.social-icons i:hover {
  color: var(--color-secondary);
}

/* Responsive Design */
@media (max-width: 768px) {
  #navHamb {
    display: block;
  }

  #navMenu {
    display: none;
    flex-direction: column;
  }

  #navMenu.active {
    display: flex;
  }

  .gallery {
    grid-template-columns: 1fr;
  }

  .productos {
    grid-template-columns: 1fr;
  }

  .admin-menu {
    grid-template-columns: 1fr;
  }

  .form-row {
    grid-template-columns: 1fr;
  }

  .delivery-card {
    flex-direction: column;
    text-align: center;
    gap: 15px;
  }

  .section-header {
    flex-direction: column;
    gap: 15px;
    text-align: center;
  }

  .search-container {
    flex-direction: column;
    align-items: center;
  }

  .search-input {
    width: 100%;
    max-width: 300px;
  }
}

/* Animations */
@keyframes fadeIn {
  from {
    opacity: 0;
  }
  to {
    opacity: 1;
  }
}

.content,
.content-full {
  animation: fadeIn 1s ease-in-out;
}

/* Ranking de productos más vendidos */
.ranking-list {
  display: flex;
  flex-direction: column;
  gap: 15px;
  margin-top: 20px;
}

.ranking-item {
  display: flex;
  align-items: center;
  background-color: var(--color-white);
  padding: 20px;
  border-radius: 10px;
  box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
}

.ranking-position {
  display: flex;
  align-items: center;
  margin-right: 20px;
  min-width: 60px;
}

.position-number {
  font-size: 24px;
  font-weight: bold;
  color: var(--color-primary);
  margin-right: 10px;
}

.fa-crown.gold {
  color: #ffd700;
}
.fa-medal.silver {
  color: #c0c0c0;
}
.fa-medal.bronze {
  color: #cd7f32;
}

.product-thumbnail {
  width: 60px;
  height: 60px;
  object-fit: cover;
  border-radius: 8px;
  margin-right: 15px;
}

.product-details {
  flex: 1;
}

.sales-bar {
  width: 200px;
  height: 20px;
  background-color: #f0f0f0;
  border-radius: 10px;
  overflow: hidden;
  margin-left: 20px;
}

.bar-fill {
  height: 100%;
  background-color: var(--color-primary);
  transition: width 0.3s ease;
}

/* Estadísticas */
.stats-summary {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
  gap: 20px;
  margin-bottom: 30px;
}

.stat-card {
  background-color: var(--color-white);
  padding: 25px;
  border-radius: 15px;
  text-align: center;
  box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
}

.stat-card i {
  font-size: 2.5rem;
  color: var(--color-primary);
  margin-bottom: 10px;
}

.stat-number {
  font-size: 2rem;
  font-weight: bold;
  color: var(--color-primary);
  margin: 10px 0;
}

.stats-table {
  background-color: var(--color-white);
  border-radius: 15px;
  overflow: hidden;
  box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
  margin-bottom: 30px;
}

.chart-section,
.chart-container {
  background-color: var(--color-white);
  padding: 20px;
  border-radius: 15px;
  box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
}

/* Domicilios */
.filter-section {
  display: flex;
  gap: 20px;
  margin-bottom: 30px;
  flex-wrap: wrap;
}

.filter-group {
  display: flex;
  flex-direction: column;
  gap: 5px;
}

.filter-group label {
  font-weight: bold;
  color: var(--color-primary);
}

.filter-group select {
  padding: 8px 12px;
  border: 2px solid var(--color-secondary);
  border-radius: 5px;
}

.deliveries-grid {
  display: flex;
  flex-direction: column;
  gap: 20px;
}

.delivery-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 15px;
}

.status-badge {
  padding: 5px 15px;
  border-radius: 20px;
  font-size: 12px;
  font-weight: bold;
  text-transform: uppercase;
}

.status-badge.en_curso {
  background-color: var(--color-warning);
  color: #333;
}

.status-badge.entregado {
  background-color: var(--color-success);
  color: white;
}

.status-badge.cancelado {
  background-color: var(--color-danger);
  color: white;
}

.delivery-summary {
  background-color: var(--color-white);
  padding: 25px;
  border-radius: 15px;
  box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
  margin-top: 30px;
}

.summary-stats {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
  gap: 15px;
}

.summary-item {
  display: flex;
  justify-content: space-between;
  padding: 10px;
  border-bottom: 1px solid var(--color-secondary);
}

.summary-label {
  font-weight: bold;
}

.summary-value {
  color: var(--color-primary);
  font-weight: bold;
}

/* Reseñas */
.reviews-filter {
  display: flex;
  gap: 20px;
  margin-bottom: 30px;
  flex-wrap: wrap;
}

.reviews-stats {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  gap: 20px;
  margin-bottom: 30px;
}

.reviews-grid,
.approved-reviews-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
  gap: 20px;
  margin-top: 20px;
}

.review-card {
  background-color: var(--color-white);
  padding: 20px;
  border-radius: 15px;
  box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
}

.review-card.pending {
  border-left: 5px solid var(--color-warning);
}

.review-card.approved {
  border-left: 5px solid var(--color-success);
}

.review-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 15px;
}

.rating {
  display: flex;
  gap: 2px;
}

.rating .fa-star {
  color: #ddd;
}

.rating .fa-star.filled {
  color: #ffc107;
}

.review-date {
  font-size: 12px;
  color: #666;
}

.review-comment {
  font-style: italic;
  margin: 10px 0;
  padding: 10px;
  background-color: var(--color-complementary);
  border-radius: 8px;
}

.review-actions {
  display: flex;
  gap: 10px;
  margin-top: 15px;
}

.btn-approve {
  background-color: var(--color-success);
  color: white;
  padding: 8px 15px;
  border: none;
  border-radius: 5px;
  cursor: pointer;
}

.btn-reject,
.btn-unpublish {
  background-color: var(--color-danger);
  color: white;
  padding: 8px 15px;
  border: none;
  border-radius: 5px;
  cursor: pointer;
}

/* Pedidos */
.orders-filter {
  display: flex;
  gap: 20px;
  margin-bottom: 30px;
  align-items: end;
  flex-wrap: wrap;
}

.btn-refresh {
  background-color: var(--color-primary);
  color: white;
  padding: 8px 15px;
  border: none;
  border-radius: 5px;
  cursor: pointer;
}

.orders-summary {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
  gap: 20px;
  margin-bottom: 30px;
}

.summary-card {
  background-color: var(--color-white);
  padding: 20px;
  border-radius: 15px;
  text-align: center;
  box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
}

.summary-card.pending {
  border-top: 5px solid var(--color-warning);
}
.summary-card.preparing {
  border-top: 5px solid #17a2b8;
}
.summary-card.ready {
  border-top: 5px solid var(--color-success);
}
.summary-card.delivered {
  border-top: 5px solid var(--color-primary);
}

.summary-number {
  font-size: 2rem;
  font-weight: bold;
  color: var(--color-primary);
  margin: 10px 0;
}

.orders-grid {
  display: flex;
  flex-direction: column;
  gap: 20px;
}

.order-card {
  background-color: var(--color-white);
  padding: 25px;
  border-radius: 15px;
  box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
}

.order-card.pending {
  border-left: 5px solid var(--color-warning);
}
.order-card.preparing {
  border-left: 5px solid #17a2b8;
}
.order-card.ready {
  border-left: 5px solid var(--color-success);
}

.order-info {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 20px;
  margin: 15px 0;
}

.customer-info,
.products-info {
  padding: 15px;
  background-color: var(--color-complementary);
  border-radius: 8px;
}

.products-info ul {
  list-style: none;
  padding: 0;
  margin: 10px 0;
}

.products-info li {
  padding: 5px 0;
  border-bottom: 1px solid #ddd;
}

.order-total {
  margin-top: 10px;
  font-size: 1.1rem;
  color: var(--color-primary);
}

.order-actions {
  display: flex;
  gap: 10px;
  margin-top: 15px;
}

.btn-start,
.btn-ready,
.btn-deliver {
  background-color: var(--color-success);
  color: white;
  padding: 10px 15px;
  border: none;
  border-radius: 5px;
  cursor: pointer;
}

.btn-cancel {
  background-color: var(--color-danger);
  color: white;
  padding: 10px 15px;
  border: none;
  border-radius: 5px;
  cursor: pointer;
}

/* Responsive para las nuevas páginas */
@media (max-width: 768px) {
  .filter-section,
  .orders-filter,
  .reviews-filter {
    flex-direction: column;
  }

  .order-info {
    grid-template-columns: 1fr;
  }

  .reviews-grid,
  .approved-reviews-grid {
    grid-template-columns: 1fr;
  }

  .stats-summary,
  .orders-summary,
  .reviews-stats {
    grid-template-columns: 1fr;
  }
}

</style>
<body> 
    <div class="container-full">
        <header class="text-center">
            <a>
                <img src="../ASSETS/img/logo.png" class="logo" alt="Repostería Misves Logo">
            </a>
        </header>
        <nav>
            <div id="navHamb">
                <i class="fas fa-bars"></i>
            </div>
            <div id="navMenu">
                <a href="../VIEW/usuario/admin-usuarios.php"><i class="fas fa-users"></i>Usuario</a>
                <a href="../VIEW/producto/admin-producto.php"> <i class="fas fa-birthday-cake"></i>Productos</a>
                <a href="../VIEW/pedidos.php"><i class="fas fa-clipboard-list"></i>Pedidos</a>
                <a href="../VIEW/reseñas/admin-resenas.php"><i class="fas fa-star"></i>Reseñas</a>
                <a href="../VIEW/domicilio/admin-domicilios.php"><i class="fas fa-truck"></i> Domicilios</a>
                <a href="../VIEW/estadistica/admin-estadisticas.php"><i class="fas fa-chart-bar"></i>Estadísticas</a>
                <a href="../VIEW/mas vendidos/admin-mas-vendidos.php"><i class="fas fa-trophy"></i>Más Vendidos</a>
                <a href="../VIEW/perfil/admin-perfil.php"><i class="fas fa-user"></i> Perfil</a>
                <a href="../VIEW/Reportes.php"><i class="fas fa-file-alt"></i> Reportes</a>
                <a href="../VIEW/indexMisves.php"><i class="fas fa-home"></i> Salir</a>
            </div>
        </nav>
        
        <div class="content-full">
            <div class="section-header-centered">
                 <h1 class="title-centered">Gestión de Productos</h1>
            </div>
    <div class="search-container">
      <form method="GET" action="../VIEW/producto.php">
    <input type="hidden" name="p" value="producto">
    <input type="hidden" name="f" value="ConsultarPorID" >
    <input type="number" name="CodProducto" placeholder="Ingrese ID del producto" class="search-input" required>
    <button type="submit" class="btn-primary">Buscar</button>

    <button type="button" onclick="location.href='?p=producto&f=Editar'" class="btn-primary">
        <i class="fas fa-plus"></i> Agregar Producto
    </button>
    </form>

    </div>

            <div class="contenido" id="contenido1">
                <div class="users-table">
                    <table>
                        <thead>
                            <tr>
                                <th>Código</th>
                                <th>Nombre</th>
                                <th>Descripción</th>
                                <th>Precio</th>
                                <th>Imagen</th>
                                <th>Stock</th>
                                <th>Estado</th>
                                <th>IdReseña</th>
                                <th class="acciones">Acciones</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php foreach($productos as $producto): ?>
                            <tr>
                                <td><?php echo $producto->CodProducto; ?></td> 
                                <td><?php echo $producto->NombreProducto; ?></td> 
                                <td><?php echo $producto->DescripcionProducto; ?></td> 
                                <td><?php echo $producto->Precio; ?></td>
                                <td>
                                    <?php if (!empty($producto->ImagenProducto)): ?>
                                    <img src="data:image/jpeg;base64,<?= base64_encode($producto->ImagenProducto) ?>" 
                                    alt="Imagen del producto" 
                                    width="100" height="100" 
                                    style="object-fit: cover; border-radius: 10px;">
                                    <?php else: ?>
                                    <span class="text-muted">Sin imagen</span>
                                    <?php endif; ?>
                                </td>
                                <td><?php echo $producto->stock; ?></td>
                                <td><?php echo $producto->EstadoProducto; ?></td>
                                <td><?php echo $producto->idReseñaFK; ?></td>
                                <td>
                                    <div class="action-buttons">
                                        <a href="?p=producto&f=Editar&CodProducto=<?php echo $producto->CodProducto; ?>" class="btn-action btn-edit-new">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <a href="?p=producto&f=Eliminar&CodProducto=<?php echo $producto->CodProducto; ?>" class="btn-action btn-delete-new" onclick="return confirm('¿Está seguro de eliminar el producto?')">
                                            <i class="fas fa-trash-alt"></i> 
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        
        <footer class="text-center">
            <p>Derechos reservados Repostería Misves | 2025 | Bogotá</p>
        </footer>
    </div>

</body>
</html>