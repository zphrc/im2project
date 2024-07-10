<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Medical Clinic</title>
    <link rel="icon" type="image/x-icon" href="img\logo.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="styles.css">
    <style>
        .loginbtn {
            margin-right: 40px;
        }
        .bookappbtn {
            width: fit-content;
            align-text: center;
            font-size: 1.0rem;
        }
        .content {
            max-height: 80vh;
            margin: 0;
        }
        .content2 {
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 20px;
            margin-top: 80px;
            margin-bottom: -2px;
        }
        .content h2, .content p {
            text-align: center;
            color: #fff;
            margin-top: 10px;
        }
        .content h2 {
            font-size: 2.0rem;
        }
        .content p {
            margin-top: -10px;
            font-size: 1.0rem;
        }
        /* .doctor {
            width: 100%;
            background-color: #fff;
            display: flex;
            align-items: center;
        } */
        .d-image-section {
            margin: 30px 80px;
        }
        .d-image-section img {
            flex: 1;
            display: block;
            max-height: 200px;
        }
        .d-text-section {
            margin-top: -20px;
        }
        .d-text-section h3, .d-text-section p {
            color: #12229D;
            text-align: left;
        }
        .faq {
            background-color: #12229D;
            margin-top: 30px;
            padding: 30px;
        }
        .faq h2 {
            margin-top: 20px;
        }
        .faq-container {
            display: flex;
            justify-content: space-between;
        }
        .faq-container2 {
            flex: 1;
            background-color: #fff;
            border-radius: 10px;
            padding: 20px;
        }
        .faq-container2 h3, .faq-container2 p {
            color: #12229D;
            text-align: left;
        }
        .footer {
            padding: 30px;
            background-color: #fff;
            display: flex;
            align-items: center;
            color: #12229D;
        }
        .footer-1 {
            text-align: center;
            width: 100%;
            border: 1px solid red;
        }
        .footer-1 p, .footer-1 h3 {
            color: #12229D;
        }
    </style>
</head>
    <body>
        <nav class="navbar">
            <div class="navbar-brand">
                <img src="img/horizontallogo.png" alt="Logo">
            </div>
            <button class="loginbtn"><a href="index2.php" style="text-decoration: none; color: #fff;">Log in</a></button>
        </nav>
        <div class="content">
            <div class="content2">
                    <h2>Your Health, Our Priority.</h2>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi luctus sapien odio, at auctor massa molestie a. Donec ut faucibus mauris. Donec auctor augue enim, a iaculis magna viverra id.</p>
                    <button class="bookappbtn"><a href="#" style="text-decoration: none; color: #fff;">Book an appointment</a></button>
            </div>
            <div class="faq">
                <h2>How to book an appointment</h2>
                <div class="faq-container">
                    <div class="faq-container2">
                        <h3>Step 1</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse vitae fringilla urna. Etiam consequat ligula quis cursus tincidunt. Nullam orci metus, aliquet in nulla et, convallis facilisis ante. Nulla iaculis quis quam vitae fermentum. Sed id orci est. In hac habitasse platea dictumst.</p>
                    </div>
                    <div class="faq-container2" style="margin: 0 30px;">
                        <h3>Step 2</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse vitae fringilla urna. Etiam consequat ligula quis cursus tincidunt. Nullam orci metus, aliquet in nulla et, convallis facilisis ante. Nulla iaculis quis quam vitae fermentum. Sed id orci est. In hac habitasse platea dictumst.</p>
                    </div>
                    <div class="faq-container2">
                        <h3>Step 3</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse vitae fringilla urna. Etiam consequat ligula quis cursus tincidunt. Nullam orci metus, aliquet in nulla et, convallis facilisis ante. Nulla iaculis quis quam vitae fermentum. Sed id orci est. In hac habitasse platea dictumst.</p>
                    </div>
                </div>
            </div>
            <!-- <div class="doctor">
                <div class="d-image-section">
                    <img src="img\doctor.png">
                </div>
                <div class="d-text-section">
                    <h3>Dr. John Doe</h3>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi luctus sapien odio, at auctor massa molestie a. Donec ut faucibus mauris. Donec auctor augue enim, a iaculis magna viverra id.</p>
                </div>
            </div> -->
            <div class="footer">
                <div class="footer-1">
                    <h3>Contact Information</h3>
                    <p>P. del Rosario St., Cebu City, 6000, Philippines</p>
                    <p>Email: info@usc.edu.ph</p>
                </div>
            </div>
        </div>
        <script src="" async defer></script>
    </body>
</html>