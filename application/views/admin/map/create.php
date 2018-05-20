<form method="post">
  <div class="form-group row">
    <label for="name" class="col-sm-2 col-form-label">Navn</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" name="name" placeholder="Navn">
    </div>
  </div>
  <div class="form-group row">
    <label for="desc" class="col-sm-2 col-form-label">Beskrivelse</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" name="desc" placeholder="Beskrivelse">
    </div>
  </div>
  <div class="form-group row">
    <label for="type" class="col-sm-2 col-form-label">Type</label>
    <div class="col-sm-10">
      <select class="form-control" name="type">
        {map_types}
        <option value="{mt_id}">{mt_name}</option>
        {/map_types}
      </select>
    </div>
  </div>
  <div class="form-group row">
    <div class="col-sm-10">
      <input type="submit" name="create" value="Opret" class="btn btn-primary">
    </div>
  </div>
</form>