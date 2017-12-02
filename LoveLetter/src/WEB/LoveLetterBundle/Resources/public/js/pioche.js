$("document").ready(function(){
    $(".piocher").click(function(){
        var finalstring;
        $.ajax({
            type: 'get',
            url: 'http://localhost/projetWeb/LoveLetter/web/app_dev.php/platform/advert/piocher',
            beforeSend: function () {
                console.log("Pioche ...");
            },
            success: function (data) {
                finalstring = "<a><img src=\"";
                finalstring += "/projetWeb/LoveLetter/web/bundles/webloveletter/img/cartes/"
                finalstring += data.carte+".png";
                finalstring += "\"></a>";
                $(".main").append(finalstring);
                console.log(finalstring);
            }
        });
    });
});