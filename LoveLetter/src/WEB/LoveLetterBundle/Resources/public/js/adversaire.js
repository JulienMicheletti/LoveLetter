$("document").ready(function(){
    function refresh(){
        $.ajax({
           type:'get',
           url: 'http://90.101.169.174/projetWeb/LoveLetter/web/app_dev.php/advert/adversaire2',
            success: function (data) {
                var string = "";
                console.log(data.tab.taille);
                if (data.tab.taille == 1) {
                    console.log("test");
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
               console.log(string);
            }
        });
    }

    setInterval(refresh, 1500);
});