<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "lead_capture";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$name = $_POST['name'];
$email = $_POST['email'];


// Check if email already exists
$checkEmail = "SELECT email FROM leads WHERE email = '$email'";
$result = $conn->query($checkEmail);

if ($result->num_rows > 0) {
    $message = "❌This email is already registered! Try another one.";
} else {
    // Insert new lead
    $sql = "INSERT INTO leads (name, email) VALUES ('$name', '$email')";

    if ($conn->query($sql) === TRUE) {
        header("Location: thank_you.html");
        exit();
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Error</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <div class="alert alert-danger text-center" role="alert">
            <?php echo $message; ?>
        </div>
        <div class="text-center mt-3">
            <a href="index.html" class="btn btn-primary">Go Back</a>
        </div>
    </div>
</body>

</html>