
function generateMiniProfileIn(infos,where){ //[id,nom,prénom,mail,statut,équipe]
    // ['Leroy.gege@gmail.com'.$i,'Leroy','gérard','gégé@gmail.com','débutant','A'];
    //t.mail, p.last_name, p.first_name, p.photo_url, t.role, t.team
    let health = 'Non-dit';
    let team = 'Aucune';
    if (infos[4] == 1){
        health = 'Débutant';
    }if (infos[4] == 2){
        health = 'Confirmé';
    }
    if (infos[5] == 1){
        team = 'A';
    }if (infos[5] == 2){
        team = 'B';
    }

    let txt = '<div class="card-info-three">'
        + '<div class="infos-card-info-three">'
            +'<span>'+infos[1]+','+ infos[2] + '<br>'
            + infos[0] + ',<br>'
            + health + ',<br>'
            + 'Équipe : ' + team
            + '</span>'
        + '</div>'
        + '<img src="images/default_avatar.jpg" alt="profil" width="70" height="83">'
            + '<div class="score-card-info-three">'
                + '<span>score : </span>'
                + '<input class="scoretxt-card-info-three" type="text">'
            + '</div>'
        + '</div>';
    $('#all_players-in' + where).append(txt);
}

function generateMiniProfileWait(infos,where){//[id,nom,prénom,mail,statut]
    let health = 'Non-dit';
    let team = 'Aucune';
    if (infos[4] == 1){
        health = 'Débutant';
    }if (infos[4] == 2){
        health = 'Confirmé';
    }
    let txt = '<div class="card-info-three">'
        +'<div class="infos-card-info-three">'
            +'<span>'+infos[1]+','+ infos[2] + '<br>'
                + infos[0] +',<br>'
                + health
            +'</span>'
        +'</div>'
        +'<img src="images/default_avatar.jpg" alt="profil" width="70" height="83">'
            +'<div class="score-card-info-three card-for-wait">'

                +'<button type="button" class="buttonSetTeamA" id="setToTeamA-' + where + '-' + infos[0] + '">Équipe A</button>'
                +'<button class="buttonSetTeamB" id="setToTeamB-' + where + '-' + infos[0] + '">Équipe B</button>'
                +'<br>'
                    +'<button class="buttonSetRefus" id="setToRefus-' + where + '-' + infos[0] + '">refus</button>'
            +'</div>'
    +'</div>';
    $('#all_players-wait' + where).append(txt);
}

function generateEventOrganize(infos){ //[id,titre,sport,date,heure,nb_minimum,nb_max,nb_actuel]
    let txt = '<div id="organizedEventId-' + infos[0] + '" class="one-event-organization-head">'
        + '<div class="one-event-organization-title">'
            + '<span>' + infos[1] + '</span><br>'
        + '</div>'
        + '<div class="one-event-organization">'
            + '<div class="center">'
                + '<div class="box-register-subinfo one-event-organization-details">'
                    + '<span>Sport : ' + infos[2] + ', date : ' + infos[3] + ', heure : ' + infos[4] + ', minimum : ' + infos[5] + ', inscrits : [' + infos[7] + '/' + infos[6] + ']</span>'
                + '</div>'
                + '<div class="box-register-subinfo min-h">'
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

                                    + '</select>'
                                + '</div>'
                            + '</div>'
                        + '</div>'

                        + '<div class="box-register-subinfo sizes-two">'
                            + '<div class="select-best-box">'
                                + '<div class="select-best-box-txt">'
                                    + '<label for="select-bestB' + infos[0] + '">Gagnant :</label>'
                                    + '<select id="select-bestB' + infos[0] + '">'
                                        + '<option value="A">Équipe A</option>'
                                        + '<option value="B">Équipe B</option>'
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

                        + '<button id="endEventOrg-'+infos[0]+'" class="classic-button end-button">Terminer</button>'
                    + '</div>'
                + '</div>'
            +'</div>'
        + '</div>'
    + '</div>';
    $('#all-events-organization').append(txt);
}

function loadMiniProfilesIn(infos){
    $('#select-bestA' + infos[0]).html("");
    $('#all_players-in' + infos[0]).html("");
    for (let i=1;i<infos.length;i++){

        generateMiniProfileIn(infos[i],infos[0]); //[id,nom,prénom,mail,statut,équipe] [j+1,'Leroy','gérard','gégé@gmail.com','débutant','A']
        //console.log('select-bestA' + infos[0]);
        $('#select-bestA' + infos[0]).append("<option value='" + infos[i][0] + "'>"+ infos[i][0] +"</option>");
    }
    //-mettre dans le select du best

}
function reload(infos){
    ajaxRequest('GET', 'php/requestA.php/organize-event/?wanted=showEventOrganize', loadEventOrganize);
}

