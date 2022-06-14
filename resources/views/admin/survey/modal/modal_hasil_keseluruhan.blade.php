<!-- Default Size -->
<div class="modal fade" id="modalhasilsemua" data-backdrop="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
  <div class="modal-dialog" role="document">
      <form id="form-input" target="_blank" action="{{ route('survey.print_data_semua') }}" method="post">
          {{ csrf_field() }} {{ method_field('POST') }}
      <div class="modal-content">
          <div class="modal-header">
              <h4>Print Semua Data</h4>
          </div>
              <div class="modal-body">
                <div class="row">

                  <div class="col-md-6">
                    <div class="form-group">
                      <input type="text" class="form-control fdate" placeholder="Tanggal Awal" autocomplete="off" name="tanggal_awal" required>
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="form-group">
                      <input type="text" class="form-control fdate" placeholder="Tanggal Akhir" autocomplete="off" name="tanggal_akhir" required>
                    </div>
                  </div>
                </div>
              </div>
              <div class="modal-footer">
                  <button type="submit" class="btn btn-success">Print</button>
                  <button type="button" class="btn btn-danger" data-dismiss="modal">Tutup</button>
              </div>
        </div>
      </form>
  </div>
</div>


