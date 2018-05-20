<a href="{map_create}" class="btn btn-primary">Opret</a>
<br><br>
<table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Titel</th>
      <th scope="col">Beskrivelse</th>
      <th scope="col">Type</th>
      <th scope="col">Handling</th>
    </tr>
  </thead>
  <tbody>
    {maps}
    <tr>
      <th scope="row">{m_id}</th>
      <td>{m_name}</td>
      <td>{m_desc}</td>
      <td>{m_type}</td>
      <td>
        <a href="{addurl}" class="btn btn-primary">Tilføj</a>
        <a href="{editurl}" class="btn btn-success">Rediger</a>
        <a href="{delurl}" class="btn btn-danger">Slet</a>
      </td>
    </tr>
    {/maps}
  </tbody>
</table>