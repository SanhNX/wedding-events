﻿var POPUP_SOURCE = "popup-source";
$(function () {
    $('#popup-button-close').click(function () {
        $('#popup').animate({ opacity: 0 }, 250, function () {
            $('#popup').css({ display: "none" })
        });
    });
    $('.product-item').click(function () {
        $('#popup').css({ display: "block", opacity: 0 }).animate({ opacity: 1 },250);
        bindingPopup(this.getAttribute("data-index"));
    });
    $('#popup-button-next').click(function () {
        var index = document.getElementById("popup-source").getAttribute("data-index");
        index++;
        if (index >= $('.product-item').length) index = 0;
        bindingPopup(index);
    });
    $('#popup-button-prev').click(function () {
        var index = document.getElementById(POPUP_SOURCE).getAttribute("data-index");
        index--;
        if (index < 0) index = $('.product-item').length - 1;
        bindingPopup(index);
    });

});
function bindingPopup(index) {
    document.getElementById(POPUP_SOURCE).innerHTML =
                $('.product-item[data-index=' + index + ']').children(".item-source").html();
    document.getElementById(POPUP_SOURCE).setAttribute("data-index", index);
}