<?php
 include $_SERVER['DOCUMENT_ROOT'] . "/components/navbar.php";  
 include $_SERVER['DOCUMENT_ROOT'] . "/berekenZaalStoelen.php";
 if (isset($_POST["volgende"])) {
  $zaalID = $_POST["zaalID"]; 
  $ticketCategorie = $_POST["ticketCategorie"]; 
  } else if (isset($_POST["volgende2"])){
 $zaalID = $_POST["zaalID2"];
} else {
  $zaalID = $_GET["zaalID"]; 
}
$zaalAsString = getzalenByID($mysqli, $zaalID); 
foreach ($zaalAsString as $zaal) {
 $zaalPlategrond = "img/zaalPictures/".$zaal["plategrond"]; 
}

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />
    <title>title</title>
</head>
<body>
<div class="hero min-h-screen bg-base-200">
  <div class="hero-content flex-col lg:flex-row-reverse">
    <div class="text-center lg:text-left">
      <h1 class="text-5xl font-bold">Reserveer plaatsen</h1>
      <p class="py-6">Selecteer hier uw plaats om een ticket te boeken.</p>
      <img src="<?php echo $zaalPlategrond?> " width="700" height="550">
    </div>
    <div class="card flex-shrink-0 w-full max-w-sm shadow-2xl bg-base-100">
    <?php  
      if ((!isset($_POST["volgende"]))&&(!isset($_POST["volgende2"]))) {
      ?>
      <form class="card-body" method="post" action="selectTicketPage.php">
        <div class="form-control">
          <input type="hidden" value= " <?php echo $_GET["zaalID"]?> " name="zaalID" >
          <label class="label">
            <span class="label-text">categorie</span>
          </label>
          <select class="select w-full max-w-xs" name="ticketCategorie">
 <?php 
          
          foreach (getCategorieData($mysqli) as $categorie) { 
 ?>
  <option value="<?php echo $categorie['id']?>"><?php echo $categorie['name']?></option>
 <?php 
}
?>
</select>
        </div>
        <div class="form-control mt-6">
          <button class="btn btn-primary" name="volgende">Volgende</button>
        </div>
      </form>
      <?php } else if(isset($_POST["volgende"])) {
        ?>
     <form class="card-body" method="post" action="selectTicketPage.php">
        <div class="form-control">
          <label class="label">
            <span class="label-text">Blok</span>
          </label>
          <input type="hidden" name="zaalID2" value="<?php echo $zaalID ?>">
          <input typpe="hidden" name
          <select class="select w-full max-w-xs">
            <?php  foreach (berekenZaalBlokken($mysqli, $ticketCategorie) as $blok) { ?>
             <option value="<?php echo $blok ?>"><?php echo $blok?></option> <?php } ?>
          </select>
        </div>
        <div class="form-control mt-6">
          <button class="btn btn-primary" name="volgende2">Volgende</button>
        </div>
      </form>
        <?php
      } elseif (isset($_POST["volgende2"])){
        ?>
        <form class="card-body" method="post" action="selectTicketPage.php">
        <div class="form-control">
          <label class="label">
            <span class="label-text">Stoel</span>
          </label>
          <input type="hidden" name="zaalID2" value="<?php echo $zaalID ?>">
          <select class="select w-full max-w-xs">
            <?php  foreach (berekenZaalBlokken($mysqli, $ticketCategorie) as $blok) { ?>
             <option value="<?php echo $blok ?>"><?php echo $blok?></option> <?php } ?>
          </select>
        </div>
        <div class="form-control mt-6">
          <button class="btn btn-primary" name="volgende2">Volgende</button>
        </div>
      </form>
     <?php }  ?>
    </div>
  </div>
</div>
</body>
</html>
<?php
include $_SERVER['DOCUMENT_ROOT'] . "/components/footer.php";
?>