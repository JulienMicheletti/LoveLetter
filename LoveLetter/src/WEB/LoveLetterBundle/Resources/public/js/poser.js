$("document").ready(function() {
    $(".main").click(function () {
        var carte = $(".baron").value();
        $.ajax({
            type: 'get',
            //  url: 'http://localhost/projetWeb/LoveLetter/web/app_dev.php/platform/advert/poser',
            beforeSend: function () {
                console.log("clique");
            },
            success: function (data) {
                console.log(carte);
            }
        });
    });

    $(".comtesse").click(function () {
        var carte = $(".baron").value();
        $.ajax({
            type: 'get',
            //  url: 'http://localhost/projetWeb/LoveLetter/web/app_dev.php/platform/advert/poser',
            beforeSend: function () {
                console.log("clique");
            },
            success: function (data) {
                console.log(carte);
            }
        });
    });

    $(".garde").click(function () {
        var carte = $(".baron").value();
        $.ajax({
            type: 'get',
            //  url: 'http://localhost/projetWeb/LoveLetter/web/app_dev.php/platform/advert/poser',
            beforeSend: function () {
                console.log("clique");
            },
            success: function (data) {
                console.log(carte);
            }
        });
    });

    $(".prince").click(function () {
        var carte = $(".baron");
        $.ajax({
            type: 'get',
            //  url: 'http://localhost/projetWeb/LoveLetter/web/app_dev.php/platform/advert/poser',
            beforeSend: function () {
                console.log("clique");
            },
            success: function (data) {
                console.log(carte);
            }
        });
    });
});