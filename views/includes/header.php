<?php
session_start();
?>

<header>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark text-white">
        <div class="container-fluid">
            <a class="navbar-brand" href="/index.php?page=accueil">
                <h1>Wolf</h1>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link " href="/index.php?page=accueil">Accueil</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/index.php?page=quiSommesNous">Qui nous sommes ?</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/index.php?page=membres">Les Membres</a>
                    </li>
                </ul>

                <ul class="navbar-nav ml-auto">
                <?php
                    if (isset($_SESSION['user']) && ($_SESSION['user'])) {
                        echo 
                            '<li class="nav-item">
                                <a class="nav-link" href="/index.php?page=deconnexion">Deconnexion</a>
                            </li>';
                    } else {
                        echo 
                        '<li class="nav-item">
                            <a class="nav-link" href="/index.php?page=connexion">Connexion</a>
                        </li>';
                    }

                    ?>
                </ul>
            </div>
        </div>
    </nav>
</header>