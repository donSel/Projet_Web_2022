function generateCardInfoEvent(infos){ //[id_match,titre,sport,ville,date,heure,inscrits,max]
    let txt = '<div class="card-event" id="cardEventNumber-' + infos[0] + '">'
        + '<div class="card-event-infos-background">'
        + '<div class="card-event-infos">'
        + infos[1] + ', ' + infos[2] + '<br>'
        + infos[3] + '<br>'
        + infos[4] + ', ' + infos[5] + '<br>'
        + infos[6] + '/' + infos[7]
        + '</div></div></div>';
    $('#result').append(txt);
}

function generateMyOrganizeEvent(infos){ //[id,titre]
    let txt = '<a href="organize.html?mode=1&location='+infos[0]+'"  class="one-event">'
        + '<span>' + infos[1] + '</span>'
        + '</a>';
    $('#me-organize-all').append(txt);
}
function generateMyEvent(infos){ //[id,titre]
    let txt = '<div id=myEventId-' + infos[0] + ' class="one-event normal">'
        + '<span>' + infos[1] + '</span>'
        + '</div>';
    $('#my-games-all').append(txt);
}

function generateMiniProfile(infos){ //[id_user,nom,url]
    let txt = '<div class="little-profil">'
        + '<img src=\"' + infos[2] + '\" alt="image de profil" width="70" height="83">'
        + '<span class="little-box">'  +  infos[1] + '</span>'
        +'</div>';
    $('#all_players').append(txt);
}


function loadAllPlayers(infos){ //tab of tab : [[infos player1],[infos player2],etc...]
    for (let i = 0; i < infos.length; i++){
        generateMiniProfile(infos[i]);
    }
}

function setShowInfosMode(infos){ //[id,titre,description,organisateur_nom,org_url,adresse,heure,durée,prix,nb_max,nb_inscrits]
    let txt = '<div id = "little-window">'
        + '<div id="title-little-window">'
        + infos[1]
        + '</div>'
        + '<div id="body-little-window">'
        + '<div id="left-side">'
        + '<div id = "description" >'

        + '<span id="label-description">Description</span>'
        + '<input id="description-txt" type="text" value="' + infos[2] + '">'
        + '</div>'
        + '<div id="the-organizator" >'
        + '<span class="fourty">Organisateur </span>'
        + '<div id="organizator" class="little-profil">'
        + '<img src="' + infos[4] + '" alt="image de profil" width="70" height="83">' //images/default_avatar.jpg
        + '<span class="little-box">' +infos[3] + '</span>'
        + '</div>'
        + '</div>'

        + '<div id="players">'
        + '<h2>Joueurs</h2>'
        + '<div id="all_players">'
        + '</div>'
        + '</div>'
        + '</div>'
        + '<div id="right-side">'
        + '<div class="infos-match">'
        + '<span class="z">Adresse : '+ infos[5] + '</span><br>'
        + '<span class="a">Heure du début : '+ infos[6] + '</span><br>'
        + '<span class="z">Durée estimée : '+ infos[7] + '</span><br>'
        + '<span class="a">Prix : '+ infos[8] + '</span><br>'
        + '<span class="z">Nombre max de participants : '+ infos[9] + '</span><br>'
        + '<span class="a">Nombre d\'inscrits : '+ infos[10] + '</span>'

        + '</div>'
        + '<div class="buttons-popup">';

    if (infos[10] < infos[9]){ //check if the match is full or not
        txt += "<button id='register' class='classic-button'>Participer</button>";

    }
        txt +=  "<button id='close' >Fermer</button>"
        + "</div>"
        + "</div>"

        + "</div>"
        + "</div>" ;
    $('#popup').html(txt);

    ajaxRequest('GET', 'php/requestA.php/search-event/?wanted=allPlayers&idMatch=' + infos[0], loadAllPlayers); //get all players in the event


    $('#close').click(function (e)
        {
            $('#popup').html(""); //close popup
        }
    );
}

function test(infos){ //debug
    console.log(infos[0])
}
function setShowInfosNormalMode(infos){ //[id,titre,terminé,best_id,best_url,best_nom,rôle,heure,durée,ville,adresse,scoreA-scoreB,vainqueur]
    let txt = "<div id = \"little-window\">"
        + "<div id=\"title-little-window\">"
        + infos[1]
        + "</div>"
        + "<div id=\"body-little-window\">"
        + "<div id=\"left-side\">";

    //2 comportments (check if the match is closen
    if (infos[2]) {
        let score = infos[11].split("-");

        txt += "<div id='best'>"
            + "<span class='twenty-five space-right space-up'>Meilleur(e) joueur(euse) : </span>"
            + "<div  class=\"little-profil\">"
            + "<img src=\"" + infos[4] + "\" alt=\"image de profil\" width=\"70\" height=\"83\">"
            + "<span class=\"little-box\">"+ infos[5] +"</span>"
            + "</div>"
            + "</div>"
            + "<div class=\"infos-match2\">"
            + "<span class='a'>État de l'évènement : Terminé</span><br>"
            + "<span class='z'>Votre rôle dans le match : "+ infos[6] +"</span><br>"

            + "<span class='a'>Score "+ score[0] +" / "+ score[1] +" === Vainqueur : "+ infos[12] +"</span><br>"

            + "</div>"

            + "</div>"
    }
    else{
        txt += "<div class=\"infos-match2\">"
        + "<span class='a'>État de l'évènement : Non terminé</span><br>"
        + "<span class='z'>Votre rôle dans le match : "+ infos[6] +"</span><br>"



        + "</div>"

        + "</div>";
    }
    txt +=
        "<div id=\"right-side\">"
        + "<div class=\"infos-match2\">"
        + "<span class='z'>Heure : "+ infos[7] +"</span><br>"
        + "<span class='a'>Durée : "+ infos[8] +"</span><br>"
        + "<span class='z'>Ville : "+ infos[9] +"</span><br>"
        + "<span class='a'>Adresse : "+ infos[10] +"</span><br>"
        + "</div>"
        + "<button id='close' >Fermer</button>"
        + "</div>"
        + "</div>"
        + "</div>" ;


    $('#popup').html(txt); //show popup
    $('#close').click(function (e)
        {
            $('#popup').html(""); //close popup

        }
    );
}



