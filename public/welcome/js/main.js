
$(document).ready(function(){
	"use strict";

	var window_width 	 = $(window).width(),
	window_height 		 = window.innerHeight,
	header_height 		 = $(".default-header").height(),
	header_height_static = $(".site-header.static").outerHeight(),
	fitscreen 			 = window_height - header_height;


	$(".fullscreen").css("height", window_height)
	$(".fitscreen").css("height", fitscreen);


     // -------   Active Mobile Menu-----//

    $(".menu-bar").on('click', function(e){
        e.preventDefault();
        $("nav").toggleClass('hide');
        $("span", this).toggleClass("lnr-menu lnr-cross");
        $(".main-menu").addClass('mobile-menu');
    });

    $('select').niceSelect();
    $('.img-pop-up').magnificPopup({
        type: 'image',
        gallery:{
        enabled:true
        }
    });

    $('.active-works-carousel').owlCarousel({
        center: true,
        items:2,
        loop:true,
        margin: 100,
        dots: true,
        responsive: {
            0: {
                items: 1
            },
            480: {
                items: 1,
            },
            768: {
                items: 2,
            }
        }
    });
    // Add smooth scrolling to Menu links
    $(".main-menu li a, .smooth").on('click', function(event) {
            if (this.hash !== "") {
              event.preventDefault();
              var hash = this.hash;
              $('html, body').animate({
                scrollTop: $(hash).offset().top - (-10)
            }, 600, function(){

                window.location.hash = hash;
            });
        }
    });

    $(document).ready(function() {
        let wrapper = $('#mc_embed_signup');
        let form = wrapper.find('form');
        $(form).submit((event) => {
            event.preventDefault();
            $.ajax(
                $(form).attr('action'),
                {
                    contentType: 'application/json',
                    dataType: 'json',
                    type: form.attr('method'),
                    data: JSON.stringify({
                        email: $(form).find('input[name=email]').val(),
                        captcha: $(form).find('input[name="g-recaptcha-response"]').val()
                    }),
                    success: (response) => {
                        let info = wrapper.find('.info');
                        info.text(response.message);
                        info.attr('style', 'color:green');
                    },
                    error: (data) => {
                        let raw = data.responseText;
                        let response = JSON.parse(raw);
                        let info = wrapper.find('.info');
                        if (data.status == 422)
                        {
                            info.text(response.errors.email[0]);
                        }else {
                            info.text(response.message);

                        }
                        info.attr('style', 'color:red');
                    }
                });
        });

    });

 });
