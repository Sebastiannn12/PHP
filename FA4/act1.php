<?php require 'header.php'; ?>

<h2>Laboratory Activity 1 - Web Based Form Stories</h2>
<p>Select a button below to load your preferred short story composition instantly into the active display viewport:</p>

<div class="story-btn-row">
    <?php
    $current_story = isset($_GET['story']) ? (int) $_GET['story'] : 1;

    for ($i = 1; $i <= 5; $i++) {
        $activeClass = ($current_story === $i) ? 'active' : '';
        echo "<a href='act1.php?story={$i}' class='story-select-btn {$activeClass}'>Story {$i}</a>";
    }
    ?>
</div>

<div class="story-box">
    <?php
    if ($current_story === 1) {
        echo "<h3>Story 1: The Digital Frontier</h3>";
        echo "<img src='https://images.unsplash.com/photo-1518770660439-4636190af475?w=600' class='story-img' alt='Digital Frontier Image'>";
        echo "<p>In the digital city, systems relied on clean logic structures to keep data running seamlessly.</p>";
    } elseif ($current_story === 2) {
        echo "<h3>Story 2: Server Room Echoes</h3>";
        echo "<img src='https://images.unsplash.com/photo-1558494949-ef010cbdcc31?w=600' class='story-img' alt='Server Room Image'>";
        echo "<p>A technician monitored core runtime logs to ensure global constant parameters were valid.</p>";
    } elseif ($current_story === 3) {
        echo "<h3>Story 3: The Quantum Code</h3>";
        echo "<img src='https://images.unsplash.com/photo-1635070041078-e363dbe005cb?w=600' class='story-img' alt='Quantum Loop Image'>";
        echo "<p>When traditional loops hit physical computational limits, an experimental logic script stepped in.</p>";
    } elseif ($current_story === 4) {
        echo "<h3>Story 4: Legacy Systems</h3>";
        echo "<img src='https://images.unsplash.com/photo-1516321318423-f06f85e504b3?w=600' class='story-img' alt='Legacy Architecture Image'>";
        echo "<p>An outdated line of string processing modules continued working reliably despite its age.</p>";
    } elseif ($current_story === 5) {
        echo "<h3>Story 5: The Virtual Oasis</h3>";
        echo "<img src='https://images.unsplash.com/photo-1451187580459-43490279c0fa?w=600' class='story-img' alt='Virtual Runtime Image'>";
        echo "<p>Deep inside clean sandboxed runtimes, localized code instances operated completely bug-free.</p>";
    } else {
        echo "<p style='color: red;'>Story element selection reference out of range.</p>";
    }
    ?>
</div>

<?php include 'footer.php'; ?>