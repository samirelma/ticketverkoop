<?php
include $_SERVER['DOCUMENT_ROOT'] . "/components/navbar.php";

if (isset($_POST["knop2"])) {
    $oldPassword = $_POST["oldPassword"];
    $newPassword = $_POST["wachtwoord"];
    $confirmPassword = $_POST["wachtwoord2"];

    // Assuming you have a session or cookie set with the user's ID
    $userId = $_SESSION["gebruikersid"];


    // Fetch the user's current password from the database
    $query = "SELECT password FROM users WHERE id = ?";
    $stmt = $mysqli->prepare($query);
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    // Verify the old password
    if (password_verify($oldPassword, $user["password"])) {
        // Check if new password and confirm password match
        if ($newPassword === $confirmPassword) {
            // Update the password in the database
            $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
            $query = "UPDATE users SET password = ? WHERE id = ?";
            $stmt = $mysqli->prepare($query);
            $stmt->bind_param("si", $hashedPassword, $userId);
            $stmt->execute();

            // echo "Password updated successfully.";
            header("Location: ../index.php");
        
        } else {
            echo "<div class='max-w-md mx-auto'>
                    <div class='bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative' role='alert'>
                        <strong class='font-bold'>Error!</strong>
                        <span class='block sm:inline'>New password and confirm password do not match.</span>
                        <span class=' top-0 bottom-0 right-0 px-4 py-3'>
                            <a href='passwordReset.php' class='text-blue-500 underline'>Try again</a>
                        </span>
                    </div>
                  </div>";
        }
     } else {
            echo "<div class='max-w-md mx-auto'>
                    <div class='bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative' role='alert'>
                        <strong class='font-bold'>Error!</strong>
                        <span class='block sm:inline'>Old password is incorrect.</span>
                        <span class=' top-0 bottom-0 right-0 px-4 py-3'>
                            <a href='passwordReset.php' class='text-blue-500 underline'>Try again</a>
                        </span>
                    </div>
                  </div>";
        }
        
} else {
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8" />
    <title>Password Reset</title>
</head>

<body>
    <div class="card-body">
        <div class="card-actions justify-center">
            <form method="post" action="passwordReset.php">
                <label class="label">Old Password</label>
                <input type="password" placeholder="Old Password" class="input input-bordered input-primary w-full max-w-xs" name="oldPassword" /><br>
                <label class="label">New Password</label>
                <input type="password" placeholder="New Password" class="input input-bordered input-primary w-full max-w-xs" name="wachtwoord" /><br>
                <label class="label">Confirm New Password</label>
                <input type="password" placeholder="Confirm New Password" class="input input-bordered input-primary w-full max-w-xs" name="wachtwoord2" /><br><br>
                <button class="btn text-blue-500" type="submit" name="knop2">Change Password</button>
            </form>
        </div>
    </div>
</body>

</html>

<?php
include $_SERVER['DOCUMENT_ROOT'] . "/components/footer.php";
}
?>