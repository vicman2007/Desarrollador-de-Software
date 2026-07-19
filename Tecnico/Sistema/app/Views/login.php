<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión - Repostería Misves</title>
    <link rel="stylesheet" href="../ASSETS/CSS/style login.css">
    <link rel="icon" type="image/x-icon" href="../ASSETS/img/icon.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/animejs/3.2.1/anime.min.js"></script>
</head>
<style>
    body {
    background: url(../ASSETS/img/bg.jpg) no-repeat center center fixed;
    background-size: cover;
    font-family: var(--font-main);
    color: var(--color-text);
    line-height: 1.6;
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
}
</style>
<body>
    <section class="auth-section">
        <div class="auth-container">
            <div class="auth-form">
                <form id="login-form" action="../CONTROLLER/ControladorSesion.php" method="POST">
                    <h2 class="auth-title">Iniciar Sesión</h2>

                    <div class="input-container">
                        <i class="fas fa-envelope"></i>
                        <input type="email" id="email" name=correo required>
                        <label for="email">Email</label>
                    </div>

                    <div class="input-container">
                        <i class="fas fa-lock"></i>
                        <input type="password" id="password" name=contrasena required>
                        <label for="password">Contraseña</label>
                    </div>

                    <div class="remember-forgot">
                        <label>
                            <input type="checkbox" id="remember"> Recordar
                        </label>
                        <a href="#" id="forgot-password">Olvidé la contraseña</a>
                    </div>

                   <button type="submit" class="auth-button">Acceder</button>

                    <div class="auth-link">
                        <p>¿No tienes cuenta? <a href="Crear.php">Crear una</a></p>
                    </div>
                </form>
            </div>
        </div>
    </section>
    
</body>
</html>