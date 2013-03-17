<script type="text/javascript">
    $(function() {
        document.getElementById("main-nav").innerHTML = "";
        $.ajax({
            type: "GET",
            url: "xml/nav.xml",
            dataType: "xml",
            success: function(xml) {
                $(xml).find('item').each(function() {
                    var text = $(this).attr('text');
                    var href = $(this).attr('href');
                    var item = document.createElement('li');
                    item.className = 'nav-item';
                    var link = document.createElement('a')
                    link.className = 'nav-link';
                    link.innerText = text;
                    link.href=href;

                    var list = document.createElement('ul')
                    list.className = 'nav-sub-list';
                    $(this).find('subItem').each(function() {
                        var text = $(this).attr('text');
                        var href = $(this).attr('href');
                        var subItem = document.createElement('li');
                        subItem.className = 'nav-sub-item';
                        var subLink = document.createElement('a')
                        subLink.className = 'nav-sub-link';
                        subLink.innerText = text;
                        subLink.href=href;

                        var subList = document.createElement('ul')
                        subList.className = 'nav-sub2-list';
                        $(this).find('subItem2').each(function() {
                            var text = $(this).attr('text');
                            var href = $(this).attr('href');
                            var subItem2 = document.createElement('li');
                            subItem2.className = 'nav-sub2-item';
                            var subLink2 = document.createElement('a')
                            subLink2.className = 'nav-sub2-link';
                            subLink2.innerText = text;
                            subLink2.href = href;
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
</script>
<div class="header">
    <div class="logo"></div>
    <ul class="nav" id="main-nav">
        <!--        <li class="nav-item"><a class="nav-link">Trang chủ</a></li>
                <li class="nav-item">
                    <a class="nav-link">Giới thiệu</a>
                    <ul class="nav-sub-list">
                        <li class="nav-sub-item"><a class="nav-sub-link">Clip</a>
                        </li>
                        <li class="nav-sub-item">
                            <a class="nav-sub-link">Chương trình</a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item"><a class="nav-link" href="listbaiviet.php?type=1">Trang điểm</a></li>
                <li class="nav-item"><a class="nav-link" href="listbaiviet.php?type=4">Áo cưới</a></li>
                <li class="nav-item"><a class="nav-link">Dịch vụ</a></li>
                <li class="nav-item"><a class="nav-link">Chụp hình</a></li>
                <li class="nav-item nav-tag">
                    <a class="nav-link"><span>Your style, your happiness</span></a>
                    <ul class="nav-sub-list">
                        <li class="nav-sub-item"><a class="nav-sub-link">Clip</a>
                            <ul class="nav-sub2-list">
                                <li class="nav-sub2-item"><a class="nav-sub2-link">Nha Trang</a></li>
                                <li class="nav-sub2-item"><a class="nav-sub2-link">Vũng Tàu</a></li>
                            </ul>
                        </li>
                        <li class="nav-sub-item">
                            <a class="nav-sub-link">Chương trình</a>
                            <ul class="nav-sub2-list">
                                <li class="nav-sub2-item"><a class="nav-sub2-link">Nha Trang</a></li>
                                <li class="nav-sub2-item"><a class="nav-sub2-link">Vũng Tàu</a></li>
                            </ul>
                        </li>
                    </ul>
                </li>-->
    </ul>
    <div class="banner">
    </div>
</div>