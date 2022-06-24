

function showNotif(show = true){


    if (show){
        ajaxRequest('GET', 'php/requestA.php/profile/?wanted=notifs', loadNotifs);
        /*txt =
             '<div class="notificationRequestContour allTypesOfNotification noTextCursor">'
            + '<div class="notificationContent noTextCursor"><br>'
            + 'User veut se joindre à l\'évènement'
            + '<!-- buttons-->'
            + '</div>'
            + '</div>'
            + '<div class="approvalNotificationContour allTypesOfNotification noTextCursor">'
            + '<div class="notificationContent noTextCursor"><br>'
            + 'Vous avez été séléctionnés pour l’évènement :'
            + '“Petit tennis au SNUC”'
            + '</div>'
            + '</div>'
            + '<div class="refusalNotificationContour allTypesOfNotification noTextCursor">'
            + '<div class="notificationContent noTextCursor"><br>'
            + 'Vous avez n’avez pas été séléctionnés pour l’évènement :'
            + '“match de basket au stade de Procès”'
            + '</div>'
            + '</div>';*/

        $('#notification-bar').addClass('hidden');
        $('#showerNotif').removeClass('hidden');
    }
    else{
        $('#notification-bar').removeClass('hidden');
        $('#showerNotif').addClass('hidden');
        $('#notifications').html('');
    }






}

function loadProfil(infos){ //[id_user,nom,prenom,age;ville,forme,mdp,url,commentaire]
    $('#imgToSet').html('<img src="'+infos[7]+'" alt="logo officiel" width="200px" height="200px">');
    $('#lastName').val(infos[1]);
    $('#firstName').val(infos[2]);
    $('#mail').val(infos[0]);
    $('#age').val(infos[3]);
    $('#town').val(infos[4]);
    $('#health').val(infos[5]);
    $('#password').val('');
    $('#photoUrl').val(infos[7]);
    $('#commentary').val(infos[8]);



}
function setNotif(infos){ //[type,text]
    let txt = '';

    if (infos[0] == 0){
        txt +=
        '<div class="notificationRequestContour allTypesOfNotification noTextCursor">'
        + '<div class="notificationContent noTextCursor"><br>'
        + infos[1]
        + '<!-- buttons-->'
        + '</div>'
        + '</div>';

    } else if (infos[0] == 1){
        txt +=
        '<div class="approvalNotificationContour allTypesOfNotification noTextCursor">'
        + '<div class="notificationContent noTextCursor"><br>'
        + infos[1]
        + '</div>'
        + '</div>';

    } else if (infos[0] == 2){
        txt +=
        '<div class="refusalNotificationContour allTypesOfNotification noTextCursor">'
        + '<div class="notificationContent noTextCursor"><br>'
        + infos[1]
        + '</div>'
        + '</div>';
    }
    $('#notifications').append(txt);

}

function loadStats(infos){ //[nbMatch,nbButs,nbBest]
    $('#nbMatch').val(infos[0]);
    $('#nbButs').val(infos[1]);
    $('#bestPlayer').val(infos[2]);
}
function loadNotifs(infos){
    for (let i = 0;i<infos.length;i++){
        setNotif(infos[i])
    }
}
function reload(infos){
    ajaxRequest('GET', 'php/requestA.php/profile/?wanted=profileInfos', loadProfil);
}

$(document).ready(function() {
    ajaxRequest('GET', 'php/requestA.php/profile/?wanted=profileInfos', loadProfil);
    ajaxRequest('GET', 'php/requestA.php/profile/?wanted=profileStats', loadStats);


    $('#profilNotifications').click(function (e) {
        showNotif();
    });

    $('.titleNotifications').click(function(e){
        showNotif(false);
    });

    $('#modifyProfil').click(function(e){
        let tabProfil = [];
        tabProfil.push($('#lastName').val());
        tabProfil.push($('#firstName').val());
        tabProfil.push($('#age').val());
        tabProfil.push($('#town').val());
        tabProfil.push($('#health').val());
        tabProfil.push($('#password').val());
        tabProfil.push($('#photoUrl').val());
        tabProfil.push($('#commentary').val());

        ajaxRequest('PUT', 'php/requestA.php/profile/',reload, 'what=setProfile&lastName='+ tabProfil[0] +'&firstName='+ tabProfil[1] +'&age='+ tabProfil[2] +'&town='+ tabProfil[3] +'&health='+ tabProfil[4] +'&password='+ tabProfil[5] +'&photoUrl='+ tabProfil[6] +'&commentary='+ tabProfil[7]);

    });
});

