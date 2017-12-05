$("document").ready(function(){
    function refresh(){
        $.ajax({
           type:'get',
           url: 'http://90.101.169.174/projetWeb/LoveLetter/web/app_dev.php/advert/adversaire2',
            success: function (data) {
                var string = "";
                console.log(data.tab.taille);
                if (data.tab.taille == 1) {
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
                var i = data.tab;
                var plateau = "";
                while (i > 0){
                    plateau = "<a><img src=\"";
                    plateau += "/projetWeb/LoveLetter/web/bundles/webloveletter/img/cartes/";
                    plateau += data.plateau[i] + ".png";
                    plateau += "\"></a>";
                    $(".plateau").append(plateau);
                    i++;
                }
            }
        });
    }

    setInterval(refresh, 1500);
});