<?php

require 'user/includes/vendor/autoload.php'; // For MongoDB connection

// Connect to MongoDB
$client = new MongoDB\Client("mongodb+srv://cadibal:Nevinotech512@cadibal.asets.mongodb.net/");
$collection = $client->mcq->announcements;

// Fetch the latest announcements
$cursor = $collection->find([], ['sort' => ['date' => -1], 'limit' => 5]);

$announcements = [];
foreach ($cursor as $document) {
    $announcements[] = [
        "title" => $document['title'],
        "description" => $document['description'],
        "date" => $document['date']
    ];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="CADIBAL connects developers worldwide through seamless tools and resources. Learn, collaborate, and grow with us.">
    <meta name="keywords" content="developers, tools, collaboration, online assessments, CADIBAL, tech community">
    <meta name="author" content="CADIBAL">
    <title>CADIBAL - Connecting Developers Worldwide</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        /* Global Styles */
        body {
        font-family: 'Poppins', sans-serif;
        background-color: #f8f9fa;
        color: #212529;
        }

        /* Header Gradient Text for Brand */
        .text-gradient {
        color: #FF914D; /* Vibrant orange */
        font-weight: bold;
        }

        /* Social Media Icons */
        .social-icon {
        font-size: 1rem;
        transition: transform 0.3s ease, color 0.3s ease;
        }
        .social-icon:hover {
        transform: scale(1.2); /* Enlarge icon on hover */
        color: #FF914D;
        }

        /* Hero Section */
        .hero-section {
        background-color: #FF914D; /* Vibrant orange */
        color: #FFFFFF; /* Clean white text */
        text-align: center;
        padding: 50px 20px;
        }
        .hero-section h1 {
        font-size: 3.5rem;
        font-weight: bold;
        margin-bottom: 10px;
        }
        .hero-section p {
        font-size: 1.2rem;
        font-weight: 400;
        }

        /* Announcements Section */
        .announcements {
        background-color: #D2E3FC; /* Light blue background */
        padding: 50px 20px;
        border-radius: 10px; /* Smooth edges */
        margin-bottom: 30px;
        }
        .announcements h2 {
        color: #37474F; /* Dark gray for headings */
        font-weight: bold;
        text-align: center;
        margin-bottom: 30px;
        }
        .announcements .card {
        border: none;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .announcements .card:hover {
        transform: translateY(-8px);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
        }
        .announcements .card-title {
        font-size: 1.25rem;
        font-weight: 600;
        color: #34495e; /* Dark blue-gray */
        margin-bottom: 10px;
        }
        .announcements .card-text {
        color: #7f8c8d; /* Muted gray */
        font-size: 1rem;
        }


        /* Date Styling */
        .announcements .card-text small {
            color: #95a5a6; /* Light gray for the date text */
            font-weight: 500;
        }

        /* Mobile Responsiveness */
        @media (max-width: 768px) {
            .announcements h2 {
                font-size: 2rem;
            }

            .announcements .card-title {
                font-size: 1.1rem;
            }

            .announcements .card-text {
                font-size: 0.95rem;
            }
        }

        /* Card Container */
        .card-container {
            max-width: 900px;
            padding: 20px;
            background: #fff;
            border-radius: 15px;
            /* box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2); */
            text-align: center;
        }

        .card-container h2 {
            color: #34495e;
            font-weight: 700;
            margin-bottom: 30px;
            text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.2);
        }

        /* Individual Cards */
        .custom-card {
            background: #FFFFFF;
            border: none;
            border-radius: 15px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            text-align: center;
        }

        .custom-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.3);
        }

        /* Card Icon */
        .custom-card .card-icon {
            font-size: 3rem;
            color: #2575fc;
            margin-bottom: 15px;
        }

        .custom-card .card-title {
            font-weight: 600;
            color: #34495e;
            margin-bottom: 10px;
        }

        .custom-card .card-text {
            font-size: 0.95rem;
            color: #7f8c8d;
        }

        /* Buttons */
        .btn-custom {
            background: #f09819;
            color: #fff;
            font-weight: 600;
            border: none;
            padding: 9px 18px;
            border-radius: 50px;
            transition: all 0.3s ease-in-out;
        }

        .btn-custom:hover {
            background: #D2E3FC;
            transform: scale(1);
        }
       /* Previous Test Section Styling */
        .test-section {
            background-color: #6a11cb; /* Solid dark blue-violet */
            color: #FFFFFF; /* Clean white text */
            padding: 20px 20px;
            position: relative;
            overflow: hidden;
            border-radius: 10px; /* Smooth edges for a modern look */
        }

        .test-section::before {
            content: '';
            position: absolute;
            top: -50px;
            right: -50px;
            width: 200px;
            height: 200px;
            background-color: rgba(255, 255, 255, 0.2); /* Subtle effect for visual interest */
            border-radius: 50%;
            animation: pulse 8s infinite ease-in-out;
        }

        .test-section h2 {
            font-size: 1.8rem;
            font-weight: bold;
            margin-bottom: 20px;
            text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.2); /* Subtle shadow for text */
        }

        .test-section p {
            font-size: 1rem;
            margin-bottom: 30px;
        }

        .test-section .btn-custom {
            background-color: #FF914D; /* Vibrant orange button */
            color: #FFFFFF; /* White text for contrast */
            font-weight: bold;
            padding: 10px 28px;
            border-radius: 50px;
            transition: all 0.3s ease;
            text-transform: uppercase;
        }

        .test-section .btn-custom:hover {
            background-color: #D2E3FC; /* Light blue hover effect */
            transform: scale(1.1);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
        }

        /* Animation for Circle */
        @keyframes pulse {
            0%, 100% {
                transform: scale(1);
                opacity: 1;
            }
            50% {
                transform: scale(1.5);
                opacity: 0.5;
            }
        }


        /* Responsive Design */
        @media (max-width: 768px) {
            .test-section h2 {
                font-size: 2rem;
            }

            .test-section p {
                font-size: 1rem;
            }
        }

        /* Animation for Circle */
        @keyframes pulse {
            0%, 100% {
                transform: scale(1);
                opacity: 1;
            }
            50% {
                transform: scale(1.5);
                opacity: 0.5;
            }
        }
        @keyframes fadeIn {
        0% { opacity: 0; }
        100% { opacity: 1; }
        }

          /* Fade-in effect for the title */
        @keyframes fadeIn {
            0% { opacity: 0; }
            100% { opacity: 1; }
        }

        /* Hover effect for cards */
        .hover-shadow:hover {
            transform: translateY(-10px);
            box-shadow: 0 12px 24px rgba(0, 0, 0, 0.15);
        }

        /* Button hover effect */
        .btn-primary:hover {
            background-color: #2980b9;
            border-color: #2980b9;
        }
        /* Card Hover Effects */
        .card:hover {
            transform: translateY(-10px);
            box-shadow: 0 12px 24px rgba(0, 0, 0, 0.2);
        }

        /* Heading Fade-in Animation */
        @keyframes fadeIn {
            0% { opacity: 0; transform: translateY(-20px); }
            100% { opacity: 1; transform: translateY(0); }
        }
        /* Fade-in Animation */
        @keyframes fadeIn {
            0% { opacity: 0; transform: translateY(-20px); }
            100% { opacity: 1; transform: translateY(0); }
        }

        /* Card Hover Effect */
        .card:hover {
            transform: translateY(-10px);
            box-shadow: 0 12px 24px rgba(0, 0, 0, 0.2);
        }


        /* Footer */
        footer {
            position: fixed;
            bottom: 0;
            width: 100%;
            background-color: #37474F;
            color:#FFFFFF;
            padding: 15px 0;
            text-align: center;
            margin-top: 30px;
        }

        footer p {
            margin: 0;
            font-size: 0.9rem;
        }

        footer a {
            color: #007bff;
            text-decoration: none;
        }

        footer a:hover {
            text-decoration: underline;
        }
       
    </style>
