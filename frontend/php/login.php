<?php
session_start();
require_once "conexion_be.php";

$correo = $_POST['correo'];
$passw0rd = $_POST['passw0rd'];

try {
    // Preparar la consulta
    $query = "SELECT * FROM usuarios WHERE correo = :correo AND passw0rd = :passw0rd";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':correo', $correo);
    $stmt->bindParam(':passw0rd', $passw0rd);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $_SESSION['correo'] = $row['correo']; 
        $_SESSION['IdUsuario'] = $row['IdUsuario'];
        $_SESSION['tipo'] = $row['tipo'];

        $tipo = $row['tipo'];

        if ($tipo == 1) {
            echo '
            <script> 
                alert("Bienvenido!");
                window.location = "../dashboardSucursal.php";
            </script>
            ';
            exit();
        } else {
            echo '
            <script> 
                alert("Bienvenido!");
                window.location = "../dashboardUsuario.php";
            </script>
            ';
            exit();
        }
    } else {
        echo '
            <script> 
                alert("Credenciales de acceso inválidas");
                window.location = "../index.php";
            </script>
            ';
        exit();
    }
} catch (PDOException $e) {
    error_log("Error en login: " . $e->getMessage());
    echo '
        <script> 
            alert("Error del sistema. Intente más tarde.");
            window.location = "../index.php";
        </script>
    ';
    exit();
}
?>