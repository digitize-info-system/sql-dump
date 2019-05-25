<?php
error_reporting('2037');
$arr_skip_db = ['information_schema', 'mysql', 'performance_schema', 'sys', 'test', 'phpmyadmin'];

$conn = mysqli_connect('127.0.0.1', 'root', '') or die(mysqli_error());

$query = mysqli_query($conn, 'SHOW databases;') or die(mysqli_error());

while($row = mysqli_fetch_assoc($query))
{
    $database = $row['Database'];

    if(in_array($database, $arr_skip_db)) continue;
    echo $database . "\n";

    exec('mysqldump --add-drop-table --disable-keys --quick --insert-ignore --order-by-primary -uroot ' . $database . ' > dumps/' . $database . '.sql');
}