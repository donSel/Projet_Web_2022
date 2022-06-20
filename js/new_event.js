/*var select = '';
for (i=1;i<=100;i++){
    select += '<option val=' + i + '>' + i + '</option>';
}
$('#nbMinSelector').html(select);*/

/*$(function(){
    var $select = $("#nbMinSelector");
    for (i=1;i<=100;i++){
        $select.append($('<option></option>').val(i).html(i))
    }
});​*/

/*$(function(){
    var $select = $(".1-100");
    for (i=1;i<=100;i++){
        $select.append($('<option></option>').val(i).html(i))
    }
});*/


function createSelectNbPlayer(){
    let option = '';
    for (i = 1; i <= 100; i++){
        option += '<option val="' + i + '">' + i + '</option>';
        console.log(option);
    }
    $('#selectNbMinPlayer').append(option);
    $('#selectNbMaxPlayer').append(option);
}


function createSelectAgeRange(){
    let option = '';
    for (i = 1; i <= 100; i++){
        option += '<option val="' + i + '">' + i + '</option>';
        console.log(option);
    }
    $('#selectMinAgeRange').append(option);
    $('#selectMaxAgeRange').append(option);
}



$(document).ready(function(){
    createSelectNbPlayer();
    createSelectAgeRange();
})



