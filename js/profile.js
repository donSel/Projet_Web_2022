

function showNotif(show = true){
    let txt = '';

    if (show){
        txt =
             '<div class="notificationRequestContour">'
            + '<div class="notificationContent"><br>'
            + 'User veut se joindre à l\'évènement'
            + '<!-- buttons-->'
            + '</div>'
            + '</div>'
            + '<div class="approvalNotificationContour">'
            + '<div class="notificationContent"><br>'
            + 'Vous avez été séléctionnés pour l’évènement :'
            + '“Petit tennis au SNUC”'
            + '</div>'
            + '</div>'
            + '<div class="refusalNotificationContour">'
            + '<div class="notificationContent"><br>'
            + 'Vous avez n’avez pas été séléctionnés pour l’évènement :'
            + '“match de basket au stade de Procès”'
            + '</div>'
            + '</div>';

        $('#notification-bar').addClass('hidden');
        $('#showerNotif').removeClass('hidden');
    }
    else{
        $('#notification-bar').removeClass('hidden');
        $('#showerNotif').addClass('hidden');
    }


    $('#notifs-space').html(txt);



}


$(document).ready(function() {
    $('#profilNotifications').click(function (e) {
        showNotif();
    });

    $('#showerNotif').click(function(e){
        showNotif(false);
    })
});

/*

<div class="notificationList">
    <div class="titleNotifications">Notification</div>
    <div class="mainNotification">
        <div id = 'notifications'>

            <div class="notificationRequestContour">
                <div class="notificationContent"><br>
                    User veut se joindre à l'évènement
                    <!-- buttons-->

                </div>
            </div>

            <div class="approvalNotificationContour">
                <div class="notificationContent"><br>
                    Vous avez été séléctionnés pour l’évènement :
                        “Petit tennis au SNUC”
                </div>
            </div>

            <div class="refusalNotificationContour">
                <div class="notificationContent"><br>
                    Vous avez n’avez pas été séléctionnés pour l’évènement :
                        “match de basket au stade de Procès”
                </div>
            </div>


        </div>

    </div>
</div>








 */