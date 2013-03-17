<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title>Wedding Event
        </title>
        <link href="css/styles.css" rel="stylesheet" />
        <link href="css/nav-styles.css" rel="stylesheet" />
        <link href="css/album-styles.css" rel="stylesheet" />
        <link href="css/popup-styles.css" rel="stylesheet" />

        <script src="js/commons/jquery-1.8.3.min.js"></script>
        <script src="js/commons/jquery-colors-min.js"></script>

        <script type="text/javascript" src="js/temp.js"></script>
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
                    <span class="title-text">Your style., your happiness / Chương trình / Vũng Tàu</span>
                </div>
                <div class="content">
                    <div class="line"></div>
                    <ul class="product-list">
                        <?php
                        include 'DAO/connection.php';
                        include 'DTO/object.php';

                        include 'BLL/feedBll.php';
                        if (count($_REQUEST) == 0)
                            echo "----------";
                        else {
                            
                            $itemList = getFeed_byDD($_REQUEST['dd']);
                            $i = 0;
                            foreach ($itemList as $item) {
                                echo "<li class='product-item' data-index='". $i ."' data-clip='true' data-poster='". $item->Hinhanh ."' data-clip-url='".$item->Video."'>";
                                echo "<div class='item-title'>" . $item->Ten . "</div>";
                                echo "<div class='item-source clip'>";
                                echo "<img src='" . $item->Hinhanh . "' />";
                                echo "</div>";
                                echo "<div class='item-fb'></div>";
                                echo "</li>";
                                $i++;
                            }
                        }
                        ?> 
                    </ul>
                    <div class="line"></div>

                </div>
            </div>                   
            <?php
            include './module/footer.php';
            ?>            
        </div>
        <div class="popup" id="popup">
            <div id="product-popup" class="popup-form">
                <table style="width: 100%; height: 570px;">
                    <tr class="popup-row">
                        <td class="popup-form-left">
                            <div class="popup-button-next" id="popup-button-next"></div>
                            <div class="popup-button-prev" id="popup-button-prev"></div>
                            <div class="popup-source" id="popup-source"></div>
                        </td>
                        <td class="popup-form-right" id="popup-form-right">
                            <div class="popup-control">
                                <div id="popup-button-close"></div>
                                <div class="line-decor"></div>
                            </div>
                            <div class="fb-comments" id="popup-fb-comments" 
                                 data-href="" 
                                 data-width="470" 
                                 data-num-posts="10"</div>
                        </td>
                    </tr>
                </table>
            </div>

        </div>
    </body>
</html>
