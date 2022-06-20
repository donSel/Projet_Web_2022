
function generateMiniProfileIn(infos){ //[id,nom,prénom,mail,statut,équipe]
    let txt = '<div class="card-info-three">'
        + '<div class="infos-card-info-three">'
            +'<span>'+infos[1]+','+ infos[2] + '<br>'
            + infos[3] + ',<br>'
            + infos[4] + ',<br>'
            + 'Équipe : ' + infos[5]
            + '</span>'
        + '</div>'
        + '<img src="images/default_avatar.jpg" alt="profil" width="70" height="83">'
            + '<div class="score-card-info-three">'
                + '<span>score : </span>'
                + '<input class="scoretxt-card-info-three" type="text">'
            + '</div>'
        + '</div>';
    $('#all_players-in' + infos[0]).append(txt);
}

function generateMiniProfileWait(infos){//[id,nom,prénom,mail,statut]
    let txt = '<div class="card-info-three">'
        +'<div class="infos-card-info-three">'
            +'<span>'+infos[1]+','+ infos[2] + '<br>'
                + infos[3] +',<br>'
                + infos[4]
            +'</span>'
        +'</div>'
        +'<img src="images/default_avatar.jpg" alt="profil" width="70" height="83">'
            +'<div class="score-card-info-three card-for-wait">'

                +'<button>Équipe A</button>'
                +'<button>Équipe B</button>'
                +'<br>'
                    +'<button>refus</button>'
            +'</div>'
    +'</div>';
    $('#all_players-wait' + infos[0]).append(txt);
}


function generateEventOrganize(infos){ //[id,titre,sport,date,heure,nb_minimum,nb_max,nb_actuel]
    let txt = '<div id=organized-event-id-' + infos[0] + 'class="one-event-organization-head">'
        + '<div class="one-event-organization-title">'
            + '<span>' + infos[1] + '</span><br>'
        + '</div>'
        + '<div class="one-event-organization">'
            + '<div class="box-register-subinfo one-event-organization-details">'
                + '<span>Sport : ' + infos[2] + ', date : ' + infos[3] + ', heure : ' + infos[4] + ', minimum : ' + infos[5] + ', inscrits : [' + infos[7] + '/' + infos[6] + ']</span>'
            + '</div>'
            + '<div class="box-register-subinfo">'
                + '<span class="sub-title">Joueurs :</span><br>'
                + '<div id="all_players-in' + infos[0] + '" class="show-all_players">'

                + '</div>'

            + '</div>'
            + '<div class="other-infos">'
                + '<div class="box-register-subinfo wait">'
                    + '<span class="sub-title">Liste des attentes:</span><br>'
                    + '<div id="all_players-wait' + infos[0] + '" class="show-all_players">'
                    + '</div>'

                + '</div>'
                + '<div class="end-stats">'
                    + '<div class="box-register-subinfo sizes-one">'
                        + '<div class="select-best-box">'
                            + '<div class="select-best-box-txt">'
                                + '<label  for="select-bestA' + infos[0] + '">Meilleur(e) joueur(euse)</label><br>'
                                + '<select id="select-bestA' + infos[0] + '">'
                                    + '<option value="valeur1">Valeur 1</option>'
                                + '</select>'
                            + '</div>'
                        + '</div>'
                    + '</div>'

                    + '<div class="box-register-subinfo sizes-two">'
                        + '<div class="select-best-box">'
                            + '<div class="select-best-box-txt">'
                                + '<label for="select-bestB' + infos[0] + '">Gagnant :</label>'
                                + '<select id="select-bestB' + infos[0] + '">'
                                    + '<option value="valeur1">Valeur 1</option>'
                                + '</select>'
                            + '</div>'

                            + '<div class="select-best-box-txt">'
                                + '<span> Score : </span>'
                                + '<input type="text" id="select-bestC' + infos[0] + '">'
                                    + '<span> / </span>'
                                    + '<input type="text" id="select-bestD' + infos[0] + '">'
                            + '</div>'
                        + '</div>'
                    + '</div>'

                    + '<button class="classic-button">Terminer</button>'


                + '</div>'
            + '</div>'
        + '</div>'



    + '</div>';
    $('#all-events-organization').append(txt);
}

