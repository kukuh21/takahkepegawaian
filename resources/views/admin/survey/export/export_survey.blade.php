
<table width="100%">
  <thead>
  <tr>
      <th>No.</th>
      <th>Jenis Layanan</th>
      <th>No. Identitas</th>
      <th>Nama</th>
      <th>Instansi</th>
      <th>Jabatan</th>
      <th>JK</th>
      <th>Jenjang</th>
      <th>Tanggal Survey</th>
      <th>Pertanyaan</th>
      <th>Jawaban</th>
      <th>Poin</th>
  </tr>
  </thead>
  <tbody>
@foreach($data as $index => $list)
    <tr>
        <td>{{ $index+1 }}</td>
        <td>{{ $list->jenislayanan_nama }}</td>
        <td>'{{ $list->identitas_no }}</td>
        <td>{{ $list->identitas_nama }}</td>
        <td>{{ $list->identitas_instansi }}</td>
        <td>{{ $list->identitas_jabatan }}</td>
        <td>{{ $list->identitas_jk }}</td>
        <td>{{ $list->identitas_jenjang }}</td>
        <td>{{ $list->survey_tanggal }}</td>
        <td>{{ $list->pertanyaan_nama }}</td>
        <td>{{ $list->jawaban_nama }}</td>
        <td>{{ $list->jawaban_poin }}</td>
    </tr>
@endforeach
  </tbody>
</table>