/*$("document").ready(function () {
    $(".formulaire").submit(function(){
        var pseudo = $(".pseudo").val();
        var mdp = $(".passw").val();
        var path = 'http://localhost/projetWeb/LoveLetter/web/app_dev.php/platform/advert/login/'+pseudo+'/'+mdp;
        $.ajax({
            type: 'get',
            url: path,
            beforeSend: function () {
                console.log("J'attend");
            },
            success: function (data) {
                if (data.check == 0){
                    $(".return").append("<span class='erreur'>Pseudo ou Mot de passe incorrect</span>");
                } else {
                    window.location.href = "http://localhost/projetWeb/LoveLetter/web/app_dev.php/platform/advert/menu/1";
                }
            }
        });
        return false;
    });
});*/