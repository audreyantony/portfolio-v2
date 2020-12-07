<section>
    <div class="contenu">
        <!-- TITRE -->
        <h1>{ Who are you }</h1>
        <h2>Connection au CRUD du site</h2>
        <div class="container-flex">
            <div class="crud" id="crud1">
                <h3 id="titre1">Connexion</h3>
                <form action=""  method="post">
                    <input type="text" name="pseudo" placeholder="Votre login" required><br>
                    <input type="password" name="mdp" placeholder="Votre mot de passe" required><br>
                    <input type="submit" value="Envoyer"><br>
                </form>
                <a href="?page=home"><button>
                        Retour à l'accueil
                    </button></a>
            </div>
            <div class="crud" id="crud2">
                <h3 id="titre2">Inscription</h3>
                <form action="" method="post">
                    <input type="text" name="pseudo" placeholder="Votre login" required><br>
                    <input type="password" name="mdp" placeholder="Votre mot de passe" required><br>
                    <input type="submit" value="Envoyer"><br>
                </form>
                <a href="?page=home"><button>
                        Retour à l'accueil
                    </button></a>
            </div>
        </div>
    </div>
</section>

<script>
    var crud1 = document.getElementById('crud1');
    var crud2 = document.getElementById('crud2');

    crud1.addEventListener('mouseover', function() {
        crud1.style.width = '65%';
        crud2.style.width = '25%';
    });
    crud2.addEventListener('mouseover', function() {
        crud2.style.width = '65%';
        crud1.style.width = '25%';
    });
</script>