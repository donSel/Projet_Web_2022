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
    let txt = '<div id=my-event-id-' + infos[0] + ' class="one-event normal">'
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




function setShowInfosMode(infos){ //[id,titre,description,organisateur_nom,org_url,adresse,heure,durée,prix,nb_max,nb_inscrits]
    let txt = "<div id = \"little-window\">"
        + "<div id=\"title-little-window\">"
        + infos[1]
        + "</div>"
        + "<div id=\"body-little-window\">"
        + "<div id=\"left-side\">"
        + "<div id = 'description' >"

        + "<span id='label-description'>" + infos[2] + "</span>"
        + "<input id=\"description-txt\" type=\"text\">"
        + "</div>"
        + "<div id='the-organizator' >"
        + "<span class='fourty'>Organisateur </span>"
        + "<div id=\"organizator\" class=\"little-profil\">"
        + "<img src=\"" + infos[4] + "\" alt=\"image de profil\" width=\"70\" height=\"83\">" //images/default_avatar.jpg
        + "<span class=\"little-box\">" +infos[3] + "</span>"
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
        + "<span class='z'>Adresse : "+ infos[5] + "</span><br>"
        + "<span class='a'>Heure du début : "+ infos[6] + "</span><br>"
        + "<span class='z'>Durée estimée : "+ infos[7] + "</span><br>"
        + "<span class='a'>Prix : "+ infos[8] + "</span><br>"
        + "<span class='z'>Nombre max de participants : "+ infos[9] + "</span><br>"
        + "<span class='a'>Nombre d'inscrits : "+ infos[10] + "</span>"

        + "</div>"
        + "<div class='buttons-popup'>"
        + "<button id='register' class='classic-button'>Participer</button>"
        + "<button id='close' >Fermer</button>"
        + "</div>"
        + "</div>"

        + "</div>"
        + "</div>" ;
    $('#popup').html(txt);

    generateMiniProfile([0,'Jean','images/default_avatar.jpg']);
    generateMiniProfile([1,'Paul','images/default_avatar.jpg']);
    generateMiniProfile([2,'Adrien','images/default_avatar.jpg']);
    generateMiniProfile([4,'Clark','images/default_avatar.jpg']);
    generateMiniProfile([5,'Batman','images/default_avatar.jpg']);
    generateMiniProfile([33,'uwu','images/default_avatar.jpg']);

    $('#close').click(function (e)
        {
            $('#popup').html("");

        }
    );
}
function setShowInfosNormalMode(infos){ //[id,titre,terminé,best_id,best_url,best_nom,rôle,heure,durée,ville,adresse,scoreA-scoreB,vainqueur]
    let txt = "<div id = \"little-window\">"
        + "<div id=\"title-little-window\">"
        + infos[1]
        + "</div>"
        + "<div id=\"body-little-window\">"
        + "<div id=\"left-side\">";
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

    generateMyOrganizeEvent([0,'foot2rue']);
    generateMyEvent([0,'foot2rue']);
    $('.card-event').click(function (e)
        {

            let idEvent = e.currentTarget.id.split("-"); //[id,titre,description,organisateur_nom,org_url,adresse,heure,durée,prix,nb_max,nb_inscrits]
            setShowInfosMode([0,'titre','description','Arnaud','images/default_avatar.jpg','--','--:--','--:--','--',10,2]);

            //HERE
            $('#register').click(function(e){
                console.log(idEvent[1]);
            })
        }
    );
    $('.normal').click(function (e)
        {
            console.log(e.currentTarget.id);
            setShowInfosNormalMode([0,'titre',true,0,'images/default_avatar.jpg','Jean-Eude','Organisateur','--:--','--','Bretteville','rue du moulin','10-2','ÉquipeA']);


        }
    );


    $('#research').click(function (e)
        {
            let tabSearch = [];
            tabSearch.push($('#ville').val());
            tabSearch.push($('#sport').val());
            tabSearch.push($('#période').val());
            tabSearch.push($('#statut_match').val());

            for (let i = 0; i< tabSearch.length;i++){
                console.log(tabSearch[i])
            }

        }
    );

    $('#new-organizes-event').click(function (e)
    {
        window.location.href = "organize.html?mode=0";


    });


});



