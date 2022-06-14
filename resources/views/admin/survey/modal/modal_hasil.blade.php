<!-- Default Size -->
<div class="modal fade" id="modalhasil" data-backdrop="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
      <form id="form-input" target="_blank" action="{{ route('survey.print_data_hasil') }}" method="post">
          {{ csrf_field() }} {{ method_field('POST') }}
      <div class="modal-content">
          <div class="modal-header">
              <h4 class="title"></h4>
          </div>
              <div class="modal-body">
                <input type="hidden" id="id" name="id">
                <div class="row">

                  <div class="col-md-3">
                    <div class="form-group">
                      <input type="text" class="form-control fdate" placeholder="Tanggal Awal" autocomplete="off" name="tanggal_awal">
                    </div>
                  </div>

                  <div class="col-md-3">
                    <div class="form-group">
                      <input type="text" class="form-control fdate" placeholder="Tanggal Akhir" autocomplete="off" name="tanggal_akhir">
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="form-group">
                      <select name="jenislayanan_id" id="jenislayanan_id" class="form-control">
                        <option value="">Jenis Layanan</option>
                        @foreach ($layanan as $list)
                          <option value="{{ $list->jenislayanan_id }}">{{ $list->jenislayanan_nama }}</option>
                        @endforeach
                      </select>
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


