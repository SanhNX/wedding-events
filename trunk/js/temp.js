var POPUP_SOURCE = "popup-source";
$(function() {
    $('#popup-button-close').click(function() {
        $('#popup').animate({opacity: 0}, 250, function() {
            $('#popup').css({display: "none"})
        });
    });
    $('.product-item').click(function() {
        $('#popup').css({display: "block", opacity: 0}).animate({opacity: 1}, 250);
        if (this.getAttribute("data-clip") == "true") {
            bindingClipPopup(this.getAttribute("data-index"), this.getAttribute("data-clip-url"));
        } else
            bindingPopup(this.getAttribute("data-index"));
    });
    $('#popup-button-next').click(function() {
        var index = document.getElementById("popup-source").getAttribute("data-index");
        var isClip = document.getElementById("popup-source").getAttribute("data-clip");
        index++;
        if (index >= $('.product-item').length)
            index = 0;
        if (isClip == "true")
            bindingClipPopup(index);
        else
            bindingPopup(index);
    });
    $('#popup-button-prev').click(function() {
        var index = document.getElementById(POPUP_SOURCE).getAttribute('data-index');
        var isClip = document.getElementById("popup-source").getAttribute("data-clip");
        index--;
        if (index < 0)
            index = $('.product-item').length - 1;
        if (isClip == "true")
            bindingClipPopup(index);       
        else
            bindingPopup(index);
    });
    loadFB(document);
});
// Load the SDK Asynchronously
function loadFB(d) {
    var js, id = 'facebook-jssdk', ref = d.getElementsByTagName('script')[0];
    if (d.getElementById(id)) {
        return;
    }
    js = d.createElement('script');
    js.id = id;
    js.async = true;
    js.src = "http://connect.facebook.net/en_US/all.js#xfbml=1";
    ref.parentNode.insertBefore(js, ref);
}
;
function bindingPopup(index) {
    document.getElementById(POPUP_SOURCE).innerHTML =
            $('.product-item[data-index=' + index + ']').children(".item-source").html();
    document.getElementById(POPUP_SOURCE).setAttribute("data-index", index);
    document.getElementById(POPUP_SOURCE).setAttribute("data-clip", "false");

    document.getElementById("popup-fb-comments").setAttribute("data-href", "http://www.haivl.com/photo/19537" + index);
    FB.XFBML.parse(document.getElementById('popup-form-right'));
}
;
function bindingClipPopup(index) {
    var url =  $('.product-item[data-index=' + index + ']').attr("data-clip-url");
    var poster =  $('.product-item[data-index=' + index + ']').attr("data-poster");
    document.getElementById(POPUP_SOURCE).innerHTML =
            '<video id="example_video_1" class="video-js vjs-default-skin" controls preload="none" width="850"' +
            'poster="'+ poster +'"' +
            'data-setup="{}">' +
            '<source src="'+url+'" type="video/mp4" />' +
            
            '<track kind="captions" src="demo.captions.vtt" srclang="en" label="English" />' +
            '</video>';
    document.getElementById(POPUP_SOURCE).setAttribute("data-index", index);
    document.getElementById(POPUP_SOURCE).setAttribute("data-clip", "true");

    document.getElementById("popup-fb-comments").setAttribute("data-href", "http://www.haivl.com/photo/19537" + index);
    FB.XFBML.parse(document.getElementById('popup-form-right'));
}
