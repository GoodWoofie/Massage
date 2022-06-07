<?php

if(isset($_REQUEST['firstName']) && isset($_REQUEST['lastName'])) {
    $db = new mysqli("localhost", "root", "", "massage");
    $q = $db->prepare("INSERT INTO staff VALUES(NULL, ?, ?)");
    $q->bind_param("ss", $_REQUEST['firstName'], $_REQUEST['lastName']);
    if($q->execute()) {
        echo "Dodano nowy personel";
    }
} else {
echo '<form action="addStaff.php" method="POST">
<label style="margin:10px" for="firstName">Imię</label>
<input style="margin:10px" type="text" name="firstName" id="firstName"><br>
<label style="margin:10px" for="lastName">Nazwisko</label>
<input style="margin:10px" type="text" name="lastName" id="lastName"><br>
<input style="margin:10px" type="submit" value="Dodaj nowy personel"><br>
</form>';
}

?>