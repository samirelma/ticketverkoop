<?php
    session_start();
    if(isset($_POST['submit'])){
        if(isset($_POST['voorwaarde'])){
            $_SESSION["gebruikersVoorwaarde"] = true;
            $_SESSION["start_time"] = time();
            header('Location: ../index.php');
        }else{
            echo 'Gelieve de gebruikersvoorwaarden te accepteren';
        }
    }
    ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Gebruikers Voorwaarde</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' type='text/css' media='screen' href='main.css'>
    <script src='main.js'></script>
</head>
<body>
    <p>Volgende website is een fictieve website voor een schoolproject. Het doel van de website is om een ticketverkoop na te bootsen voor een jury. Geen van de evenementen Zijn echt plaatvindende evenementen. Indien je tickets wilt kopen voor evenementen concerten en dergelijk doe dit dan zeker niet op deze website.</p>
    <form action="#" method="post">
        <input type="checkbox" name="voorwaarde" id="voorwaarde" required>
        <label for="voorwaarde">Ik ga akkoord met de gebruikersvoorwaarden</label>
        <button type="submit" name="submit">Verder</button>
    </form>
</body>
</html>