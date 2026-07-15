<?php

$basepath = '';
$pagetitle = "Home";

require('includes/Buyerheader.php');
?>

<main>
    <section class="landing-page">
        <div class="container">
            <div class="row align-items-center g-5">
                <div class="col-lg-6">
                    <p class="landing-subtitle">Premium instruments and studio essentials</p>

                    <h1 class="landing-title">Find Your Sound. Play Your Encore.</h1>

                    <p class="landing-description">
                        Explore curated guitars, keyboards, drums, and audio gear selected for players who care about tone, feel, and lasting craftsmanship.
                    </p>

                    <div class="landing-actions">
                        <a href="buyer/store.php" class="btn btn-register btn-lg">
                            Shop Collection
                        </a>

                        <a href="#featured-products" class="btn btn-outline-premium btn-lg">
                            View Featured
                        </a>
                    </div>

                    <div class="trust-strip">
                        <div>
                            <strong>Curated</strong>
                            <span>Trusted brands</span>
                        </div>
                        <div>
                            <strong>Premium</strong>
                            <span>Player-ready gear</span>
                        </div>
                        <div>
                            <strong>Local</strong>
                            <span>Manila support</span>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 text-center">
                    <div class="hero-product-showcase">
                        <img src="assets/images/landing-image.png"
                            class=   "landing-image img-fluid"
                            alt="Premium musical instruments at Encore Music Store">
                        <div class="hero-product-note">
                            <span>Signature Collection</span>
                            <strong>Stage and studio ready</strong>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </section>

    <section class="featured-products-section" id="featured-products">

        <div class="container">

            <div class="section-heading">
                <div>
                    <p class="section-kicker">Featured selection</p>

                    <h2 class="section-title">
                        Instruments worth reaching for.
                    </h2>

                    <p class="section-description">
                        A focused edit of best-selling pieces with clean design, reliable tone, and professional finish.
                    </p>
                </div>

                <a href="buyer/store.php" class="section-link">Shop all products <i class="bi bi-arrow-right"></i></a>
            </div>

            <div class="row g-4">

                <div class="col-lg-3 col-md-6">
                    <div class="product-card">
                        <img src="assets/images/yamaha310.jpg"
                            class="product-image"
                            alt="Yamaha F310 acoustic guitar">

                        <div class="product-content">
                            <p class="product-category">Acoustic Guitar</p>
                            <h5>Yamaha F310</h5>
                            <h4 class="product-price">PHP 9,990</h4>

                            <a href="cart.php" class="btn btn-register w-100">Add to Cart</a>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6">
                    <div class="product-card">
                        <img src="assets/images/roland.jpg"
                            class="product-image"
                            alt="Roland digital piano">

                        <div class="product-content">
                            <p class="product-category">Digital Piano</p>
                            <h5>Roland FP-10</h5>
                            <h4 class="product-price">PHP 34,990</h4>

                            <a href="cart.php" class="btn btn-register w-100">Add to Cart</a>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6">
                    <div class="product-card">
                        <img src="assets/images/electricG.jpg"
                            class="product-image"
                            alt="Encore Studio electric guitar">

                        <div class="product-content">
                            <p class="product-category">Electric Guitar</p>
                            <h5>Encore Studio Electric</h5>
                            <h4 class="product-price">PHP 28,490</h4>

                            <a href="cart.php" class="btn btn-register w-100">Add to Cart</a>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6">
                    <div class="product-card">
                        <img src="assets/images/amplifier.jpg"
                            class="product-image"
                            alt="Classic stage guitar">

                        <div class="product-content">
                            <p class="product-category">Audio Equipment</p>
                            <h5>Classic Stage Guitar</h5>
                            <h4 class="product-price">PHP 15,750</h4>

                            <a href="cart.php" class="btn btn-register w-100">Add to Cart</a>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </section>

    <section class="brand-values-section">
        <div class="container">
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="value-item">
                        <i class="bi bi-gem"></i>
                        <h3>Premium Curation</h3>
                        <p>Every product is presented with the clarity and restraint expected from a modern luxury store.</p>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="value-item">
                        <i class="bi bi-soundwave"></i>
                        <h3>Made for Tone</h3>
                        <p>From first chord to final mix, the catalog puts musical quality before visual noise.</p>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="value-item">
                        <i class="bi bi-bag-check"></i>
                        <h3>Effortless Shopping</h3>
                        <p>Clean cards, readable pricing, and responsive layouts keep browsing quick and confident.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

</main>

<?php require('includes/footer.php');
?>
