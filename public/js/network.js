/**
 * Created by angelika on 3/16/18.
 */
$(document).ready(function () {
    $(".create_network_submit").on("click", function (e) {
        e.preventDefault();
        var data = $(this).parents(form=name["create_network"]).serialize();
        $.ajax({
            url: '/api/network/report',
            type: 'POST',
            dataType: "json",
            data: data,
            success: function (data) {
                if(data["success"]){
                    $(".response").html(data["data"]);
                }
                else{
                    $(".response").html(data["error"]);
                }

            },
            error: function (jqXHR, textStatus, errprThrown) {
                console.log('error');
            }
        })
    })

});


