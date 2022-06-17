    function generateCardInfoEvent(infos){ //[id_match,titre,sport,ville,date,heure,inscrits,max]
    let txt = '<div class="card-event" id="card-event-number' + infos[0] + '">'
        + '<div class="card-event-infos-background">'
        + '<div class="card-event-infos">'
        + infos[1] + ', ' + infos[2] + '<br>'
        + infos[3] + '<br>'
        + infos[4] + ', ' + infos[5] + '<br>'
        + infos[6] + '/' + infos[7]
        + '</div></div></div>';
    $('#result').append(txt);
}

function generateMyOrganizeEvent(infos){ //[titre]
    let txt = '<div class="one-event">'
        + '<span>' + infos[0] + '</span>'
        + '</div>';
    $('#me-organize-all').append(txt);
}
function generateMyEvent(infos){ //[titre]
    let txt = '<div class="one-event normal">'
        + '<span>' + infos[0] + '</span>'
        + '</div>';
    $('#my-games-all').append(txt);
}

function generateMniProfile(infos){
    let txt = '<div class="little-profil">'
        + '<img src="images/default_avatar.jpg" alt="image de profil" width="70" height="83">'
        + '<span class="little-box">profil</span>'
        +'</div>';
    $('#all_players').append(txt);
}




function setShowInfosMode(){
    let txt = "<div id = \"little-window\">"
        + "<div id=\"title-little-window\">"
        + "Titre de l'évènement"
        + "</div>"
        + "<div id=\"body-little-window\">"
        + "<div id=\"left-side\">"
        + "<div id = 'description'>"

        + "<span id='label-description'>Description </span>"
        + "<input id=\"description-txt\" type=\"text\">"
        + "</div>"
        + "<div id='the-organizator'>"
        + "<span class='fourty'>Organisateur </span>"
        + "<div id=\"organizator\" class=\"little-profil\">"
        + "<img src=\"images/default_avatar.jpg\" alt=\"image de profil\" width=\"70\" height=\"83\">"
        + "<span class=\"little-box\">profil</span>"
        + "</div>"
        + "</div>"

        + "<div id=\"players\">"
        + "<h2>Joueurs</h2>"
        + "<div id=\"all_players\">"
        + "</div>"
        + "</div>"
        + "</div>"
        + "<div id=\"right-side\">"
        + "<div class=\"infos-match\">"
        + "<span>Adresse : --:--</span><br>"
        + "<span>Heure du début : --:--</span><br>"
        + "<span>Durée estimée : --:--</span><br>"
        + "<span>Prix : --</span><br>"
        + "<span>Nombre max de participants : --</span><br>"
        + "<span>Nombre d'inscrits : --</span>"

        + "</div>"
        + "<button id='register' class='classic-button'>Participer</button>"
        + "<button id='close' >Fermer</button>"

        + "</div>"

        + "</div>"
        + "</div>" ;
    $('#popup').html(txt);

    generateMniProfile(1);
    generateMniProfile(1);
    generateMniProfile(1);
    generateMniProfile(1);
    generateMniProfile(1);
    generateMniProfile(1);

    $('#close').click(function (e)
        {
            $('#popup').html("");

        }
    );
}
function setShowInfosNormalMode(){
    let txt = "<div id = \"little-window\">"
        + "<div id=\"title-little-window\">"
        + "Titre de l'évènement"
        + "</div>"
        + "<div id=\"body-little-window\">"
        + "<div id=\"left-side\">"

        + "<div id='best'>"
        + "<span class='twenty-five space-right space-up'>Meilleur(e) joueur(euse) : </span>"
        + "<div id=\"organizator\" class=\"little-profil\">"
        + "<img src=\"images/default_avatar.jpg\" alt=\"image de profil\" width=\"70\" height=\"83\">"
        + "<span class=\"little-box\">profil</span>"
        + "</div>"
        + "</div>"

        + "<div class=\"infos-match2\">"
        + "<span>État de l'évènement : Terminé</span><br>"
        + "<span>Votre rôle dans le match : Organisateur</span><br>"

        + "<span>Score 0 / 0 === Vainqueur : équipeA</span><br>"

        + "</div>"

        + "</div>"
        + "<div id=\"right-side\">"



        + "<button id='close' >Fermer</button>"

        + "</div>"
        + "</div>"


        + "</div>" ;
    $('#popup').html(txt);



    $('#close').click(function (e)
        {
            $('#popup').html("");

        }
    );
}

$(document).ready(function(){


    for (let i = 0; i < 15; i++){
        generateCardInfoEvent([i,'test','foot-ball','Nantes','10-10-2022','12:00',1,12]);
    }

    generateMyOrganizeEvent(['foot2rue']);
    generateMyEvent(['foot2rue']);
    $('.card-event').click(function (e)
        {
            console.log(e.currentTarget.id);
            setShowInfosMode();

        }
    );
    $('.normal').click(function (e)
        {
            console.log(e.currentTarget.id);
            setShowInfosNormalMode();

        }
    );
    //setShowInfosMode();


});





/*

<div class="card-event">
        <div class="card-event-infos-background">
            <div class="card-event-infos">
                titre,sport <br>
                ville,<br>
                date,heure<br>
                inscrits/max (:évènmentA)
            </div>
        </div>
    </div>


<div class="one-event">
                    <span>titre évènement</span>
                </div>




+ "<div id=\"left-side\">"




        + "<div class=\"infos-match left\">"
        + "<div class='grid-double'>"
            + "<span>Meilleur(e) joueur(euse) :</span>"
            + "<div class=\"little-profil\">"
            + "<img src=\"images/default_avatar.jpg\" alt=\"image de profil\" width=\"70\" height=\"83\">"
            + "<span class=\"little-box\">profil</span>"
            + "</div>"
        + "</div>"
        + "<span>État de l'évènement : Terminé</span><br>"
        + "<span>Votre rôle dans le match : Joueur</span><br><br>"
        + "<span>Score : 0 / 0</span><br>"
        + "<span>Gagnant : équipeA</span><br>"
        + "</div>"
        + "</div>"
        + "<div id=\"right-side\">"


        + "<button id='close' >Fermer</button>"

        + "</div>"
 */