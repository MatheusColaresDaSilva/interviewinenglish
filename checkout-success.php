<?php
$plan = $_POST['plan'] ?? null;
$validPlans = ['basic', 'standard', 'executive'];

if (!$plan || !in_array($plan, $validPlans)) {
    http_response_code(403);
    die("Unauthorized access");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>InterView In English - Calendly</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Free HTML Templates" name="keywords">
    <meta content="Free HTML Templates" name="description">

    <!-- Favicon -->
    <link href="img/LOGO-02.jpg" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">


    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/style.css" rel="stylesheet">


    <script src="https://assets.calendly.com/assets/external/widget.js" type="text/javascript"></script>

    <style>
    html, body {
    margin: 0;
    padding: 0;
    height: 100%;
    overflow-x: hidden; /* remove scroll lateral */
}

#schedule {
    width: 100%;
    max-width: 100vw;
    height: calc(100vh - 120px); /* ajusta altura total menos o navbar (~120px) */
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 0;
}

.calendly-inline-widget {
    width: 100%;
    height: 100% !important;
    min-height: 100% !important;
}
</style>
</head>

<body>

    <!-- Navbar Start -->
    <div class="container ps-lg-0 pe-lg-0">
        <nav class="navbar navbar-expand-lg bg-light navbar-light py-5 py-lg-0">
            <a href="index.php" class="text-decoration-none d-block">
                <h4 class="logo-heading fw-bold" style="font-size: 26px;">
                    <span class="text-primary fw-bold" style="font-weight: bolder;">InterView</span>&nbsp;In English
                </h4>
            </a>
                    
            </div>
        </nav>
    </div>
    
    <div id="schedule" class="container-fluid p-0"></div>
    

    <script type="text/javascript">
        var plan = "<?= htmlspecialchars($plan) ?>";
        var calendlyUrls = {
        'basic': 'https://calendly.com/interview-in-english-basic-plan',
        'standard': 'https://calendly.com/interview-in-english-standard-plan',
        'executive': 'https://calendly.com/interview-in-english-premium-plan'
        };
        var calendlyUrl = calendlyUrls[plan] || calendlyUrls['basic'];
        Calendly.initInlineWidget({
        url: calendlyUrl,
        parentElement: document.getElementById('schedule'),
        prefill: {},
        utm: {}
        });
    </script>

</body>

</html>