function generateCardInfoEvent(infos){ //[id_match,titre,sport,ville,date,heure,inscrits,max]
    let txt = '<div class="card-event">'
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
    $('#me-games-all').append(txt);
}

$(document).ready(function(){
    for (let i = 0; i < 15; i++){
        generateCardInfoEvent([i,'test','foot-ball','Nantes','10-10-2022','12:00',1,12]);
    }
    generateMyOrganizeEvent(['foot2rue']);
    generateMyEvent(['foot2rue']);
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