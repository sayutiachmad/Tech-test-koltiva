<div class="row">
    <div class="col-md-12 col-12">
        <div class="card card-outline card-olive">
          <div class="card-header">
            <h2 class="card-title"><i class="fa fa-users-cog"></i> Tipe Pengguna </h2>

            <div class="card-tools">
                <a href="javascript:;" class="btn btn-tool" id="action_add" data-toggle="tooltip" data-placement="top" data-original-title="Tambah Data" title=""><i class="fa fa-plus"></i> Tambah Data</a>
                <a href="javascript:;" class="btn btn-tool" id="reload_table"><i class="fa fa-sync"></i> Reload Data</a>
            </div>

            
            <div class="clearfix"></div>
          </div>

          <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover dataTable" id="table_for_data">
                    <thead>
                        <tr class="bg-themes-default">
                            <th>#</th>
                            <th>Type</th>
                            <th>Option</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
          </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal_form" tabindex="-1" role="dialog" style="display: none;" style="width: 100%;">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modal_label"></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>    
                
            </div>
            <form class="form-horizontal" id="mp_form" method="POST">
                <div class="modal-body">
                        <div class="row clearfix">
                            <div class="col-12 col-md-3 control-label">
                                <label>User Type</label>
                            </div>
                            <div class="col-12 col-md-9">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" name="ut_name_" class="form-control" placeholder="User Type">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <input type="hidden" name="ut_code_">

                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary waves-effect" id="btn_submit">SIMPAN</button>
                    <button type="button" class="btn btn-olive" data-dismiss="modal">CLOSE</button>
                </div>
            </form>
        </div>
    </div>
</div>