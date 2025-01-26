<?php
session_start();
include("../connect.php");
if (!isset($_SESSION['loggedin']) || !isset($_SESSION['id'])) {
  header("Location: sign-in.php");
  exit();
}
$userid = $_SESSION['id'];
$query = "SELECT d.email, d.username, d.contact_number, u.first_name, u.last_name FROM users d JOIN user_details u
ON d.id = u.user_id WHERE u.id = '$userid'";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);
$userN = $row['username'];
$fN = $row['first_name'];
$lN = $row['last_name'];


$new = "SELECT t.transaction_id, t.transaction_date, t.total_bet_amount, 
                     td.event_name, td.bet_type, td.bet_amount, td.odds, td.potential_payout
              FROM transactions t
              JOIN transaction_details td ON t.transaction_id = td.transaction_id
              ORDER BY t.transaction_id DESC
              LIMIT 3";
$new_result = mysqli_query($conn, $new);

$old = "SELECT t.transaction_id, t.transaction_date, t.total_bet_amount, 
                     td.event_name, td.bet_type, td.bet_amount, td.odds, td.potential_payout
              FROM transactions t
              JOIN transaction_details td ON t.transaction_id = td.transaction_id
              ORDER BY t.transaction_date DESC
              LIMIT 3 OFFSET 3";


$old_result = mysqli_query($conn, $old);
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
  <!-- Nucleo Icons -->
  <link href="https://demos.creative-tim.com/soft-ui-dashboard/assets/css/nucleo-icons.css" rel="stylesheet" />
  <link href="https://demos.creative-tim.com/soft-ui-dashboard/assets/css/nucleo-svg.css" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <!-- CSS Files -->
  <link id="pagestyle" href="../assets/css/soft-ui-dashboard.css?v=1.1.0" rel="stylesheet" />
  <!-- Nepcha Analytics (nepcha.com) -->
  <!-- Nepcha is a easy-to-use web analytics. No cookies and fully compliant with GDPR, CCPA and PECR. -->
  <script defer data-site="YOUR_DOMAIN_HERE" src="https://api.nepcha.com/js/nepcha-analytics.js"></script>
</head>

