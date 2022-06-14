
<table width="100%">
  <thead>
  <tr>
      <th>No.</th>
      <th>Status Responden</th>
      <th>NIP</th>
      <th>Nama</th>
      <th>Saran</th>
      <th>Time</th>
  </tr>
  </thead>
  <tbody>
@foreach($data as $index => $list)
    <tr>
        <td>{{ $index+1 }}</td>
        <td>{{ $list->status_responden }}</td>
        <td>'{{ $list->status_no }}</td>
        <td>{{ $list->status_nama }}</td>
        <td>{{ $list->saran_isi }}</td>
        <td>{{ $list->created_at }}</td>
    </tr>
@endforeach
  </tbody>
</table>