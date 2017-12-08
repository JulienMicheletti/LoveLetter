$("document").ready(function(){
    refresh_plateau();
    refresh_adversaire2();
    function refresh_adversaire2(){
        $.ajax({
            type:'get',
            url: 'http://localhost/projetWeb/LoveLetter/web/app_dev.php/advert/adversaire2',
            success: function (data) {
                var string = "";
                if (data.tab.taille == 1) {
                    // console.log("test");
                    string = "<a><img src=\"";
                    string += "/projetWeb/LoveLetter/web/bundles/webloveletter/img/cartes/";
                    string += data.tab.c1 + ".png";
                    string += "\"></a>";
                }
                if (data.tab.taille == 2){
                    string += "<a><img src=\"";
                    string += "/projetWeb/LoveLetter/web/bundles/webloveletter/img/cartes/pioche.png";
                 //   string += data.tab.c2 + ".png";
                    string += "\"></a>";
                }
                $(".adversaire").html(string);
            }
        });
    }

    function refresh_plateau(){
        $.ajax({
            type:'get',
            url: 'http://localhost/projetWeb/LoveLetter/web/app_dev.php/advert/refresh',
            success: function (data){
                var i = data.taille;
                var plateau = "";
                while (i > 0){
                    plateau += "<a><img src=\"";
                    plateau += "/projetWeb/LoveLetter/web/bundles/webloveletter/img/cartes/";
                    plateau += data.plateau[i] + ".png";
                    plateau += "\"></a>";
                    i -= 1;
                }
                var a = 2;
                var defausse ="";
                for (a; a < 5; a++){
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
                if (data.taille > 0)
                    $(".plateau").html(plateau);
            }
        })
    }
/*
    function refresh_main(){
        $.ajax({
           type:'get',
            url: 'http://localhost/projetWeb/LoveLetter/web/app_dev.php/advert/refresh',
            success: function (data){
               var string;
               if (data.tab.taille == 1){
                   string = "<a><img src=\"";
                   string += "/projetWeb/LoveLetter/web/bundles/webloveletter/img/cartes/";
                   string += data.tab.c1 + ".png";
                   string += "\"></a>";
               } else if (data.tab.taille == 2){
                   string += "<a><img src=\"";
                   string += "/projetWeb/LoveLetter/web/bundles/webloveletter/img/cartes/";
                   string += data.tab.c2 + ".png";
                   string += "\"></a>";
               }
            }
        });
    }*/
    setInterval(refresh_adversaire2, 1500);
    setInterval(refresh_plateau, 1000);
});