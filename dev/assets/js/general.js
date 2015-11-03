$(document).ready(function() {
    $(".menu-button").click(function() {
        if($("#menu").is(":hidden")) {
            $("#menu").show();
        } else {
            $("#menu").hide();
        }
    });

    $(".MobileFilter").click(function() {
        var menu = 0;
        $(".filters").data("menu", menu);
        $(window).resize(function() {
            if ($(window).width() < 768) {
                if(!$(".filters").is(":hidden") && $(".filters").data("menu") != 0) {
                    menu = 1;
                    $(".filters").show();
                    $(".filters").css("visibility", "visible");
                    $(".filters").data("menu", menu);
                }
            } else {
                $(".filters").show();
                $(".filters").css("visibility", "visible");
            }
        });

        if($(".filters").is(":hidden")) {
            $(".filters").show();
            $(".filters").css("visibility", "visible");
        } else {
            $(".filters").hide();
            $(".filters").css("visibility", "hidden");
        }
    });

    $(".zoekPlaats").on("click", function() {
        $(this).hide();

        $("#zoeken").show();
        $(".plaatszoeken").prop("type", "text");
    });

    $("#zoeken input").on("click", function() {
        $(this).val('');
    });

    $("input[name='q']").on("click", function() {
        $(this).val('');
        $("input[name='branche']").val('');
        $("input[name='subbranche']").val('');
    });
});