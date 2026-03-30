<?php
require_once 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $phone = trim($_POST['phone'] ?? '');
    $passout_year = trim($_POST['passout_year'] ?? '');
    $section = trim(strtoupper($_POST['section'] ?? ''));
    $profession = trim($_POST['profession'] ?? '');

    if (!empty($name) && !empty($phone) && !empty($passout_year) && !empty($section)) {
        
        $sql = "INSERT INTO alumni_requests (name, email, phone, passout_year, section, profession, status) 
                VALUES (:name, :email, :phone, :passout_year, :section, :profession, 'pending')";
        
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':name' => $name,
            ':email' => $email,
            ':phone' => $phone,
            ':passout_year' => $passout_year,
            ':section' => $section,
            ':profession' => $profession
        ]);
        
        // Redirect back with success message
        header("Location: alumni.php?success=1");
        exit;
    } else {
        die("Please fill out all required fields.");
    }
} else {
    header("Location: alumni.php");
    exit;
}
?>