function subMenuWanted(menu){ //0 or 1
    let txt = '';
    if (menu == 1){
        txt += '<nav>'
            + '<ul id = "navigation2" class="navi">'
                + '<li class = "navigation_elmt"><a href="">Nouvel évènement</a></li>'
                + '<li class = "navigation_elmt"><a href=""><b>Registre</b></a></li>'
            + '</ul>'
        + '</nav>'

        + '<div id="all-events-organization">'

        + '</div>'
    }
    $('body').append(txt);

    if (menu == 1){
        generateEventOrganize([0,'titre0','foot','date','heure',2,20,8]); //[id,titre,sport,date,heure,nb_minimum,nb_max,nb_actuel]
        generateEventOrganize([1,'titre1','hand','date','heure',4,20,5]);

        for (let i=0;i<3;i++){
            generateMiniProfileIn([0,'Leroy','gérard','gégé@gmail.com','débutant','A']); //[id,nom,prénom,mail,statut,équipe]
        }

        for (let i=0;i<3;i++){
            generateMiniProfileWait([1,'Leroy','gérard','gégé@gmail.com','débutant']); //[id,nom,prénom,mail,statut]
        }
    }
}

$(document).ready(function(){
    subMenuWanted(1);
    //window.scrollTo(0,4000);
    //console.log($('organized-event-id-1').offset());
    location.href = "#organized-event-id-1";





});


/*

<div class="card-info-three">
    <div class="infos-card-info-three">
    <span>nom, prénom<br>
    mail,<br>
    statut sportif
    </span>
    </div>
    <img src="images/default_avatar.jpg" alt="profil" width="70" height="83">
    <div class="score-card-info-three card-for-wait">

        <button>Équipe A</button>
        <button>Équipe B</button>
        <br>
        <button>refus</button>
    </div>
</div>





<div class="one-event-organization-head">
            <div class="one-event-organization-title">
                <span>Titre mon évènement A (que j'organise): </span><br>
            </div>
            <div class="one-event-organization">
                <div class="box-register-subinfo one-event-organization-details">
                    <span>Sport,date,heure,nb_minimum [nb_joueurs / nb_total]</span>
                </div>
                <div class="box-register-subinfo">
                    <span class="sub-title">Joueurs :</span><br>
                    <div id="all_players-in1" class="show-all_players">

                    </div>

                </div>
                <div class="other-infos">
                    <div class="box-register-subinfo wait">
                        <span class="sub-title">Liste des attentes:</span><br>
                        <div id="all_players-wait1" class="show-all_players">




                        </div>

                    </div>
                    <div class="end-stats">
                        <div class="box-register-subinfo sizes-one">
                            <div class="select-best-box">
                                <div class="select-best-box-txt">
                                    <label  for="select-bestA1">Meilleur(e) joueur(euse)</label><br>
                                    <select id="select-bestA1">
                                        <option value="valeur1">Valeur 1</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="box-register-subinfo sizes-two">
                            <div class="select-best-box">
                                <div class="select-best-box-txt">
                                    <label for="select-bestB1">Gagnant :</label>
                                    <select id="select-bestB1">
                                        <option value="valeur1">Valeur 1</option>
                                    </select>
                                </div>

                                <div class="select-best-box-txt">
                                    <span> Score : </span>
                                    <input type="text" id="select-bestC1">
                                    <span> / </span>
                                    <input type="text" id="select-bestD1">
                                </div>
                            </div>
                        </div>

                        <button class="classic-button">Terminer</button>


                    </div>
                </div>
            </div>



        </div>


 */