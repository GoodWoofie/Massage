<?php

if(isset($_REQUEST['firstName']) && isset($_REQUEST['lastName'])) {

    $db = new mysqli("localhost", "root", "", "massage");
    $q = $db->prepare("INSERT INTO customer VALUES (NULL, ?, ?, ?, ?)");
    $q->bind_param("ssss", $_REQUEST['firstName'], $_REQUEST['lastName'], $_REQUEST['phone'], $_REQUEST['pesel']);
    if($q->execute()) {
    echo "Klient Dodany!";
    } else {

    }
} else {
    echo '
    <form action="newCustomer.php" method="post">
    <label style="margin:10px" for="firstName">Imię:</label>
    <input style="margin:10px" type="text" name="firstName" id="firstName">
    <label style="margin:10px" for="lastName">Nazwisko:</label>
    <input style="margin:10px" type="text" name="lastName" id="lastName">
    <label style="margin:10px" for="phone">Numer Telefonu:</label>
    <input style="margin:10px" type="text" name="phone" id="phone">
    <label style="margin:10px" for="pesel">Numer Pesel:</label>
    <input style="margin:10px" type="text" name="pesel" id="pesel">
    <input style="margin:10px" type="submit" value="Zapisz">
    </form>';
}

?>