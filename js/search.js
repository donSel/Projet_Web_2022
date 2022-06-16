function createCardInfoEvent(infos){ //[id_match,titre,sport,ville,date,heure,inscrits,max]
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
$(document).ready(function(){
    for (let i = 0; i < 15; i++){
        createCardInfoEvent([i,'test','foot-ball','Nantes','10-10-2022','12:00',1,12]);
    }

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





 */