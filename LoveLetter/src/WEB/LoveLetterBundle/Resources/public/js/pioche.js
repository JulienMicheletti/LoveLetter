$("document").ready(function(){
    $(".piocher").click(function(){
        var finalstring;
        var carteC = "prince";
        $.ajax({
            type: 'get',
            url: 'http://90.101.169.174/projetWeb/LoveLetter/web/app_dev.php/advert/piocher',
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
                var newstring = $(finalstring).on('click', function(){
                    $.ajax({
                        type: 'get',
                        url: 'http://90.101.169.174/projetWeb/LoveLetter/web/app_dev.php/advert/poser/'+idCarte+'/'+carteC,
                        beforeSend: function(){
                            if (idCarte == 1){
                                carteC = prompt("Devinez la carte que le joueur possède", "");

                            }
                        },
                        success: function(data){
                            plateaustring = "<a><img src=\"";
                            plateaustring += "/projetWeb/LoveLetter/web/bundles/webloveletter/img/cartes/"
                            plateaustring += data.card + ".png";
                            plateaustring += "\"></a>";
                            $(".plateau").append(plateaustring);
                            $("."+data.card+"").remove();
                            console.log(plateaustring);
                            console.log(data.rep);
                        }
                    })
                });//
                $(".main").append(newstring);
                console.log(newstring);
            }
        });
    });
});