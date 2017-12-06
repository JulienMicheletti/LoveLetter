$("document").ready(function(){
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
                    $(".adversaire").html(string);
                }
                if (data.tab.taille == 2){
                    string += "<a><img src=\"";
                    string += "/projetWeb/LoveLetter/web/bundles/webloveletter/img/cartes/";
                    string += data.tab.c2 + ".png";
                    string += "\"></a>";
                    $(".adversaire").html(string);
                }
            }
        });
    }

    function refresh_plateau(){
        $.ajax({
            type:'get',
            url: 'http://90.101.169.174/projetWeb/LoveLetter/web/app_dev.php/advert/refresh',
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
                console.log(plateau);
                if (data.taille > 0)
                    $(".plateau").html(plateau);
            }
        })
    }

    setInterval(refresh_adversaire2, 1500);
    setInterval(refresh_plateau, 1500);
});