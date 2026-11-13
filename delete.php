<?php

include "db.php";


if (isset($_POST['delete']) && filter_var($_POST['delete'], FILTER_VALIDATE_INT) !== false) {
    $id = (int) $_POST['delete'];

    $sql = $conn->prepare("DELETE FROM results WHERE id = ?");
    $sql->bind_param("i", $id);

    if ($sql->execute()) {
        header("Location: index.php");
        exit;
    }
}

header("Location: index.php");
exit;
?>