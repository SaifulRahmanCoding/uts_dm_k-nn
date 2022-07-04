<!-- Button trigger modal -->
<button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#TambahData" style="font-size: 14px;">
  Tambah Data
</button>

<!-- Modal -->
<div class="modal fade" id="TambahData" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="TambahDataLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable">

    <form action="index.php?opsi=input" method="POST">

      <div class="modal-content px-3">
        <div class="modal-header">
          <h5 class="modal-title" id="TambahDataLabel">Tambah Data</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">

          <div class="form-group mb-1 d-flex align-items-center">
            <label for="x1" class="mb-2 col-3 pt-2 pb-2">Nilai x1</label>

            <input name="x1" id="x1"  class="form-control bg-light" type="number">
          </div>

          <div class="form-group mb-1 d-flex align-items-center">
            <label for="y1" class="mb-2 col-3 pt-2 pb-2">Nilai y1</label>

            <input name="y1" id="y1"  class="form-control bg-light" type="number">
          </div>

          <div class="form-group mb-1 d-flex align-items-center">
            <label for="class" class="mb-2 col-3 pt-2 pb-2">Data Class</label>

             <select id="class" class="form-control bg-light" name="class" required>
                <option value="">- Pilih</option>
                <option value="Good">Good</option>
                <option value="Bad">Bad</option>
              </select>
          </div>

        </div>
        <div class="modal-footer justify-content-center">

          <input type="submit" name="submit" value="Simpan" class="btn btn-info text-white col-11 p-2">

        </div>
      </div>

    </form>

  </div>
</div>
