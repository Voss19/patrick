<a href="{map_create}" class="btn btn-primary">Opret</a>
<br><br>
<table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Land</th>
      <th scope="col">Kode</th>
      <th scope="col">Aktiv</th>
      <th scope="col">Handling</th>
    </tr>
  </thead>
  <tbody>
    {inputs}
    <tr>
      <th scope="row">{mi_id}</th>
      <td>{mi_name}</td>
      <td>{mi_a2}</td>
      <td>{mi_active}</td>
      <td>
        <a href="{toggle}" class="btn btn-primary">Toggle</a>
        <a href="" class="btn btn-danger">Slet</a>
      </td>
    </tr>
    {/inputs}
  </tbody>
</table>