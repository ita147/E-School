<!-- Modal add-->
<div class="modal fade" id="newMenuModal" tabindex="-1" role="dialog" aria-labelledby="newMenuModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <br>
            <i class="fa fa-list fa-7x"></i>
            <h4 id="myModalLabel" class="semi-bold">Tambah Menu Baru.</h4>
          </div>
          <form action="<?= base_url('setting/menu/add_process'); ?>" method="post">
            <div class="modal-body">
              <div class="row form-row">
                <div class="col-md-12">
                  <div class="form-group row">
                    <label for="inputMenu" class="col-sm-2 col-form-label">Menu</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="inputMenu" placeholder="Menu" name="menu" style="width: 250px;">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="inputIcon" class="col-sm-2 col-form-label">Icon</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="inputIcon" placeholder="Skrip Dari Font Awesome" style="width: 250px;" name="icon">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="inputUrl" class="col-sm-2 col-form-label">Url</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="inputUrl" placeholder="System url" style="width: 250px;" name="url">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="inputOrder" class="col-sm-2 col-form-label">Urutan Menu</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="inputOrder" placeholder="sort" style="width: 100px;" name="order">
                    </div>
                  </div>
                  
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
              <button class="btn btn-primary" type="submit">Simpan</button>
            </div>
          </form>
        </div>
    </div>
</div>
<!-- Modal Delete -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
            </div>
            <div class="modal-body">Data yang dihapus tidak akan bisa dikembalikan.</div>
            <div class="modal-footer">
                <a id="btn-delete" class="btn btn-danger" href="#">Delete</a>
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>