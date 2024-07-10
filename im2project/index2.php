<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Medical Clinic</title>
    <link rel="icon" type="image/x-icon" href="img\logo.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXGEL0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <div class="form-container">
            <div class="l-image-section">
                <img src="img\loginlogo.png" alt="loginlogo" id="loginImage">
            </div>
            <div id="Login">
                <h2>Login</h2>
                <?php
                session_start();
                if (isset($_SESSION['login_error'])) {
                    echo '<p class="error">' . $_SESSION['login_error'] . '</p>';
                    unset($_SESSION['login_error']);
                }
                ?>
                <form action="login.php" method="post">
                    <input type="email" id="email" name="email" placeholder="Email" required>
                    <input type="password" id="password" name="password" placeholder="Password" required>
                    <p class="forgot-password"><a href="javascript:void(0);" onclick="showForgotPassword()">Forgot password?</a></p>
                    <button type="submit" class="loginbtn">Sign in</button>
                    <p>Don't have an account? <a href="javascript:void(0);" onclick="showRegister()" class="registerlink">Register</a></p>
                </form>
            </div>
        </div>

        <div id="Register" style="display: none;">
            <div class="r-image-section">
                <img src="img/horizontallogo.png" alt="horizontallogo" id="registerImage">
            </div>
            <h2>Register</h2>
            <form action="register.php" method="post">
                <input type="text" id="fname" name="first_name" placeholder="First name" required>
                <input type="text" id="lname" name="last_name" placeholder="Last name" required>
                <input type="text" id="address" name="address" placeholder="Address" required>
                <input type="date" id="dob" name="dob" placeholder="Date of birth" required>
                <input type="tel" id="phone" name="phone_number" pattern="[0-9]{4} [0-9]{3} [0-9]{4}" placeholder="Phone number (e.g. 0917 123 4567)" oninput="formatPhoneNumber(this)" maxlength="13" required>
                <input type="email" id="email" name="email" placeholder="Email" pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}" title="Enter a valid email address" required>
                <input type="password" id="psw" name="password" placeholder="Password" pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[^\da-zA-Z]).{8,}$" title="Password must be at least 8 characters long and include at least one lowercase letter, one uppercase letter, one number, and one special character" required>
                <div class="show-password-container">
                    <input type="checkbox" onclick="showHidePass()" id="showPasswordCheckbox">
                    <label for="showPasswordCheckbox" class="show-password-label">Show Password</label>
                </div>
                <input type="password" id="confirmPassword" name="confirmPassword" placeholder="Confirm your password" required>
                <span id="passwordError" class="password-error"></span>
                <button type="submit" id="r-btn" class="registerbtn">Register</button>
                <p>Already have an account? <a href="javascript:void(0);" onclick="showLogin()" class="loginlink">Login</a></p>
            </form>
        </div>

        <div id="ForgotPassword" style="display: none;">
            <h2>Forgot Password</h2>
            <form id="reset-form" action="/forgot-password" method="post">
                <p>Send password change instructions through:</p>
                <div class="radioop">
                    <input type="radio" id="email-option" name="reset-method" value="email" checked onchange="toggleResetMethod()">
                    <label for="email-option">Email</label><br>

                    <input type="radio" id="phone-option" name="reset-method" value="phone" onchange="toggleResetMethod()">
                    <label for="phone-option">SMS</label><br>
                </div>
        
                <div id="email-section" style="display: none;">
                    <input type="email" id="reset-email" name="reset-email" placeholder="Enter your email" required>
                </div>
                
                <div id="phone-section" style="display: none;">
                    <input type="tel" id="reset-phone" name="reset-phone" placeholder="Enter your phone number">
                </div>
        
                <button type="submit" class="forgotpassbtn">Reset Password</button>
                <p>Remember your password? <a href="javascript:void(0);" onclick="showLogin()" class="loginlink">Login</a></p>
            </form>
        </div>
    </div>

    <script>
        function showLogin() {
            document.getElementById('Login').style.display = 'block';
            document.getElementById('Register').style.display = 'none';
            document.getElementById('ForgotPassword').style.display = 'none';
            document.getElementById('loginImage').style.display = 'block';
            document.getElementById('registerImage').style.display = 'none';
        }

        function showRegister() {
            document.getElementById('Login').style.display = 'none';
            document.getElementById('Register').style.display = 'block';
            document.getElementById('ForgotPassword').style.display = 'none';
            document.getElementById('registerImage').style.display = 'block';
            document.getElementById('loginImage').style.display = 'none';
        }

        function showForgotPassword() {
            document.getElementById('Login').style.display = 'none';
            document.getElementById('Register').style.display = 'none';
            document.getElementById('ForgotPassword').style.display = 'block';
            document.getElementById('registerImage').style.display = 'none';
            document.getElementById('loginImage').style.display = 'none';
            
            document.getElementById('email-section').style.display = 'none';
            document.getElementById('phone-section').style.display = 'none';


            document.getElementById('email-option').checked = false;
            document.getElementById('phone-option').checked = false;
        }

        function toggleResetMethod() {
            var emailSection = document.getElementById('email-section');
            var phoneSection = document.getElementById('phone-section');
            var emailOption = document.getElementById('email-option');

            if (emailOption.checked) {
                emailSection.style.display = 'block';
                phoneSection.style.display = 'none';
            } else {
                emailSection.style.display = 'none';
                phoneSection.style.display = 'block';
            }
        }

        function formatPhoneNumber(input) {
            var cleaned = input.value.replace(/\D/g, '');
            
            var formattedNumber = '';
            if (cleaned.length > 0) {
                if (cleaned.length <= 4) {
                    formattedNumber = cleaned;
                } else if (cleaned.length <= 7) {
                    formattedNumber = cleaned.slice(0, 4) + ' ' + cleaned.slice(4);
                } else {
                    formattedNumber = cleaned.slice(0, 4) + ' ' + cleaned.slice(4, 7) + ' ' + cleaned.slice(7);
                }
            }

            input.value = formattedNumber;

            if (input.value.trim() === '') {
                input.value = '';
            }
        }

        function showHidePass() {
            const passwordField = document.getElementById('psw');
            if (passwordField.type === 'password') {
                passwordField.type = 'text';
            } else {
                passwordField.type = 'password';
            }
        }

        document.getElementById('confirmPassword').addEventListener('input', function() {
            const password = document.getElementById('psw').value;
            const confirmPassword = this.value;
            const passwordError = document.getElementById('passwordError');
            const registerBtn = document.getElementById('r-btn');

            if (password !== confirmPassword) {
                passwordError.textContent = 'Passwords do not match';
                registerBtn.disabled = true;
            } else {
                passwordError.textContent = '';
                registerBtn.disabled = false;
            }
        });

    </script>
</body>
</html>
