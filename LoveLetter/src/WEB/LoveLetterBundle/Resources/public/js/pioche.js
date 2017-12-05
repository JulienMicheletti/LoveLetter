$("document").ready(function(){
    $(".piocher").click(function(){
        var finalstring;
        var carteC = "prine";
        var joueur = "default";
        $.ajax({
            type: 'get',
            url: 'http://localhost/projetWeb/LoveLetter/web/app_dev.php/advert/piocher',
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
                var users = data.utilisateurs;
                var me = data.me;
                var newstring = $(finalstring).on('click', function(){
                    if (idCarte == 1){
                        joueur = prompt("Quel joueur ciblez vous ?");
                        while (joueur != users && joueur != me){
                            alert("Ce joueur n'existe pas !");
                            joueur = prompt("Quel joueur ciblez vous ?");
                        }
                        carteC = prompt("Devinez la carte que le joueur possède", "");
                    }
                    $.ajax({
                        type: 'get',
                        url: 'http://localhost/projetWeb/LoveLetter/web/app_dev.php/advert/poser/'+idCarte+'/'+carteC,
                        success: function(data){
                            console.log(data.carteA);
                            console.log(data.carteD);
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