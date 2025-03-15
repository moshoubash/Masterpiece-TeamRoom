<nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm sticky-top">
    <div class="container">
        <a class="navbar-brand fw-bold" href="/p2p">SpaceMeet</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="/p2p">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/p2p/pages/listing.php">Listings</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/p2p/pages/about.php">About</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/p2p/pages/contact.php">Contact</a>
                </li>
                <?php require_once "auth.php" ?>
            </ul>
        </div>
    </div>
</nav>