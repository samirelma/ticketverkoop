<?php
include $_SERVER['DOCUMENT_ROOT'] . "/components/navbar.php";
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>404 Page Not Found</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
</head>
<body>
  <div class="hero-content flex-col lg:flex-row">
    <img src="404image.png" class="max-w-sm rounded-lg shadow-2xl" />
    <div>
      <h1 class="text-5xl font-bold">OOPS!</h1>
      <p class="py-6">de pagina die u zoekt bestaat niet.</p>
      <a href="../index.php">ga terug naar de startpagina.</a>
    </div>
  </div>
</body>
</html>
<?php
include $_SERVER['DOCUMENT_ROOT'] . "/components/footer.php";
?>