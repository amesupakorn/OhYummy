<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
</head>
<body>
<?php
    session_start();
    include('../connectDatabase/connectToDatabase.php');

    $connect = new database();

    $connect->addRow("Menu", "(1, 'ส้มตำ', '50.00', 'on')");

?>
</body>
</html>