<?php
include $_SERVER['DOCUMENT_ROOT'] . "/components/navbar.php";
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />
    <title>title</title>
</head>
<body>
<?php
if (isset($_POST["zaal"])) {
  $zaal = $_POST["zaal"];
 $data = geteventsforarena($mysqli,$zaal); 
 foreach ($data as $event) {
  echo '
  <div class="card w-96 bg-base-100 shadow-xl">
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
    <p>'.$event["beschrijving"].'</p>
    <p> datum: '.$event["datum"].'</p>
    <div class="card-actions">
      <button class="btn btn-primary">Bestel tickets</button>
    </div>
  </div>
</div>'; 

 }
} else {
 $data = getzalen($mysqli);
 echo'<div class="justify-start>';
 foreach( $data as $zaal) {
echo '
<div class="card w-96 bg-base-100 shadow-xl">
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