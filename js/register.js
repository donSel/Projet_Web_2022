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
    let txt = '<div class="one-event">'
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

function setSearchMode() {
    let txt = "<div id = 'result'>" +
        "</div>" +
        "<h1 id=\"my-events-title\">Mes matchs :</h1>" +
        "<div id=\"my-events\">" +

        "<div id=\"me-organize\" class=\"under-block\">" +
        "<h2>Ceux que j'organise :</h2>" +
        "<div id=\"me-organize-all\">" +

        "</div>" +
        "<button class=\"classic-button\">Nouveau</button>" +
        "</div>" +
        "<div id=\"my-games\" class=\"under-block\">" +
        "<h2>Ceux qui me concernent :</h2>" +
        "<div id=\"my-games-all\">" +

        "</div>" +
        "<button class=\"classic-button hidden\">Nouveau</button>" +
        "</div>" +
        "</div>";
    $('#page').html(txt);
    $('#popup').html('');

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
}


function setShowInfosMode(){
    let txt = "<div id = \"little-window\">"
        + "<div id=\"title-little-window\">"
        + "Titre de l'évènement"
        + "</div>"
        + "<div id=\"body-little-window\">"
        + "<div id=\"left-side\">"
        + "<div id = 'description'>"

        + "<label for=\"description-txt\">Description </label>"
        + "<input id=\"description-txt\" type=\"text\">"
        + "</div>"

        + "<div id=\"organisateur\" class=\"little-profil\">"
        + "<img src=\"images/default_avatar.jpg\" alt=\"image de profil\" width=\"70\" height=\"83\">"
        + "<span class=\"little-box\">profil</span>"
        + "</div>"

        + "<div id=\"players\">"
        + "<h2>Joueurs</h2>"
        + "<div id=\"all_players\">"
        + "</div>"
        + "</div>"
        + "</div>"
        + "<div id=\"right\">"
        + "<div id=\"infos-match\">"
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
            setSearchMode();

        }
    );
}

$(document).ready(function(){



    setSearchMode();
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


 */