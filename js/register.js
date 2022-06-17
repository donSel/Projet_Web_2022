
function generateMiniProfileIn(infos){
    let txt = '<div class="card-info-three">'
        + '<div class="infos-card-info-three">'
            + '<span>nom, prénom<br>'
            + 'mail,<br>'
            + 'statut sportif<br>'
            + 'équipe'
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

function generateMiniProfileWait(infos){
    let txt = '<div class="card-info-three">'
        +'<div class="infos-card-info-three">'
            +'<span>nom, prénom<br>'
                +'mail,<br>'
                +'statut sportif'
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


function generateEventOrganize(infos){
    let txt = '<div class="one-event-organization-head">'
        + '<div class="one-event-organization-title">'
            + '<span>Titre mon évènement A (que j\'organise): </span><br>'
        + '</div>'
        + '<div class="one-event-organization">'
            + '<div class="box-register-subinfo one-event-organization-details">'
                + '<span>Sport,date,heure,nb_minimum [nb_joueurs / nb_total]</span>'
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

$(document).ready(function(){
    //generateEventOrganize([0]);
    //generateEventOrganize([1]);

    for (let i=0;i<3;i++){
        generateMiniProfileIn([0]);
    }

    for (let i=0;i<3;i++){
        generateMiniProfileWait([[1]]);
    }




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