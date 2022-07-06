<!-- Modal -->
<div class="modal fade" id="EditData<?php echo $data['id'] ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="EditData<?php echo $data['id'] ?>Label" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable">
   <form action="index.php?opsi=edit" method="POST">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="EditData<?php echo $data['id'] ?>Label">Edit Data</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">

        <input name="id" id="id" value="<?php echo $data['id'] ?>" class="form-control bg-light" type="number" hidden>

        <div class="form-group mb-1 d-flex align-items-center">
          <label for="x1" class="mb-2 col-3 pt-2 pb-2">Nilai x1</label>

          <input name="x1" id="x1" value="<?php echo $data['x1'] ?>" class="form-control bg-light" type="number">
        </div>

        <div class="form-group mb-1 d-flex align-items-center">
          <label for="y1" class="mb-2 col-3 pt-2 pb-2">Nilai y1</label>

          <input name="y1" id="y1" value="<?php echo $data['y1'] ?>" class="form-control bg-light" type="number">
        </div>

        <div class="form-group mb-1 d-flex align-items-center">
          <label for="class" class="mb-2 col-3 pt-2 pb-2">Nilai Class</label>

          <select id="class" class="form-control bg-light" name="class" required>
            <option value="">- Pilih</option>
            <option value="Good" <?php echo ($data['class'] == "Good") ? "selected" : "" ?> >Good</option>
            <option value="Bad" <?php echo ($data['class'] == "Bad") ? "selected" : "" ?> >Bad</option>
          </select>
        </div>

      </div>
      <div class="modal-footer justify-content-center">

        <input type="submit" name="submit" value="Edit" class="btn btn-info text-white col-12 col-lg p-2">

      </div>
    </div>
  </form>
</div>
</div>
