<?php
session_start();

// Hardcoded admin credentials
$admin_user = 'admin';
$admin_pass = 'admin123';

// Handle Login
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login'])) {
    if ($_POST['username'] === $admin_user && $_POST['password'] === $admin_pass) {
        $_SESSION['alumni_admin_logged_in'] = true;
        header("Location: alumni_admin.php");
        exit;
    } else {
        $login_error = "Invalid credentials!";
    }
}

// Handle Logout
if (isset($_GET['logout'])) {
    session_destroy();
    header("Location: alumni_admin.php");
    exit;
}

include("header.php");

// If not logged in, show login form
if (!isset($_SESSION['alumni_admin_logged_in']) || $_SESSION['alumni_admin_logged_in'] !== true):
?>
<section class="page-header-gradient text-center">
  <div class="container">
    <h1 class="fw-bold text-white">Admin Login</h1>
  </div>
</section>

<section class="py-5">
  <div class="container d-flex justify-content-center">
    <div class="card border-0 shadow-sm p-4 text-center" style="max-width: 400px; width: 100%;">
      <h4 class="mb-4">Please Sign In</h4>
      
      <?php if (isset($login_error)): ?>
        <div class="alert alert-danger p-2"><?php echo $login_error; ?></div>
      <?php endif; ?>

      <form method="POST">
        <div class="mb-3 text-start">
          <label class="form-label fw-bold">Username</label>
          <input type="text" name="username" class="form-control" required autofocus>
        </div>
        <div class="mb-3 text-start">
          <label class="form-label fw-bold">Password</label>
          <input type="password" name="password" class="form-control" required>
        </div>
        <button type="submit" name="login" class="btn btn-primary w-100 fw-bold">Login</button>
      </form>
    </div>
  </div>
</section>

<?php 
include("footer.php");
exit; 
endif;

// --- AUTHORIZED ADMIN DASHBOARD ---
require_once 'db.php';

// Fetch pending requests
$stmt = $pdo->query("SELECT * FROM alumni_requests WHERE status = 'pending' ORDER BY created_at ASC");
$requests = $stmt->fetchAll();
?>

<section class="page-header-gradient text-center">
  <div class="container position-relative">
    <h1 class="fw-bold text-white">Admin: Review Registrations</h1>
    <p class="lead mb-0">Approve or reject pending alumni requests.</p>
    <a href="?logout=1" class="btn btn-outline-danger position-absolute top-50 end-0 translate-middle-y me-3">Logout</a>
  </div>
</section>

<?php if (isset($_GET['msg'])): ?>
<div class="container mt-4">
    <div class="alert alert-info alert-dismissible fade show text-center shadow-sm" role="alert">
        <?php echo htmlspecialchars($_GET['msg']); ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
</div>
<?php endif; ?>

<section class="py-5">
  <div class="container">
    <div class="card border-0 shadow-sm p-4">

      <?php if (count($requests) > 0): ?>
      <div class="table-responsive">
          <table class="table table-hover align-middle mb-0">
               <thead class="table-dark">
                  <tr>
                      <th>ID</th>
                      <th>Name</th>
                      <th>Email</th>
                      <th>Phone</th>
                      <th>Profession</th>
                      <th>Passout Year</th>
                      <th>Section</th>
                      <th>Applied At</th>
                      <th class="text-center">Action</th>
                  </tr>
              </thead>
              <tbody>
                  <?php foreach ($requests as $req): ?>
                  <tr>
                      <td>#<?php echo $req['id']; ?></td>
                      <td class="fw-semibold"><?php echo htmlspecialchars($req['name']); ?></td>
                      <td><?php echo htmlspecialchars($req['email'] ? $req['email'] : '—'); ?></td>
                      <td><?php echo htmlspecialchars($req['phone']); ?></td>
                      <td class="text-muted"><?php echo htmlspecialchars($req['profession'] ? $req['profession'] : '—'); ?></td>
                      <td><span class="badge bg-primary fs-6"><?php echo htmlspecialchars($req['passout_year']); ?></span></td>
                      <td>Section <?php echo htmlspecialchars($req['section']); ?></td>
                      <td class="text-muted small"><?php echo $req['created_at']; ?></td>
                      <td class="text-center">
                          <form action="process_alumni_admin.php" method="POST" class="d-inline">
                              <input type="hidden" name="id" value="<?php echo $req['id']; ?>">
                              <input type="hidden" name="action" value="approve">
                              <button type="submit" class="btn btn-sm btn-success fw-bold"><i class="bi bi-check-circle"></i> Approve</button>
                          </form>
                          <form action="process_alumni_admin.php" method="POST" class="d-inline" onsubmit="return confirm('Reject this registration?');">
                              <input type="hidden" name="id" value="<?php echo $req['id']; ?>">
                              <input type="hidden" name="action" value="reject">
                              <button type="submit" class="btn btn-sm btn-danger fw-bold"><i class="bi bi-x-circle"></i> Reject</button>
                          </form>
                      </td>
                  </tr>
                  <?php endforeach; ?>
              </tbody>
          </table>
      </div>
      <?php else: ?>
      <div class="text-center py-5">
          <i class="bi bi-inbox fs-1 text-muted"></i>
          <h4 class="mt-3">No Pending Requests</h4>
          <p class="text-muted">All caught up! There are currently no alumni registrations awaiting approval.</p>
      </div>
      <?php endif; ?>

    </div>
  </div>
</section>

<?php include("footer.php"); ?>
