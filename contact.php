<?php 
include("header.php");

$message_sent = false;
$error_message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $name = sanitize_input($_POST["name"]);
  $email = sanitize_input($_POST["email"]);
  $message = sanitize_input($_POST["message"]);
  
  if (empty($name) || empty($email) || empty($message)) {
    $error_message = "All fields are required.";
  } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $error_message = "Invalid email address.";
  } else {
    $to = "stfrancishrsecschoolvavarai@gmail.com";
    $subject = "New Contact Form Submission from " . $name;
    $body = "Name: " . $name . "\n";
    $body .= "Email: " . $email . "\n\n";
    $body .= "Message:\n" . $message;
    
    $headers = "From: " . $email . "\r\n";
    $headers .= "Reply-To: " . $email . "\r\n";
    
    if (mail($to, $subject, $body, $headers)) {
      $message_sent = true;
    } else {
      $error_message = "Failed to send message. Please try again later.";
    }
  }
}

function sanitize_input($data) {
  return htmlspecialchars(stripslashes(trim($data)));
}
?>

<section class="page-header-gradient text-center">
  <div class="container">
    <h1 class="fw-bold text-white">Contact Us</h1>
    <p>We'd love to hear from you. Reach out to us anytime.</p>
  </div>
</section>

<section class="py-5">
  <div class="container">
    <div class="row g-4">
      <div class="col-md-6">
        <h4 class="fw-bold text-primary"><i class="bi bi-geo-alt-fill me-2"></i>Contact Details</h4>
        <p><b>Address:</b> St. Francis Higher Secondary School, Vavarai, S. T. Mankad - 629172, Tamil Nadu, India</p>
        <p><b>Phone:</b> 04651 - 240495</p>
        <p><b>Email:</b> stfrancishrsecschoolvavarai@gmail.com</p>
      </div>

      <div class="col-md-6">
        <h4 class="fw-bold text-primary">Send Message</h4>
        
        <?php if ($message_sent): ?>
          <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Success!</strong> Your message has been sent successfully.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
        <?php endif; ?>
        
        <?php if (!empty($error_message)): ?>
          <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Error!</strong> <?php echo $error_message; ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
        <?php endif; ?>
        
        <form method="POST">
          <div class="mb-3">
            <label class="form-label">Name</label>
            <input type="text" name="name" class="form-control" placeholder="Enter your name" required>
          </div>
          <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" name="email" class="form-control" placeholder="Enter your email" required>
          </div>
          <div class="mb-3">
            <label class="form-label">Message</label>
            <textarea name="message" class="form-control" rows="4" placeholder="Enter message" required></textarea>
          </div>
          <button type="submit" class="btn btn-primary">Submit</button>
        </form>
      </div>
    </div>
  </div>
</section>

<?php include("footer.php"); ?>
