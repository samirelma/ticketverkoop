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
      <p class="py-6">Provident cupiditate voluptatem et in. Quaerat fugiat ut assumenda excepturi exercitationem quasi. In deleniti eaque aut repudiandae et a id nisi.</p>
    </div>
    <div class="card flex-shrink-0 w-full max-w-sm shadow-2xl bg-base-100">
      <form class="card-body">
        <div class="form-control">
          <label class="label">
            <span class="label-text">categorie</span>
            <select name="categorie" default="categorie"></select>
          </label>
          <?php
    $categorieString = getCategorieData($mysqli); 
    foreach ($categorieString as $categorie) { 
       echo' 
        <option value="' . $categorie["id"].'">'. $categorie["name"].'</option>';
    }
?>
        </div>
        <div class="form-control">
          <label class="label">
            <span class="label-text">plaats</span>
          </label>
          <input type="password" placeholder="plaats" class="input input-bordered" required />
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