<?php include("header.php"); ?>

<section class="py-5 bg-light text-center">
  <div class="container">
    <h1 class="fw-bold text-primary">Contact Us</h1>
    <p>Get in touch with us (dummy form).</p>
  </div>
</section>

<section class="py-5">
  <div class="container">
    <div class="row g-4">
      <div class="col-md-6">
        <h4 class="fw-bold text-primary">Contact Details</h4>
        <p><b>Address:</b> Dummy Address, Tamil Nadu</p>
        <p><b>Phone:</b> +91 00000000</p>
        <p><b>Email:</b> info@vavarai.com</p>
      </div>

      <div class="col-md-6">
        <h4 class="fw-bold text-primary">Send Message</h4>
        <form>
          <div class="mb-3">
            <label class="form-label">Name</label>
            <input type="text" class="form-control" placeholder="Enter your name">
          </div>
          <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" class="form-control" placeholder="Enter your email">
          </div>
          <div class="mb-3">
            <label class="form-label">Message</label>
            <textarea class="form-control" rows="4" placeholder="Enter message"></textarea>
          </div>
          <button class="btn btn-primary">Submit</button>
        </form>
      </div>
    </div>
  </div>
</section>

<?php include("footer.php"); ?>
