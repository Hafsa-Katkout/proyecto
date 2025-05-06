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
    background-image: url('/images/back_modificar_user_ansible.jpg'); /* Replace with your image path */
    background-size: cover;
    background-position: center;
    color: #fff;
    height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
    flex-direction: column;
}

/* Container styling */
.container {
    background: rgba(0, 0, 0, 0.7); /* Keeps the black background */
    padding: 80px; /* Increased padding to make the container larger */
    border-radius: 15px;
    width: 100%;
    max-width: 700px; /* Increased max-width for a larger container */
    text-align: center;
    margin-bottom: 20px;
    box-shadow: 0 0 40px rgba(0, 0, 0, 0.9); /* Increased shadow size and opacity for a larger and deeper effect */
}

/* Title styling */
h3 {
    margin-bottom: 30px;
    font-size: 28px;
    color: #87CEEB; /* Sky Blue color */
}

/* Form styling */
form {
    display: flex;
    flex-direction: column;
    gap: 20px; /* Add gap between form elements */
}

/* Label styling */
label {
    font-size: 18px;
    color: #fff; /* White color for labels */
}

/* Input field styling */
input[type="text"],
input[type="password"] {
    padding: 15px;
    margin-bottom: 25px;
    border: 1px solid #ddd;
    border-radius: 8px;
    font-size: 18px;
    background-color: #222; /* Darker background for input */
    color: #fff; /* White text inside input fields */
}

/* Button styling */
button.save-btn {
    background-color: #87CEEB; /* Sky Blue color for the button */
    color: #fff; /* White text */
    padding: 18px 30px; /* Larger padding for bigger button */
    font-size: 22px; /* Bigger font size */
    border: none;
    border-radius: 12px; /* More rounded corners */
    cursor: pointer;
    transition: background-color 0.3s, color 0.3s, transform 0.3s;
    margin-bottom: 25px; /* Space between buttons */
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.7); /* Increased shadow size for the button */
}

button.save-btn:hover {
    background-color: #4682B4; /* Darker Sky Blue color on hover */
    color: #fff; /* Ensure text stays white */
    transform: scale(1.1); /* Slight scale effect for the button */
}

/* Navigation buttons styling */
.nav-buttons {
    display: flex;
    justify-content: space-between; /* Space out buttons evenly */
    width: 100%;
    margin-top: 30px;
    gap: 20px; /* Adds space between the buttons */
}

.nav-buttons a {
    text-decoration: none;
    color: #000;
    background-color: #fff; /* White background for nav buttons */
    padding: 18px 30px; /* Larger padding for bigger buttons */
    border-radius: 12px; /* More rounded corners */
    font-size: 20px; /* Slightly bigger font size */
    transition: background-color 0.3s, color 0.3s, transform 0.3s;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.7); /* Increased shadow size for nav buttons */
}

.nav-buttons a:hover {
    background-color: #87CEEB; /* Sky Blue color */
    color: #fff; /* White text */
    transform: scale(1.1); /* Slight scale effect for nav buttons */
}

/* Responsive Design */
@media (max-width: 768px) {
    .container {
        width: 90%;
        padding: 30px; /* Reduce padding on small screens */
    }

    .nav-buttons {
        flex-direction: column;
        align-items: center;
        gap: 15px; /* Add vertical gap */
    }

    .nav-buttons a {
        margin-bottom: 15px;
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
                <button type="submit" class="save-btn">Guardar Cambios</button>
            </div>
        </form>

        <!-- Navigation buttons inside the container -->
        <div class="nav-buttons">
            <a href="index.php">Inicio</a>
            <a href="login.php">Iniciar Sesión</a>
            <a href="dashboard.php">Dashboard</a>
            <a href="usuarios_ansible.php">Volver</a>
        </div>
    </div>
</body>
</html>