function acceptationOrNot(id,value){
    let infos = id.split("-");
    //console.log(infos[0] + ' ' + infos[1] + ' ' + infos[2]);
    ajaxRequest('PUT', 'php/requestA.php/organize-event/',reload, 'what=setTeam&idMatch='+infos[1]+'&mail='+infos[2]+'&team='+value);


}
function loadMiniProfilesWait(infos){
    $('#all_players-wait' + infos[0]).html("");
    for (let i=1;i<infos.length;i++){

        generateMiniProfileWait(infos[i],infos[0]); //[id,nom,prénom,mail,statut]
    }
    $('.buttonSetTeamA').click(function (e)
        {
            console.log(' TEAM A !');
            acceptationOrNot(e.currentTarget.id,1); //A
        }
    );
    $('.buttonSetTeamB').click(function (e)
        {
            console.log(' TEAM B !');
            acceptationOrNot(e.currentTarget.id,2); //B
        }
    );
    $('.buttonSetRefus').click(function (e)
        {
            console.log(' Refus !');
            acceptationOrNot(e.currentTarget.id,-1); //refus
        }
    );
}
function debug(infos){
    console.log('ici c\'est le debug : ' + infos);
}
function loadEventOrganize(infos){
    $('#all-events-organization').html("");
    ajaxRequest('GET', 'php/requestA.php/organize-event/?wanted=debug', debug);
    for(let i=0;i<infos.length;i++){
        generateEventOrganize(infos[i]);

        ajaxRequest('GET', 'php/requestA.php/organize-event/?wanted=showMiniProfilesIn&idMatch='+infos[i][0], loadMiniProfilesIn);
        ajaxRequest('GET', 'php/requestA.php/organize-event/?wanted=showMiniProfilesWait&idMatch='+infos[i][0], loadMiniProfilesWait);





    }
    if(mode == 1){
        location.href = "#organizedEventId-" + parsedUrl.searchParams.get("location");
    }
    $('.end-button').click(function (e)
        {
            console.log(e.currentTarget.id);
            let idEvent = e.currentTarget.id.split("-");
            //console.log(idEvent[1]);
            let tabBest = [];

            tabBest.push($('#select-bestA'+idEvent[1]).val());
            tabBest.push($('#select-bestB'+idEvent[1]).val());

            $('#select-bestC'+idEvent[1]).val(setScore($('#select-bestC'+idEvent[1]).val()));
            tabBest.push($('#select-bestC'+idEvent[1]).val());
            $('#select-bestD'+idEvent[1]).val(setScore($('#select-bestD'+idEvent[1]).val()))
            tabBest.push(setScore($('#select-bestD'+idEvent[1]).val()));



            //for (let i = 0;i<tabBest.length;i++){
                //console.log(tabBest[i]);
            //}

            ajaxRequest('PUT', 'php/requestA.php/organize-event/',null, 'what=setEnd&idMatch='+idEvent[1]+'&best='+tabBest[0]+'&winner='+tabBest[1]+'&scoreA='+tabBest[2]+'&scoreB='+tabBest[3]);
        }
    );

    //generateEventOrganize([0,'titre0','foot','date','heure',2,20,8]); //[id,titre,sport,date,heure,nb_minimum,nb_max,nb_actuel]
    //generateEventOrganize([1,'titre1','hand','date','heure',4,20,5]);
}

function setScore(val){
    let score = '0';
    if (val != ''){
        score = val;
    }
    return score;
}

function refresh(infos){
    //window.location.href = "organize.html?mode=1";
    console.log('HERE : '+ infos);
}

