$("document").ready(function(){
    $(".piocher").click(function(){
        var finalstring;
        var carte;
        $.ajax({
            type: 'get',
            url: 'http://localhost/projetWeb/LoveLetter/web/app_dev.php/platform/advert/piocher',
            beforeSend: function () {
                console.log("Pioche ...");
            },
            success: function (data) {
                finalstring = "<a class=\"" + data.carte + "\"><img src=\"";
                finalstring += "/projetWeb/LoveLetter/web/bundles/webloveletter/img/cartes/"
                finalstring += data.carte + ".png";
                finalstring += "\"></a>";
                var idCarte = data.id;
                var plateaustring;
                var removestring;
                var newstring = $(finalstring).on('click', function(){
                    $.ajax({
                        type: 'get',
                        url: 'http://localhost/projetWeb/LoveLetter/web/app_dev.php/platform/advert/poser/'+idCarte,
                        success: function(data){
                            plateaustring = "<a><img src=\"";
                            plateaustring += "/projetWeb/LoveLetter/web/bundles/webloveletter/img/cartes/"
                            plateaustring += data.card + ".png";
                            plateaustring += "\"></a>";
                            removestring = "<a class=\"" + data.card + "\"><img src=\"";
                            removestring += "/projetWeb/LoveLetter/web/bundles/webloveletter/img/cartes/"
                            removestring += data.card + ".png";
                            removestring += "\"></a>";
                            $(".plateau").append(plateaustring);
                            $("."+data.card+"").remove();
                            console.log(plateaustring);
                        }
                    })
                });
                $(".main").append(newstring);
                console.log(newstring);
            }
        });
    });
});