<?php
include "db.php";
if (isset($_POST['option'])) {

    if ($_POST['option'] != '') {

        $update = "UPDATE messages SET message_status=1 WHERE message_status=0";
        $result = mysqli_query($db, $update);
        if (!$result) {
            die("Query Failed" . mysqli_error($db));
        }
    }
    $query = "SELECT * FROM messages ORDER BY message_id DESC LIMIT 3";
    $result = mysqli_query($db, $query);
    $output = '';
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_array($result)) {
            $output .= "
      <li>
      <a href='#'>
      <strong>" . $row['message_tittle'] . "</strong><br>
      <small><em>" . $row['message_desc'] . "</em></small>
      </a>
        ";
        }
    } else {

        $output = "<li><a href='#'>You Have Zero Notifications</a></li>";
    }
    $status_query = "SELECT * FROM messages WHERE message_status=0";
    $result_query = mysqli_query($db, $status_query);
    $count = mysqli_num_rows($result_query);
    $data = array(
        'notifications' => $output,
        'unreadnotification' => $count

    );
    echo json_encode($data);
}
