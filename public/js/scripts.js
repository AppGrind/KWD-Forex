$(document).ready(function () {
    (function () {
        [].slice.call(document.querySelectorAll('.tabs')).forEach(function (el) {
            new CBPFWTabs(el);
        });
    })();

    $('#fullpage').fullpage({
        'verticalCentered': true,
        'easing': 'easeInOutCirc',
        'css3': false,
        'scrollingSpeed': 900,
        'slidesNavigation': true,
        'slidesNavPosition': 'bottom',
        'easingcss3': 'ease',
        'navigation': true,
        'anchors': ['Home', 'Training', 'Students', 'Pricing', 'Contact'], // ,'About', 'Register', 'Login'
        'navigationPosition': 'left',
    });
     $('.screenshots-content, .students-content').css('height', $(window).height());

    // CONTACT FORM

    $(document).mouseup(function (e) {
        if ($(".sidr-open ")) {
            var container = $("#sidr");

            if (!container.is(e.target) // if the target of the click isn't the container...
                && container.has(e.target).length === 0) // ... nor a descendant of the container
            {
                $(".sidr-open #main-nav").click();
            }
        }
    });


    // $('#submit').click(function () {
    //
    //     $.post("/get-in-touch", $("#contact-form").serialize(), function (response) {
    //         $('#success').fadeIn().html(response);
    //         $('#success').delay(2000).fadeOut();
    //     });
    //     return false;
    //
    // });


});

jQuery(window).load(function () {
    jQuery('#preloader').fadeOut(1500);
});
