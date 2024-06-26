<?php
include $_SERVER['DOCUMENT_ROOT'] . "/components/navbar.php";
//make it sp if u arent logged in u cant get to this page and if u arent admin or bedrijf u cant get to this page
if (!isset($_SESSION['user'])) {
    header("Location: /profile/login.php");
    exit;
}
if ($_SESSION['user'] != 'admin' && $_SESSION["user"] != "bedrijf") {
    header("Location: ../index.php");
    exit;
}
?>


<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8" />
    <title>title</title>
</head>

<body>




    <h1 class="text-center text-4xl font-bold mb-12 text-blue-500">Maak een nieuwe evenement</h1>

    <form action="/profile/evenement-toevoegen-code.php" method="post" enctype="multipart/form-data" class="flex flex-col items-center justify-center gap-4 max-w-2xl mx-auto">
        <!-- Zaal Selection -->

        <label class="label">
            <span class="label-text text-blue-500">Zaal</span>
        </label>
        <select name="zaal" id="zaal" class="input input-bordered w-full" required>
            <?php
            // Connect to the database
            // Prepare the SQL query
            $stmt = $mysqli->prepare("SELECT zaalID, naam, capaciteit FROM tblzalen");

            // Execute the query
            $stmt->execute();

            // Get the result
            $result = $stmt->get_result();

            // Loop through the result and create the option elements
            while ($row = $result->fetch_assoc()) {
                echo "<option value='" . $row['zaalID'] . "' data-capaciteit='" . $row['capaciteit'] . "'>" . $row['naam'] . "</option>";
            }
            ?>
        </select>
        </div>
        <!-- Name -->
        <div class="form-control w-full">
            <label class="label">
                <span class="label-text text-blue-500">Naam</span>
            </label>
            <input type="text" name="naam" placeholder="Event Name" class="input input-bordered w-full" required />
        </div>

        <!-- Date -->
        <div class="form-control w-full">
            <label class="label">
                <span class="label-text text-blue-500">Einde datum event</span>
            </label>
            <input type="datetime-local" name="datum" class="input input-bordered w-full" required min="<?php echo date('Y-m-d\TH:i'); ?>" />
        </div>

        <!-- Number of Tickets -->
        <div class="form-control w-full">
            <label class="label">
                <span class="label-text text-blue-500">Aantal tickets</span>
            </label>
            <input type="number" name="aantalTickets" id="aantalTickets" placeholder="100" min="0" class="input input-bordered w-full" required />
            <p id="warning" style="display: none; color: red;"></p>
        </div>

        <script>
            // When the selected zaal changes, update the max value of the aantalTickets input
            function updateMaxValue() {
                var selectedOption = document.getElementById('zaal').options[document.getElementById('zaal').selectedIndex];
                var capaciteit = selectedOption.getAttribute('data-capaciteit');
                document.getElementById('aantalTickets').max = capaciteit;
            }

            // Call the updateMaxValue function initially
            updateMaxValue();

            // Add event listener to the zaal selection
            document.getElementById('zaal').addEventListener('change', updateMaxValue);
        </script>



        <!-- Description -->
        <div class="form-control w-full">
            <label class="label">
                <span class="label-text text-blue-500">beschrijving</span>
            </label>
            <textarea name="beschrijving" class="textarea textarea-bordered min-h-[8em]" placeholder="Event Description" required minlength="50" maxlength="252"></textarea>        </div>

        <!-- Image -->
        <div class="form-control w-full">
            <label class="label">
                <span class="label-text text-blue-500">Foto</span>
            </label>
            <input type="file" name="fileToUpload" id="fileToUpload" required>
        </div>

        <!-- Submit -->

        <div class="form-control w-full max-w-xs mt-4">
            <button name="create" class="btn btn-primary bg-blue-500 hover:bg-blue-600 text-white">Create</button>
        </div>


        <br>
    </form>
    </form>
</body>


</html>

<footer class="footer footer-center p-10 bg-[#150578] text-primary-content">
    <aside>
        <p class="normal-case text-xl text-[#FF101F]" href="../index.php">RS ticket service</p>
        <p class="font-bold text-[#FDFFFF]">
            Uw bertrouwbare partner voor al uw evenementen.
            <br /> Live kom en beleef de experience !
            <br />RS ticket service nv - Zandpoortsebaan 12 - 2800 Mechelen
        </p>
        <p class="text-[#FDFFFF]">info@RSticketservice.be</p>
        <p class="text-[#FDFFFF]">© RS ticket service - Alle rechten voorbehouden</p>
    </aside>
    <nav>
        <h1 class="text-[#FDFFFF]">volg ons</h1>
        <div class="grid grid-flow-col gap-4 text-[#FDFFFF]">
            <a><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" class="fill-current">
                    <path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z"></path>
                </svg></a>
            <a><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" class="fill-current">
                    <path d="M19.615 3.184c-3.604-.246-11.631-.245-15.23 0-3.897.266-4.356 2.62-4.385 8.816.029 6.185.484 8.549 4.385 8.816 3.6.245 11.626.246 15.23 0 3.897-.266 4.356-2.62 4.385-8.816-.029-6.185-.484-8.549-4.385-8.816zm-10.615 12.816v-8l8 3.993-8 4.007z"></path>
                </svg></a>
            <a><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" class="fill-current">
                    <path d="M9 8h-3v4h3v12h5v-12h3.642l.358-4h-4v-1.667c0-.955.192-1.333 1.115-1.333h2.885v-5h-3.808c-3.596 0-5.192 1.583-5.192 4.615v3.385z"></path>
                </svg></a>
        </div>
    </nav>
</footer>