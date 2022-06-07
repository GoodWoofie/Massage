<?php
$db = new mysqli("localhost", "root", "", "massage");
$appointmentID = $_REQUEST['appointmentID'];
$q = $db->prepare("SELECT * FROM appointment WHERE ID = ?");
$q->bind_param("i", $appointmentID);
if ($q && $q->execute()) {
    $appointment = $q->get_result()->fetch_assoc();
    $appointmentDate = $appointment['date'];
    $appointmentTimestamp = strtotime($appointmentDate);
    echo "Zapis na wizytę w terminie " . date("j.m H:i", $appointmentTimestamp) . "<br>";
}
if (isset($_REQUEST['firstName']) && isset($_REQUEST['lastName'])) {
    $q->prepare("INSERT INTO customer VALUES (NULL, ?, ?, ?, ?)");
    $q->bind_param("ssss", $_REQUEST['firstName'], $_REQUEST['lastName'], $_REQUEST['phone'], $_REQUEST['pesel']);
    $q->execute();
    $customerID = $db->insert_id;
    $q->prepare("INSERT INTO customerappointment VALUES (NULL, ?, ?)");
    $q->bind_param("ii", $appointmentID, $customerID);
    $q->execute();
    echo "Zapisano na wizytę";
} else {
    $q = $db->prepare("SELECT * FROM customer WHERE pesel = ?");
    $q->bind_param("i", $_REQUEST['pesel']);
    if ($q->execute()) {
        $customerResult = $q->get_result();
        if ($customerResult->num_rows == 1) {
            $customer = $customerResult->fetch_assoc();
            $customerID = $customer['ID'];
            $q->prepare("INSERT INTO customerappointment VALUES (NULL, ?, ?)");
            $q->bind_param("ii", $appointmentID, $customerID);
            $q->execute();
            echo "Zapisano na wizytę";
        } else {
            echo "Nie znaleziono takiego pacjenta";
        }
    }
}
