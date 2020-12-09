<section>
    <div class="contenu">
        <!-- TITRE -->
        <h1>{ Who are you }</h1>
        <h2>Connection au CRUD du site</h2>
        <div class="container-flex">
            <div class="crud" id="crud1">
                <h3 id="titre1">Connexion</h3>
                <form action=""  method="post">
                    <label for="pseudo">Votre Pseudo :</label><br>
                    <input id="pseudo" type="text" name="pseudo" placeholder="Login" required value="<?=$nickname?>"><br>
                    <label for="mdp">Votre mot de passe :</label><br>
                    <input id="mdp" type="password" name="mdp" placeholder="Password" required value="<?=$pwd?>"><br>
                    <?php
                    if (isset($warning)){
                        echo "<h6>".$warning."</h6>";
                    } else {
                        echo "<h6> </h6>";
                    }
                    ?>
                    <input type="submit" name="signin" value="GO"><br>
                </form>
            </div>
            <div id="crud1block"><img src="img/parts/<?=($styleCookie == "darkmode") ? "connexiondark.png" : "connexionlight.png"?>"></div>
            <div class="crud" id="crud2">
                <h3>Inscription</h3>
                <form action="" method="post">
                    <label for="pseudo">Veuillez renseigner :</label><br>
                    <input type="text" name="pseudo-signup" placeholder="Login" required value="<?=$signUpNickname?>"><br>
                    <input type="email" name="mail-signup" placeholder="E-mail" required value="<?=$signUpMail?>"><br>
                    <input type="password" name="mdp-signup" placeholder="Password" required value="<?=$signUpPwd?>"><br>
                    <input type="password" name="mdpcheck-signup" placeholder="Password confirmation" required value="<?=$signUpCheckPwd?>"><br>
                    <?php
                    if (isset($warning2)){
                        echo "<h6>".$warning2."</h6>";
                    } else {
                        echo "<h6> </h6>";
                    }
                    ?>
                    <input type="submit" name="signup" value="GO"><br>
                </form>
            </div>
            <div id="crud2block"><img src="img/parts/<?=($styleCookie == "darkmode") ? "inscriptiondark.png" : "inscriptionlight.png"?>"></div>
        </div>
        <a href="?page=home" class="middle"><button>
                Retour à l'accueil
            </button></a>
    </div>
</section>

<script>
    var crud1 = document.getElementById('crud1');
    var crud2 = document.getElementById('crud2');
    var crud1block = document.getElementById('crud1block');
    var crud2block = document.getElementById('crud2block');

    crud1block.addEventListener('click', function() {
        crud1.style.display = 'block';
        crud2.style.display = 'none';
        crud1block.style.display = 'none';
        crud2block.style.display = 'flex';

    });
    crud2block.addEventListener('click', function() {
        crud2.style.display = 'block';
        crud1.style.display = 'none';
        crud2block.style.display = 'none';
        crud1block.style.display = 'flex';
    });
</script>