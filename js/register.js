
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
    $('#all_players-in').append(txt);
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
    $('#all_players-wait').append(txt);
}

$(document).ready(function(){

    for (let i=0;i<3;i++){
        generateMiniProfileIn(8);
    }

    for (let i=0;i<3;i++){
        generateMiniProfileWait(8);
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



 */