function subMenuWanted(menu){ //0 or 1
    let txt = '';

    if (menu == 0){
        txt += '<nav>'
            + '<ul id = "navigation2" class="navi">'
            + '<li id="go-new-event" class = "navigation_elmt"><span><b>Nouvel évènement</b></span></li>'
            + '<li id="go-register" class = "navigation_elmt"><span>Registre</span></li>'
            + '</ul>'
            + '</nav>';
        $('#sub-menu-organize-space').html(txt);
        txt = '';
        txt +=
            '<div class="one-event-organization-head">'

            + '<br>'
                + '<div class="one-event-organization">'
                        + '<div id="alert-event-creation" class="hidden"><span>Veuillez au minimum saisir les informations marquées d\'une *</span></div>'

                    + '<div class="other-infos">'
                        + '<div class="box-register-subinfo wait">'
                            + '<br>'
                                + '*Discipline (sport) : <input type="text" id="sportName" name="sportName" class="text_field"><br><br>'
                                + '*Titre <input type="text" size="15" id="eventTitle" name="eventTitle" class="large_text_field"><br><br>'
                                + 'Description <br><br>'
                                + '<textarea name="eventDescription" size="50" id="commentary" rows="5" cols="20" placeholder="entrer votre la description de votre évènement"></textarea><br><br>'
                                + '*Nombre Minimum <select id="selectNbMinPlayer" name="eventNbMin"></select>'
                                + '*Nombre Maximum <select id="selectNbMaxPlayer" name="eventNbMax"></select><br><br>'
                                + '*ville <input type="text" id="eventTown" name="eventTown" class="text_field"><br><br>'
                                + '*adresse <input type="text" id="eventAdress" name="eventAdress" class="text_field"><br><br>'
                        + '</div>'

                        + '<div class="box-register-subinfo wait">'
                            + '<br>'
                                + '*date <input type="date" id="start" name="eventDate"><br><br>'
                                + '*heure <input type="time" id="eventHour" name="eventHour"><br><br>'
                                + '*durée éstimée <input type="time" id="eventDuration" name="eventDuration"><br><br>'
                                + '*prix <input type="text" id="eventPrice" name="eventPrice" class="small_text_field"><br><br>'
                                + '<div class="hidden">*tranche d\'âge <select id="selectMinAgeRange" name="eventNbMin"></select> - <select id="selectMaxAgeRange" name="eventNbMax"></select><br><br></div>'
                                + 'participer <input type="checkbox" id="isOrganiserParticipating" name="isOrganiserParticipating"><br><br>'
                        + '</div>'
                        + '<button id="start-event" class="classic-button">Lancer</button>'
                    + '</div>'
                + '</div>'
        + '</div>';
    }
    else{
        txt +='<nav>'
            + '<ul id = "navigation2" class="navi">'
            + '<li id="go-new-event" class = "navigation_elmt_nav2"><span>Nouvel évènement</span></li>'
            + '<li id="go-register" class = "navigation_elmt_nav2"><span><b>Registre</b></span></li>'
            + '</ul>'
            + '</nav>';
        $('#sub-menu-organize-space').html(txt);
        txt = '';
        txt +=
            '<div id="all-events-organization">'

            + '</div>';
    }
    $('#page-organize-space').html(txt);

    if (menu == 0){
        createSelectNbPlayer();
        createSelectAgeRange();
        $('#go-register').click(function (e)
            {
                window.location.href = "organize.html?mode=1";
            }
        );

        $('#start-event').click(function (e)
            {
                //console.log('Lance l\'évènement');
                let tab=[];
                tab.push($('#sportName').val());
                tab.push($('#eventTitle').val());
                tab.push($('#commentary').val());
                tab.push($('#selectNbMinPlayer').val());
                tab.push($('#selectNbMaxPlayer').val());
                tab.push($('#eventTown').val());
                tab.push($('#eventAdress').val());


                tab.push($('#start').val());
                tab.push($('#eventHour').val());
                tab.push($('#eventDuration').val());
                tab.push($('#eventPrice').val());
                tab.push("null"); //$('#selectMinAgeRange').val()
                tab.push("null"); //$('#selectMaxAgeRange').val()

                let check = true;

                for (let i=0;i<tab.length;i++){
                    if (i!=2){
                        if (tab[i] == ""){
                            check = false
                        }
                    }
                }
                tab.push($('#isOrganiserParticipating').prop("checked"));
                console.log(tab[13]);
                if (check){
                    $('#alert-event-creation').addClass('hidden');
                    ajaxRequest('POST', 'php/requestA.php/organize-event/',refresh, 'what=createEvent&sport='+tab[0]+'&title='+tab[1]+'&comment='+tab[2]+'&min='+tab[3]+'&max='+tab[4]+'&town='+tab[5]+'&adress='+tab[6]+'&date='+tab[7]+'&hour='+tab[8]+'&duration='+tab[9]+'&price='+tab[10]+'&mina='+tab[11]+'&maxa='+tab[12] + '&in='+tab[13]);
                }
                else{
                    $('#alert-event-creation').removeClass('hidden');
                }
            }
        );

    }
    else{
        ajaxRequest('GET', 'php/requestA.php/organize-event/?wanted=showEventOrganize', loadEventOrganize);



        $('#go-new-event').click(function (e)
            {
                window.location.href = "organize.html?mode=0";
            }
        );

    }
}



function createSelectNbPlayer(){
    let option = '';
    for (i = 1; i <= 100; i++){
        option += '<option value="' + i + '">' + i + '</option>';
    }
    $('#selectNbMinPlayer').append(option);
    $('#selectNbMaxPlayer').append(option);
}


function createSelectAgeRange(){
    let option = '';
    for (i = 1; i <= 100; i++){
        option += '<option value="' + i + '">' + i + '</option>';
    }
    $('#selectMinAgeRange').append(option);
    $('#selectMaxAgeRange').append(option);
}

$(document).ready(function(){
    parsedUrl = new URL(window.location.href);
    mode = parsedUrl.searchParams.get("mode");
    if (mode == null){
        mode = 0;
    }

    subMenuWanted(mode);


});

