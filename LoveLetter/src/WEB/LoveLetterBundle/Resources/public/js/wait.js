/*$("document").ready(function(){
    function checkready()
    {
        console.log("test?");
        $.ajax({
            type:'get',
            url:'http://localhost/projetWeb/LoveLetter/web/app_dev.php/platform/advert/ImWaiting',
            beforeSend: function () {
                console.log("En attente ...");
            },
            success: function (data) {
                if (data.check == 1){
                    window.location.href = "http://localhost/projetWeb/LoveLetter/web/app_dev.php/platform/advert/IWait";
                }
            }
        });
    }

    setInterval(checkready, 1500);
});*/