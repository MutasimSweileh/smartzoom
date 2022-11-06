<?php
$del = $core->isv("del");
$edit = $core->isv("edit");
$add = $core->isv("add");
$status = $core->isv("status");
$myorder = array();
if ($del)
    $core->SqlDel("visitors", "where id=" . $del);
if (!$add && !$edit) {
?>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary" style="text-transform: capitalize;float: right;">القائمة البريديه</h6>
            <div class="d-sm-flex align-items-center justify-content-between " style="float: left;">
                <div class="form-groupd col2">
                    <a href="?app=<?= $app ?>&add=true" class="btn btn-success btn-icon-split">
                        <span class="icon text-white-50">
                            <i class="fas fa-plus"></i>
                        </span>
                        <span class="text">اضافة بريد الكترونى</span>
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
                            <th>البريد</th>
                            <th>الاجراء</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $index = 1;
                        $data =  $core->getlogin(array("table" => "visitors"), "visitors");
                        for ($i = 0; $i < count($data); $i++) {
                            //$login = $core->getspecialized(array("id"=>$data[$i]["specialized"]));
                        ?>
                            <tr>
                                <td style="vertical-align: middle;"><?= $index++ ?></td>
                                <td style="vertical-align: middle;direction: rtl;"><?= $data[$i]["email"] ?></td>
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
    if ($edit)  $myorder = $core->getlogin(array("table" => "visitors", "id" => $edit), "visitors");  ?>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary" style="text-transform: capitalize;"> اضافة او تعديل</h6>
        </div>
        <div class="card-body">
            <form onsubmit="onsubmit(this); return false;" action="admin/?app=<?= $app ?>" id="<?= $app ?>" method="post" enctype="multipart/form-data">
                <div class="row">
                    <div class="form-group col">
                        <label for="exampleFormControlInput1">البريد</label>
                        <input type="text" class="form-control" id="exampleFormControlInput1" name="email" value="<?= $myorder[0]["email"] ?>">
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