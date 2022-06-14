<!-- Modal-->
<div class="modal fade" id="modaljawaban" data-backdrop="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <form id="form-input" class="form-horizontal" data-toggle="validator" method="post">
      {{ csrf_field() }} {{ method_field('POST') }}
      <input type="hidden" id="id" name="id">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title"></h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <i aria-hidden="true" class="ki ki-close"></i>
              </button>
          </div>
          <div class="modal-body">
            <input type="hidden" name="pertanyaan_id" id="pertanyaan_id" value="{{ $pertanyaan->pertanyaan_id }}">
            <div class="form-group">
              <label>Jawaban</label>
              <input type="text" class="form-control" name="jawaban" id="jawaban" autocomplete="off"/>
            </div>
            <div class="form-group">
              <label>Poin</label>
              <input type="number" class="form-control" name="poin" id="poin" autocomplete="off"/>
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