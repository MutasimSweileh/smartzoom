<?php
$del = $core->isv("del");
$edit = $core->isv("edit");
$add = $core->isv("add");
$status = $core->isv("status");
$myorder = array();
if ($del)
    $core->SqlDel("images", "where id=" . $del);
if (!$add && !$edit) {
?>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary" style="text-transform: capitalize;float: right;"> الصور</h6>
            <div class="d-sm-flex align-items-center justify-content-between " style="float: left;">
                <div class="form-groupd col2">
                    <a href="?app=<?= $app ?>&add=true" class="btn btn-success btn-icon-split">
                        <span class="icon text-white-50">
                            <i class="fas fa-plus"></i>
                        </span>
                        <span class="text">اضافة صوره</span>
                    </a>
                </div>
            </div>
            <div class="clear"></div>
        </div>
        <div class="card-body" style="    padding: 0;">
            <div class="table-responsive">
                <table class="table table-striped" id="dataTable" width="100%" cellspacing="0">
                    <thead class="thead-light">
                        <tr>
                            <th>#</th>
                            <th>الاسم</th>
                            <th>الصورة</th>
                            <th>التصنيف</th>
                            <th>التاريخ</th>
                            <th>الحالة</th>
                            <th>الاجراء</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $index = 1;
                        $data =  $core->getgallery(array());
                        for ($i = 0; $i < count($data); $i++) {
                            $date = $core->getDateTime($data[$i]["date"], "arabic");
                            // $login = $core->getspecialized(array("id"=>$data[$i]["specialized"]));
                            $login = false;
                            if ($data[$i]["category"])
                                $login = $core->getgallery(array("id" => $data[$i]["category"]));
                            // if(!$data[$i]["category"])
                            //  continue;
                        ?>
                            <tr>
                                <td style="vertical-align: middle;"><?= $index++ ?></td>
                                <td style="vertical-align: middle;direction: rtl;"><?= $data[$i]["name"] ?></td>
                                <td style="vertical-align: middle;"><img style=" height:100px;  background: #36b9cc;
    border-radius: 50%;   width: 100px;" src="../images/<?= $data[$i]["image"] ? $data[$i]["image"] : "boss2.png" ?>" alt="" /></td>
                                <td style="vertical-align: middle;direction: rtl;"><?= $login ? $login[0]["name"] : "لايوجد" ?></td>
                                <td style="vertical-align: middle;direction: rtl;"><?= $date[0] ?>, <?= $date[1] ?> <?= $date[2] ?></td>
                                <td style="vertical-align: middle;direction: rtl;"><?= $data[$i]["active"] ? "مفعل" : "غير مفعل" ?></td>
                                <td class="center" style=" text-align: center;vertical-align: middle;"><a href="?app=<?= $app ?>&del=<?= $data[$i]["id"] ?>" style="margin-left: 5px;" class="btn btn-danger btn-circle btn-sm">
                                        <i class="fas fa-trash"></i>
                                    </a><a href="?app=<?= $app ?>&edit=<?= $data[$i]["id"] ?>" class="btn btn-warning btn-circle btn-sm">
                                        <i class="fas fa-edit"></i>
                                    </a></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
<?php } else {
    if ($edit)  $myorder = $core->getgallery(array("id" => $edit));  ?>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary" style="text-transform: capitalize;"> اضافة او تعديل</h6>
        </div>
        <div class="card-body">
            <form onsubmit="onsubmit(this); return false;" action="admin/?app=<?= $app ?>" id="<?= $app ?>" method="post" enctype="multipart/form-data">
                <div class="row">
                    <div class="form-group col">
                        <label for="exampleFormControlSelect1">التصنيف</label>
                        <select class="form-control" name="category">
                            <option value="0">حدد ...</option>
                            <?php $count = $core->getgallery(array());
                            for ($i = 0; $i < count($count); $i++) {
                                if ($count[$i]["category"]  == 0) {
                                    // continue;
                            ?>
                                    <option data="<?= $count[$i]["id"] ?>" <?php if ($myorder[0]["category"] == $count[$i]["id"]) {  ?> selected="selected" <?php } ?> value="<?= $count[$i]["id"] ?>"><?= $count[$i]["name"] ?></option>
                            <?php }
                            } ?>
                        </select>
                    </div>
                    <div class="form-group col">
                        <label for="exampleFormControlInput1">الاسم</label>
                        <input type="text" class="form-control" id="exampleFormControlInput1" name="name" value="<?= $myorder[0]["name"] ?>">
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label for="exampleFormControlInput1">مميز</label>
                            <select class="form-control" name="special">
                                <option value="1">نعم</option>
                                <option value="0" <?php if (!$myorder[0]["special"]) {  ?> selected="selected" <?php } ?>>لا</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlInput1">الترتيب</label>
                            <input type="number" class="form-control" id="exampleFormControlInput1" name="order" value="<?= ($myorder[0]["order"] ? $myorder[0]["order"] : 0) ?>">
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlInput1">مفعل</label>
                            <select class="form-control" name="active">
                                <option value="1">نعم</option>
                                <option value="0" <?php if (!$myorder[0]["active"]) {  ?> selected="selected" <?php } ?>>لا</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group bo-img col" for="exampleInputFile">
                        <label for="exampleFormControlInput1" style="display: block;">الصورة</label>
                        <div class="progressbar">
                            <h4 class="small font-weight-bold text-right">جارى الرفع <span class="float-left">50%</span></h4>
                            <div class="progress">
                                <div class="progress-bar bg-success" role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                        <div class="image-upload">
                            <img id="blah" class="ulogo" src="../images/<?= $myorder[0]["image"] ? $myorder[0]["image"] : "boss2.png" ?>" />
                            <div class="fileUpload2 fa fa-camera">
                                <input name="fileToUpload" accept="image/*" id="imgInp" class="photo upload-field-1" type="file">
                                <input type="hidden" name="image" value="<?= $myorder[0]["image"] ? $myorder[0]["image"] : "boss2.png" ?>" />
                            </div>
                        </div>
                    </div>
                </div>
                <input type="hidden" name="mydata" value="<?= $edit ?>" />
                <input type="hidden" name="date" value="<?= time() ?>" />
                <button type="submit" name="next" class="btn btn-outline-success" style="    float: left;" value="تم"> حفظ </button>
            </form>
            <div class="form-group">
            </div>
        </div>
    </div>
<?php } ?>