function loadInfosMode(infos){
    setShowInfosMode(infos); //[0, 'titre', 'description', 'Arnaud', 'images/default_avatar.jpg', '--', '--:--', '--:--', '--', 10, 2]

    $('#register').click(function(e){
        //console.log('participer '+infos[0]); //debug
        ajaxRequest('POST', 'php/requestA.php/search-event/',null, 'what=participate&matchID=' + infos[0]);
    })
}

function loadInfosNormalMode(infos) {
    if (infos != null){
        setShowInfosNormalMode(infos); //[0, 'titre', true, 0, 'images/default_avatar.jpg', 'Jean-Eude', 'Organisateur', '--:--', '--', 'Bretteville', 'rue du moulin', '10-2', 'ÉquipeA']
    }

}


function loadEvents(infos){
    $('#result').html(""); //init the destination of the cards
    for (let i = 0; i < infos.length; i++){
        generateCardInfoEvent(infos[i]);
    }

    $('.card-event').click(function (e)
        {

            let idEvent = e.currentTarget.id.split("-"); //get the html-id of the card on Tab[name,id_match on bdd]
            //setShowInfosMode([0,'titre','description','Arnaud','images/default_avatar.jpg','--','--:--','--:--','--',10,2]); //==> Test with fake values
            ajaxRequest('GET', 'php/requestA.php/search-event/?wanted=infos&idMatch=' + idEvent[1], loadInfosMode); //we get details of events

        }
    );

}

function loadMyOrganizeEvent(infos){
    for (let i=0;i<infos.length;i++){
        generateMyOrganizeEvent(infos[i]);
    }

}

function loadMyEvent(infos){
    console.log('mes events');
    for (let i=0;i<infos.length;i++){
        generateMyEvent(infos[i]);
    }

    $('.normal').click(function (e)
        {
            let idMyEvent = e.currentTarget.id.split("-");
            ajaxRequest('GET', 'php/requestA.php/search-event/?wanted=infosNormal&idMatch=' + idMyEvent[1], loadInfosNormalMode);
        }
    );
}

function setOption(id,infos){ //[id_town,town]
    $('#'+id).append('<option value="'+infos[1]+'">'+infos[1]+'</option>');
}

function loadCitiesOptions(infos){
    for (let i=0;i<infos.length;i++){
        setOption('ville',infos[i]);
    }
}
function loadSportsOptions(infos){
    //console.log(infos);
    for (let i=0;i<infos.length;i++){
        setOption('sport',infos[i]);
    }
}

$(document).ready(function(){

    ajaxRequest('GET', 'php/requestA.php/search-event/?wanted=cities', loadCitiesOptions);
    ajaxRequest('GET', 'php/requestA.php/search-event/?wanted=sports', loadSportsOptions);

    ajaxRequest('GET', 'php/requestA.php/search-event/?wanted=allEvents', loadEvents);

    ajaxRequest('GET', 'php/requestA.php/search-event/?wanted=myOrganizeEvent', loadMyOrganizeEvent);

    ajaxRequest('GET', 'php/requestA.php/search-event/?wanted=myEvent', loadMyEvent);




    $('#research').click(function (e)
        {
            //get all infos from form
            let tabSearch = [];
            tabSearch.push($('#ville').val());
            tabSearch.push($('#sport').val());
            tabSearch.push($('#période').val());
            tabSearch.push($('#statut_match').val());

            /*for (let i = 0; i< tabSearch.length;i++){ //debug
                console.log(tabSearch[i])
            }*/
            ajaxRequest('GET', 'php/requestA.php/search-event/?wanted=speEvents&ville='+tabSearch[0]+'&sport='+tabSearch[1]+'&periode='+tabSearch[2]+'&statutMatch='+tabSearch[3], loadEvents);
            //ajaxRequest('POST', 'php/requestA.php/search-event/',test, 'value1=' + 8 );

        }
    );

    $('#new-organizes-event').click(function (e)
    {
        window.location.href = "organize.html?mode=0"; //redirection


    });


});



