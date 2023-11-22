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

} else {
echo '
<div class="card w-96 bg-base-100 shadow-xl">
  <figure class="px-10 pt-10">
    <img src="/images/stock/photo-1606107557195-0e29a4b5b4aa.jpg" alt="Shoes" class="rounded-xl" />
  </figure>
  <div class="card-body items-center text-center">
    <h2 class="card-title">Zaal</h2>
    <div class="card-actions">
      <form method="post" action="zalen.php">
        <button class="btn btn-primary" name="zaal" value="zaal">bekijk kalender</button>
      </form>
    </div>
  </div>
</div>'; 
}
?>
</body>
</html>
<?php
include $_SERVER['DOCUMENT_ROOT'] . "/components/footer.php";
?>