<!-- Modal-->
<div class="modal fade" id="modalberkas" data-backdrop="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <form id="form-input" class="form-horizontal" data-toggle="validator" method="post" enctype="multipart/form-data">
      {{ csrf_field() }} {{ method_field('POST') }}
      <input type="hidden" id="id" name="id">
      <input type="hidden" name="folder_id" value="{{ $data->folder_id }}">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title"></h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <i aria-hidden="true" class="ki ki-close"></i>
              </button>
          </div>
          <div class="modal-body">

            <div class="col-md-12">
              <div class="progress" style="display:none">
                      <div class="progress-bar" role="progressbar" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100" style="">
                          <span class="sr-only"></span>
                      </div>
              </div>
            </div>

            <div class="form-group">
              <label>Nama Berkas</label>
              <input type="text" class="form-control" name="nama_berkas" id="nama_berkas" autocomplete="off"/>
            </div>

            <div class="form-group">
              <label>File</label>
              <input type="file" class="form-control" name="file" id="file" />
            </div>

          </div>
          <div class="modal-footer">
              <button type="button" class="btn btn-danger font-weight-bold" data-dismiss="modal">Tutup</button>
              <button id="simpan" type="submit" class="btn btn-primary font-weight-bold">Simpan</button>
              <button id="loading" class="btn btn-primary font-weight-bold" type="button" disabled>
                  <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                  Loading...
              </button>
          </div>
      </div>
    </form>
  </div>
</div>