<?php
// Include Composer's autoload file to use phpseclib classes
require 'vendor/autoload.php';

// Database connection
$servername = "localhost";  // Your DB server
$username = "root";         // Your DB username
$password = "Hafsa@2005";             // Your DB password
$dbname = "proyecto_db";  // Your DB name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get user inputs from the form if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $ip = $_POST['ip'];
    $usuario = 'usuario'; // Hardcoded as per your request
    $claveContent = $_POST['clave'];

    // Step 1: Check if the entry already exists in the database
    $sql = "SELECT * FROM datos WHERE ip = ? AND usuario = ? AND clave = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $ip, $usuario, $claveContent);
    $stmt->execute();
    $result = $stmt->get_result();

    // If the record doesn't exist, insert it
    if ($result->num_rows == 0) {
        // Step 2: Create the ruta based on existing logic
        $ruta = '/home/usuario/.ssh/clave';  // Default path
        $checkRuta = "SELECT * FROM datos WHERE ip = ? AND usuario = ?";
        $stmtCheck = $conn->prepare($checkRuta);
        $stmtCheck->bind_param("ss", $ip, $usuario);
        $stmtCheck->execute();
        $checkResult = $stmtCheck->get_result();
        if ($checkResult->num_rows > 0) {
            // If the path exists, increment it
            $count = 2;
            while ($checkResult->num_rows > 0) {
                $ruta = "/home/usuario/.ssh/clave" . $count;
                $stmtCheck->execute();
                $checkResult = $stmtCheck->get_result();
                $count++;
            }
        }

        // Step 3: Insert into the database
        $insertSql = "INSERT INTO datos (ip, usuario, clave, ruta) VALUES (?, ?, ?, ?)";
        $stmtInsert = $conn->prepare($insertSql);
        $stmtInsert->bind_param("ssss", $ip, $usuario, $claveContent, $ruta);
        if ($stmtInsert->execute()) {
            echo "Data successfully inserted into the database!";
        } else {
            echo "Error inserting data: " . $stmtInsert->error;
        }

        // Step 4: Now send the data (ip, usuario, ruta) to update.php for further processing
        // Prepare the data to pass to update.php
        $data = [
            'ip' => $ip,
            'usuario' => $usuario,
            'ruta' => $ruta,
        ];

        // Step 5: Connect to the remote server via SSH to create the file with the private key
        use phpseclib3\Net\SSH2;
        use phpseclib3\Crypt\PublicKeyLoader;

        // SSH Connection
        $ssh = new SSH2($ip);
        $privateKey = PublicKeyLoader::load(file_get_contents('/path/to/your/private/key'));

        if (!$ssh->login($usuario, $privateKey)) {
            echo 'SSH login failed';
            exit;
        }

        // Create the file on the remote server
        $ssh->exec("echo '$claveContent' > $ruta");

        echo "Private key successfully saved to the remote server!";

        // Step 6: Now redirect to update.php with the necessary data
        header("Location: update.php?ip=$ip&usuario=$usuario&ruta=$ruta");
        exit();
    } else {
        echo "Data already exists in the database.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Machine Data Entry</title>
</head>
<body>
    <h2>Enter Machine Information</h2>
    <form action="" method="POST">
        <label for="ip">IP Address:</label>
        <input type="text" id="ip" name="ip" required><br><br>

        <label for="clave">Private Key:</label>
        <textarea id="clave" name="clave" rows="6" cols="50" placeholder="Enter the private key here" required></textarea><br><br>

        <input type="submit" value="Submit">
    </form>
</body>
</html>
