$("document").ready(function(){
    function refresh(){
        $.ajax({
           type:'get',
           url: 'http://localhost/projetWeb/LoveLetter/web/app_dev.php/platform/advert/adversaire2',
            success: function (data) {
                var string = "";
               /* if (data.taille == 1) {
                    string = "<a><img src=\"";
                    string += "/projetWeb/LoveLetter/web/bundles/webloveletter/img/cartes/";
                    string += data.tab.c1 + ".png";
                    string += "\"></a>";
                    $(".adversaire").html(string);
                }
                if (data.taille == 2){
                    string += "<a><img src=\"";
                    string += "/projetWeb/LoveLetter/web/bundles/webloveletter/img/cartes/";
                    string += data.tab.c2 + ".png";
                    string += "\"></a>";
                    $(".adversaire").html(string);
                }*/
               string += data.tab.c1;
                console.log(string);
            }
        });
    }

    setInterval(refresh, 1500);
});