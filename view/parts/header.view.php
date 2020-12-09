<!doctype html>
    <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport"
                  content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
            <meta http-equiv="X-UA-Compatible" content="ie=edge">
            <link rel="preconnect" href="https://fonts.gstatic.com">
            <link href="https://fonts.googleapis.com/css2?family=Fredericka+the+Great&family=Montserrat:wght@100;200;300;400;500;600&display=swap" rel="stylesheet">
            <link rel="stylesheet" href="css/styles.css">
            <title>Audrey Antony || Portfolio </title>
        </head>
        <body>
            <header id="sideBarNav" class="sideNav">
                <nav role="navigation">
                    <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">×</a>
                    <ul class="menu">
                        <?php
                        if (isset($_SESSION['session_id']) && $_SESSION['session_id']==session_id()){
                            echo '<a href="?admin=home"><li>Accueil</li></a>';
                            if($_SESSION['permission'] == 1) {
                                echo '<a href="?admin=gallery"><li>Galerie</li></a>';
                                echo '<a href="?admin=links"><li>Liens</li></a>';
                                echo '<a href="?admin=contact"><li>Contact</li></a>';
                            }
                            echo '<a href="?admin=disconnection"><li>Déconnexion</li></a>';
                        } else {
                            echo '<a href="?page=home"><li>Accueil</li></a>';
                            echo '<a href="?page=gallery"><li>Galerie</li></a>';
                            echo '<a href="?page=links"><li>Liens</li></a>';
                            echo '<a href="?page=cv"><li>CV</li></a>';
                            echo '<a href="?page=contact"><li>Contact</li></a>';
                            echo '<a href="?page=connection"><li>Connexion</li></a>';
                        }
                        ?>
                    </ul>
                    <div id="container">
                        <div class="inner-container">
                            <div class="toggle">
                                <p>Dark Mode</p>
                            </div>
                            <div class="toggle">
                                <p>Light Mode</p>
                            </div>
                        </div>
                        <div class="inner-container" id='toggle-container'>
                            <div class="toggle">
                                <p>Dark Mode</p>
                            </div>
                            <div class="toggle">
                                <p>Light Mode</p>
                            </div>
                        </div>
                    </div>
                    <div class="socialmedia">
                        <a href="https://www.facebook.com/audrey.antony.calzi" target="_blank"><img src="img/socialmedia/lighticon/facebook.png" alt="facebook" title="Aller vers ma page Facebook" ></a>
                        <a href="https://www.instagram.com/antony_audrey/?hl=fr" target="_blank"><img src="img/socialmedia/lighticon/instagram.png" alt="instagram" title="Aller vers ma page Instagram"></a>
                        <a href="https://github.com/audreyantony" target="_blank"><img src="img/socialmedia/lighticon/github.png" alt="github" title="Aller vers ma page Github"></a>
                        <a href="https://www.linkedin.com/in/audrey-antony-b7754084/" target="_blank"><img src="img/socialmedia/lighticon/linkedin.png" alt="linkedIn" title="Aller vers ma page LinkedIn"></a>
                    </div>
                </nav>
            </header>

            <span class="openMenu" onclick="openNav()"><img src="img/parts/menulight.png" alt="Menu >>"></span>