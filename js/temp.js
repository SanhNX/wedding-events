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

    document.getElementById("main-nav").innerHTML = "";
    $.ajax({
        type: "GET",
        url: "xml/nav.xml",
        dataType: "xml",
        success: function (xml) {
            $(xml).find('item').each(function () {
                var text = $(this).attr('text');
                var href = $(this).attr('href');
                var item = document.createElement('li');
                item.className = 'nav-item';
                var link = document.createElement('a')
                link.className = 'nav-link';
                link.innerText = text;

                var list = document.createElement('ul')
                list.className = 'nav-sub-list';
                $(this).find('subItem').each(function () {
                    var text = $(this).attr('text');
                    var href = $(this).attr('href');
                    var subItem = document.createElement('li');
                    subItem.className = 'nav-sub-item';
                    var subLink = document.createElement('a')
                    subLink.className = 'nav-sub-link';
                    subLink.innerText = text;

                    var subList = document.createElement('ul')
                    subList.className = 'nav-sub2-list';
                    $(this).find('subItem2').each(function () {
                        var text = $(this).attr('text');
                        var href = $(this).attr('href');
                        var subItem2 = document.createElement('li');
                        subItem2.className = 'nav-sub2-item';
                        var subLink2 = document.createElement('a')
                        subLink2.className = 'nav-sub2-link';
                        subLink2.innerText = text;
                        subItem2.appendChild(subLink2);
                        subList.appendChild(subItem2);
                    });

                    subItem.appendChild(subLink);
                    subItem.appendChild(subList);
                    list.appendChild(subItem);
                });

                item.appendChild(link);
                item.appendChild(list);
                document.getElementById('main-nav').appendChild(item);
            });
        }
    });


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