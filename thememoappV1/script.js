$(document).ready(function(){
    $("a, li, input").mouseenter(function(){
        $(this).fadeTo('fast', 1);
    });
    $("a, li, input").mouseleave(function(){
        $(this).fadeTo('fast', 0.75);
    });
});
//#5fdf80