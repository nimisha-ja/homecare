<!-- DataTables CSS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
<!-- DataTables JS -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<!-- DataTables Responsive JS -->
<script src="https://cdn.datatables.net/responsive/2.3.0/js/dataTables.responsive.min.js"></script>
<style>/* Prevent text selection on table cells */
/* Prevent text selection for table cells in deliveryTable, staffTable, expenseTable, and advanceTable */
#deliveryTable td, #deliveryTable th,
#staffTable td, #staffTable th,
#expenseTable td, #expenseTable th,
#advanceTable td, #advanceTable th {
    -webkit-user-select: none; /* Disable text selection for WebKit browsers */
    -moz-user-select: none; /* Disable text selection for Firefox */
    -ms-user-select: none; /* Disable text selection for IE/Edge */
    user-select: none; /* Disable text selection for modern browsers */
}

/* Ensure the cursor is a pointer on clickable elements in deliveryTable, staffTable, expenseTable, and advanceTable */
#deliveryTable .btn, #staffTable .btn, #expenseTable .btn, #advanceTable .btn {
    cursor: pointer; /* Show the hand cursor when hovering over buttons */
}

/* Optional: Change cursor for rows that are clickable in deliveryTable, staffTable, expenseTable, and advanceTable */
#deliveryTable tr:hover, #staffTable tr:hover, #expenseTable tr:hover, #advanceTable tr:hover {
    cursor: pointer; /* Show the hand cursor when hovering over rows */
}

</style>