<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title>Wedding Event
        </title>
        <link href="css/styles.css" rel="stylesheet" />
        <link href="css/nav-styles.css" rel="stylesheet" />
        <link href="css/listbaiviet.css" rel="stylesheet" />
        <script src="js/commons/jquery-1.8.3.min.js"></script>
        <script src="js/commons/jquery-colors-min.js"></script>
        <script type="text/javascript" src="js/main.js"></script>
    </head>
    <body>
        <div id="fb-root"></div>
        <div class="page">
            <?php
            include './module/header.php';
            ?>
            <div class="products">
                <div class="title">
                    <span class="title-logo"></span>
                    <span class="title-text">Your style. your happiness / Chương trình / Vũng Tàu</span>
                </div>
                <div class="content">
                    <ul class="topic-list">
                        <?php
                        include 'DAO/connection.php';
                        include 'DTO/object.php';

                        include 'BLL/feedBll.php';
                        include './utils/simple_html_dom.php';
                        if (count($_REQUEST) == 0)
                            header("Location: error.php");
                        else {
                            $size=5;
                            $type=$_REQUEST['type'];
                            $itemList = getFeedList($_REQUEST['type']);
                            $page = isset($_REQUEST['page']) ? $_REQUEST['page'] : 0;

                            $max = ($page + 1) * $size > count($itemList) ? count($itemList) : ($page + 1) * $size;
                            for ($i = $page * $size; $i < $max; $i++) {
                                $item = $itemList[$i];
                                echo "<li class='topic-item'>";
                                echo "<a class='topic-link' href=baiviet.php?id=" . $item->Id . ">";
                                                                echo "<div class='topic-item-src'>";

                                echo "<img class='topic-item-pic' src='images/resource/img/" . $item->Id . "/" . $item->Id . "-0.jpeg' />";
                                                   echo "</div>";
             
                                echo "<div class='topic-item-content'>";
                                echo "<span class='content-title'>" . $item->Ten . "</span>";
                                echo "<div class='content-datetime'>";
                                echo "<span class='date'>" . $item->Date . "</span>";
                                echo "<span class='time'>20h15</span>";
                                echo "</div>";
                                $html = str_get_html($item->Noidung);
                                echo "<span class='content-quote'>" . $html->plaintext . "</span>";
                                echo "</div>";
                                echo "</a>";
                                echo "</li>";
                            }
                            for ($i = 0; $i < count($itemList) / $size; $i++) {
                                if ($page == $i)
                                    echo "<span class='btn-page active'>" . ($i + 1) . "</span>";
                                else
                                    echo "<a class='btn-page' href='listbaiviet.php?type=$type&page=$i'>" . ($i + 1) . "</a>";
                            }
                        }
                        ?>
                    </ul>
                </div>
            </div>

            <?php
            include './module/footer.php';
            ?>
        </div>
    </body>
</html>
