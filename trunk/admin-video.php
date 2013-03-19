<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title>Admin Video
        </title>
        <link href="css/admin-styles.css" rel="stylesheet" />
        <script src="js/commons/jquery-1.8.3.min.js"></script>
        <script src="js/commons/jquery-colors-min.js"></script>       
        <script src="js/commons/nic-edit.js"></script>
        <script src="js/admin-page.js"></script>

        <script type="text/javascript">
            bkLib.onDomLoaded(function() {
                new nicEditor({buttonList: ['bold', 'italic', 'underline']}).panelInstance('admin-textbox');
            });
        </script>
    </head>
    <body>
        <div id="fb-root"></div>
        <div class="page">
            <div class="header">
                <div class="logo"></div>
            </div>
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

                            $page = isset($_REQUEST['page']) ? $_REQUEST['page'] : 0;
                            buildGridFeed(6, $page, 5);
                            ?>
                            <table class="admin-tab">
                                <tr>
                                    <td><span>Tiêu đề</span></td>
                                    <td><input name="txtName" class="admin-textbox" type="text" /></td>
                                </tr>
                                <tr>
                                    <td><span>Địa điểm:</span></td>
                                    <td><select name="cboAddress" id="cboAddress" class="admin-textbox input-box" onChange="ddChange()">
                                            <?php
                                            $addressList = getAddressList();
                                            foreach ($addressList as $item) {
                                                echo "<option value='$item->Id'>$item->Ten</option>";
                                            }
                                            ?>
                                        </select>
                                    </td>
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
                                    <td>Video:</td>
                                    <td><input id="fileVideo" name="vid[]" class="admin-textbox input-box" type="file" />
                                    </td>
                                </tr>
                                <tr>
                                    <td>Hình ảnh:</td>
                                    <td>
                                        <input id="fileImage" name="img[]" class="admin-textbox input-box"
                                               type="file" />
                                    </td>
                                </tr>
                                <tr>
                                    <td><span>Nội dung:</span>
                                    </td>
                                    <td><textarea name="txtDescription" id="admin-textbox" class="admin-textbox" cols="20" rows="10"></textarea>
                                    </td>
                                </tr>

                                <tr>
                                    <td><span>PostDate:</span></td>
                                    <td>
                                        <input id="picker-PostDate" name="txtPostDate" readonly="readonly" class="inputDate admin-textbox" type="text" value="3/12/2012" />
                                    </td>
                                </tr>
                                <tr>
                                    <td>&nbsp;</td>
                                    <td><input  class='btn-upload' name="btnUpload" type="submit" value="Upload" />
                                    </td>
                                </tr>
                            </table>  

                            <?php
                            if (isset($_POST['btnUpload'])) {
                                $newFeedId = addFeed(6, $_POST['txtName'], $_POST['txtPostDate'], $_POST['txtDescription'], '', '', $_POST['cboAddress']);
                                if ($newFeedId != -1) {
                                    $newDir = "video/" . $newFeedId;

                                    $oldmask = umask(0);
                                    mkdir($newDir, 0777);
                                    umask($oldmask);

                                    $videoUrl = $newDir . '/' . $newFeedId . '.' . GetFileExt($_FILES['vid']['name'][0]);
                                    move_uploaded_file($_FILES['vid']['tmp_name'][0], $videoUrl);
                                    updateFeedVideo($newFeedId, $videoUrl);

                                    $imgUrl = $newDir . '/' . $newFeedId . '.' . GetFileExt($_FILES['img']['name'][0]);
                                    move_uploaded_file($_FILES['img']['tmp_name'][0], $imgUrl);
                                    updateFeedImg($newFeedId, $imgUrl);

                                    echo "<div class='admin-message'>Thêm Mới Hoàn Tất!</div> ";
                                } else {
                                    echo "<div class='admin-message error'>Xảy Ra Sự Cố!</div> ";
                                }
                            } else {
                                //echo "<br/><div class='message'>1</div> ";    
                            }
                            ?>
                            <div class="line"></div>
                        </form>
                    </div>
                </div>
            </div>            
        </div>

    </body>
</html>
