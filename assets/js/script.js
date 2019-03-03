$("#show").click(function () {
    $(".comments").show("slow");
});

$("#hide").click(function () {
    $(".comments").hide(1000);
});

$(function () {
    $('#btn_up').click(function () {
        $('html,body').animate({scrollTop: 0}, 'slow');
    });

    $(window).scroll(function () {
        if ($(window).scrollTop() < 50) {
            $('#btn_up').fadeOut();
        } else {
            $('#btn_up').fadeIn();
        }
    });
});