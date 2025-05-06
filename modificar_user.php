<?php
// Database connection
$host = 'localhost';
$user = 'root';
$pass = 'Hafsa@2005';
$db = 'proyecto_db';
$conn = new mysqli($host, $user, $pass, $db);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the user ID is passed
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    // Fetch the user details from the database
    $query = "SELECT * FROM usuarios_ansible WHERE id = $id";
    $result = $conn->query($query);
    $user = $result->fetch_assoc();

    if (!$user) {
        echo "User not found.";
        exit;
    }
} else {
    echo "User ID not specified.";
    exit;
}

// Check if form is submitted to update user
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'];
    $contraseña = $_POST['contraseña'];
    
    // Update user in the database
    $update_query = "UPDATE usuarios_ansible SET nombre = '$nombre', contraseña = '$contraseña' WHERE id = $id";
    if ($conn->query($update_query) === TRUE) {
        header("Location: usuarios_ansible.php");  // Redirect to the main page after save
        exit();
    } else {
        echo "Error updating record: " . $conn->error;
    }
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modificar Usuario</title>
    <style>
        /* Basic reset */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        /* Set background image */
        body {
            font-family: 'Arial', sans-serif;
            background-image: url('https://www.example.com/your-background-image.jpg'); /* Replace with your image path */
            background-size: cover;
            background-position: center;
            color: #fff;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .container {
            background: rgba(0, 0, 0, 0.6);
            padding: 30px;
            border-radius: 10px;
            width: 100%;
            max-width: 500px;
            text-align: center;
        }

        h3 {
            margin-bottom: 20px;
            font-size: 24px;
            color: #ffcc00; /* Yellow color */
        }

        form {
            display: flex;
            flex-direction: column;
        }

        label {
            margin-bottom: 8px;
            font-size: 16px;
        }

        input[type="text"],
        input[type="password"] {
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
        }

        button {
            background-color: #ffcc00; /* Yellow color */
            color: #000;
            padding: 12px;
            font-size: 18px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #e6b800; /* Slightly darker yellow */
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .container {
                width: 90%;
                padding: 20px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h3>Modificar Usuario</h3>
        <form action="modificar_user.php?id=<?php echo $id; ?>" method="POST">
            <div>
                <label for="nombre">Nombre:</label>
                <input type="text" id="nombre" name="nombre" value="<?php echo htmlspecialchars($user['nombre']); ?>" required>
            </div>
            <div>
                <label for="contraseña">Contraseña:</label>
                <input type="password" id="contraseña" name="contraseña" value="<?php echo htmlspecialchars($user['contraseña']); ?>" required>
            </div>
            <div>
                <button type="submit">Guardar Cambios</button>
            </div>
        </form>
    </div>
</body>
</html>
