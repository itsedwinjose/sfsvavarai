<?php 
include("header.php");

// Only scan for available year filenames (lightweight)
$dir = "assets/data/alumni";
$availableYears = [];

if (is_dir($dir)) {
    $files = scandir($dir);
    foreach ($files as $file) {
        if (pathinfo($file, PATHINFO_EXTENSION) === 'csv') {
            $availableYears[] = pathinfo($file, PATHINFO_FILENAME);
        }
    }
}

// Sort years descending (latest first)
rsort($availableYears, SORT_NUMERIC);
$yearsJson = json_encode($availableYears);
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

            <div class="mb-3">
              <label class="form-label fw-semibold">Profession</label>
              <input type="text" name="profession" class="form-control" placeholder="Eg: Engineer, Teacher, Doctor">
            </div>

            <button type="submit" class="btn btn-primary w-100 fw-bold">Submit Registration</button>
          </form>
        </div>
      </div>

    </div>
  </div>
</section>

<!-- Frontend Logic (AJAX-based on-demand loading) -->
<script>
document.addEventListener("DOMContentLoaded", function() {
    const years = <?php echo $yearsJson; ?>;
    const yearSelect = document.getElementById("filterYear");
    const sectionSelect = document.getElementById("filterSection");
    const tableBody = document.getElementById("alumniTableBody");

    // Cache fetched data to avoid re-fetching
    const cache = {};

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
        loadYearData(this.value);
    });

    // Handle Section Change
    sectionSelect.addEventListener("change", function() {
        renderTable(yearSelect.value, this.value);
    });

    // Initial Load - default to latest year (first in the sorted array)
    yearSelect.value = years[0];
    loadYearData(years[0]);

    function loadYearData(year) {
        // Show loading state
        sectionSelect.innerHTML = '<option value="">Loading...</option>';
        sectionSelect.disabled = true;
        tableBody.innerHTML = '<tr><td colspan="2" class="text-center text-muted"><div class="spinner-border spinner-border-sm text-primary me-2" role="status"></div>Loading alumni data...</td></tr>';

        // Return from cache if available
        if (cache[year]) {
            populateSections(year, cache[year]);
            return;
        }

        // AJAX call to fetch data for the selected year
        fetch("api_alumni.php?year=" + encodeURIComponent(year))
            .then(response => {
                if (!response.ok) throw new Error("Failed to load data.");
                return response.json();
            })
            .then(result => {
                if (result.error) {
                    tableBody.innerHTML = '<tr><td colspan="2" class="text-center text-danger">' + result.error + '</td></tr>';
                    sectionSelect.innerHTML = '<option value="">No Sections</option>';
                    sectionSelect.disabled = false;
                    return;
                }
                cache[year] = result.sections;
                populateSections(year, result.sections);
            })
            .catch(err => {
                tableBody.innerHTML = '<tr><td colspan="2" class="text-center text-danger">Error loading data. Please try again.</td></tr>';
                sectionSelect.innerHTML = '<option value="">Error</option>';
                sectionSelect.disabled = false;
                console.error(err);
            });
    }

    function populateSections(year, sections) {
        sectionSelect.innerHTML = "";
        sectionSelect.disabled = false;

        const sectionKeys = Object.keys(sections).sort();
        if (sectionKeys.length === 0) {
            sectionSelect.innerHTML = '<option value="">No Sections</option>';
            tableBody.innerHTML = '<tr><td colspan="2" class="text-center text-muted">No records found for this year.</td></tr>';
            return;
        }

        sectionKeys.forEach(sec => {
            let option = document.createElement("option");
            option.value = sec;
            option.textContent = "Section " + sec;
            sectionSelect.appendChild(option);
        });

        // Default select first section
        sectionSelect.value = sectionKeys[0];
        renderTable(year, sectionKeys[0]);
    }

    function renderTable(year, section) {
        tableBody.innerHTML = "";
        const sections = cache[year];

        if (!year || !section || !sections || !sections[section]) {
            tableBody.innerHTML = '<tr><td colspan="2" class="text-center text-muted">No records found.</td></tr>';
            return;
        }

        const students = sections[section];

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
