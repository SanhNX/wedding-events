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
                        if (count($_REQUEST) == 0)
                            echo "----------";
                        else {
                            $itemList = getFeedList($_REQUEST['type']);
                            foreach ($itemList as $item) {
                                echo "<li class='topic-item'>";
                                echo "<a class='topic-link' href=gioithieu.php?id=" . $item->Id . ">";
                                echo "<div class='topic-item-pic' style='background:url(" . $item->Hinhanh . ")no-repeat center center;background-size: 100%;'></div>";
                                echo "<div class='topic-item-content'>";
                                echo "<div class='content-title'>" . $item->Ten . "</div>";
                                echo "<div class='content-datetime'>";
                                echo "<div class='date'>" . $item->Date . "</div>";
                                echo "<div class='time'>20h15</div>";
                                echo "</div>";
                                echo "<div class='content-quote'>" . $item->Noidung . "</div>";
                                echo "</div>";
                                echo "</a>";
                                echo "</li>";
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
