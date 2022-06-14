<!-- Default Size -->
<div class="modal fade" id="modalexport" data-backdrop="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
  <div class="modal-dialog" role="document">
      <form id="form-input" action="{{ route('saranadmin.export') }}" method="post">
          {{ csrf_field() }} {{ method_field('POST') }}
      <div class="modal-content">
          <div class="modal-header">
              <h4 class="title" id="modalcreateskp-label"></h4>
          </div>
              <div class="modal-body">
                <input type="hidden" id="id" name="id">
                <div class="row">

                  <div class="col-md-6">
                    <b>Tahun</b>
                    <div class="input-group mb-1">
                      <input type="number" required class="form-control" name="tahun" id="tahun">
                    </div>
                  </div>

                </div>
              </div>
              <div class="modal-footer">
                  <button type="submit" class="btn btn-success">Export</button>
                  <button type="button" class="btn btn-danger" data-dismiss="modal">Tutup</button>
              </div>
        </div>
      </form>
  </div>
</div>