</head>
<body>
<header class="py-1" style="background-color:#D2E3FC;">
    <div class="container d-flex justify-content-between align-items-center">
        <!-- Logo / Brand -->
        <a href="index.php" class="navbar-brand fw-bold fs-4 text-gradient">
            <!-- <img src="images/logo/logo2.png" alt="" width="50px">&nbsp; -->
            CADIBAL
        </a>

        <!-- Social Media Icons -->
        <div class="d-flex align-items-center">
            <a href="https://www.facebook.com/profile.php?id=61565720930346" target="_blank" class="text-light mx-2 social-icon">
            <img src="images/icons/facebook.png" alt="" width="20px">
                <!-- <i class="fab fa-facebook"></i> -->
            </a>
            <a href="https://x.com/cadibal_info" target="_blank" class="text-light mx-2 social-icon">
            <img src="images/icons/twitter.png" alt="" width="20px">
            </a>
            <a href="https://www.linkedin.com/company/cadibaltech" target="_blank" class="text-light mx-2 social-icon">
            <img src="images/icons/linkedin.png" alt="" width="20px">
            </a>
            <a href="https://www.instagram.com/cadibal.info" target="_blank" class="text-light mx-2 social-icon">
            <img src="images/icons/instagram.png" alt="" width="20px">
            </a>
            <a href="https://wa.me/919080373739" target="_blank" class="text-light mx-2 social-icon">
            <img src="images/icons/whatsapp.png" alt="" width="20px">
            </a>
        </div>
    </div>
</header>

<!-- Hero Section -->
<div class="hero-section">
    <h1>Welcome to the Exam Portal</h1>
    <p>Your gateway to online assessments and knowledge testing.</p>
