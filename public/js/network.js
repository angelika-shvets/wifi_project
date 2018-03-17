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
                    $(".response_create_network").html(data["data"]);
                }
                else{
                    $(".response_create_network").html(data["error"]);
                }

            },
            error: function (jqXHR, textStatus, errprThrown) {
                
                $(".response_create_network").html(errprThrown );
            }
        })
    });
    
    $(".add_new_device_to_network_submit").on("click", function (e) {
        e.preventDefault();
        var data = $(this).parents(form=name["add_new_device_to_network"]).serialize();
        $.ajax({
            url: '/api/network/device',
            type: 'POST',
            dataType: "json",
            data: data,
            success: function (data) {
                if(data["success"]){
                    $(".response_update_device").html(data["data"]);
                }
                else{
                    $(".response_update_device").html(data["error"]);
                }

            },
            error: function (jqXHR, textStatus, errprThrown) {
                console.log(errprThrown);
                $(".response_update_device").html(errprThrown);
            }
        })
    });

});


