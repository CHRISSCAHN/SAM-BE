<?php
session_start();
include("../connect.php");
if (!isset($_SESSION['loggedin']) || !isset($_SESSION['user_id'])) {
  header("Location: sign-in.php");
  exit();
}
$userid = $_SESSION['id'];

$query = "SELECT d.email, d.username, d.contact_number FROM users d JOIN user_details u
ON d.id = u.user_id WHERE u.id = '$userid'";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);
$userN = $row['username'];

$results_per_page = 5;


$page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
$page = max($page, 1);


$start_from = ($page - 1) * $results_per_page;


$query = "SELECT c.name,c.flag, m.gold, m.silver, m.bronze, m.country_id 
          FROM country c 
          JOIN medal m ON c.id = m.country_id 
          ORDER BY m.gold DESC 
          LIMIT $start_from, $results_per_page";
$result = mysqli_query($conn, $query);


$count_query = "SELECT COUNT(*) AS total FROM country c JOIN medal m ON c.id = m.country_id";
$count_result = mysqli_query($conn, $count_query);
$row = mysqli_fetch_assoc($count_result);
$total_results = $row['total'];
$total_pages = ceil($total_results / $results_per_page);



?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="../assets/img/chanlogs.png">
  <title>
    Olympics Blog
  </title>
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700,800" rel="stylesheet" />
  <!-- Add Font Awesome CDN -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
  <!-- Font Awesome Icons -->

  <!-- CSS Files -->
  <link id="pagestyle" href="../assets/css/soft-ui-dashboard.css?v=1.1.0" rel="stylesheet" />
  <script defer data-site="YOUR_DOMAIN_HERE" src="https://api.nepcha.com/js/nepcha-analytics.js"></script>
</head>

<body class="g-sidenav-show  bg-gray-100">
  <?php include('dashboardnav_user.php'); ?>
  <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
    <!-- Navbar -->
    <?php include('nav.php'); ?>
    <!-- End Navbar -->
    <div class="container-fluid py-4">
      <div class="row">
        <div class="col-12">
          <div class="card mb-4">
            <div class="card-header pb-0">
              <h6>Overall Ranking</h6>
            </div>
            <div class="card-body px-0 pt-0 pb-2">
              <div class="table-responsive p-0">
                <table class="table align-items-center mb-0">
                  <thead>
                    <tr>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Country</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Gold</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Silver
                      </th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Bronze
                      </th>
                      <th class="text-secondary opacity-7"></th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $position = ($page - 1) * $results_per_page + 1;

                    $rows = [];
                    while ($row = mysqli_fetch_assoc($result)) {
                      $rows[] = $row;
                    }

                    usort($rows, function ($a, $b) {
                      return $b['gold'] - $a['gold'];
                    });

                    foreach ($rows as $row) {
                      $gold = $row["gold"];
                      $name = $row["name"];
                      $silver = $row["silver"];
                      $bronze = $row["bronze"];
                      $flag = $row["flag"];
                      $country_id = $row["country_id"];

                      if ($position == 1) {
                        $suffix = "st";
                      } elseif ($position == 2) {
                        $suffix = "nd";
                      } elseif ($position == 3) {
                        $suffix = "rd";
                      } else {
                        $suffix = "th";
                      }

                      $place = $position . $suffix . " " . 'place';
                      ?>
                      <tr>
                        <td>
                          <div class="d-flex px-2 py-1">
                            <div>
                              <img src="<?php echo $flag ?>" class="avatar avatar-sm me-3" alt="user1">
                            </div>
                            <div class="d-flex flex-column justify-content-center">
                              <h6 class="mb-0 text-sm"><?php echo $name ?></h6>
                              <p class="text-xs text-secondary mb-0"><?php echo $place ?></p>
                            </div>
                          </div>
                        </td>
                        <td>
                          <div class="d-flex align-items-center">
                        
                            <span class="badge badge-sm mx-2"
                              style="background: linear-gradient(90deg, #FFD700, #FFA700); color: white;">
                              <?php echo $gold ?>
                            </span>
                
                          </div>
                        </td>
                        <td class="align-middle text-center text-sm">
                          <div class="d-flex align-items-center justify-content-center">
                           
                            <span class="badge badge-sm mx-2"
                              style="background: linear-gradient(90deg, #C0C0C0, #A9A9A9); color: white;">
                              <?php echo $silver ?>
                            </span>
                          
                          </div>
                        </td>
                        <td class="align-middle text-center">
                          <div class="d-flex align-items-center justify-content-center">
                            
                            <span class="badge badge-sm mx-2"
                              style="background: linear-gradient(90deg, #CD7F32, #A0522D); color: white;">
                              <?php echo $bronze ?>
                            </span>
                        
                          </div>
                        </td>
                      </tr>
                      <?php
                      $position++;
                    }
                    ?>
                  </tbody>



                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
      <nav aria-label="pagiantion daw">
        <ul class="pagination justify-content-center">
          <!-- Previous Button -->
          <li class="page-item <?php echo ($page <= 1) ? 'disabled' : ''; ?>">
            <a class="page-link" href="?page=<?php echo $page - 1; ?>" aria-label="Previous">
              <span aria-hidden="true">&laquo;</span>
            </a>
          </li>

          <!-- Page Numbers -->
          <?php for ($i = 1; $i <= $total_pages; $i++): ?>
            <li class="page-item <?php echo ($i == $page) ? 'active' : ''; ?>">
              <a class="page-link" href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
            </li>
          <?php endfor; ?>

          <!-- Next Button -->
          <li class="page-item <?php echo ($page >= $total_pages) ? 'disabled' : ''; ?>">
            <a class="page-link" href="?page=<?php echo $page + 1; ?>" aria-label="Next">
              <span aria-hidden="true">&raquo;</span>
            </a>
          </li>
        </ul>
      </nav>

      <?php
      include('footer.php');
      ?>
    </div>
  </main>
  <script>
    function updateMedal(countryId, medalType, increment) {
      const xhr = new XMLHttpRequest();
      xhr.open("POST", "update_medal.php", true);
      xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
      xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
          location.reload(); // Reload the page to update the values
        }
      };
      xhr.send(`country_id=${countryId}&medal_type=${medalType}&increment=${increment}`);
    }
    
  </script>

  <!--   Core JS Files   -->
  <script src="../assets/js/core/popper.min.js"></script>
  <script src="../assets/js/core/bootstrap.min.js"></script>
  <script src="../assets/js/plugins/perfect-scrollbar.min.js"></script>
  <script src="../assets/js/plugins/smooth-scrollbar.min.js"></script>
  <script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
      var options = {
        damping: '0.5'
      }
      Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
  </script>
  <!-- Github buttons -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="../assets/js/soft-ui-dashboard.min.js?v=1.1.0"></script>
</body>

</html>