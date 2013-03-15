var POPUP_SOURCE = "popup-source";
$(function () {
    $('#popup-button-close').click(function () {
        $('#popup').animate({ opacity: 0 }, 250, function () {
            $('#popup').css({ display: "none" })
        });
    });
    $('.product-item').click(function () {
        $('#popup').css({ display: "block", opacity: 0 }).animate({ opacity: 1 }, 250);
        bindingPopup(this.getAttribute("data-index"));
    });
    $('#popup-button-next').click(function () {
        var index = document.getElementById("popup-source").getAttribute("data-index");
        index++;
        if (index >= $('.product-item').length) index = 0;
        bindingPopup(index);
    });
    $('#popup-button-prev').click(function () {
        var index = document.getElementById(POPUP_SOURCE).getAttribute('data-index');
        index--;
        if (index < 0) index = $('.product-item').length - 1;
        bindingPopup(index);
    });
    loadFB(document);
});
// Load the SDK Asynchronously
function loadFB(d) {
    var js, id = 'facebook-jssdk', ref = d.getElementsByTagName('script')[0];
    if (d.getElementById(id)) { return; }
    js = d.createElement('script'); js.id = id; js.async = true;
    js.src = "http://connect.facebook.net/en_US/all.js#xfbml=1";
    ref.parentNode.insertBefore(js, ref);
};
function bindingPopup(index) {
    document.getElementById(POPUP_SOURCE).innerHTML =
                $('.product-item[data-index=' + index + ']').children(".item-source").html();
    document.getElementById(POPUP_SOURCE).setAttribute("data-index", index);
    document.getElementById("popup-fb-comments").setAttribute("data-href", "http://www.haivl.com/photo/19537" + index);
    FB.XFBML.parse(document.getElementById('popup-form-right'));
}