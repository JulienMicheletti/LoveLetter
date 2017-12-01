$("document").ready(function () {
    $(".formulaire").submit(function(){
        var pseudo = $(".pseudo").val();
        var mdp = $(".passw").val();
        alert(pseudo+mdp);
    });
});
