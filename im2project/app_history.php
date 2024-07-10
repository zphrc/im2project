<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Medical Clinic - Appointment History</title>
    <link rel="icon" type="image/x-icon" href="img/logo.png">
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <style>
        .content {
            max-height: 50vh;
            display: flex;
            flex-direction: column;
            align-items: center !important;/* Center content horizontally */
            padding: 30px;
        }
        .content h2 {
            margin: 0;
            color: #12229D;
        }
        .appointment-container {
            width: 100%;
            background-color: #fff;
            padding: 30px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }
        .no-appointments {
            text-align: center;
            margin-top: 20px;
            color: #777;
        }
    </style>
</head>
<body>

<nav class="navbar">
    <div class="navbar-brand">
    <a href="landing_page.php"><img src="img/horizontallogo.png" alt="Logo"></a>
    </div>
    <div class="profile-container">
        <a href="#" class="profile-icon" onclick="toggleDropdown()"><i class="fas fa-user-circle"></i></a>
        <div id="profile-dropdown" class="dropdown-content">
            <a href="edit_account.php">Profile</a>
            <a href="app_history.php">Appointment history</a>
            <hr>
            <a href="index2.php">Logout</a>
        </div>
    </div>
</nav>

<div class="content">
    <div class="appointment-container">
        <a class="return-link" href="landing_page.php">Return to dashboard</a>
        <h2>Appointment History</h2>
        <!-- Display Appointments -->

        <div class="search-filter-container">
            <input type="text" id="searchInput" placeholder="Search by Date...">
            <button onclick="searchAppointments()">Search</button>
            <select id="filterSelect">
                <option value="all">All</option>
                <option value="day">Day</option>
                <option value="week">Week</option>
                <option value="month">Month</option>
                <option value="year">Year</option>
            </select>
            <button onclick="filterAppointments()">Filter</button>
        </div>

        <table class="table">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Appointment Type</th>
                    <th>Reason</th>
                    <th>Prescription</th>
                </tr>
            </thead>
            <tbody id="appointmentHistory">
                <!-- Appointments will be dynamically inserted here -->
            </tbody>
        </table>
        <p id="noAppointmentsMessage" class="no-appointments" style="display: none;">No appointments found.</p>
    </div>
</div>

<script>
    function toggleDropdown() {
        var dropdown = document.getElementById("profile-dropdown");
        if (dropdown.style.display === "block") {
            dropdown.style.display = "none";
        } else {
            dropdown.style.display = "block";
        }
    }

    // Close the dropdown if the user clicks outside of it
    window.onclick = function(event) {
        if (!event.target.matches('.profile-icon i')) {
            var dropdowns = document.getElementsByClassName("dropdown-content");
            for (var i = 0; i < dropdowns.length; i++) {
                var openDropdown = dropdowns[i];
                if (openDropdown.style.display === "block") {
                    openDropdown.style.display = "none";
                }
            }
        }
    }
    document.addEventListener('DOMContentLoaded', function() {
        fetchAppointmentHistory();
    });

    function fetchAppointmentHistory() {
        fetch('fetch_appointments.php')
            .then(response => response.json())
            .then(data => {
                renderAppointments(data);
            })
            .catch(error => {
                console.error('Error fetching appointment data:', error);
            });
    }

    function renderAppointments(appointments) {
        const tbody = document.getElementById('appointmentHistory');
        const noAppointmentsMessage = document.getElementById('noAppointmentsMessage');
        tbody.innerHTML = ''; // Clear existing records

        if (appointments.length === 0) {
            noAppointmentsMessage.style.display = 'block';
        } else {
            noAppointmentsMessage.style.display = 'none';
            appointments.forEach((appointment, index) => {
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td>${appointment.date_preference}</td>
                    <td>${appointment.time_preference}</td>
                    <td>${appointment.appointment_type}</td>
                    <td>${appointment.reason}</td>
                    <td><button class="btn" onclick="viewPrescription(${appointment.id})"><i class="fas fa-file-prescription"></i> View Prescription</button></td>
                `;
                
                if (index % 2 === 0) {
                    row.classList.add('even-row');
                } else {
                    row.classList.add('odd-row');
                }

                tbody.appendChild(row);
            });
        }
    }

    function viewPrescription(appointmentId) {
        // Replace with your logic to handle viewing prescription for the specific appointment ID
        // Example: Redirect to a prescription viewing page
        window.location.href = `view_prescription.php?appointmentId=${appointmentId}`;
    }
</script>

</body>
</html>
