<?php

$db = new mysqli("localhost", "root", "", "massage");
$q = $db->prepare("SELECT * FROM staff");
if($q && $q->execute()) {
    $result = $q->get_result();
    while($staff = $result->fetch_assoc()) {
        $staff_id = $staff['ID'];
        $firstName = $staff['firstName'];
        $lastName = $staff['lastName'];
        echo "Masażysta $firstName $lastName<br>";
        $q = $db->prepare("SELECT * FROM appointment WHERE staff_id = ?");
        $q->bind_param("i", $staff_id);
        if($q && $q->execute()) {
            $appointments = $q->get_result();
            while($appointment = $appointments->fetch_assoc()) {
                $appointmentID = $appointment['ID'];
                $appointmentDate= $appointment['date'];
                $appointmentTimestamp = strtotime($appointmentDate);
                echo "<a href=\"customerLogin.php?id=$appointmentID\" style=\"margin:10px; display:block\">";
                echo date("j.m H:i", $appointmentTimestamp);
                echo"</a>";
            }
            echo "<br>";
        } else {
            die("Błąd pobierania wizyt bazy danych");
        }
    }
} else {
    die("Błąd pobierania lekarzy bazy danych");
}

?>