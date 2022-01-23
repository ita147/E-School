<!-- load js here -->
<script src="<?= base_url('assets/') ?>plugins/ckeditor/ckeditor.js" type="text/javascript"></script>
<script type="text/javascript">
function open_popup(url)
{
  var w = 880;
  var h = 570;
  var l = Math.floor((screen.width-w)/2);
  var t = Math.floor((screen.height-h)/2);
  var win = window.open(url, 'ResponsiveFilemanager', "scrollbars=1,width=" + w + ",height=" + h + ",top=" + t + ",left=" + l);
}
function responsive_filemanager_callback(field_id){
  console.log(field_id);
  var url=jQuery('#'+field_id).val();
  //your code
  $('#image_preview').attr("src", "<?= base_url(); ?>/upload/"+url);
}
function string_to_slug (str) {
    str = str.replace(/^\s+|\s+$/g, ''); // trim
    str = str.toLowerCase();
  
    // remove accents, swap ñ for n, etc
    var from = "àáäâèéëêìíïîòóöôùúüûñç·/_,:;";
    var to   = "aaaaeeeeiiiioooouuuunc------";
    for (var i=0, l=from.length ; i<l ; i++) {
        str = str.replace(new RegExp(from.charAt(i), 'g'), to.charAt(i));
    }

    str = str.replace(/[^a-z0-9 -]/g, '') // remove invalid chars
        .replace(/\s+/g, '-') // collapse whitespace and replace by -
        .replace(/-+/g, '-'); // collapse dashes
    $('#inputSlug').val(str);
}
</script>
<!-- Breadcumb positiion -->
<ul class="breadcrumb">
  <li>
    <p>Post</p>
  </li>
  <li>
    <a href="<?= base_url(); ?>post/post/">List Post</a>
  </li>
  <li><a href="#" class="active"><?=$title?></a></li>
</ul>
<!-- Heading Of Page -->
<div class="page-title"> <i class="fa fa-book"></i>
  <h3><?=$title?></h3>
</div>
<div class="row">
  <form action="<?= base_url('post/post/add_process'); ?>" method="post">
    <div class="col-md-8">
      <div class="grid simple ">
        <div class="grid-title no-border">
        </div>
        <div class="grid-body no-border">
          <!-- load form notfication here -->
          <?php $this->load->view('backend/layout/form_notification'); ?>
          <!-- start listing data here -->
          <input class="form-control input-lg" type="text" placeholder="Judul" onkeyup="string_to_slug(this.value);" required="required" name="title">
          <br>
          <textarea id="content_editor" name="content"></textarea>
        </div>

      </div>
    </div>
    <div class="col-md-4">
      <div class="grid simple ">
        <div class="grid-title no-border">
        </div>
        <div class="grid-body no-border">
          <!-- load form notfication here -->
          <?php $this->load->view('backend/layout/form_notification'); ?>
          <!-- start listing data here -->
          <button class="btn btn-success" type="submit">
            <i class="fa fa-paper-plane"></i> Simpan</button>
          <br>
          <br>
          <div class="checkbox check-success ">
            <input id="checkbox2" type="checkbox" value="1"  name="is_publish">
            <label for="checkbox2">Tampilkan Publik</label>
          </div>
          <div class="row form-row">
            <div class="col-md-12">
              <div class="form-group row">
                <label for="inputSlug" class="col-sm-4 col-form-label">Slug</label>
                <div class="col-sm-8">
                  <input type="text" class="form-control" id="inputSlug" placeholder="slug" name="slug"  value="" required="required" readonly="">
                </div>
              </div>
              <div class="form-group row">
                <label for="inputMeta" class="col-sm-4 col-form-label">Meta Desc</label>
                <div class="col-sm-8">
                  <textarea name="meta_desc" rows="5" class="form-control" id="inputMeta"></textarea>
                </div>
              </div>
              <div class="form-group row">
                <label for="inputImage" class="col-sm-4 col-form-label">Gambar Unggulan</label>
                <div class="col-sm-8">
                  <input type="hidden" id="imgField" name="featured_image" required="required">
                  <img src="<?= base_url('assets/')?>img/default.jpg" id="image_preview" style="width: 100%;">
                  <br>
                  <br>
                  <a data-toggle="modal" data-target="#imageModal"  href="javascript:;" class="btn" type="button">Select</a>
                </div>
              </div>
              <br>
              <div class="form-group row">
                <label for="inputMeta" class="col-sm-4 col-form-label">Kategori</label>
                <div class="col-sm-8">
                  <select class="select2" name="categories[]" multiple style="width: 100%">
                    <?php foreach ($categories as $val) : ?>
                      <option value="<?=$val['id']?>"><?=$val['name']?></option>
                    <?php endforeach; ?>
                  </select>
                </div>
              </div>
              <div class="form-group row">
                <label for="inputMeta" class="col-sm-4 col-form-label">Tags</label>
                <div class="col-sm-8">
                  <select class="select2" name="tags[]" multiple style="width: 100%">
                    <?php foreach ($tags as $val) : ?>
                      <option value="<?=$val['id']?>"><?=$val['name']?></option>
                    <?php endforeach; ?>
                  </select>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>
    </div>
  </form>
</div>
<!-- load modal here -->
<div class="modal fade" id="imageModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-body">
              <iframe style="width: 100%" height="450" src="<?= base_url() ?>includes/filemanager/dialog.php?type=1&field_id=imgField&relative_url=1&multiple=0" frameborder="0" style="overflow: scroll; overflow-x: hidden; overflow-y: scroll; "></iframe>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
          </div>
        </div>
    </div>
</div>
<!-- java script start here -->
<script>
    function deleteConfirm(url) {
        $('#btn-delete').attr('href', url);
        $('#deleteModal').modal();
    }
</script>
<script>
CKEDITOR.replace( 'content_editor' ,{
  filebrowserBrowseUrl : '<?= base_url('includes/') ?>filemanager/dialog.php?type=2&editor=ckeditor&fldr=',
  height: '500px'   
});
$(document).ready(function() {
    $('.select2').select2();
});
</script>

