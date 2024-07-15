<?php
require 'vendor/autoload.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$name = $email = $message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if(isset($_POST['name']) && !empty($_POST['name'])){
        $name = trim($_POST['name']);
    }

    if(isset($_POST['email']) && !empty($_POST['email'])){
        $email = trim($_POST['email']);
    }

    if(isset($_POST['message']) && !empty($_POST['message'])){
        $message = trim($_POST['message']);
    }

    // Define the path to your Excel file
    $file = 'contacts.xlsx';

    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();

    // Check if the file exists
    if (file_exists($file)) {
        // Load existing file
        $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($file);
        $sheet = $spreadsheet->getActiveSheet();
    } else {
        // Create new file and add headers
        $sheet->setCellValue('A1', 'Name');
        $sheet->setCellValue('B1', 'Email');
        $sheet->setCellValue('C1', 'Message');
    }

    // Find the next available row
    $row = $sheet->getHighestRow() + 1;
    $sheet->setCellValue("A{$row}", $name);
    $sheet->setCellValue("B{$row}", $email);
    $sheet->setCellValue("C{$row}", $message);

    // Write to the file
    $writer = new Xlsx($spreadsheet);
    $writer->save($file);

    $mail = new PHPMailer(true);
    try {
        //Server settings
        $mail->isSMTP();                                     
        $mail->Host       = 'smtp.gmail.com';                
        $mail->SMTPAuth   = true;                             
        $mail->Username   = 'sujaladhikari149@gmail.com';        
        $mail->Password   = 'soww tunz dktq vfhp';            
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;   
        $mail->Port       = 587;                              

        //Recipients
        $mail->setFrom('your-email@gmail.com', 'Mailer');
        $mail->addAddress('sujaladhikari149@gmail.com', 'Sujal Adhikari');     

        // Content
        $mail->isHTML(true);                                 
        $mail->Subject = 'New Contact Form Submission';
        $mail->Body    = "Name: $name\nEmail: $email\nMessage: $message";

        $mail->send();
        echo 'Email has been sent';
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
    // Redirect back to the contact page or wherever you want after submission
    header("Location: index.html");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Me</title>
    <link rel="stylesheet" href="contactstyl.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<body>
    <div id="success_tic" class="modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <a class="close" href="#" data-dismiss="modal">&times;</a>
                <div class="page-body">
                    <div class="head">
                        <h3 style="margin-top:5px;">Message</h3>
                        <h4>Message sent successfully.</h4>
                    </div>
                    <h1 style="text-align:center;">
                        <div class="checkmark-circle">
                            <div class="background"></div>
                            <div class="checkmark draw"></div>
                        </div>
                    </h1>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="big-box">
            <div class="left-box">
                <img src="sujaladhikari.webp" alt="Your Photo" class="profile-pic">
                <div class="about-box">
                <p style="text-align: center;">HOPE TO SEE YOU AGAIN SOON</p>
                </div>
            </div>
            <div class="right-box">
                <h2>Contact Me</h2>
                <!-- Contact form -->
                <form id="contact-form" action="" method="post">
                    <input type="text" id="name" name="name" placeholder="Your Name" required>
                    <input type="email" id="email" name="email" placeholder="Your Email" required>
                    <textarea id="message" name="message" placeholder="Your Message" required></textarea>
                    <input type="submit" value="Send">
                </form>
                <div class="social-icons">
                    <a href="https://www.facebook.com/sujal.adhikari.73" target="_blank"><i class="fab fa-facebook"></i></a>
                    <a href="https://www.instagram.com/sujal_adhikari69/" target="_blank"><i class="fab fa-instagram"></i></a>
                    <a href="mailto:sujaladhikari149@gmail.com" target="_blank"><i class="fas fa-envelope"></i></a>
                    <a href="https://www.linkedin.com/in/sujal-adhikari-4906242b1/" target="_blank"><i class="fab fa-linkedin"></i></a>
                    <a href="https://github.com/SujalAdhikari-coder" target="_blank"><i class="fab fa-github"></i></a>
                </div>
            </div>
        </div>
    </div>

    <footer>
        <div class="container">
            <p>&copy; 2024 Sujal Adhikari All rights reserved.</p>
        </div>
    </footer>

    <script src="scripts.js"></script>
    <script>
        // scripts.js

document.addEventListener("DOMContentLoaded", function() {
    const form = document.getElementById("contact-form");
    const modal = document.getElementById("success_tic");

    form.addEventListener("submit", function(event) {
        event.preventDefault();
        // Assuming form validation and AJAX submission happen here
        // On successful submission:
        modal.style.display = "block";
    });

    const closeModal = document.querySelector(".close");
    closeModal.addEventListener("click", function() {
        modal.style.display = "none";
        window.location.href = "index.html";
    });

    window.addEventListener("click", function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
            window.location.href = "index.html";
        }
    });
});
    </script>
</body>
</html>
