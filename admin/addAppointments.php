<?php

$db = new mysqli("localhost", "root", "", "massage");
$q= $db->prepare("SELECT ID, firstName, lastName FROM staff");
$q->execute();
$staffResult = $q->get_result();

?>
<form action="addAppointment.php">
    <label for="staffID">Wybierz lekarza:</label>
    <select name="staffID" id="staffID">
        <?php
            while($staffRow = $staffResult->fetch_assoc()) {
                $staffID = $staffRow['ID'];
                $staffFirstName = $staffRow['firstName'];
                $staffLastName = $staffRow['lastName'];

                echo"<option value=\"$staffID\">$staffFirstName $staffLastName</option>";
            }
        ?>
    </select>
</form>