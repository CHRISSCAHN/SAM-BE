<?php
include('../connect.php'); 


$offset = isset($_GET['offset']) ? (int)$_GET['offset'] : 0;
$limit = 3;  


if ($offset == 0) {
    $query = "SELECT t.transaction_id, t.transaction_date, t.total_bet_amount, 
                     td.event_name, td.bet_type, td.bet_amount, td.odds, td.potential_payout
              FROM transactions t
              JOIN transaction_details td ON t.transaction_id = td.transaction_id
              ORDER BY t.transaction_date DESC
              LIMIT $limit OFFSET 3";  
} 

else {
    $query = "SELECT t.transaction_id, t.transaction_date, t.total_bet_amount, 
                     td.event_name, td.bet_type, td.bet_amount, td.odds, td.potential_payout
              FROM transactions t
              JOIN transaction_details td ON t.transaction_id = td.transaction_id
              WHERE t.transaction_date < (SELECT MAX(transaction_date) FROM transactions)
              ORDER BY t.transaction_date ASC"; 
}

$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_array($result)) {
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

       
        echo '<li class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
                <div class="d-flex align-items-center">
                  <button class="btn btn-icon-only btn-rounded ' . $btnClass . ' mb-0 me-3 btn-sm d-flex align-items-center justify-content-center">
                    <i class="fas fa-arrow-up"></i>
                  </button>
                  <div class="d-flex flex-column">
                    <h6 class="mb-1 text-dark text-sm">' . $name . '</h6>
                    <span class="text-xs">' . date("d M Y, h:i A", strtotime($date)) . '</span>
                  </div>
                </div>
                <div class="d-flex align-items-center ' . $colorClass . ' text-gradient text-sm font-weight-bold">
                  ' . $displayAmount . '
                </div>
              </li>';
    }
} else {
    echo "<li>No transactions found</li>";
}
?>
