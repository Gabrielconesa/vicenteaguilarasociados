<?php
// Conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = ""; // Cambia esto si tienes contraseña
$dbname = "segunda_oportunidad";

$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Error en la conexión: " . $conn->connect_error);
}

// Recibir datos del formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = htmlspecialchars($_POST['nombre']);
    $email = htmlspecialchars($_POST['email']);
    $telefono = htmlspecialchars($_POST['telefono']);
    $comentarios = htmlspecialchars($_POST['comentarios']);

    // Validar campos obligatorios
    if (!empty($nombre) && !empty($email) && !empty($telefono)) {
        // Preparar la consulta
        $stmt = $conn->prepare("INSERT INTO registros (nombre, email, telefono, comentarios) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $nombre, $email, $telefono, $comentarios);

        // Ejecutar consulta
        if ($stmt->execute()) {
            echo "¡Registro guardado exitosamente!";
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Por favor, completa todos los campos obligatorios.";
    }
}

$conn->close();
?>
