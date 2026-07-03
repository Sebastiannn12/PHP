

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($pageTitle); ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <header class="site-header d-flex align-items-center gap-3 px-4 px-md-5 py-4">
        <div class="logo-box d-flex align-items-center justify-content-center">T3</div>
        <div>
            <p class="small-label mb-0"><?php echo htmlspecialchars($headerLabel); ?></p>
            <h1 class="mb-0 fs-4"><?php echo htmlspecialchars($headerTitle); ?></h1>
        </div>
    </header>
