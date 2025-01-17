(function ($) {
    'use strict';
    $(function () {
        var body = $('body');
        var contentWrapper = $('.content-wrapper');
        var scroller = $('.container-scroller');
        var footer = $('.footer');
        var sidebar = $('#sidebar');

        //Add active class to nav-link based on url dynamically
        //Active class can be hard coded directly in html file also as required
        if (!$('#sidebar').hasClass("dynamic-active-class-disabled")) {
            var current = location.pathname.split("/").slice(-1)[0].replace(/^\/|\/$/g, '');
                current = current.replace('admin', '');
            $('#sidebar >.nav > li:not(.not-navigation-link) a').each(function () {
                var $this = $(this);
                if (current === "") {
                    //for root url
                    if ($this.attr('href').indexOf("index.html") !== -1) {
                        $(this).parents('.nav-item').last().addClass('active');
                        if ($(this).parents('.sub-menu').length) {
                            $(this).addClass('active');
                        }
                    }
                } else {
                    //for other url
                    if ($this.attr('href').indexOf(current) !== -1) {
                        $(this).parents('.nav-item').last().addClass('active');
                        if ($(this).parents('.sub-menu').length) {
                            $(this).addClass('active');
                        }
                        if (current !== "index.html") {
                            $(this).parents('.nav-item').last().find(".nav-link").attr("aria-expanded", "true");
                            if ($(this).parents('.sub-menu').length) {
                                $(this).closest('.collapse').addClass('show');
                            }
                        }
                    }
                }
            })
        }

        //Close other submenu in sidebar on opening any
        $("#sidebar > .nav > .nav-item > a[data-toggle='collapse']").on("click", function () {
            $("#sidebar > .nav > .nav-item").find('.collapse.show').collapse('hide');
        });
/*
        (function() {
            $("body").addClass("purchase-banner-active");
            $("body").prepend('\
               <div class= "item-purchase-banner">\
                    <p class="banner-text">Buy now at Bootstrapdash.com</p>\
                    <a href="https://www.bootstrapdash.com/product/star-admin-pro/" target="_blank" class= "banner-button btn btn-primary btn-icon">\
                        <i class="mdi mdi-cart"></i> Buy Now\
                    </a>\
                    <span class="toggler-close"><i class="mdi mdi-close"></i></span>\
                </div>\
            ');
            $(".item-purchase-banner .toggler-close").on("click", function () {
                $(".item-purchase-banner").slideUp(300);
                $("body").removeClass("purchase-banner-active");
                localStorage.setItem('bannerState', "disabled");
            });
        })();*/

        //checkbox and radios
        $(".form-check label,.form-radio label").append('<i class="input-helper"></i>');

    });
})(jQuery);
