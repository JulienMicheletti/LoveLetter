$("document").ready(function () {
    $(".piocher").click(function () {
        var finalstring;
        var carteC = "defaultCarte";
        var joueur = "default";
        $.ajax({
            type: 'get',
            url: 'http://90.101.169.174/projetWeb/LoveLetter/web/app_dev.php/advert/piocher/0/0',
            beforeSend: function (){
                console.log("Pioche ...");
            },
            success: function (data) {
                if (data.gagnant != null || data.finP == true){
                    alert("La partie est finie, félicitation "+data.gagnant);
                    finP = true;
                }
                if (data.fin == true) {
                    alert("fin de la manche, piochez une carte pour déclencher la suivante");
                } else if (data.check == 2) {
                    alert("Vous avez perdu pour cette manche, vous ne pouvez plus jouer, ni piocher !");
                } else if (data.nbMax == true){
                    alert("Vous ne pouvez pas piocher plus de 2 cartes");
                } else if (data.tour != data.me){
                    alert("Ce n'est pas votre tour de jouer !");
                } else{
                    finalstring = "<a class=\"" + data.carte + "\"><img src=\"";
                    finalstring += "/projetWeb/LoveLetter/web/bundles/webloveletter/img/cartes/"
                    finalstring += data.carte + ".png";
                    finalstring += "\"></a>";
                    if (data.repComtesse == true) {
                        $(".comtesse").remove();
                    }
                    var idCarte = data.id;
                    var typeCarte = data.type;
                    var plateaustring;
                    var users = data.utilisateurs;
                    var me = data.me;
                    var newstring = setEffet(finalstring, typeCarte, users, me, idCarte, data.pose);
                    $(".main").append(newstring);
                }
            }
        });
    });

    function setEffet(finalstring, typeCarte, users, me, idCarte, pose) {
        var newstring = $(finalstring).on('click', function () {
            if (pose == 0){
                alert("Vous n'avez qu'une carte en main !");
                return finalstring;
            }
            console.log("ok"+typeCarte);
            var carteC;
            if (typeCarte == 1) {
                joueur = prompt("Quel joueur ciblez vous ?");
                while (joueur != users && joueur != me) {
                    alert("Ce joueur n'existe pas !");
                    joueur = prompt("Quel joueur ciblez vous ?");
                }
                carteC = prompt("Devinez la carte que le joueur possède", "");
                while (carteC == "garde" | carteC == "Garde") {
                    alert("Vous ne pouvez pas dire que c'est un Garde !");
                    carteC = prompt("Devinez la carte que le joueur possède", "");
                }
            }else if (typeCarte == 4){
                alert("Effet servante : Vous êtes immunisé jusqu'au prochain tour") ;
            } else if (typeCarte == 6) {
                joueur = prompt("Quel joueur ciblez vous ?");
                while (joueur != users && joueur != me) {
                    alert("Ce joueur n'existe pas !");
                    joueur = prompt("Quel joueur ciblez vous ?");
                }
            } else if (typeCarte == 5) {
                joueur = prompt("Quel joueur ciblez vous ?");
                while (joueur != users && joueur != me) {
                    alert("Ce joueur n'existe pas !");
                    joueur = prompt("Quel joueur ciblez vous ?");
                }
                carteC = joueur;
            } else if (typeCarte == 3) {
                joueur = prompt("Quel joueur ciblez vous ?");
                while (joueur != users && joueur != me) {
                    alert("Ce joueur n'existe pas !");
                    joueur = prompt("Quel joueur ciblez vous ?");
                }
            } else if (typeCarte == 2) {
                joueur = prompt("Quel joueur ciblez vous ?");
                while (joueur != users && joueur != me) {
                    alert("Ce joueur n'existe pas !");
                    joueur = prompt("Quel joueur ciblez vous ?");
                }
                carteC = joueur;
            }
            $.ajax({
                type: 'get',
                url: 'http://90.101.169.174/projetWeb/LoveLetter/web/app_dev.php/advert/poser/' + idCarte + '/' + carteC + '/' + typeCarte,
                success: function (data) {
                    $("." + data.card + "").remove();
                    if (typeCarte == 1 && data.rep == true) {
                        alert("Effet garde : Vous avez trouvé la bonne carte, le joueur a été éliminé");
                    } else if (typeCarte == 1 && data.rep == false) {
                        alert("Effet garde : Vous vous êtes trompé");
                    }
                    if (data.immu == true){
                        alert("Vous êtes immunisé !");
                    }
                    if (typeCarte == 3) {
                        if (data.repBaron == "me") {
                            alert("Effet baron : Votre carte est inférieur à la carte adverse, vous êtes éliminé de la manche");
                        } else if (data.repBaron == "enemy") {
                            alert("Effet baron : Votre carte est supérieur à la carte adverse, l'adversaire est éliminé de la manche");
                        } else {
                            alert("Effet baron : Vos deux cartes sont égales, personne n'est éliminé");
                        }
                    }
                    if (data.alertPrincesse == true) {
                        alert("Effet princesse : Vous êtes éliminé de la manche car la princesse a été défaussée");
                    }
                    if (data.repPrince == true) {
                        if (data.user == me) {
                            alert("Effet du prince : Votre main a été remplacée");
                            piocher(".main", 0);
                        }
                        else
                            piocher(".adversaire", 1);
                    }
                    if (data.card == "prêtre") {
                        alert("Effet du prêtre : La main adverse va être affiché pendant 5 secondes !");
                        setTimeout(function () {
                            $.ajax({
                                type: 'get',
                                url: 'http://90.101.169.174/projetWeb/LoveLetter/web/app_dev.php/advert/pretre/' + carteC + '/0',
                                success: function (data) {
                                    alert("Effet du prêtre : effet terminé !");
                                }
                            })
                        }, 5000);
                    }
                    if (data.card == "roi") {
                        idCarte = data.rep.cid;
                        var mainstring = "<a class=\"" + data.rep.nom + "\"><img src=\"";
                        mainstring += "/projetWeb/LoveLetter/web/bundles/webloveletter/img/cartes/"
                        mainstring += data.rep.nom + ".png";
                        mainstring += "\"></a>";
                        newstring = $(mainstring).on('click', function () {
                            if (typeCarte == 1) {
                                joueur = prompt("Quel joueur ciblez vous ?");
                                while (joueur != users && joueur != me) {
                                    alert("Ce joueur n'existe pas !");
                                    joueur = prompt("Quel joueur ciblez vous ?");
                                }
                                carteC = prompt("Devinez la carte que le joueur possède", "");
                                while (carteC == "garde" | carteC == "Garde" | carteC == ""){
                                    alert("Vous ne pouvez pas dire que c'est un Garde !");
                                    carteC = prompt("Devinez la carte que le joueur possède", "");
                                }
                            } else if (typeCarte == 5) {
                                console.log(me);
                                joueur = prompt("Quel joueur ciblez vous ?");
                                while (joueur != users && joueur != me) {
                                    alert("Ce joueur n'existe pas !");
                                    joueur = prompt("Quel joueur ciblez vous ?");
                                }
                                carteC = joueur;
                            } else if (typeCarte == 3) {
                                joueur = prompt("Quel joueur ciblez vous ?");
                                while (joueur != users && joueur != me) {
                                    alert("Ce joueur n'existe pas !");
                                    joueur = prompt("Quel joueur ciblez vous ?");
                                }
                            } else if (typeCarte == 2) {
                                joueur = prompt("Quel joueur ciblez vous ?");
                                while (joueur != users && joueur != me) {
                                    alert("Ce joueur n'existe pas !");
                                    joueur = prompt("Quel joueur ciblez vous ?");
                                }
                                carteC = joueur;
                            }
                            $.ajax({
                                type: 'get',
                                url: 'http://90.101.169.174/projetWeb/LoveLetter/web/app_dev.php/advert/poser/' + idCarte + '/' + carteC + '/' + typeCarte,
                                success: function (data) {
                                    $("." + data.card + "").remove();
                                    if (typeCarte == 1 && data.rep == true) {
                                        alert("Effet garde : Vous avez trouvé la bonne carte, le joueur a été éliminé");
                                    } else if (typeCarte == 1 && data.rep == false) {
                                        alert("Effet garde : Vous vous êtes trompé");
                                    }
                                    if (typeCarte == 3) {
                                        if (data.repBaron == "me") {
                                            alert("Effet baron : Votre carte est inférieur à la carte adverse, vous êtes éliminé de la manche");
                                        } else if (data.repBaron == "enemy") {
                                            alert("Effet baron : Votre carte est supérieur à la carte adverse, l'adversaire est éliminé de la manche");
                                        } else {
                                            alert("Effet baron : Vos deux cartes sont égales, personne n'est éliminé");
                                        }
                                    }
                                    if (data.alertPrincesse == true) {
                                        alert("Effet princesse : Vous êtes éliminé de la manche car la princesse a été défaussée");
                                    }
                                    if (data.repPrince == true) {
                                        if (data.user == me) {
                                            alert("Effet du prince : Votre main a été remplacée");
                                            piocher(".main", 0);
                                        }
                                        else
                                            piocher(".adversaire", 1);
                                    }
                                    if (data.card == "prêtre") {
                                        alert("Effet du prêtre : La main adverse va être affiché pendant 5 secondes !");
                                        setTimeout(function () {
                                            $.ajax({
                                                type: 'get',
                                                url: 'http://90.101.169.174/projetWeb/LoveLetter/web/app_dev.php/advert/pretre/' + carteC + '/0',
                                                success: function (data) {
                                                    alert("Effet du prêtre : effet terminé !");
                                                }
                                            })
                                        }, 5000);
                                    }
                                }
                            });
                        })
                        $(".main").html(newstring);
                        alert("Effet du Roi : Mains échangées !");
                    }
                }
            });
        })
        return newstring;
    }

    function piocher(nomClass, id) {
        var finalstring;
        var carteC = "defaultCarte";
        var joueur = "default";
        $.ajax({
            type: 'get',
            url: 'http://90.101.169.174/projetWeb/LoveLetter/web/app_dev.php/advert/piocher/' + id + '/1',
            beforeSend: function () {
                console.log("Pioche du prince ..");
            },
            success: function (data) {
                if (data.check == 2) {
                    alert("Vous avez perdu pour cette manche, vous ne pouvez plus jouer, ni piocher !");
                } else {
                    finalstring = "<a class=\"" + data.carte + "\"><img src=\"";
                    finalstring += "/projetWeb/LoveLetter/web/bundles/webloveletter/img/cartes/"
                    finalstring += data.carte + ".png";
                    finalstring += "\"></a>";
                    if (data.repComtesse == true) {
                        $(".comtesse").remove();
                    }
                    var idCarte = data.id;
                    var typeCarte = data.type;
                    var plateaustring;
                    var users = data.utilisateurs;
                    var me = data.me;
                    var newstring = $(finalstring).on('click', function () {
                        if (typeCarte == 1) {
                            joueur = prompt("Quel joueur ciblez vous ?");
                            while (joueur != users && joueur != me) {
                                alert("Ce joueur n'existe pas !");
                                joueur = prompt("Quel joueur ciblez vous ?");
                            }
                            carteC = prompt("Devinez la carte que le joueur possède", "");
                            while (carteC == "garde" | carteC == "Garde" | carteC == ""){
                                alert("Vous ne pouvez pas dire que c'est un Garde !");
                                carteC = prompt("Devinez la carte que le joueur possède", "");
                            }
                        }  else if (typeCarte == 3) {
                            joueur = prompt("Quel joueur ciblez vous ?");
                            while (joueur != users && joueur != me) {
                                alert("Ce joueur n'existe pas !");
                                joueur = prompt("Quel joueur ciblez vous ?");
                            }
                        }
                        else if (typeCarte == 6) {
                            joueur = prompt("Quel joueur ciblez vous ?");
                            while (joueur != users && joueur != me) {
                                alert("Ce joueur n'existe pas !");
                                joueur = prompt("Quel joueur ciblez vous ?");
                            }
                        } else if (typeCarte == 5) {
                            joueur = prompt("Quel joueur ciblez vous ?");
                            while (joueur != users && joueur != me) {
                                alert("Ce joueur n'existe pas !");
                                joueur = prompt("Quel joueur ciblez vous ?");
                            }
                            carteC = joueur;
                        } else if (typeCarte == 2) {
                            joueur = prompt("Quel joueur ciblez vous ?");
                            while (joueur != users && joueur != me) {
                                alert("Ce joueur n'existe pas !");
                                joueur = prompt("Quel joueur ciblez vous ?");
                            }
                            carteC = joueur;
                        }
                        $.ajax({
                            type: 'get',
                            url: 'http://90.101.169.174/projetWeb/LoveLetter/web/app_dev.php/advert/poser/' + idCarte + '/' + carteC + '/' + typeCarte,
                            success: function (data) {
                                $("." + data.card + "").remove();
                                if (typeCarte == 1 && data.rep == true) {
                                    alert("Effet garde : Vous avez trouvé la bonne carte, le joueur a été éliminé");
                                } else if (typeCarte == 1 && data.rep == false) {
                                    alert("Effet garde : Vous vous êtes trompé");
                                }
                                if (data.alertPrincesse == true) {
                                    alert("Effet princesse : Vous êtes éliminé de la manche car la princesse a été défaussée");
                                }
                                if (typeCarte == 3) {
                                    if (data.repBaron == "me") {
                                        alert("Effet baron : Votre carte est inférieur à la carte adverse, vous êtes éliminé de la manche");
                                    } else if (data.repBaron == "enemy") {
                                        alert("Effet baron : Votre carte est supérieur à la carte adverse, l'adversaire est éliminé de la manche");
                                    } else {
                                        alert("Effet baron : Vos deux cartes sont égales, personne n'est éliminé");
                                    }
                                }
                                if (data.repPrince == true) {
                                    if (data.user == me) {
                                        alert("Effet du prince : Votre main a été remplacée");
                                        piocher(".main", 0);
                                    }
                                    else
                                        piocher(".adversaire", 1);
                                }
                                if (data.card == "prêtre") {
                                    alert("Effet du prêtre : La main adverse va être affiché pendant 5 secondes !");
                                    setTimeout(function () {
                                        $.ajax({
                                            type: 'get',
                                            url: 'http://90.101.169.174/projetWeb/LoveLetter/web/app_dev.php/advert/pretre/' + carteC + '/0',
                                            success: function (data) {
                                                alert("Effet du prêtre : effet terminé !");
                                            }
                                        })
                                    }, 5000);
                                }
                                if (data.card == "roi") {
                                    idCarte = data.rep.cid;
                                    var mainstring = "<a class=\"" + data.rep.nom + "\"><img src=\"";
                                    mainstring += "/projetWeb/LoveLetter/web/bundles/webloveletter/img/cartes/"
                                    mainstring += data.rep.nom + ".png";
                                    mainstring += "\"></a>";
                                    newstring = $(mainstring).on('click', function () {
                                        if (typeCarte == 1) {
                                            joueur = prompt("Quel joueur ciblez vous ?");
                                            while (joueur != users && joueur != me) {
                                                alert("Ce joueur n'existe pas !");
                                                joueur = prompt("Quel joueur ciblez vous ?");
                                            }
                                            carteC = prompt("Devinez la carte que le joueur possède", "");
                                            while (carteC == "garde" | carteC == "Garde" | carteC == ""){
                                                alert("Vous ne pouvez pas dire que c'est un Garde !");
                                                carteC = prompt("Devinez la carte que le joueur possède", "");
                                            }
                                        }  else if (typeCarte == 3) {
                                            joueur = prompt("Quel joueur ciblez vous ?");
                                            while (joueur != users && joueur != me) {
                                                alert("Ce joueur n'existe pas !");
                                                joueur = prompt("Quel joueur ciblez vous ?");
                                            }
                                        } else if (typeCarte == 5) {
                                            joueur = prompt("Quel joueur ciblez vous ?");
                                            while (joueur != users && joueur != me) {
                                                alert("Ce joueur n'existe pas !");
                                                joueur = prompt("Quel joueur ciblez vous ?");
                                            }
                                            carteC = joueur;
                                        } else if (typeCarte == 2) {
                                            joueur = prompt("Quel joueur ciblez vous ?");
                                            while (joueur != users && joueur != me) {
                                                alert("Ce joueur n'existe pas !");
                                                joueur = prompt("Quel joueur ciblez vous ?");
                                            }
                                            carteC = joueur;
                                        }
                                        $.ajax({
                                            type: 'get',
                                            url: 'http://90.101.169.174/projetWeb/LoveLetter/web/app_dev.php/advert/poser/' + idCarte + '/' + carteC + '/' + typeCarte,
                                            success: function (data) {
                                                $("." + data.card + "").remove();
                                                if (typeCarte == 1 && data.rep == true) {
                                                    alert("Effet garde : Vous avez trouvé la bonne carte, le joueur a été éliminé");
                                                } else if (typeCarte == 1 && data.rep == false) {
                                                    alert("Effet garde : Vous vous êtes trompé");
                                                }
                                                if (data.alertPrincesse == true) {
                                                    alert("Effet princesse : Vous êtes éliminé de la manche car la princesse a été défaussée");
                                                }
                                                if (typeCarte == 3) {
                                                    if (data.repBaron == "me") {
                                                        alert("Effet baron : Votre carte est inférieur à la carte adverse, vous êtes éliminé de la manche");
                                                    } else if (data.repBaron == "enemy") {
                                                        alert("Effet baron : Votre carte est supérieur à la carte adverse, l'adversaire est éliminé de la manche");
                                                    } else {
                                                        alert("Effet baron : Vos deux cartes sont égales, personne n'est éliminé");
                                                    }
                                                }
                                                if (data.repPrince == true) {
                                                    if (data.user == me) {
                                                        alert("Effet du prince : Votre main a été remplacée");
                                                        piocher(".main", 0);
                                                    }
                                                    else
                                                        piocher(".adversaire", 1);
                                                }
                                                if (data.card == "prêtre") {
                                                    alert("Effet du prêtre : La main adverse va être affiché pendant 5 secondes !");
                                                    setTimeout(function () {
                                                        $.ajax({
                                                            type: 'get',
                                                            url: 'http://90.101.169.174²2/projetWeb/LoveLetter/web/app_dev.php/advert/pretre/' + carteC + '/0',
                                                            success: function (data) {
                                                                alert("Effet du prêtre : effet terminé !");
                                                            }
                                                        })
                                                    }, 5000);
                                                }
                                            }
                                        });
                                    })
                                    $(".main").html(newstring);
                                    alert("Effet du Roi : Mains échangées !");
                                }
                            }
                        });
                    })
                    $(nomClass).html(newstring);
                }
            }
        });
    }
});