<body class="g-sidenav-show  bg-gray-100">
  <?php
  include("dashboardnav_user.php");
  ?>
  <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
    <!-- Navbar -->
    <?php include('nav.php'); ?>
    <!-- End Navbar -->
    <div class="container-fluid py-4">
      <div class="row">
        <div class="col-lg-8">
          <div class="row">
            <div class="col-xl-6 mb-xl-0 mb-4">
              <div class="card bg-transparent shadow-xl">
                <div class="overflow-hidden position-relative border-radius-xl"
                  style="background-image: url('../assets/img/curved-images/curved14.jpg');">
                  <span class="mask bg-gradient-dark"></span>
                  <div class="card-body position-relative z-index-1 p-3">
                    <i class="fas fa-wifi text-white p-2"></i>
                    <h5 class="text-white mt-4 mb-5 pb-2">
                      4562&nbsp;&nbsp;&nbsp;1122&nbsp;&nbsp;&nbsp;4594&nbsp;&nbsp;&nbsp;7852</h5>
                    <div class="d-flex">
                      <div class="d-flex">
                        <div class="me-4">
                          <p class="text-white text-sm opacity-8 mb-0">Card Holder</p>
                          <h6 class="text-white mb-0"><?php echo $fN . ' ' . $lN ?></h6>
                        </div>
                        <div>
                          <p class="text-white text-sm opacity-8 mb-0">Expires</p>
                          <h6 class="text-white mb-0">11/22</h6>
                        </div>
                      </div>
                      <div class="ms-auto w-20 d-flex align-items-end justify-content-end">
                        <img class="w-60 mt-2" src="../assets/img/logos/mastercard.png" alt="logo">
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-xl-6">
              <div class="row">
                <div class="col-md-6">
                  <div class="card">
                    <div class="card-header mx-4 p-3 text-center">
                      <div class="icon icon-shape icon-lg bg-primary shadow text-center border-radius-lg">
                        <i class="fas fa-landmark opacity-10"></i>
                      </div>
                    </div>
                    <div class="card-body pt-0 p-3 text-center">
                      <h6 class="text-center mb-0">Salary</h6>
                      <span class="text-xs">Belong Interactive</span>
                      <hr class="horizontal dark my-3">
                      <h5 class="mb-0">+$2000</h5>
                    </div>
                  </div>
                </div>
                <div class="col-md-6 mt-md-0 mt-4">
                  <div class="card">
                    <div class="card-header mx-4 p-3 text-center">
                      <div class="icon icon-shape icon-lg bg-primary shadow text-center border-radius-lg">
                        <i class="fab fa-paypal opacity-10"></i>
                      </div>
                    </div>
                    <div class="card-body pt-0 p-3 text-center">
                      <h6 class="text-center mb-0">Paypal</h6>
                      <span class="text-xs">Freelance Payment</span>
                      <hr class="horizontal dark my-3">
                      <h5 class="mb-0">$455.00</h5>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-12 mb-lg-0 mb-4">
              <div class="card mt-4">
                <div class="card-header pb-0 p-3">
                  <div class="row">
                    <div class="col-6 d-flex align-items-center">
                      <h6 class="mb-0">Payment Method</h6>
                    </div>
                    <div class="col-6 text-end">
                      <a class="btn bg-gradient-dark mb-0" href="javascript:;"><i
                          class="fas fa-plus"></i>&nbsp;&nbsp;Add New Card</a>
                    </div>
                  </div>
                </div>
                <div class="card-body p-3">
                  <div class="row">
                    <div class="col-md-6 mb-md-0 mb-4">
                      <div class="card card-body border card-plain border-radius-lg d-flex align-items-center flex-row">
                        <img class="w-10 me-3 mb-0" src="../assets/img/logos/mastercard.png" alt="logo">
                        <h6 class="mb-0">****&nbsp;&nbsp;&nbsp;****&nbsp;&nbsp;&nbsp;****&nbsp;&nbsp;&nbsp;7852</h6>
                        <i class="fas fa-pencil-alt ms-auto text-dark cursor-pointer" data-bs-toggle="tooltip"
                          data-bs-placement="top" title="Edit Card"></i>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="card card-body border card-plain border-radius-lg d-flex align-items-center flex-row">
                        <img class="w-10 me-3 mb-0" src="../assets/img/logos/visa.png" alt="logo">
                        <h6 class="mb-0">****&nbsp;&nbsp;&nbsp;****&nbsp;&nbsp;&nbsp;****&nbsp;&nbsp;&nbsp;5248</h6>
                        <i class="fas fa-pencil-alt ms-auto text-dark cursor-pointer" data-bs-toggle="tooltip"
                          data-bs-placement="top" title="Edit Card"></i>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-4">
          <div class="card h-100">
            <div class="card-header pb-0 p-3">
              <div class="row">
                <div class="col-6 d-flex align-items-center">
                  <h6 class="mb-0">Invoices</h6>
                </div>
                <div class="col-6 text-end">
                  <button class="btn btn-outline-primary btn-sm mb-0">View All</button>
                </div>
              </div>
            </div>
            <div class="card-body p-3 pb-0">
              <?php
              $userid = $_SESSION['id'];
              $querys = "SELECT t.transaction_id, t.transaction_date, t.total_bet_amount, 
                      td.event_name, td.bet_type, td.bet_amount, td.odds, td.potential_payout
                      FROM transactions t
                      JOIN transaction_details td ON t.transaction_id = td.transaction_id 
                      WHERE t.user_id = '$userid'
                      ORDER BY t.transaction_id DESC LIMIT 5
                      ";

              $result = executeQuery($querys);
              while ($row = mysqli_fetch_array($result)) {
                $name = $row["event_name"];
                $date = $row['transaction_date'];
                $betType = $row['bet_type'];
                $betAmount = $row['bet_amount'];
                $odds = $row['odds'];
                $payout = $row['potential_payout'];
                ?>
                <ul class="list-group">
                  <li class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
                    <div class="d-flex flex-column">
                      <h6 class="mb-1 text-dark font-weight-bold text-sm">
                        <?php echo date("d M Y, h:i A", strtotime($date)); ?></h6>
                      <span class="text-xs"><?php echo $name ?></span>
                    </div>
                    <div class="d-flex align-items-center text-sm">
                      <?php echo $betAmount ?>
                      <button class="btn btn-link text-dark text-sm mb-0 px-0 ms-4"><i
                          class="fas fa-file-pdf text-lg me-1"></i> <?php echo $betType ?></button>
                    </div>
                  </li>
                <?php }
              ?>
              </ul>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-7 mt-4">
          <div class="card">
            <div class="card-header pb-0 px-3">
              <h6 class="mb-0">Billing Information</h6>
            </div>
            <div class="card-body pt-4 p-3">
              <ul id="transaction-list" class="list-group">
                <!-- Transactions will be dynamically loaded here -->
              </ul>
            </div>
            <nav aria-label="pagination daw">
              <ul id="pagination-links" class="pagination justify-content-center">
                <!-- Pagination links will be dynamically loaded here -->
              </ul>
            </nav>
          </div>
        </div>
        <div class="col-md-5 mt-4">
          <div class="card h-100 mb-4">
            <div class="card-header pb-0 px-3">
              <div class="row">
                <div class="col-md-6">
                  <h6 class="mb-0">Your Transaction's</h6>
                </div>
                <div class="col-md-6 d-flex justify-content-end align-items-center">
                  <i class="far fa-calendar-alt me-2"></i>
                  <?php
                  $date_query = "SELECT MIN(transaction_date) AS first_date, MAX(transaction_date) AS last_date FROM transactions";
                  $date_result = mysqli_query($conn, $date_query);
                  if ($row = mysqli_fetch_assoc($date_result)) {
                    $firstDate = date('d M Y', strtotime($row['first_date']));
                    $lastDate = date('d M Y', strtotime($row['last_date']));
                    ?>
                    <small><?php echo $firstDate . '-' . $lastDate; ?></small>
                  <?php } else {
                    echo '<small>No dates avaialable</small>';
                  } ?>
                </div>
              </div>
            </div>
            <div class="card-body pt-4 p-3">
              <h6 class="text-uppercase text-body text-xs font-weight-bolder mb-3">Newest</h6>
              <ul class="list-group">
                <?php
                while ($row = mysqli_fetch_array($new_result)) {
                  $name = $row["event_name"];
                  $date = $row['transaction_date'];
                  $betType = $row['bet_type'];
                  $betAmount = $row['bet_amount'];
                  $odds = $row['odds'];
                  $payout = $row['potential_payout'];

                  if ($betType === 'Win') {
                    $amount = $betAmount * $odds;
                    $colorClass = 'text-success';
                    $btnClass = 'btn-outline-success';
                    $displayAmount = '+ $' . number_format($amount, 2);
                  } else {
                    $amount = -$betAmount;
                    $colorClass = 'text-danger';
                    $btnClass = 'btn-outline-danger';
                    $displayAmount = '- $' . number_format(abs($amount), 2);
                  }
                  ?>
                  <li class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
                    <div class="d-flex align-items-center">
                      <button
                        class="btn btn-icon-only btn-rounded <?php echo $btnClass ?> mb-0 me-3 btn-sm d-flex align-items-center justify-content-center"><i
                          class="fas fa-arrow-down"></i></button>
                      <div class="d-flex flex-column">
                        <h6 class="mb-1 text-dark text-sm"><?php echo $name ?></h6>
                        <span class="text-xs"><?php echo date("d M Y, h:i A", strtotime($date)); ?></span>
                      </div>
                    </div>
                    <div
                      class="d-flex align-items-center <?php echo $colorClass ?> text-gradient text-sm font-weight-bold">
                      <?php echo $displayAmount ?>
                    </div>
                  </li>
                <?php }
                ?>
              </ul>
              <h6 class="text-uppercase text-body text-xs font-weight-bolder my-3">Oldest</h6>
              <ul class="list-group" id="viewtra">

              </ul>
              <div class="text-center ">
                <button class="btn btn-outline-primary btn-sm" id="viewAllBtn">View All</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    </div>
    <footer class="footer pt-3  ">
      <div class="container-fluid">
        <div class="row align-items-center justify-content-lg-between">
          <div class="col-lg-6 mb-lg-0 mb-4">
            <div class="copyright text-center text-sm text-muted text-lg-start">
              ©
              <script>
                document.write(new Date().getFullYear())
              </script>,
              made with <i class="fa fa-heart"></i> by
              <a href="https://www.creative-tim.com" class="font-weight-bold" target="_blank">Creative Tim</a>
              for a better web.
            </div>
          </div>
          <div class="col-lg-6">
            <ul class="nav nav-footer justify-content-center justify-content-lg-end">
              <li class="nav-item">
                <a href="https://www.creative-tim.com" class="nav-link text-muted" target="_blank">Creative Tim</a>
              </li>
              <li class="nav-item">
                <a href="https://www.creative-tim.com/presentation" class="nav-link text-muted" target="_blank">About
                  Us</a>
              </li>
              <li class="nav-item">
                <a href="https://www.creative-tim.com/blog" class="nav-link text-muted" target="_blank">Blog</a>
              </li>
              <li class="nav-item">
                <a href="https://www.creative-tim.com/license" class="nav-link pe-0 text-muted"
                  target="_blank">License</a>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </footer>
    </div>
  </main>
  <!--   Core JS Files   -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script>
    $(document).ready(function () {
      function loadTransactions(page = 1) {
        $.ajax({
          url: 'load_transactions.php',
          type: 'GET',
          data: { page: page },
          success: function (response) {
            const data = JSON.parse(response);
            $('#transaction-list').html(data.transactions); // Load transactions
            $('#pagination-links').html(data.pagination); // Load pagination
          }
        });
      }

      // Initial load
      loadTransactions();

      // Handle pagination clicks
      $(document).on('click', '.pagination-link', function (e) {
        e.preventDefault();
        const page = $(this).data('page');
        loadTransactions(page);
      });
    });
  </script>
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

  <script src="../assets/js/soft-ui-dashboard.min.js?v=1.1.0"></script>

  <script>
    let isAllTransactionsVisible = false;

    $(document).ready(function () {
      loadTransactions(0);


      $("#viewAllBtn").on("click", function () {
        if (isAllTransactionsVisible) {
          loadTransactions(0);
          $(this).text("View All");
        } else {
          loadTransactions(3);
          $(this).text("Hide");
        }
        isAllTransactionsVisible = !isAllTransactionsVisible;
      });
    });

    function loadTransactions(offset = 0) {
      $.ajax({
        url: 'view.php',
        method: 'GET',
        data: { offset: offset },
        success: function (response) {
          $('#viewtra').html(response);
        },
        error: function () {
          alert("Error loading transactions.");
        }
      });
    }

  </script>
</body>

</html>