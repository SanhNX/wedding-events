<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title>Admin</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
            <link href="css/admin-styles.css" rel="stylesheet" />
            <script src="js/commons/jquery-1.8.3.min.js"></script>
            <script src="js/commons/jquery-colors-min.js"></script>       
            <script src="js/commons/nic-edit.js"></script>
            <script src="js/admin-page.js"></script>


            <script type="text/javascript">
                bkLib.onDomLoaded(function() {
                    nicEditors.allTextAreas()
                });
            </script>
    </head>
    <body>
        <div id="fb-root"></div>
        <div class="page">
            <div class="header">
                <div class="logo"></div>
                <div class="products">
                    <?php
                    include './module/admin-header.php';
                    ?>
                    <div class="title">
                        <span class="title-logo"></span>
                        <span class="title-text">Admin</span>
                    </div>
                    <div class="content">
                        <div class="line"></div>
                        <div class="admin-panel" id="admin-panel">
                            <form method='post' enctype='multipart/form-data'>
                                <?php
                                include 'DAO/connection.php';
                                include 'DTO/object.php';

                                include 'BLL/feedBll.php';
                                include 'BLL/catelogyBll.php';
                                include 'BLL/addressBll.php';
                                include 'BLL/common.php';
                                include './utils/simple_html_dom.php';

                                if (count($_REQUEST) == 0)
                                    header("Location: error.php");
                                else {
                                    $_REQUEST['type'];
                                    $page = isset($_REQUEST['page']) ? $_REQUEST['page'] : 0;
                                    buildGridFeed($_REQUEST['type'], $page, 5);
                                }
                                ?>
                                <div id="admin-tab">
                                    <table class="admin-tab" >
                                        <tr>
                                            <td class="style2"><span>Tiêu đề</span></td>
                                            <td><input name="txtName" id="txtName" class="admin-textbox" type="text" /></td>
                                        </tr>
                                        <tr>
                                            <td class="style2"><span>Địa điểm:</span></td>
                                            <td><select name="cboAddress"  id="cboAddress"class="admin-textbox input-box">
                                                    <?php
                                                    $addressList = getAddressList();
                                                    foreach ($addressList as $item) {
                                                        echo "<option value='$item->Id'>$item->Ten</option>";
                                                    }
                                                    ?>
                                                </select></td>
                                        </tr>
                                        <tr>
                                            <td class="style2"><span>Khu vực:</span></td>
                                            <td><select name="cboSubAddress"  id="cboSubAddress"class="admin-textbox input-box">
                                                    <?php
                                                    $addressSubList = getSubAddressList();
                                                    foreach ($addressSubList as $item) {
                                                        echo "<option value='$item->Id'>$item->Ten</option>";
                                                    }
                                                    ?>
                                                </select></td>
                                        </tr>
                                        <tr>
                                            <td class="style2"><span>Nội dung:</span>
                                            </td>
                                            <td><textarea name="txtDescription" class="admin-textbox" id="admin-area"
                                                          cols="20" rows="10"></textarea>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="style2"><span>PostDate:</span>
                                            </td>
                                            <td><input id="picker-PostDate" name="txtPostDate"
                                                       readonly="readonly" class="inputDate admin-textbox" type="text"
                                                       value="3/12/2012" />
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>&nbsp;</td>
                                            <td  class="admin-grid-footer"><input class='btn-upload' name="btnUpload" type="submit" value="Upload" />
                                            </td>
                                        </tr>
                                    </table>  
                                </div>
                                <?php
                                if (isset($_POST['btnUpload'])) {
                                    $newFeedId = addFeed($_REQUEST['type'], $_POST['txtName'], $_POST['txtPostDate'], '', '', '', $_POST['cboAddress']);

                                    if ($newFeedId != -1) {
                                        //Create resource folder
                                        $newDir = "images/resource/img/" . $newFeedId;

                                        $oldmask = umask(0);
                                        mkdir($newDir, 0777);
                                        umask($oldmask);

                                        $html = str_get_html($_POST['txtDescription']);
                                        $i = 0;
                                        foreach ($html->find('img') as $element) {
                                            $newImageName = $newFeedId . '-' . $i . '.jpeg';
                                            $imgUrl = str_replace('\\"', '', $element->src);
                                            //copy($imgUrl, $newDir . '/' . $newImageName);
                                            file_put_contents($newDir . '/' . $newImageName, file_get_contents($imgUrl));


                                            $html->find('img', $i)->src = "images/resource/img/" . $newFeedId . '/' . $newImageName;
                                            $i++;
                                        }
                                        updateFeedDescript($newFeedId, $html);
                                        echo "<div class='admin-message'>Thêm Mới Hoàn Tất!</div> ";
                                        echo '<script>alert("Thêm Mới Hoàn Tất!");
                                            parent.window.location.reload(true);</script>';
                                    } else {
                                        echo "<div class='admin-message error'>Xảy Ra Sự Cố!</div> ";
                                    }
                                } 
                                if (isset($_POST['btnDelete'])) {
                                    echo "<div class='admin-message error'>Detete</div> ";
                                }
                                ?>
                                </ul>
                                <div class="line"></div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
