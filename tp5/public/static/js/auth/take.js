/**
 * Created by Administrator on 2017/12/22.
 */
$('button:first').click(function () {
    $(".rit").append($(".let option:selected"));
});
$('button:last').click(function () {
    $(".let").append($(".rit option"));
});
$('button:eq(1)').click(function () {
    $(".rit").append($(".let option"));
});
$('button:eq(2)').click(function () {
    $(".let").append($(".rit option:selected"));
});
$("option").dblclick(function () {
    //console.log($(this).parent().attr("class"));
    if($(this).parent().attr("class")==="let"){
        $(".rit").append($(this));
    }
    else if($(this).parent().attr("class")==="rit"){
        $(".let").append($(this));
    }
});
