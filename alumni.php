<?php 
include("header.php");

// Prepare dynamic alumni data from CSVs
$dir = "assets/data/alumni";
$alumniData = []; 

if (is_dir($dir)) {
    $files = scandir($dir);
    foreach ($files as $file) {
        if (pathinfo($file, PATHINFO_EXTENSION) === 'csv') {
            $year = pathinfo($file, PATHINFO_FILENAME);
            $filepath = $dir . '/' . $file;
            
            if (($handle = fopen($filepath, "r")) !== FALSE) {
                // Get header and skip it
                $header = fgetcsv($handle, 1000, ",");
                
                while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                    if (count($data) < 3) continue;
                    $name = trim($data[0]);
                    $email = trim($data[1]);
                    $section = trim($data[2]);
                    
                    if (!empty($name) && !empty($section)) {
                        if (!isset($alumniData[$year])) {
                            $alumniData[$year] = [];
                        }
                        if (!isset($alumniData[$year][$section])) {
                            $alumniData[$year][$section] = [];
                        }
                        $alumniData[$year][$section][] = [
                            'name' => htmlspecialchars($name),
                            'email' => htmlspecialchars($email)
                        ];
                    }
                }
                fclose($handle);
            }
        }
    }
}

// Sort years descending
krsort($alumniData);
// Convert to JSON for the frontend
$alumniDataJson = json_encode($alumniData);
?>

<section class="page-header-gradient text-center">
  <div class="container">
    <h1 class="fw-bold text-white">Alumni Directory</h1>
    <p class="lead mb-0">Connect with past students of St. Francis Higher Secondary School.</p>
  </div>
</section>

<?php if (isset($_GET['success'])): ?>
<div class="container mt-4">
    <div class="alert alert-success alert-dismissible fade show text-center shadow-sm" role="alert">
        <strong>Success!</strong> Your alumni registration has been submitted and is pending admin approval.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
</div>
<?php endif; ?>

<section class="py-5">
  <div class="container">
    <div class="row g-4">
      
      <!-- List of Alumni -->
      <div class="col-md-7">
        <div class="card shadow-sm p-4 h-100 border-0">
          <h4 class="fw-bold text-primary mb-4">View Alumni</h4>
          
          <div class="row g-3 mb-4">
              <div class="col-md-6">
                <label class="form-label fw-semibold">Passout Year</label>
                <select id="filterYear" class="form-select"></select>
              </div>
              <div class="col-md-6">
                <label class="form-label fw-semibold">Section</label>
                <select id="filterSection" class="form-select"></select>
              </div>
          </div>

          <div class="table-responsive">
              <table class="table table-hover align-middle">
                  <thead class="table-dark">
                      <tr>
                          <th>Name</th>
                          <th>Email</th>
                      </tr>
                  </thead>
                  <tbody id="alumniTableBody">
                      <tr><td colspan="2" class="text-center text-muted">Select a year and section to view list.</td></tr>
                  </tbody>
              </table>
          </div>
        </div>
      </div>

      <!-- Register Form -->
      <div class="col-md-5">
        <div class="card shadow-sm p-4 h-100 border-0 bg-light">
          <h4 class="fw-bold text-primary mb-4">Register as Alumni</h4>
          <form action="register_alumni.php" method="POST">
            <div class="mb-3">
              <label class="form-label fw-semibold">Full Name *</label>
              <input type="text" name="name" class="form-control" placeholder="Enter name" required>
            </div>
            <div class="mb-3">
              <label class="form-label fw-semibold">Email Form</label>
              <input type="email" name="email" class="form-control" placeholder="Optional">
            </div>
            <div class="mb-3">
              <label class="form-label fw-semibold">Phone *</label>
              <input type="text" name="phone" class="form-control" placeholder="Enter phone" required>
            </div>
            
            <div class="row g-3 mb-3">
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Passout Year *</label>
                    <input type="text" name="passout_year" class="form-control" placeholder="Eg: 2022" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Section *</label>
                    <input type="text" name="section" class="form-control" placeholder="Eg: A" required>
                </div>
            </div>

            <button type="submit" class="btn btn-primary w-100 fw-bold">Submit Registration</button>
          </form>
        </div>
      </div>

    </div>
  </div>
</section>

<!-- Frontend Logic -->
<script>
document.addEventListener("DOMContentLoaded", function() {
    const data = <?php echo $alumniDataJson; ?>;
    const yearSelect = document.getElementById("filterYear");
    const sectionSelect = document.getElementById("filterSection");
    const tableBody = document.getElementById("alumniTableBody");

    const years = Object.keys(data).sort((a, b) => parseInt(b) - parseInt(a));
    
    if (years.length === 0) {
        yearSelect.innerHTML = '<option>No data available</option>';
        yearSelect.disabled = true;
        sectionSelect.disabled = true;
        return;
    }

    // Populate Year Dropdown
    years.forEach(year => {
        let option = document.createElement("option");
        option.value = year;
        option.textContent = year;
        yearSelect.appendChild(option);
    });

    // Handle Year Change
    yearSelect.addEventListener("change", function() {
        populateSections(this.value);
    });

    // Handle Section Change
    sectionSelect.addEventListener("change", function() {
        renderTable(yearSelect.value, this.value);
    });

    // Initial Load - default to max year (which is the first after krsort)
    yearSelect.value = years[0];
    populateSections(years[0]);

    function populateSections(year) {
        sectionSelect.innerHTML = "";
        if (!data[year]) return;
        
        const sections = Object.keys(data[year]).sort();
        if (sections.length === 0) {
            sectionSelect.innerHTML = '<option value="">No Sections</option>';
            renderTable(year, null);
            return;
        }

        sections.forEach(sec => {
            let option = document.createElement("option");
            option.value = sec;
            option.textContent = "Section " + sec;
            sectionSelect.appendChild(option);
        });

        // Default select first section
        sectionSelect.value = sections[0];
        renderTable(year, sections[0]);
    }

    function renderTable(year, section) {
        tableBody.innerHTML = "";
        
        if (!year || !section || !data[year] || !data[year][section]) {
            tableBody.innerHTML = '<tr><td colspan="2" class="text-center text-muted">No records found.</td></tr>';
            return;
        }

        const students = data[year][section];
        
        if (students.length === 0) {
             tableBody.innerHTML = '<tr><td colspan="2" class="text-center text-muted">No records found.</td></tr>';
             return;
        }

        students.forEach(student => {
            let tr = document.createElement("tr");
            let tdName = document.createElement("td");
            tdName.className = "fw-medium";
            tdName.textContent = student.name;
            
            let tdEmail = document.createElement("td");
            tdEmail.className = "text-muted";
            tdEmail.textContent = student.email ? student.email : "—";

            tr.appendChild(tdName);
            tr.appendChild(tdEmail);
            tableBody.appendChild(tr);
        });
    }
});
</script>

<?php include("footer.php"); ?>
