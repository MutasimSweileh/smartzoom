<?php
$del = $core->isv("del");
$edit = $core->isv("edit");
$add = $core->isv("add");
$status = $core->isv("status");
$myorder = array();
if ($del)
    $core->SqlDel("categories", "where id=" . $del);
if (!$add && !$edit) {
?>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary" style="text-transform: capitalize;float: right;">التصنيفات</h6>
            <div class="d-sm-flex align-items-center justify-content-between " style="float: left;">
                <div class="form-groupd col2">
                    <a href="?app=<?= $app ?>&add=true" class="btn btn-success btn-icon-split">
                        <span class="icon text-white-50">
                            <i class="fas fa-plus"></i>
                        </span>
                        <span class="text">اضافة تصنيف</span>
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
                            <th>التصنيف الرئيسى</th>
                            <th>الموضع</th>
                            <th>الحالة</th>
                            <th>الاجراء</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $index = 1;
                        $data =  $core->getCat(array());
                        for ($i = 0; $i < count($data); $i++) {
                            //$login = $core->getspecialized(array("id"=>$data[$i]["specialized"]));
                            $login = false;
                            if ($data[$i]["level"])
                                $login = $core->getCat(array("id" => $data[$i]["level"]));
                        ?>
                            <tr>
                                <td style="vertical-align: middle;"><?= $index++ ?></td>
                                <td style="vertical-align: middle;direction: rtl;"><?= $data[$i]["name"] ?></td>
                                <td style="vertical-align: middle;direction: rtl;"><?= $login ? $login[0]["name"] : "لايوجد" ?></td>
                                <td style="vertical-align: middle;direction: rtl;"><?= $data[$i]["selection"] ?></td>
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
    if ($edit)  $myorder = $core->getCat(array("id" => $edit));  ?>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary" style="text-transform: capitalize;"> اضافة او تعديل</h6>
        </div>
        <div class="card-body">
            <form onsubmit="onsubmit(this); return false;" action="admin/?app=<?= $app ?>" id="<?= $app ?>" method="post" enctype="multipart/form-data">
                <div class="row">
                    <div class="form-group col">
                        <label for="exampleFormControlSelect1">التصنيف الرئيسى</label>
                        <select class="form-control" name="level">
                            <option value="0">حدد ...</option>
                            <?php $count = $core->getCat(array());
                            for ($i = 0; $i < count($count); $i++) {
                                if ($count[$i]["level"]  == 0) {
                                    // continue;
                            ?>
                                    <option data="<?= $count[$i]["id"] ?>" <?php if ($myorder[0]["level"] == $count[$i]["id"]) {  ?> selected="selected" <?php } ?> value="<?= $count[$i]["id"] ?>"><?= $count[$i]["name"] ?></option>
                            <?php }
                            } ?>
                        </select>
                    </div>
                    <div class="form-group col">
                        <label for="exampleFormControlInput1">الاسم</label>
                        <input type="text" class="form-control" id="exampleFormControlInput1" name="name" value="<?= $myorder[0]["name"] ?>">
                    </div>
                    <div class="form-group col">
                        <label for="exampleFormControlSelect1">الموضع</label>
                        <select class="form-control" name="selection">
                            <option value="0">حدد ...</option>
                            <?php for ($i = 1; $i < 6; $i++) {
                                if (1 == 1) {
                            ?>
                                    <option data="<?= $i ?>" <?php if ($myorder[0]["selection"] == $i) {  ?> selected="selected" <?php } ?> value="<?= $i ?>"><?= $i ?></option>
                            <?php }
                            } ?>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col">
                        <label for="exampleFormControlInput1">مميز</label>
                        <select class="form-control" name="special">
                            <option value="1">نعم</option>
                            <option value="0" <?php if (!$myorder[0]["special"]) {  ?> selected="selected" <?php } ?>>لا</option>
                        </select>
                    </div>
                    <div class="form-group col">
                        <label for="exampleFormControlInput1">الترتيب</label>
                        <input type="number" class="form-control" id="exampleFormControlInput1" name="order" value="<?= ($myorder[0]["order"] ? $myorder[0]["order"] : 0) ?>">
                    </div>
                    <div class="form-group col">
                        <label for="exampleFormControlInput1">مفعل</label>
                        <select class="form-control" name="active">
                            <option value="1">نعم</option>
                            <option value="0" <?php if (!$myorder[0]["active"]) {  ?> selected="selected" <?php } ?>>لا</option>
                        </select>
                    </div>
                </div>
                <input type="hidden" name="mydata" value="<?= $edit ?>" />
                <input type="hidden" name="admin" value="<?= $edit ?>" />
                <button type="submit" name="next" class="btn btn-outline-success" style="    float: left;" value="تم"> حفظ </button>
            </form>
            <div class="form-group">
            </div>
        </div>
    </div>
<?php } ?>