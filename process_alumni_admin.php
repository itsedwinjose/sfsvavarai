<?php
session_start();

if (!isset($_SESSION['alumni_admin_logged_in']) || $_SESSION['alumni_admin_logged_in'] !== true) {
    die("Unauthorized Access.");
}

require_once 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = intval($_POST['id']);
    $action = $_POST['action'];

    if ($id <= 0 || !in_array($action, ['approve', 'reject'])) {
        header("Location: alumni_admin.php?msg=" . urlencode("Invalid request."));
        exit;
    }

    // Fetch the pending record
    $stmt = $pdo->prepare("SELECT * FROM alumni_requests WHERE id = :id AND status = 'pending'");
    $stmt->execute([':id' => $id]);
    $req = $stmt->fetch();

    if (!$req) {
        header("Location: alumni_admin.php?msg=" . urlencode("Request not found or already processed."));
        exit;
    }

    if ($action === 'approve') {
        // Prepare CSV payload format: Name,email,section
        $year = $req['passout_year'];
        $filepath = "assets/data/alumni/{$year}.csv";

        // Check if file exists. If not, maybe create and put headers
        $fileExists = file_exists($filepath);
        if (($handle = fopen($filepath, "a")) !== FALSE) {
            
            // If new file, create headers
            if (!$fileExists) {
                fputcsv($handle, ["Name", "email", "section"]);
            }

            fputcsv($handle, [
                $req['name'],
                $req['email'],
                $req['section']
            ]);
            fclose($handle);

            // Mark as approved DB
            $upd = $pdo->prepare("UPDATE alumni_requests SET status = 'approved' WHERE id = :id");
            $upd->execute([':id' => $id]);

            header("Location: alumni_admin.php?msg=" . urlencode("Registration approved and added to {$year}.csv!"));
            exit;

        } else {
            header("Location: alumni_admin.php?msg=" . urlencode("Error processing file check permissions on folder."));
            exit;
        }

    } elseif ($action === 'reject') {
        $upd = $pdo->prepare("UPDATE alumni_requests SET status = 'rejected' WHERE id = :id");
        $upd->execute([':id' => $id]);
        
        header("Location: alumni_admin.php?msg=" . urlencode("Registration rejected."));
        exit;
    }
}
?>
