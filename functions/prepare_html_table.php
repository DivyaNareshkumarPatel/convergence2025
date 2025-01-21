<style>
    table {
        width: 100%;
        margin-bottom: 20px;
        border-collapse: collapse;
    }

    th,
    td {
        padding: 10px;
        text-align: left;
        border-bottom: 1px solid #ddd;
    }

    th {
        background-color: #007bff;
        color: #fff;
    }
</style>

<?php

require_once "config.php";
$user_id = $_POST['user_id'];

$sql = "SELECT event.event_id, event.event_name, event.date, event.time, event.venue
FROM event
INNER JOIN registered_event ON event.event_id = registered_event.event_id
WHERE registered_event.user_id = '" . $user_id . "'";
$result = $conn->query($sql);
ob_start();
?>
<table>
    <thead>
        <tr>
            <th>Event Name</th>
            <th>Date</th>
            <th>Time</th>
            <th>Venue</th>
        </tr>
    </thead>
    <tbody>
        <?php
        while ($rows = $result->fetch_assoc()) {
            ?>
            <tr>
                <td>
                    <?php echo $rows['event_name']; ?>
                </td>
                <td>
                    <?php echo $rows['date']; ?>
                </td>
                <td>
                    <?php echo $rows['time']; ?>
                </td>
                <td>
                    <?php echo $rows['venue']; ?>
                </td>
            </tr>
            <?php
        }
        ?>
    </tbody>
</table>

<?php
$table_html = ob_get_clean();
echo $table_html;
?>