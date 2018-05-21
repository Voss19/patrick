<div>{err}</div>
<form method="post" enctype="multipart/form-data">
  <div class="form-group row">
    <label for="name" class="col-sm-2 col-form-label">Navn</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" name="name" placeholder="Navn">
    </div>
  </div>
  <div class="form-group row">
    <label for="desc" class="col-sm-2 col-form-label">Kode</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" name="code" placeholder="Kode">
    </div>
  </div>
  <div class="form-group row">
    <label for="desc" class="col-sm-2 col-form-label">Fil</label>
    <div class="col-sm-10">
      <input type="file" class="form-control" name="file" placeholder="Fil">
    </div>
  </div>
  <div class="form-group row">
    <div class="col-sm-10">
      <input type="submit" name="upload" value="Upload" class="btn btn-primary">
    </div>
  </div>
</form>