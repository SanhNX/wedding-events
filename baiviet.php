<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title>Wedding Event
        </title>
        <link href="css/styles.css" rel="stylesheet" />
        <link href="css/gioithieu.css" rel="stylesheet" />
        <link href="css/nav-styles.css" rel="stylesheet" />

        <script src="js/commons/jquery-1.8.3.min.js"></script>
        <script src="js/commons/jquery-colors-min.js"></script>

        <script type="text/javascript" src="js/main.js"></script>
        <script>
            // Load the SDK Asynchronously
            (function(d) {
                var js, id = 'facebook-jssdk', ref = d.getElementsByTagName('script')[0];
                if (d.getElementById(id)) {
                    return;
                }
                js = d.createElement('script');
                js.id = id;
                js.async = true;
                js.src = "http://connect.facebook.net/en_US/all.js#xfbml=1";
                ref.parentNode.insertBefore(js, ref);
            }(document));
        </script>
        <script>(function(d, s, id) {
                var js, fjs = d.getElementsByTagName(s)[0];
                if (d.getElementById(id))
                    return;
                js = d.createElement(s);
                js.id = id;
                js.src = "//connect.facebook.net/en_US/all.js#xfbml=1";
                fjs.parentNode.insertBefore(js, fjs);
            }(document, 'script', 'facebook-jssdk'));
        </script>
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
                    <?php
                    include 'DAO/connection.php';
                    include 'DTO/object.php';

                    include 'BLL/feedBll.php';
                    if (count($_REQUEST) == 0)
                        echo "----------";
                    else {
                        $item = getFeed_byID($_REQUEST['id']);
                        echo "<div class='descriptionTopic'>";
                        echo $item->Noidung . "<br/>";
                        echo "</div>";
                    }
                    ?>
                </div>
            </div>
            <?php
            include './module/footer.php';
            ?>		
        </div>
    </body>
</html>
