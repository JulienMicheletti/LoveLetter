$("document").ready(function () {
    refresh_plateau();
    refresh_adversaire2();

    function refresh_adversaire2() {
        $.ajax({
            type: 'get',
            url: 'http://90.101.169.174/projetWeb/LoveLetter/web/app_dev.php/advert/adversaire2',
            success: function (data) {
                var string = "";
                if (data.tab.taille == 1) {
                    // console.log("test");
                    string = "<a><img src=\"";
                    string += "/projetWeb/LoveLetter/web/bundles/webloveletter/img/cartes/";
                    string += data.tab.c1 + ".png";
                    string += "\"></a>";
                }
                if (data.tab.taille == 2) {
                    string += "<a><img src=\"";
                    string += "/projetWeb/LoveLetter/web/bundles/webloveletter/img/cartes/pioche.png";
                    //   string += data.tab.c2 + ".png";
                    string += "\"></a>";
                }
                $(".adversaire").html(string);
            }
        });
    }

    function refresh_plateau() {
        $.ajax({
            type: 'get',
            url: 'http://90.101.169.174/projetWeb/LoveLetter/web/app_dev.php/advert/refresh',
            success: function (data) {
                var i = data.plateau_a[1] + 1;
                var plateau = "";
                $(".noma").html(data.point[3]);
                $(".pointa").html(data.point[4]);
                $(".nomj").html(data.point[1]);
                $(".pointj").html(data.point[2]);
                while (i > 1) {
                    plateau += "<a><img src=\"";
                    plateau += "/projetWeb/LoveLetter/web/bundles/webloveletter/img/cartes/";
                    plateau += data.plateau_a[i] + ".png";
                    plateau += "\"></a>";
                    i -= 1;
                }
                i = data.plateau_j[1] + 1;
                var plateauj = "";
                while (i > 1) {
                    plateauj += "<a><img src=\"";
                    plateauj += "/projetWeb/LoveLetter/web/bundles/webloveletter/img/cartes/";
                    plateauj += data.plateau_j[i] + ".png";
                    plateauj += "\"></a>";
                    i -= 1;
                }
                var a = 2;
                var defausse = "";
                for (a; a < 5; a++) {
                    defausse += "<a><img src=\"";
                    defausse += "/projetWeb/LoveLetter/web/bundles/webloveletter/img/cartes/";
                    defausse += data.defausse[a] + ".png";
                    defausse += "\"></a>";
                }
                $(".regle2").html(defausse);
                defausse = "<a><img src=\"";
                defausse += "/projetWeb/LoveLetter/web/bundles/webloveletter/img/cartes/";
                defausse += data.defausse[1] + ".png";
                defausse += "\"></a>";
                $(".defausse").html(defausse);
                if (data.plateau_j[1] > 0)
                    $(".plateau-j").html(plateauj);
                if (data.plateau_a[1] > 0)
                    $(".plateau-a").html(plateau);
                if (data.plateau_a[1] == 0)
                    $(".plateau-a").html("<a></a>");
                if (data.plateau_j[1] == 0)
                    $(".plateau-j").html("<a></a>");
            }
        })
    }

    function refresh_main() {
        $.ajax({
            type: 'get',
            url: 'http://90.101.169.174/projetWeb/LoveLetter/web/app_dev.php/advert/refreshMain',
            success: function (data) {
                var string;
                console.log(data.tab.taille);
                if (data.tab.taille == 0){
                    $(".main").html("<a></a>");
                }
                if (data.tab.taille >= 1) {
                    string = "<a class=\"" + data.tab.c1 + "\"><img src=\"";
                    string += "/projetWeb/LoveLetter/web/bundles/webloveletter/img/cartes/";
                    string += data.tab.c1 + ".png";
                    string += "\"></a>";
                    if (data.tab.taille == 1) {
                        string = setEffet(string, data.tab.type1, data.user, data.me, data.tab.idCarte1, 0, data.tour);
                        $(".main").html(string);
                    }
                }
                if (data.tab.taille == 2) {
                    var string2;
                    string2 = "<a class=\"" + data.tab.c2 + "\"><img src=\"";
                    string2 += "/projetWeb/LoveLetter/web/bundles/webloveletter/img/cartes/";
                    string2 += data.tab.c2 + ".png";
                    string2 += "\"></a>";
                    string2 = setEffet(string2, data.tab.type2, data.user, data.me, data.tab.idCarte2, 1, data.tour);
                    string = setEffet(string, data.tab.type1, data.user, data.me, data.tab.idCarte1, 1, data.tour);
                    $(".main").html(string2);
                    $(".main").append(string);
                }
            }
        });
    }

    function setEffet(finalstring, typeCarte, users, me, idCarte, set, tour) {
        var newstring = $(finalstring).on('click', function () {
            if (tour != me){
                alert("Ce n'est pas votre tour de jouer !");
                return finalstring;
            }
            if (set == 0){
                alert("Vous n'avez qu'une carte en main !");
                return finalstring;
            }
            var check = 1;
            if (check == 0) {
                console.log("test");
                return finalstring;
            }
            var carteC;
            if (typeCarte == 1) {
                joueur = prompt("Quel joueur ciblez vous ?");
                while (joueur != users && joueur != me) {
                    alert("Ce joueur n'existe pas !");
                    joueur = prompt("Quel joueur ciblez vous ?");
                }
                carteC = prompt("Devinez la carte que le joueur possède", "");
                while (carteC == "garde" | carteC == "Garde"){
                    alert("Vous ne pouvez pas dire que c'est un Garde !");
                    carteC = prompt("Devinez la carte que le joueur possède", "");
                }
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
                beforeSend:function(){
                    console.log("pose..");
                },
                success: function (data) {
                    console.log("ID : "+idCarte);
                    console.log("carteC : "+carteC);
                    console.log("type : "+typeCarte);
                    console.log("pose");
                    console.log(data.card);
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
                                while (carteC == "garde" | carteC == "Garde"){
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
                                    console.log(data.card);
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
            url: 'http://90.101.169.174/projetWeb/LoveLetter/web/app_dev.php/advert/piocher/' + id,
            beforeSend: function () {
                console.log("Pioche du prince ..");
            },
            success: function (data) {
                if (data.check == 2) {
                    alert("Vous avez perdu pour cette manche, vous ne pouvez plus jouer, ni piocher !");
                } else {
                    console.log("PRINCE :" + data.carte);
                    finalstring = "<a class=\"" + data.carte + "\"><img src=\"";
                    finalstring += "/projetWeb/LoveLetter/web/bundles/webloveletter/img/cartes/"
                    finalstring += data.carte + ".png";
                    finalstring += "\"></a>";
                    console.log(data.rep);
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
                            while (carteC == "garde" | carteC == "Garde"){
                                alert("Vous ne pouvez pas dire que c'est un Garde !");
                                carteC = prompt("Devinez la carte que le joueur possède", "");
                            }
                        } else if (typeCarte == 6) {
                            joueur = prompt("Quel joueur ciblez vous ?");
                            while (joueur != users && joueur != me) {
                                alert("Ce joueur n'existe pas !");
                                joueur = prompt("Quel joueur ciblez vous ?");
                            }
                        } else if (typeCarte == 5) {
                            console.log(me);
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
                                console.log(data.card);
                                $("." + data.card + "").remove();
                                if (typeCarte == 1 && data.rep == true) {
                                    alert("Effet garde : Vous avez trouvé la bonne carte, le joueur a été éliminé");
                                } else if (typeCarte == 1 && data.rep == false) {
                                    alert("Effet garde : Vous vous êtes trompé");
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
                                            while (carteC == "garde" | carteC == "Garde"){
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
                                                console.log(data.card);
                                                $("." + data.card + "").remove();
                                                if (typeCarte == 1 && data.rep == true) {
                                                    alert("Effet garde : Vous avez trouvé la bonne carte, le joueur a été éliminé");
                                                } else if (typeCarte == 1 && data.rep == false) {
                                                    alert("Effet garde : Vous vous êtes trompé");
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
                                    console.log(newstring);
                                    alert("Effet du Roi : Mains échangées !");
                                }
                            }
                        });
                    })
                    $(nomClass).html(newstring);
                    console.log(newstring);
                }
            }
        });
    }

    setInterval(refresh_adversaire2, 1500);
    setInterval(refresh_plateau, 1000);
    setInterval(refresh_main, 1000);
});