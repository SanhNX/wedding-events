
var POPUP_SOURCE = "popup-source";
$(function () {
    $.ajax({
        type: "GET",
        url: "xml/nav.xml",
        dataType: "xml",
        success: function (xml) {
            $(xml).find('item').each(function () {
                var text = $(this).attr('text');
                var href = $(this).attr('href');
                var item = document.createElement('li');
                item.className = 'anav-item';
                var link = document.createElement('input')
                link.type = 'text';
                link.className = 'anav-link';
                link.value = text;
                var url = document.createElement('input')
                url.type = 'text';
                url.className = 'anav-url';
                url.value = href;

                var list = document.createElement('ul')
                list.className = 'anav-sub-list';
                $(this).find('subItem').each(function () {
                    var text = $(this).attr('text');
                    var href = $(this).attr('href');
                    var subItem = document.createElement('li');
                    subItem.className = 'anav-sub-item';
                    var subLink = document.createElement('input')
                    subLink.type = 'text';
                    subLink.className = 'anav-sub-link';
                    subLink.value = text;
                    var subUrl = document.createElement('input')
                    subUrl.type = 'text';
                    subUrl.className = 'anav-sub-url';
                    subUrl.value = href;

                    var subList = document.createElement('ul')
                    subList.className = 'anav-sub2-list';
                    $(this).find('subItem2').each(function () {
                        var text = $(this).attr('text');
                        var href = $(this).attr('href');
                        var subItem2 = document.createElement('li');
                        subItem2.className = 'anav-sub2-item';
                        var subLink2 = document.createElement('input')
                        subLink2.type = 'text';
                        subLink2.className = 'anav-sub2-link';
                        subLink2.value = text;
                        var subUrl2 = document.createElement('input')
                        subUrl2.type = 'text';
                        subUrl2.className = 'anav-sub2-url';
                        subUrl2.value = href;
                        subItem2.appendChild(subLink2);
                        subItem2.appendChild(subUrl2);
                        subItem2.appendChild(createElement('a', 'btn-remove'));
                        subList.appendChild(subItem2);
                    });

                    subItem.appendChild(subLink);
                    subItem.appendChild(subUrl);
                    subItem.appendChild(createElement('a', 'btn-add'));
                    subItem.appendChild(createElement('a', 'btn-remove'));
                    subItem.appendChild(subList);
                    list.appendChild(subItem);
                });

                item.appendChild(link);
                item.appendChild(url);
                item.appendChild(createElement('a', 'btn-add'));
                item.appendChild(createElement('a', 'btn-remove'));
                item.appendChild(list);
                document.getElementById('admin-panel').appendChild(item);
            });

            loadModifyItem();

        }
    });
});

function loadModifyItem() {
    $('.btn-remove').click(function () {
        this.parentNode.parentNode.removeChild(this.parentNode);

    });
    $('.btn-add').click(function () {
        var nameSpace = $(this.parentNode).children('ul')[0].className.replace('-list', '');

        var newItem = createElement('li', nameSpace + '-item');
        newItem.className = 'anav-item';
        var newLink = document.createElement('input', nameSpace + '-link')
        newLink.type = 'text';
        var newUrl = document.createElement('input', nameSpace + '-url')
        newUrl.type = 'text';

        var newList = document.createElement('ul')
        newList.className = nameSpace + '-list';
        if (nameSpace == 'anav-sub') newList.className = nameSpace + '2-list';

        newItem.appendChild(newLink);
        newItem.appendChild(newUrl);
        if (nameSpace != 'anav-sub2')
            newItem.appendChild(createElement('a', 'btn-add'));
        newItem.appendChild(createElement('a', 'btn-remove'));
        newItem.appendChild(newList);
        $(this.parentNode).children('ul')[0].appendChild(newItem);
        $('.btn-add').unbind("click");
        loadModifyItem();
    });
};
function createElement(tagName, id, className) {
    var elem = document.createElement(tagName);
    elem.id = id;
    elem.className = className;
    return elem;
};
function createElement(tagName, className) {
    var elem = document.createElement(tagName);
    elem.className = className;
    return elem;
};