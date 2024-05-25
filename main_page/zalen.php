<?php
include $_SERVER['DOCUMENT_ROOT'] . "/components/navbar.php";
if (isset($_POST["bestelTicket"])) {
  header("Location:../selectTicketPage.php?zaalID=".$_POST["zaalID"]."&evenementID=".$_POST["evenementID"]); 
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />
    <title>main page</title>
</head>
<body>
<?php
if (isset($_POST["zaal"])) {
  $zaal = $_POST["zaal"];
 $data = geteventsforarena($mysqli,$zaal); 
 echo '<div class="flex flex-wrap gap-4">';
 if($data != false) {
 foreach ($data as $event) {
  if($event["weergeven"] == 1) {
  echo '
  <div class="card w-72 bg-base-100 shadow-xl">
  <figure class="px-10 pt-10">';
  if (empty($event["afbeelding"])) {
    echo ' <img src="../img/eventPictures/no_picture.png" alt="'.$event["naam"].'" class="rounded-xl" />';
  } else {
    echo ' <img src="../img/eventPictures/'.$event["afbeelding"].'" alt="'.$event["naam"].'" class="rounded-xl" />'; 
  }
    echo'
  </figure>
  <div class="card-body items-center text-center">
    <h2 class="card-title">'.$event["naam"].'</h2>
    <textarea name="beschrijving" class="text-gray-600" required readonly style="height: 100px;">'.$event["beschrijving"].'</textarea>';
    ?>
    <style>
    textarea {
      background: none; 
      resize: none;
      text-align: center;
    }
  </style>
  <?php
  echo'
    <p> datum: '.$event["datum"].'</p>
    <div class="card-actions">
      <form method="post" action="zalen.php">
      <input type="hidden" value="'.$event["zaalID"].'" name="zaalID">
      <input type="hidden" value="'.$event["evenementID"].'" name="evenementID">
      <button class="btn btn-primary" name="bestelTicket">Bestel tickets</button>
      </form>
      
      </div>
  </div>
</div>

'; 
  } 
 }
} else {
  echo '<p class="text-2xl ml-6">Er zijn geen evenementen in deze zaal.</p>';
}
 echo '</div>';
} else {
 $data = getzalen($mysqli);
 echo '<div class="flex flex-wrap gap-4">';
 foreach( $data as $zaal) {
echo '
<div class="card w-96 bg-base-100 shadow-xl ">
  <figure class="px-10 pt-10">
    <img src="../img/zaalPictures/'.$zaal['afbeelding'].'" alt="'.$zaal["naam"].'" class="rounded-xl" />
  </figure>
  <div class="card-body items-center text-center">
    <h2 class="card-title">'.$zaal['naam'].'</h2>
    <div class="card-actions">
      <form method="post" action="zalen.php">
        <button class="btn btn-primary" name="zaal" value="'.$zaal["zaalID"].'">bekijk kalender</button>
      </form>
    </div>
  </div>
</div>'; 
 }
 echo'</div>';
}
?>
</body>
</html>
<?php
include $_SERVER['DOCUMENT_ROOT'] . "/components/footer.php";
?>