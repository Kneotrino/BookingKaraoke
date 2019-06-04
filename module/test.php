<?php

if(isset($_POST['submit'])) {
    $country = $_POST['countries'];
    echo $country;
}

?>
<form method="POST">
    <select name="countries">
        <option value="India" />
        <option value="United States" />
        <option value="United Kingdom" />
        <option value="Germany" />
        <option value="France" />
    </select>
    <input type="submit" name="submit" />
</form>

