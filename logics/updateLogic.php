<?php
$utils = new Utils;

$update = new Update;

if (isset($_POST['start_update'])) {
    $sql = [$update->rename_table("admin", "users")];

    foreach ($sql as $query) {
        $msg = $update->execute($query);
    }
}
