<!DOCTYPE html>
  <html lang="en">
  <link href="https://cdn.jsdelivr.net/npm/daisyui@3.7.4/dist/full.css" rel="stylesheet" type="text/css" />
<script src="https://cdn.tailwindcss.com"></script>

  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
  </head>
  <body>


<center>

<h1 class="md:text-center text-4xl font-bold mb-8">Create a new account</h1>
<form action="/profile/register.php" method="post" class="flex flex-col gap-8 w-full md:max-w-2xl">
  <div class="flex flex-col gap-4">
    <div class="flex flex-col gap-4 md:flex-row">
      <div class="form-control md:flex-1">
        <label class="label">
          <span class="label-text">Firstname</span>
        </label>
        <input type="text" name="firstname" placeholder="John" class="input input-bordered w-full" required />
      </div>
      
      <div class="form-control md:flex-1">
        <label class="label">
          <span class="label-text">Lastname</span>
        </label>
        <input type="text" name="lastname" placeholder="Doe" class="input input-bordered w-full" required />
      </div>
    </div>
    
    <div class="flex flex-col gap-4 md:flex-row">
      <div class="form-control md:flex-1">
        <label class="label">
          <span class="label-text">Email</span>
        </label>
        <input type="email" name="email" placeholder="john.doe@gmail.com" class="input input-bordered w-full" required />
      </div>
      
      <div class="form-control md:flex-1">
        <label class="label">
          <span class="label-text">Username</span>
        </label>
        <input type="text" name="username" placeholder="john.doe" class="input input-bordered w-full" required />
      </div>
    </div>
    
    <div class="flex flex-col gap-4 md:flex-row">
      <div class="form-control md:flex-1">
        <label class="label">
          <span class="label-text">Password</span>
        </label>
        <input type="password" name="password" placeholder="Password" class="input input-bordered w-full" required />
      </div>
      
      <div class="form-control md:flex-1">
        <label class="label">
          <span class="label-text">Confirm password</span>
        </label>
        <input type="password" name="passwordConfirm" placeholder="Confirm password" class="input input-bordered w-full" required />
      </div>
    </div>
  </div>

  <button name="register" class="btn btn-primary">Register</button>
</form>

<div class="w-full text-center mt-8">
  <a class="link" href="../account/index">I already have an account</a>
</div>
</div>
</center>

</body>
</html>
