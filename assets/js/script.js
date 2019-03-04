//boutons afficher et masquer
$("#show").click(function () {
    $(".comments").show("slow");
});

$("#hide").click(function () {
    $(".comments").hide(1000);
});

//bouton retour en haut
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

//tableaux responsives
document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.table').forEach(function (table) {
        var labels = Array.from(table.querySelectorAll('th')).map(function (th) {
            return th.innerText
        });
        table.querySelectorAll('td').forEach(function (td, i) {
            td.setAttribute('data-label', labels[i % labels.length])
        })
    })
});