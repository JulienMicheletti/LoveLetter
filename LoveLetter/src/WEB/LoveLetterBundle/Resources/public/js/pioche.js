$("document").ready(function(){
    $(".piocher").click(function(){
        var finalstring;
        var carteC = "prince";
        var joueur = "default";
        $.ajax({
            type: 'get',
            url: 'http://localhost/projetWeb/LoveLetter/web/app_dev.php/advert/piocher',
            beforeSend: function () {
                console.log("Pioche ...");
            },
            success: function (data) {
                if (data.check == 2){
                    alert("Vous avez perdu pour cette manche, vous ne pouvez plus jouer, ni piocher !");
                } else {finalstring = "<a class=\"" + data.carte + "\"><img src=\"";
                finalstring += "/projetWeb/LoveLetter/web/bundles/webloveletter/img/cartes/"
                finalstring += data.carte + ".png";
                finalstring += "\"></a>";
                console.log(data.rep);
                if (data.repComtesse == true){
                    $(".comtesse").remove();
                    alert("Effet de la comtesse : La comtzsse a été défaussée de votre main");
                }var idCarte = data.id;
                var plateaustring;
                var users = data.utilisateurs;
                var me = data.me;
                var newstring = $(finalstring).on('click', function(){
                    if (idCarte == 1){
                        joueur = prompt("Quel joueur ciblez vous ?");
                        while (joueur != users){
                            alert("Ce joueur n'existe pas !");
                            joueur = prompt("Quel joueur ciblez vous ?");
                        }
                        carteC = prompt("Devinez la carte que le joueur possède", "");
                    } else if (idCarte == 5){
                        console.log(me);
                        joueur = prompt("Quel joueur ciblez vous ?");
                        while (joueur != users && joueur != me){
                            alert("Ce joueur n'existe pas !");
                            joueur = prompt("Quel joueur ciblez vous ?");
                        }
                        carteC = joueur;
                    }
                    $.ajax({
                        type: 'get',
                        url: 'http://localhost/projetWeb/LoveLetter/web/app_dev.php/advert/poser/'+idCarte+'/'+carteC,
                        success: function(data){
                            plateaustring = "<a><img src=\"";
                            plateaustring += "/projetWeb/LoveLetter/web/bundles/webloveletter/img/cartes/"
                            plateaustring += data.card + ".png";
                            plateaustring += "\"></a>";
                            $(".plateau").append(plateaustring);
                            $("."+data.card+"").remove();
                            if (idCarte == 1 && data.rep == true){
                                alert("Effet garde : Vous avez trouvé la bonne carte, le joueur a été éliminé");
                            }else if (idCarte == 1 && data.rep == false){
                                alert("Effet garde : Vous vous êtes trompé");
                            }
                            if (data.repPrince == true && data.user == me){
                                alert("Effet du prince : Votre main a été remplacée");
                                console.log(data.user);
                                console.log(data.nouvelleCarte);
                                $("."+data.ancienneCarte+"").remove();
                                finalstring = "<a class=\"" + data.nouvelleCarte + "\"><img src=\"";
                                finalstring += "/projetWeb/LoveLetter/web/bundles/webloveletter/img/cartes/"
                                finalstring += data.nouvelleCarte + ".png";
                                finalstring += "\"></a>";
                                $(".main").append(finalstring);
                            }
                        }
                    })
                });
                $(".main").append(newstring);
                console.log(newstring);}
            }
        });
    });
});