</div>
<section class="announcements py-1">
    <div class="container">
        <h2 class="text-center mb-4">Latest Announcements</h2>
        <div class="row">
            <?php if (empty($announcements)): ?>
                <p class="text-center text-muted">No announcements available.</p>
            <?php else: ?>
                <?php foreach ($announcements as $announcement): ?>
                    <div class="col-md-4 mb-4">
                        <div class="card h-100 shadow-sm border-0">
                            <div class="card-body">
                                <h5 class="card-title text-primary"><?php echo htmlspecialchars($announcement['title']); ?></h5>
                                <p class="card-text text-muted">
                                    <small><i class="bi bi-calendar-event"></i> <?php echo htmlspecialchars($announcement['date']); ?></small>
                                </p>
                                <p class="card-text"><?php echo htmlspecialchars($announcement['description']); ?></p>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
</section>

<!-- Main Section -->
<div class="container card-container">
    <div class="row justify-content-center">
        <!-- Admin Login Card -->
        <div class="col-md-5 mx-3 mb-4">
            <div class="custom-card p-4">
                <i class="fas fa-user-shield card-icon"></i>
                <h5 class="card-title">Admin Login</h5>
                <p class="card-text">Manage exams, users, and monitor progress effortlessly.</p>
                <a href="admin/" class="btn btn-custom">Login as Admin</a>
            </div>
        </div>

        <!-- User Login Card -->
        <div class="col-md-5 mx-3 mb-4">
            <div class="custom-card p-4">
                <i class="fas fa-user card-icon"></i>
                <h5 class="card-title">User Login</h5>
                <p class="card-text">Access tests, track performance, and grow your skills.</p>
                <a href="user/" class="btn btn-custom">Login as User</a>
            </div>
        </div>
    </div>

</div>
<!-- Test Preview Section -->
<section class="test-section text-center">
    <div class="container">
        <h2>Try a Sample Test</h2>
        <p>Experience the demo version of our advanced testing system!</p>
        <button class="btn btn-custom" onclick="window.location.href='sample_test.php'">Start Demo Test</button>
    </div>
</section>

<!-- Blog Section -->
<section class="blog-section py-5" style="background-color: #FFFFFF; border-radius: 15px; box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1); overflow: hidden;">
    <div class="container">
        <!-- Main Heading with Animation -->
        <h2 class="text-center mb-4" style="font-size: 1.3rem; font-weight: 700; color: #34495e; text-transform: uppercase; letter-spacing: 1px; animation: fadeIn 1.5s ease;">
            Tips to Excel in Online Assessments
        </h2>
        
        <!-- Subheading with Different Font Style and Size -->
        <p class="text-center mb-5" style="font-size: 1rem; color: #7f8c8d; font-weight: 300; line-height: 1.5;">
            Mastering online assessments is key to acing your career journey. Here are some tips that can help you get ahead
        </p>
        
        <!-- Card Section -->
        <div class="row text-center">
            <!-- Time Management Card -->
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card border-0 shadow-sm" style="border-radius: 12px; transition: transform 0.3s, box-shadow 0.3s;">
                    <div class="card-body py-5">
                        <img src="images/icons/time.gif" width="70px" class="mb-3" alt="Time Management">
                        <h5 class="card-title" style="font-size: 1.2rem; font-weight: 600; color: #FF914D;">Time Management</h5>
                        <p class="card-text" style="font-size: 1rem; font-weight: 300; color: #7f8c8d;">Master time management techniques to ensure you finish tests on time with precision.</p>
                    </div>
                </div>
            </div>
            
            <!-- Stable Internet Card -->
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card border-0 shadow-sm" style="border-radius: 12px; transition: transform 0.3s, box-shadow 0.3s;">
                    <div class="card-body py-5">
                        <img src="images/icons/hotspot.gif" width="70px" class="mb-3" alt="Stable Internet">
                        <h5 class="card-title" style="font-size: 1.2rem; font-weight: 700; color: #FF914D;">Stable Internet</h5>
                        <p class="card-text" style="font-size: 1rem; font-weight: 400; color: #7f8c8d;">Ensure a reliable and fast internet connection to avoid interruptions during tests.</p>
                    </div>
                </div>
            </div>
            
            <!-- Test Format Card -->
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card border-0 shadow-sm" style="border-radius: 12px; transition: transform 0.3s, box-shadow 0.3s;">
                    <div class="card-body py-5">
                        <img src="images/icons/exam.gif" width="70px" class="mb-3" alt="Understand Test Format">
                        <h5 class="card-title" style="font-size: 1.2rem; font-weight: 700; color: #FF914D;">Understand Test Format</h5>
                        <p class="card-text" style="font-size: 1rem; font-weight: 400; color: #7f8c8d;">Familiarize yourself with the test structure and types of questions before you start.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<div class="text-center mt-5">
    <a href="https://cadibal.in/about.html" target="_blank" class="btn btn-primary" style="font-size: 1rem; font-weight: 650; padding: 8px 20px; border-radius: 50px; border-width: 2px; transition: background-color 0.3s;">
        Learn More About Us
    </a>
</div>
<br>
<br>
<br>
<br>

<!-- Footer -->
<footer>
    <p>&copy; <?php echo date("Y"); ?> Exam Portal. All rights reserved. | <a href="files/CADIBAL Private Policy.pdf" target="_blank">Privacy Policy</a></p>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
