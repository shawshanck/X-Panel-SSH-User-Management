<!-- [ Main Content ] start -->
<div class="pc-container">
    <div class="pc-content">
        <!-- [ breadcrumb ] start -->
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <div class="page-header-title">
                            <h2 class="mb-0"><?php echo security_ip_lang;?></h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- [ breadcrumb ] end -->


        <!-- [ Main Content ] start -->
        <div class="row">
            <!-- [ sample-page ] start -->
            <div class="col-sm-12">
                <div class="card table-card" style="padding: 20px">
                    <div class="card-body">
                        <form class="validate-me" action="" method="post" enctype="multipart/form-data">
                            <div class="form-group row">
                                <div class="col-lg-6">
                                    <input type="hidden" name="csrf_token" value="<?php echo csrfToken; ?>">
                                    <input type="text" name="ip" class="form-control" required="">
                                    <small class="form-text text-muted">IP</small>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-lg-6">
                                    <input class="form-control" type="text" name="desc" required="" value="">
                                    <small class="form-text text-muted"><?php echo security_desc_lang;?></small>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-lg-6">
                                    <input class="form-check-input input-primary" type="radio" name="status" required="" value="allow">
                                    <small class="form-text text-muted"><?php echo security_white_lang;?></small>
                                    <input class="form-check-input input-primary" type="radio" name="status" required="" value="ban">
                                    <small class="form-text text-muted"><?php echo security_block_lang;?></small>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-lg-4 col-form-label"></div>
                                <div class="col-lg-6">
                                    <input type="submit" name="submit" class="btn btn-primary" value="<?php echo modal_submit_lang;?>">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <hr>
            <div class="col-sm-12">
                <div class="card table-card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover" id="pc-dt-simple">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>IP</th>
                                    <th><?php echo security_desc_lang;?></th>
                                    <th class="text-center"><?php echo security_status_lang;?></th>
                                    <th class="text-center"><?php echo security_action_lang;?></th>
                                </tr>

                                <?php  foreach($data['list'] as $val){
                                    $id=$val['id'];
                                    $ip=$val['ip_address'];
                                    $desc=$val['ip_dsc'];
                                    $status=$val['ip_status'];
                                    ?>
                                    <tr>
                                        <td>#</td>
                                        <td><?php echo $ip;?></td>
                                        <td><?php echo $desc;?></td>
                                        <td class="text-center"><?php echo $status;?></td>
                                        <td class="text-center">
                                            <li class="list-inline-item align-bottom" >
                                                <button class="avtar avtar-xs btn-link-success btn-pc-default" style="border:none" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="ti ti-adjustments f-18"></i></button>
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item" href="ip&allow=<?php echo $id; ?>"><?php echo security_white_lang;?></a>
                                                    <a class="dropdown-item" href="ip&ban=<?php echo $id; ?>"><?php echo security_block_lang;?></a>
                                                </div>
                                            </li>
                                            <a href="ip&id=<?php echo $id;?>" class="avtar avtar-xs btn-link-success btn-pc-default">
                                                <i class="ti ti-trash f-18"></i>
                                            </a></td>
                                    </tr>
                                <?php } ?>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
<!-- [ sample-page ] end -->
</div>
<!-- [ Main Content ] end -->
</div>
</div>
<div class="modal fade" id="customer_add-modal" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <form class="modal-content" action="" method="post" enctype="multipart/form-data" onsubmit="return confirm('<?php echo confirm_ac_lang;?>');">

            <div class="modal-header">
                <h5 class="mb-0"><?php echo manager_newuser_lang;?></h5>
                <a href="#" class="avtar avtar-s btn-link-danger btn-pc-default" data-bs-dismiss="modal">
                    <i class="ti ti-x f-20"></i>
                </a>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group row">
                            <div class="col-lg-6">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <input type="text" name="username" class="form-control"
                                               placeholder="<?php echo modal_username_lang;?>" required>
                                        <small class="form-text text-muted"><?php echo modal_username_lable_lang;?></small>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="feather icon-lock"></i></span>
                                            <input type="text" name="password" class="form-control"
                                                   placeholder="<?php echo modal_pass_lang;?>" required>
                                        </div>
                                        <small class="form-text text-muted"><?php echo modal_pass_lable_lang;?></small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <div class="flex-grow-1 text-end">
                    <button type="button" class="btn btn-link-danger btn-pc-default" data-bs-dismiss="modal"><?php echo modal_cancell_lang;?>
                    </button>
                    <button type="submit" class="btn btn-primary" value="submit" name="submit"><?php echo modal_submit_lang;?></button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- [ Main Content ] end -->

