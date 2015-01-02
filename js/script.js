
$(function(){
    "use strict";
    
    function validEmail(email) {
      var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
      return regex.test(email);
    }
    var $rows;
    // Show hide menu navbar
    $("#trigger-navbar").click(function(){
        $("#navbar").toggleClass("open").show();
    })
    $("#navbar-close").click(function(){
        $("#navbar").toggleClass("open").hide();
    })
    // show contact
    $("#go-contact").click(function(){
        $('#contact_form input, #contact_form textarea').val('');
        $("#form_result").hide().empty();
        $("#list").hide();
        $("#contact").show();
        $("#navbar").toggleClass("open").hide();
    })

    // show messages
    $("#go-list").click(function(){
        $('#search').val('');
        $.get('include/contact.php', function(response){  
                $("#list-table tbody").empty();
                for (var i = 0; i < response.length; i++) {
                    var msj=response[i];
                     $("#list-table tbody").append("<tr><td>"+(i+1)+"</td><td>"+msj[1]+"</td><td>"+msj[2]+"</td><td>"+msj[3]+"</td></tr>");
                }
                $rows = $('#list-table tbody tr');
            }, 'json')
        .fail(function(data){
            $("#list-table tbody").empty();
            $("#list-table tbody").append("<tr><td></td><td>No hay mensajes que mostrar.</td><td></td><td></td></tr>");
            console.log(data);
        });
        $("#list").show();
        $("#contact").hide();
        $("#navbar").toggleClass("open").hide();
        
    })
    // Ajax working contact form
    $("#submit").click(function() { 
        //get input field values
        var user_name       = $('input[name=name]').val(); 
        var user_email      = $('input[name=email]').val();
        var user_message    = $('textarea[name=message]').val();
        var post_data;
        var output;

        //simple validation at client's end
        var proceed = true;
        if(user_name==""){ 
            $('input[name=name]').css('border-color','red'); 
            proceed = false;
        }
        else{ 
            $('input[name=name]').css('border-color','green');
        }

        if(user_email=="" || !validEmail(user_email) ){ 
            $('input[name=email]').css('border-color','red');
            proceed = false;
        }
        else{
            $('input[name=email]').css('border-color','green'); 
        }

        if(user_message=="") {  
            $('textarea[name=message]').css('border-color','red');
            proceed = false;
        }
        else{
            $('textarea[name=message]').css('border-color','green');
        }


        if(proceed) 
        {
            //data to be sent to server
            post_data = {'userName':user_name, 'userEmail':user_email, 'userMessage':user_message};
            
            //Ajax post data to server
            $.post('include/contact.php', post_data, function(response){  
            
                //load json data from server and output message     
                if(response.type == 'error')
                {
                    output = '<div class="error text-center col-md-6 col-md-offset-3">'+response.text+'</div>';
                }else{
                
                    output = '<div class="success text-center col-md-6 col-md-offset-3">'+response.text+'</div>';
                    
                    //reset values in all input fields
                    $('#contact_form input, #contact_form textarea').val(''); 
                }
                
                $("#form_result").hide().html(output).slideDown();
            }, 'json');
            
        }
    });
    
    //reset previously set border colors and hide all message on .keyup()
    $("#contact_form input, #contact_form textarea").keyup(function() { 
        $("#contact_form input, #contact_form textarea").css('border-color',''); 
        $("#form_result").slideUp();
    });

    //search filter
    $('#search').keyup(function() {
        var val = '^(?=.*\\b' + $.trim($(this).val()).split(/\s+/).join('\\b)(?=.*\\b') + ').*$',
            reg = RegExp(val, 'i'),
            text;
        
        $rows.show().filter(function() {
            text = $(this).text().replace(/\s+/g, ' ');
            return !reg.test(text);
        }).hide();
    });

});

// Google Maps
google.maps.event.addDomListener(window, 'load', loadGoogleMap);
function loadGoogleMap() {    
    $('#map').addClass('loading');    

    var settings = {
        zoom: 14,
        center: new google.maps.LatLng(-33.436494, -70.647433),
        mapTypeId: google.maps.MapTypeId.ROADMAP,
        mapTypeControl: false,
        panControl: false,
        rotateControl: false,
        zoomControl: false,
        streetViewControl: false,
        scrollwheel: false,
        draggable: true,
        mapTypeControlOptions: {style: google.maps.MapTypeControlStyle.DROPDOWN_MENU},
        navigationControl: false,
        navigationControlOptions: {style: google.maps.NavigationControlStyle.SMALL},
        styles: [{"featureType":"water","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":17}]},{"featureType":"landscape","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":20}]},{"featureType":"road.highway","elementType":"geometry.fill","stylers":[{"color":"#000000"},{"lightness":17}]},{"featureType":"road.highway","elementType":"geometry.stroke","stylers":[{"color":"#000000"},{"lightness":29},{"weight":0.2}]},{"featureType":"road.arterial","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":18}]},{"featureType":"road.local","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":16}]},{"featureType":"poi","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":21}]},{"elementType":"labels.text.stroke","stylers":[{"visibility":"on"},{"color":"#000000"},{"lightness":16}]},{"elementType":"labels.text.fill","stylers":[{"saturation":36},{"color":"#000000"},{"lightness":40}]},{"elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"featureType":"transit","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":19}]},{"featureType":"administrative","elementType":"geometry.fill","stylers":[{"color":"#000000"},{"lightness":20}]},{"featureType":"administrative","elementType":"geometry.stroke","stylers":[{"color":"#000000"},{"lightness":17},{"weight":1.2}]}]            
    };
    var map = new google.maps.Map(document.getElementById("map"), settings);

    google.maps.event.addDomListener(window, "resize", function() {
        var center = map.getCenter();
        google.maps.event.trigger(map, "resize");
        map.setCenter(center);
        $('#map').removeClass('loading');
    });


    var companyImage = new google.maps.MarkerImage('images/map-marker.png',
        new google.maps.Size(36,62),// Width and height of the marker
        new google.maps.Point(0,0),
        new google.maps.Point(18,52)// Position of the marker 
    );

    var octano = new google.maps.LatLng(-33.434190, -70.608661); // Pedro de Valdivia 1215, Providencia

    var companyMarker = new google.maps.Marker({
        position: octano,
        map: map,
        icon: companyImage,
        title:"ZetaByte",
        zIndex: 3});


};