<section>
    <div class="contenu">
        <h1>{ Contact }</h1>
        <h2>Un petit mot ou une question ?</h2>
        <form method="post" >
            <?php
            if (isset($warning)){
                echo "<span class='warning'>".$warning."</span>";
            } else {
                echo "<span class='warning'> </span>";
            }
            ?>
            <div class="grid-container">
                    <input class="name" type="text" name="name" placeholder="Votre nom" value="<?=$name?>">
                    <input class="email" type="email" name="mail" placeholder="Votre adresse email" value="<?=$mail?>">
                    <input class="phone" type="tel" name="phone" placeholder="Votre numéro de téléphone" value="<?=$phone?>">
                    <textarea class="msg" name="message" placeholder="Votre question, suggestion et/ou avis !"><?=$message?></textarea>
            </div>
            <input type="submit" name="envoyer" value="Envoyer" class="btnenvoyer">

        </form>
        <a href="?page=home"><button>
                Retour à l'accueil
            </button></a>
    </div>
</section>