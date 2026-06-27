

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Activity 2 - Cookies</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-6">

                <div class="card shadow">
                    <div class="card-body text-center">

                        <h4 class="mb-3">Cookies</h4>

                        <form action="cookie.php" method="post">
                            <p class="text-start mb-3"></p>

                        
                        </form>

                        <hr>

                        <h5>Cookie Output:</h5>

                        <div id="cookie-output" class="text-start">
                            <div id="first-line">
                                <?php if (isset($_COOKIE['firstname'])): ?>
                                    First Name: <?php echo $_COOKIE['firstname']; ?>
                                <?php else: ?>
                                    First Name: (waiting 10s)
                                <?php endif; ?>
                            </div>
                            <div id="middle-line" class="mt-1">
                                <?php if (isset($_COOKIE['middlename'])): ?>
                                    Middle Name: <?php echo $_COOKIE['middlename']; ?>
                                <?php else: ?>
                                    Middle Name: (waiting 20s)
                                <?php endif; ?>
                            </div>
                            <div id="last-line" class="mt-1">
                                <?php if (isset($_COOKIE['lastname'])): ?>
                                    Last Name: <?php echo $_COOKIE['lastname']; ?>
                                <?php else: ?>
                                    Last Name: (waiting 30s)
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="mt-3 d-flex justify-content-center">
                            <a href="index.php" class="btn btn-secondary me-2">Back</a>
                            <button class="btn btn-outline-secondary" id="refresh-btn">Refresh</button>
                        </div>

                        <script>
                            function readCookie(name) {
                                const v = document.cookie.match('(^|;)\\s*' + name + '\\s*=\\s*([^;]+)');
                                return v ? decodeURIComponent(v.pop()) : null;
                            }

                            function updateCookieDisplay(){
                                const f = readCookie('firstname');
                                const m = readCookie('middlename');
                                const l = readCookie('lastname');

                                const fEl = document.getElementById('first-line');
                                const mEl = document.getElementById('middle-line');
                                const lEl = document.getElementById('last-line');

                                fEl.textContent = f ? ('First Name: ' + f) : 'First Name: (waiting 10s)';
                                mEl.textContent = m ? ('Middle Name: ' + m) : 'Middle Name: (waiting 20s)';
                                lEl.textContent = l ? ('Last Name: ' + l) : 'Last Name: (waiting 30s)';
                            }

                            document.getElementById('refresh-btn').addEventListener('click', updateCookieDisplay);
                        </script>

                    </div>
                </div>

            </div>
        </div>
    </div>

</body>

</html>
