<?php
require_once 'conexion_be.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $tipo = trim($_POST['TipoUsuario']);
    $tipo_id = ($tipo === 'Pertenezco a una empresa') ? 1 : 2;
    
    try {
        // Verificar que la contraseña no se repita en la base de datos
        $verificar_password = $pdo->prepare("SELECT * FROM usuarios WHERE passw0rd = ?");
        $verificar_password->execute([$_POST['passw0rd']]);
        
        if($verificar_password->rowCount() > 0){
            echo '
            <script>
                alert("Esta contraseña ya está en uso, intenta con otra diferente");
                window.location = "../index.php";
            </script>
            '; 
            exit();
        }
        $stmt = $pdo->prepare("INSERT INTO usuarios(nombre_usuario, correo, Telefono, passw0rd, tipo) 
                               VALUES (?, ?, ?, ?, ?)");

        
        $stmt->execute([
            $_POST['nombre_completo'],
            $_POST['correo'],
            $_POST['Telefono'],
            $_POST['passw0rd'],
            $tipo_id
        ]);
        
        echo '
            <script> 
                alert("Tu usuario ha sido registrado exitosamente");
                window.location ="../index.php";
            </script>
        ';
        exit();
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>