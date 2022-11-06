<?php
//include_once ("../../classes/core.php");
//$core = new core;
$del = $core->isv("del");
$edit = $core->isv("edit");
$add = $core->isv("add");
$myorder = array();
if ($del)
    $core->SqlDel("comments", "where id=" . $del);
if (!$add && !$edit) {
?>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary" style="text-transform: capitalize;float: right;"> التعليقات</h6>
            <div class="d-sm-flex align-items-center justify-content-between " style="float: left;">
                <a href="?app=<?= $app ?>&add=true" class="btn btn-success btn-icon-split">
                    <span class="icon text-white-50">
                        <i class="fas fa-plus"></i>
                    </span>
                    <span class="text">اضافة تعليق</span>
                </a>
            </div>
            <div class="clear"></div>
        </div>
        <div class="card-body" style="    padding: 0;">
            <div class="table-responsive">
                <table class="table table-striped" id="dataTable" width="100%" cellspacing="0">
                    <thead class="thead-light">
                        <tr>
                            <th>#</th>
                            <th>التعليق</th>
                            <th>صاحب التعليق</th>
                            <th>المنشور</th>
                            <th>التاريخ</th>
                            <th>الاجراء</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $data =  $core->getorder(array(), "comments");
                        for ($i = 0; $i < count($data); $i++) {
                            $date = $core->getDateTime($data[$i]["date"], "arabic");
                            $blog = $core->getBlog(array("id" => $data[$i]["pid"]))[0]["name"];
                        ?>
                            <tr>
                                <td style="vertical-align: middle;"><?= $i + 1 ?></td>
                                <td style="vertical-align: middle;direction: rtl;"><?= $data[$i]["comment"] ?></td>
                                <td style="vertical-align: middle;direction: rtl;"><?= $data[$i]["name"] ?></td>
                                <td style="vertical-align: middle;direction: rtl;"><?= $blog ?></td>
                                <td style="vertical-align: middle;direction: rtl;"><?= $date[0] ?>, <?= $date[1] ?> <?= $date[2] ?></td>
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
    if ($edit) $myorder = $core->getorder(array("id" => $edit), "comments");  ?>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary" style="text-transform: capitalize;"> اضافة او تعديل</h6>
        </div>
        <div class="card-body">
            <form onsubmit="onsubmit(this); return false;" action="admin/?app=<?= $app ?>" id="<?= $app ?>" method="post" enctype="multipart/form-data">
                <div class="row">
                    <div class="form-group col">
                        <label for="exampleFormControlSelect1">المنشور</label>
                        <select class="form-control" name="pid">
                            <?php $count = $core->getBlog(array());
                            for ($i = 0; $i < count($count); $i++) { ?>
                                <option data="<?= $count[$i]["id"] ?>" <?php if ($myorder[0]["pid"] == $count[$i]["id"]) {  ?> selected="selected" <?php } ?> value="<?= $count[$i]["id"] ?>"><?= $count[$i]["name"] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group col">
                        <div class="form-group col">
                            <label for="exampleFormControlInput1">صاحب التعليق</label>
                            <input type="text" class="form-control" id="exampleFormControlInput1" name="name" value="<?= $myorder[0]["name"] ?>">
                        </div>
                    </div>
                    <div class="form-group col">
                        <label for="exampleFormControlInput1">مفعل</label>
                        <select class="form-control" name="active">
                            <option value="1">نعم</option>
                            <option value="0" <?php if (!$myorder[0]["active"]) {  ?> selected="selected" <?php } ?>>لا</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="exampleFormControlTextarea1">التعليق</label>
                    <textarea class="form-control" name="comment" id="exampleFormControlTextarea1" rows="6"><?= str_replace(array("<br>", "</br>", "<br />"), PHP_EOL, $myorder[0]["comment"]) ?></textarea>
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