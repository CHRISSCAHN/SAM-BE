<?php
include("../connect.php");


$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$limit = 3;
$offset = ($page - 1) * $limit;


$total_query = "SELECT COUNT(*) as total FROM transactions t JOIN transaction_details td ON t.transaction_id = td.transaction_id";
$total_result = mysqli_query($conn, $total_query);
$total_row = mysqli_fetch_assoc($total_result);
$total_records = $total_row['total'];
$total_pages = ceil($total_records / $limit);


$query = "
    SELECT 
        t.transaction_id,
        t.user_id,
        t.transaction_date,
        t.total_bet_amount,
        t.payment_method,
        td.detail_id,
        td.event_name,
        td.bet_type,
        td.bet_amount,
        td.odds,
        td.potential_payout
    FROM 
        transactions t
    JOIN 
        transaction_details td
    ON 
        t.transaction_id = td.transaction_id
    ORDER BY t.transaction_date DESC
    LIMIT $limit OFFSET $offset
";
$result = mysqli_query($conn, $query);


$transactions = '';
while ($row = mysqli_fetch_assoc($result)) {
    $game = $row["event_name"];
    $bet = $row["bet_amount"];
    $pot = $row["potential_payout"];
    $pay = $row["payment_method"];
    $transactions .= "
        <li class='list-group-item border-0 d-flex p-4 mb-2 bg-gray-100 border-radius-lg'>
            <div class='d-flex flex-column'>
                <h6 class='mb-3 text-sm'>$game</h6>
                <span class='mb-2 text-xs'>Bet Amount: <span class='text-dark font-weight-bold ms-sm-2'>$bet</span></span>
                <span class='mb-2 text-xs'>Potential Payout: <span class='text-dark ms-sm-2 font-weight-bold'>$pot</span></span>
                <span class='text-xs'>Payment Method: <span class='text-dark ms-sm-2 font-weight-bold'>$pay</span></span>
            </div>
            <div class='ms-auto text-end'>
                <a class='btn btn-link text-danger text-gradient px-3 mb-0' href='javascript:;'><i class='far fa-trash-alt me-2'></i>Delete</a>
                <a class='btn btn-link text-dark px-3 mb-0' href='javascript:;'><i class='fas fa-pencil-alt text-dark me-2' aria-hidden='true'></i>Edit</a>
            </div>
        </li>
    ";
}

$pagination = '';

// Previous
$pagination .= "
    <li class='page-item " . (($page <= 1) ? 'disabled' : '') . "'>
        <a class='page-link pagination-link' href='#' data-page='" . ($page - 1) . "' aria-label='Previous'>
            <span aria-hidden='true'>&laquo;</span>
        </a>
    </li>
";

// kung ilan
for ($i = 1; $i <= $total_pages; $i++) {
    $active = ($i == $page) ? 'active' : '';
    $pagination .= "
        <li class='page-item $active'>
            <a class='page-link pagination-link' href='#' data-page='$i'>$i</a>
        </li>
    ";
}

// Next
$pagination .= "
    <li class='page-item " . (($page >= $total_pages) ? 'disabled' : '') . "'>
        <a class='page-link pagination-link' href='#' data-page='" . ($page + 1) . "' aria-label='Next'>
            <span aria-hidden='true'>&raquo;</span>
        </a>
    </li>
";


echo json_encode([
    'transactions' => $transactions,
    'pagination' => $pagination
]);
?>