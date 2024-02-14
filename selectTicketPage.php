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
<div class="hero min-h-screen bg-base-200">
  <div class="hero-content flex-col lg:flex-row-reverse">
    <div class="text-center lg:text-left">
      <h1 class="text-5xl font-bold">Reserveer plaatsen</h1>
      <p class="py-6">Selecteer hier uw plaats om een ticket te boeken.</p>
      <?php
       $zaalAsString = getzalenByID($mysqli, $_GET["zaalID"]); 
       foreach ($zaalAsString as $zaal) {
        $zaalPlategrond = "img/zaalPictures/".$zaal["plategrond"]; 
       }
      ?>
      <img src="<?php echo $zaalPlategrond?> " width="500" height="350">
    </div>
    <div class="card flex-shrink-0 w-full max-w-sm shadow-2xl bg-base-100">
      <form class="card-body">
        <div class="form-control">
          <label class="label">
            <span class="label-text">categorie</span>
          </label>
          <select class="select w-full max-w-xs">
 <option disabled selected>Selecteer de categorie die u wilt boeken </option>
 <?php 
 $categorieAlsString = getCategorieData($mysqli); 
foreach ($categorieAlsString as $categorie) { 
 ?>
  <option value="<?php $categorie['id']?>"><?php echo $categorie['name']?></option>
 <?php 
}
?>
</select>
        </div>
        <div class="form-control">
          <label class="label">
            <span class="label-text">plaats</span>
          </label>
          <select class="select w-full max-w-xs">
  <option disabled selected>Pick your favorite Simpson</option>
  <option>Homer</option>
  <option>Marge</option>
  <option>Bart</option>
  <option>Lisa</option>
  <option>Maggie</option>
</select>
        </div>
        <div class="form-control mt-6">
          <button class="btn btn-primary">Reserveer</button>
        </div>
      </form>
    </div>
  </div>
</div>
</body>
</html>
<?php
include $_SERVER['DOCUMENT_ROOT'] . "/components/footer.php";
?>