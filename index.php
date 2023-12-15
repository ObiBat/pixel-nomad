<?php



use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

// Database credentials
$serverName = "tcp:pixelnomad.database.windows.net,1433";
$dbName = "pixelnomad";
$username = "CloudSAb8b0699e";
$password = "Onlyyou99!";

// Check for form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errorMessage = "Invalid email format";
    } else {
        try {
            // Establish database connection
            $conn = new PDO("sqlsrv:server=$serverName;Database=$dbName", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Insert query
            $sql = "INSERT INTO subscribers (email) VALUES (?)";
            $stmt = $conn->prepare($sql);
            $stmt->execute([$email]);

            // Prepare and send an email
            $mail = new PHPMailer(true);
            $mail->isSMTP();
            $mail->Host = 'smtp.pixelnomad.studio'; // e.g., smtp.sendgrid.net
            $mail->SMTPAuth = true;
            $mail->Username = 'admin@pixelnomad.studio';
            $mail->Password = 'Onlyyou99!';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587; // or 465 if using SSL

            $mail->setFrom('admin@pixelnomad.studio', 'Pixel Nomad');
            $mail->addAddress($email);

            $mail->isHTML(true);
            $mail->Subject = 'Thank you for subscribing!';
            $mail->Body = 'Welcome to Pixel Nomad! Stay tuned for updates.';

            $mail->send();
            $successMessage = "Subscription successful. Check your email for confirmation.";
        } catch (Exception $e) {
            $errorMessage = "Error: " . $e->getMessage();
        }
    }
}
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">

    <!-- Google font -->
    <link rel="stylesheet" href="https://use.typekit.net/jab4xjc.css">

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <!-- Custom CSS  -->
    <link rel="stylesheet" href="css/style.css">

    <!-- AOS Library for animations -->
    <link rel="stylesheet" href="https://unpkg.com/aos@2.3.1/dist/aos.css">

    <title>Pixel Nomad | Coming Soon</title>

</head>
<body>
    <div class="container-fluid h-100 bg-image" style="background-image: url('img/hero.jpg'); background-size: cover; background-position: center;">
        <div class="row h-100 justify-content-center align-items-center">
            <div class="col-10 text-center text-white" data-aos="fade-up" data-aos-duration="1000">
                <h1 class="display-1 animated fadeInDown" style="font-family: 'Montserrat', sans-serif; text-shadow: 2px 2px 4px #000000;">PIXEL NOMAD</h1>
                <h2 class="animated fadeInUp">Crafting your digital adventure.</h2>
                <p class="lead animated fadeIn">Stay tuned for a space of creativity, connection, and exploration.</p>
                <form id="email-form" method="post" action="index.php" data-aos="fade-up" data-aos-duration="1000">
                     <input type="email" name="email" placeholder="Enter your email" class="form-control mb-3" required style="opacity: 0.6;">
                     <button type="submit" class="btn-custom" data-aos="fade-up" data-aos-duration="1000">Subscribe</button>
               </form>
        <?php
        if (!empty($successMessage)) {
            echo "<p>$successMessage</p>";
        }
        if (!empty($errorMessage)) {
            echo "<p>$errorMessage</p>";
        }
        ?>

                <div class="social-links d-flex justify-content-center mt-4" data-aos="fade-up" data-aos-duration="1000">
                    <a href="https://www.facebook.com/pixelnomad.studio" target="_blank" class="text-white me-3"><i class="bi bi-facebook" style="font-size: 2em;"></i></a>
                    <a href="https://www.instagram.com/pixelnomad.studio/" target="_blank" class="text-white"><i class="bi bi-instagram" style="font-size: 2em;"></i></a>
                </div>
                <p class="copyright text-white mt-5" data-aos="fade-up" data-aos-duration="1000">&copy; 2023 Pixel Nomad</p>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn30AZQ1exjLEQ+Yb2o+L2Q9v3H+CgCE5kE21CqACvI+8FHdN5Nqv+8z1K4" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script src="script/script.js"></script>
    <script>
        AOS.init({
            delay: 200,
            duration: 1000,
            easing: 'ease-in-out',
        });

        function subscribe() {
            var email = document.getElementById('email').value;

            // You can add additional validation here if needed

            // Simulate sending the email to your backend or third-party service
            // For a real application, you'd want to replace this with actual backend code
            console.log("Subscribed with email: " + email);

            // Optionally, you can redirect the user to a thank-you page or show a confirmation message
            alert("Thank you for subscribing!");
        }
    </script>
</body>
</html>
