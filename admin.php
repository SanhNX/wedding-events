<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title>Admin Navigator
        </title>
        <link href="css/styles.css" rel="stylesheet" />

        <script src="js/commons/jquery-1.8.3.min.js"></script>
        <script src="js/commons/jquery-colors-min.js"></script>
        <style>

        </style>
    </head>
    <body>
        <div id="fb-root"></div>

        <div class="page">
            <div class="header">
                <div class="logo"></div>
                <ul class="nav" id="main-nav">
                    <li class="nav-item"><a class="nav-link">Trang chủ</a></li>
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
                    <li class="nav-item"><a class="nav-link">Trang điểm</a></li>
                    <li class="nav-item"><a class="nav-link">Áo cưới</a></li>
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
                    </li>
                </ul>
                <div class="banner">
                </div>
            </div>
            <div class="products">
                <div class="title">
                    <span class="title-logo"></span>
                    <span class="title-text">Your style., your happiness / Chương trình / Vũng Tàu</span>
                </div>
                <div class="content">
                    <div class="line"></div>
                    <div class="admin-panel" id="admin-panel">
                        <form action='admin.php' method='post' enctype='multipart/form-data'>
                            <?php
                            include 'DAO/connection.php';
                            include 'DTO/object.php';

                            include 'BLL/feedBll.php';
                            include 'BLL/catelogyBll.php';
                            include 'BLL/addressBll.php';
                            include 'BLL/common.php';
                            ?>
                            <table style="width: 100%;">
                                <tr>
                                    <td class="style2"><span>Book title</span></td>
                                    <td><input name="txtName" class="admin-textbox" type="text" /></td>
                                </tr>
                                <tr>
                                    <td class="style2"><span>Loại:</span></td>
                                    <td><select name="cboCategory" class="admin-textbox input-box">

                                            <?php
                                            $catelogyList = getCatelogyList();
                                            foreach ($catelogyList as $item) {
                                                echo "<option value='$item->Id'>$item->Ten</option>";
                                            }
                                            ?>

                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="style2"><span>Địa điểm:</span></td>
                                    <td><select name="cboAddress" class="admin-textbox input-box">

                                            <?php
                                            $addressList = getAddressList();
                                            foreach ($addressList as $item) {
                                                echo "<option value='$item->Id'>$item->Ten</option>";
                                            }
                                            ?>

                                        </select></td>
                                </tr>
                                <tr>
                                    <td class="style2"><span>Nội dung:</span>
                                    </td>
                                    <td><textarea name="txtDescription" class="admin-textbox"
                                                  cols="20" rows="10"></textarea>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="style2">Hình ảnh:</td>
                                    <td><input id="File1" name="img[]" class="admin-textbox input-box"
                                               type="file" />
                                    </td>
                                </tr>
                                <tr>
                                    <td class="style2">Video:</td>
                                    <td><input id="File2" name="img[]" class="admin-textbox input-box"
                                               type="file" />
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
                                    <td class="style2">&nbsp;</td>
                                    <td><input name="btnUpload" type="submit" value="Upload" />
                                    </td>
                                </tr>
                            </table>  

                            <?php
                            if (isset($_POST['btnUpload'])) {
                                echo "<br/><div class='message'>Thêm mới !!!!!</div> ";
                                $isAddSuccess = addBook(
                                        $_POST['cboCategory'],
                                        $_POST['txtName'], 
                                        $_POST['txtPostDate'],
                                        $_POST['txtDescription'], 
                                        $_POST['txtDescription'],
                                        $_POST['txtDescription'],
                                        
                                        $_POST['cboAddress']);


                                if ($isAddSuccess) {
                                    echo "<br/><div class='message'>Thêm mới hoàn tất! ID Book:</div> ";
//                                . $idNewBook
//                                . " <br/>Lúc $currentTime ngày $vieCurrentDate</div>";

                                    /* IMAGE: sau khi thêm dữ liệu→ tiến hành cập nhật các ảnh(lưu và lấy url) */
                                    //Copy file vào host
//                                $i = 0;
//
//                                $fileName = $_FILES['img']['name'][$i]; //Tên file cũ
//                                $fileExt = GetFileExt($fileName); //Lấy đuôi file cũ
//                                $rootPath = "resources/icon/"; //Thư mục tại host
//                                $fileSaveName = 'ico-book-' . $idNewBook . '.' . $fileExt; //Tên file mới
//
//                                move_uploaded_file($_FILES['img']['tmp_name'][$i], $rootPath . $fileSaveName);
//                                $iconUrl = $rootPath . $fileSaveName;
//
//
//                                echo "Upload ảnh thành công! | file <b>$fileName</b><br />";
//                                echo "<img src='$iconUrl' width='120' /><br />";
//                                echo "Images URL: <input type='text' name='link' value='$iconUrl' size='35' /><br />";
//
//                                $i++;
//                                $fileName = $_FILES['img']['name'][$i]; //Tên file cũ
//                                $fileExt = GetFileExt($fileName);
//                                $rootPath = "resources/banner/"; //Thư mục tại host
//                                $fileSaveName = 'bnn-book-' . $idNewBook . '.' . $fileExt;
//
//                                move_uploaded_file($_FILES['img']['tmp_name'][$i], $rootPath . $fileSaveName);
//                                $bannerUrl = $rootPath . $fileSaveName;
//
//                                echo "Upload Thanh cong file <b>$fileName</b><br />";
//                                echo "<img src='$bannerUrl' width='120' /><br />";
//                                echo "Images URL: <input type='text' name='link' value='$bannerUrl' size='35' /><br />";
//
//                                //Lưu database
//                                updateBookImage($idNewBook, $iconUrl, $bannerUrl);
                                } 
                                else {

                                    echo "<br/><span>Xảy ra sự cố!!!</span>";
//                                . " <br/>Lúc $currentTime ngày $vieCurrentDate</span>";
                                }
                            }
                            ?>
                            </ul>
                            <div class="line"></div>
                        </form>
                    </div>
                </div>
            </div>
    </body>
</html>
