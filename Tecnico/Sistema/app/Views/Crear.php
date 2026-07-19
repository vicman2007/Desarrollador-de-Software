<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Cuenta - Repostería Misves</title>
    <link rel="stylesheet" href="../ASSETS/CSS/style login.css">
    <link rel="icon" type="image/x-icon" href="../ASSETS/img/icon.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/animejs/3.2.1/anime.min.js"></script>
</head>
<style>
        .content {
            height: auto;
            width: 1100px;
        }
        body {
            background: url(/ASSETS/img/bg.jpg);
            font-family: var(--font-main);
            color: var(--color-text);
            line-height: 1.6;
        }
    </style>
<body>
    <section class="auth-section">
        <div class="auth-container">
            <div class="auth-form">
                <form id="signup-form"> 
                    <h2 class="auth-title">Crear cuenta</h2>

                    <div class="input-container">
                        <i class="fas fa-user"></i>
                        <input type="text" id="username" required>
                        <label for="username">Usuario</label>
                    </div>
            
                    <div class="input-container">
                        <i class="fas fa-envelope"></i>
                        <input type="email" id="email" required>
                        <label for="email">Email</label>
                    </div>

                    <div class="input-container">
                        <i class="fas fa-map-marker-alt"></i>
                        <input type="nvarchar" id="nvarchar" required>
                        <label for="">Direccion</label>
                    </div>

                    <div class="input-container">
                        <i class="fas fa-phone"></i>
                        <input type="number" id="number" required>
                        <label for="number">telefono</label>
                    </div>
                    
                    <div class="input-container">
                        <i class="fas fa-at"></i>
                        <input type="text" id="username" required>
                        <label for="username">Nickname</label>
                    </div>

                    <div class="input-container">
                        <i class="fas fa-lock"></i>
                        <input type="password" id="password" required>
                        <label for="password">Contraseña</label>
                    </div>

                    

                    <button type="submit" class="auth-button">Crear Cuenta</button>

                    <div class="auth-link">
                        <p>¿Ya tienes una cuenta? <a href="../VIEW/login.php">Acceder</a></p>
                    </div>
                </form>
            </div>
        </div>
    </section>
</body>
</html>