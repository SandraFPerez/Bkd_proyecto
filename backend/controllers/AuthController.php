<?php
// auth.php (nuevo controlador)

session_start(); // Iniciar sesión para guardar el estado del usuario

class AuthController {

    public function login($usuario, $password) {
        // Aquí deberías verificar las credenciales con la base de datos
        // Para este ejemplo, se usan credenciales predefinidas
        if ($usuario === 'admin' && $password === 'admin123') {
            // Guardar el usuario en la sesión
            $_SESSION['usuario'] = $usuario;
            return ['message' => 'Login exitoso', 'usuario' => $usuario];
        } else {
            return ['message' => 'Credenciales incorrectas'];
        }
    }

    public function logout() {
        // Eliminar la sesión del usuario
        session_destroy();
        return ['message' => 'Logout exitoso'];
    }
}
?>
