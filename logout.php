<?php
session_start();
if (isset($_POST['logout'])) {
    session_unset();
    session_destroy();
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logout Form</title>
    <link rel="stylesheet" href="css/logout.css">
</head>

<body>
    <div id="logoutModal" class="modal">
        <div class="modal-content">
            <h2>Are you sure you want to logout?</h2>
            <form method="post" id="logoutForm">
                <div class="buttons">
                    <input type="submit" name="logout" value="Yes">
                    <button type="button" onclick="closeModal()">No</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function closeModal() {
            document.getElementById("logoutModal").style.display = "none";
        }

        // Show the logout form when the page loads
        document.addEventListener("DOMContentLoaded", function() {
            document.getElementById("logoutModal").style.display = "block";
        });

        // Handle form submission for "Yes" button
        document.querySelector("#logoutModal input[type='submit']").addEventListener("click", function(event) {
            event.preventDefault();
            logout();
        });

        // Handle "No" button
        document.querySelector("#logoutModal button").addEventListener("click", function() {
            closeModal();
            window.location.href = "dashboard.php"; // Redirect back to dashboard
        });

        function logout() {
            const xhr = new XMLHttpRequest();
            xhr.open("POST", "logout.php");
            xhr.onload = function() {
                if (xhr.status === 200) {
                    window.location.href = "login.php";
                } else {
                    // Handle error if needed
                }
            };
            xhr.send(new FormData(document.getElementById("logoutForm")));
        }
    </script>
</body>

</html>