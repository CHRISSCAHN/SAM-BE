<?php
session_start();
include("../connect.php");
if (!isset($_SESSION['loggedin']) || !isset($_SESSION['user_id'])) {
  header("Location: ../admin/sign-in.php");
  exit();
}

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
  <!-- CSS Files -->
  <link id="pagestyle" href="../assets/css/soft-ui-dashboard.css?v=1.1.0" rel="stylesheet" />
  <!-- Add Font Awesome CDN -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
</head>

<body class="g-sidenav-show  bg-gray-100">
  <?php
  include("dashboardnav.php");
  ?>
  <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
    <!-- Navbar -->
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur"
      navbar-scroll="true">
      <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
            <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Pages</a></li>
            <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Billing</li>
          </ol>
          <h6 class="font-weight-bolder mb-0">Billing</h6>
        </nav>
        <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
          <div class="ms-md-auto pe-md-3 d-flex align-items-center">
            <div class="input-group">
              <span class="input-group-text text-body"><i class="fas fa-search" aria-hidden="true"></i></span>
              <input type="text" class="form-control" placeholder="Type here...">
            </div>
          </div>
          <ul class="navbar-nav  justify-content-end">
            <li class="nav-item d-flex align-items-center">
              <a class="btn btn-outline-primary btn-sm mb-0 me-3" target="_blank"
              href="../index.html">User login</a>
            </li>
            <li class="nav-item d-flex align-items-center">
              <a href="javascript:;" class="nav-link text-body font-weight-bold px-0">
                <i class="fa fa-user me-sm-1"></i>
                <span class="d-sm-inline d-none">Admin</span>
              </a>
            </li>
            <li class="nav-item d-xl-none ps-3 d-flex align-items-center">
              <a href="javascript:;" class="nav-link text-body p-0" id="iconNavbarSidenav">
                <div class="sidenav-toggler-inner">
                  <i class="sidenav-toggler-line"></i>
                  <i class="sidenav-toggler-line"></i>
                  <i class="sidenav-toggler-line"></i>
                </div>
              </a>
            </li>
            <li class="nav-item px-3 d-flex align-items-center">
              <a href="javascript:;" class="nav-link text-body p-0">
                <i class="fa fa-cog fixed-plugin-button-nav cursor-pointer"></i>
              </a>
            </li>
            <li class="nav-item dropdown pe-2 d-flex align-items-center">
              <a href="javascript:;" class="nav-link text-body p-0" id="dropdownMenuButton" data-bs-toggle="dropdown"
                aria-expanded="false">
                <i class="fa fa-bell cursor-pointer"></i>
              </a>
              <ul class="dropdown-menu  dropdown-menu-end  px-2 py-3 me-sm-n4" aria-labelledby="dropdownMenuButton">
                <li class="mb-2">
                  <a class="dropdown-item border-radius-md" href="javascript:;">
                    <div class="d-flex py-1">
                      <div class="my-auto">
                        <img src="../assets/img/team-2.jpg" class="avatar avatar-sm  me-3 ">
                      </div>
                      <div class="d-flex flex-column justify-content-center">
                        <h6 class="text-sm font-weight-normal mb-1">
                          <span class="font-weight-bold">New message</span> from Laur
                        </h6>
                        <p class="text-xs text-secondary mb-0 ">
                          <i class="fa fa-clock me-1"></i>
                          13 minutes ago
                        </p>
                      </div>
                    </div>
                  </a>
                </li>
                <li class="mb-2">
                  <a class="dropdown-item border-radius-md" href="javascript:;">
                    <div class="d-flex py-1">
                      <div class="my-auto">
                        <img src="../assets/img/small-logos/logo-spotify.svg"
                          class="avatar avatar-sm bg-gradient-dark  me-3 ">
                      </div>
                      <div class="d-flex flex-column justify-content-center">
                        <h6 class="text-sm font-weight-normal mb-1">
                          <span class="font-weight-bold">New album</span> by Travis Scott
                        </h6>
                        <p class="text-xs text-secondary mb-0 ">
                          <i class="fa fa-clock me-1"></i>
                          1 day
                        </p>
                      </div>
                    </div>
                  </a>
                </li>
                <li>
                  <a class="dropdown-item border-radius-md" href="javascript:;">
                    <div class="d-flex py-1">
                      <div class="avatar avatar-sm bg-gradient-secondary  me-3  my-auto">
                        <svg width="12px" height="12px" viewBox="0 0 43 36" version="1.1"
                          xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                          <title>credit-card</title>
                          <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <g transform="translate(-2169.000000, -745.000000)" fill="#FFFFFF" fill-rule="nonzero">
                              <g transform="translate(1716.000000, 291.000000)">
                                <g transform="translate(453.000000, 454.000000)">
                                  <path class="color-background"
                                    d="M43,10.7482083 L43,3.58333333 C43,1.60354167 41.3964583,0 39.4166667,0 L3.58333333,0 C1.60354167,0 0,1.60354167 0,3.58333333 L0,10.7482083 L43,10.7482083 Z"
                                    opacity="0.593633743"></path>
                                  <path class="color-background"
                                    d="M0,16.125 L0,32.25 C0,34.2297917 1.60354167,35.8333333 3.58333333,35.8333333 L39.4166667,35.8333333 C41.3964583,35.8333333 43,34.2297917 43,32.25 L43,16.125 L0,16.125 Z M19.7083333,26.875 L7.16666667,26.875 L7.16666667,23.2916667 L19.7083333,23.2916667 L19.7083333,26.875 Z M35.8333333,26.875 L28.6666667,26.875 L28.6666667,23.2916667 L35.8333333,23.2916667 L35.8333333,26.875 Z">
                                  </path>
                                </g>
                              </g>
                            </g>
                          </g>
                        </svg>
                      </div>
                      <div class="d-flex flex-column justify-content-center">
                        <h6 class="text-sm font-weight-normal mb-1">
                          Payment successfully completed
                        </h6>
                        <p class="text-xs text-secondary mb-0 ">
                          <i class="fa fa-clock me-1"></i>
                          2 days
                        </p>
                      </div>
                    </div>
                  </a>
                </li>
              </ul>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <!-- End Navbar -->
    <div class="container-fluid ">
      <div class="row">
        <div class="col-md-7 mt-4">
          <div class="card">
            <div class="card-header pb-0 px-3">
              <h6 class="mb-0">Billing Information</h6>
            </div>
            <div class="card-body pt-4 p-3">
              <ul id="transaction-list" class="list-group">
                <!-- ajax to -->
              </ul>
            </div>
            <nav aria-label="pagination daw">
              <ul id="pagination-links" class="pagination justify-content-center">
                <!-- ajaxx din -->
              </ul>
            </nav>
          </div>
        </div>
        <div class="col-md-5 mt-4">
          <div class="card h-100 mb-4">
            <div class="card-header pb-0 px-3">
              <div class="row">
                <div class="col-md-6">
                  <h6 class="mb-0">Bet Transactions</h6>
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
      <?php include("footer.php"); ?>
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