$("document").ready(function(){
    $(".piocher").click(function(){
        var finalstring;
        var carteC = "defaultCarte";
        var joueur = "default";
        $.ajax({
            type: 'get',
            url: 'http://localhost/projetWeb/LoveLetter/web/app_dev.php/advert/piocher',
            beforeSend: function () {
                console.log("Pioche ...");
            },
            success: function (data) {
                if (data.check == 2) {
                    alert("Vous avez perdu pour cette manche, vous ne pouvez plus jouer, ni piocher !");
                } else {
                    console.log(data.carte);
                    finalstring = "<a class=\"" + data.carte + "\"><img src=\"";
                    finalstring += "/projetWeb/LoveLetter/web/bundles/webloveletter/img/cartes/"
                    finalstring += data.carte + ".png";
                    finalstring += "\"></a>";
                    console.log(data.rep);
                    if (data.repComtesse == true) {
                        $(".comtesse").remove();
                    }
                    var idCarte = data.id;
                    var plateaustring;
                    var users = data.utilisateurs;
                    var me = data.me;
                    var newstring = $(finalstring).on('click', function () {
                        if (idCarte == 1) {
                            joueur = prompt("Quel joueur ciblez vous ?");
                            while (joueur != users && joueur != me) {
                                alert("Ce joueur n'existe pas !");
                                joueur = prompt("Quel joueur ciblez vous ?");
                            }
                            carteC = prompt("Devinez la carte que le joueur possède", "");
                        } else if (idCarte == 6) {
                            joueur = prompt("Quel joueur ciblez vous ?");
                            while (joueur != users && joueur != me) {
                                alert("Ce joueur n'existe pas !");
                                joueur = prompt("Quel joueur ciblez vous ?");
                            }
                        }
                        $.ajax({
                            type: 'get',
                            url: 'http://localhost/projetWeb/LoveLetter/web/app_dev.php/advert/poser/' + idCarte + '/' + carteC,
                            success: function (data) {
                                console.log(data.rep);
                                /*plateaustring = "<a><img src=\"";
                                plateaustring += "/projetWeb/LoveLetter/web/bundles/webloveletter/img/cartes/"
                                plateaustring += data.card + ".png";
                                plateaustring += "\"></a>";
                                $(".plateau").append(plateaustring);*/
                                $("." + data.card + "").remove();
                                if (data.card == "roi") {
                                    idCarte = data.rep.cid;
                                    var mainstring = "<a class=\"" + data.rep.nom + "\"><img src=\"";
                                    mainstring += "/projetWeb/LoveLetter/web/bundles/webloveletter/img/cartes/"
                                    mainstring += data.rep.nom + ".png";
                                    mainstring += "\"></a>";
                                    newstring = $(mainstring).on('click', function () {
                                        if (idCarte == 1) {
                                            joueur = prompt("Quel joueur ciblez vous ?");
                                            while (joueur != users && joueur != me) {
                                                alert("Ce joueur n'existe pas !");
                                                joueur = prompt("Quel joueur ciblez vous ?");
                                            }
                                            carteC = prompt("Devinez la carte que le joueur possède", "");
                                        }
                                        $.ajax({
                                            type: 'get',
                                            url: 'http://localhost/projetWeb/LoveLetter/web/app_dev.php/advert/poser/' + idCarte + '/' + carteC,
                                            success: function (data) {
                                                console.log(data.carteA);
                                                console.log(data.carteD);
                                            /*plateaustring = "<a><img src=\"";
                                                plateaustring += "/projetWeb/LoveLetter/web/bundles/webloveletter/img/cartes/"
                                                plateaustring += data.card + ".png";
                                                plateaustring += "\"></a>";
                                                $(".plateau").append(plateaustring);*/
                                                $("." + data.card + "").remove();
                                            }
                                        });
                                    })
                                    $(".main").html(newstring);
                                    console.log(newstring);
                                    alert("Effet du Roi : Mains échangées !");
                                }
                            }
                        });
                    })
                    $(".main").append(newstring);
                    console.log(newstring);
                }
            }
        });
    });
});