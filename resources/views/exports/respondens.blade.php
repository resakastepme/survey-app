<table>
    <thead>
    <tr>
        <th>Nama</th>
        <th>Email</th>
        <th>Jenis Kelamin</th>
        <th>Rentang Usia</th>
        <th>Pekerjaan</th>
        <th>Bidang Industri</th>
        <th>Menggunakan Email</th>
        <th>Mengalami</th>
        <th>Kesadaran</th>
        <th>Korban</th>
        <th>Pengguna Extension</th>
        <th>Pengguna Extension Spesifik</th>
        <th>Deteksi Email</th>
        <th>Mempertimbangkan</th>
        <th>Fitur Utama</th>
        <th>Seberapa Nyaman</th>
        <th>Platform Email</th>
        <th>Waktu</th>
    </tr>
    </thead>
    <tbody>
    @foreach($respondens as $r)
        <tr>
            <td>{{ $r->nama }}</td>
            <td>{{ $r->email }}</td>
            <td>{{ $r->jenis_kelamin }}</td>
            <td>{{ $r->rentang_usia }}</td>
            <td>{{ $r->pekerjaan }}</td>
            <td>{{ $r->bidang_industri }}</td>
            <td>{{ $r->getResult->menggunakan_email }}</td>
            <td>{{ $r->getResult->mengalami }}</td>
            <td>{{ $r->getResult->kesadaran }}</td>
            <td>{{ $r->getResult->korban }}</td>
            <td>{{ $r->getResult->pengguna_extension }}</td>
            <td>{{ $r->getResult->pengguna_extension_spesifik }}</td>
            <td>{{ $r->getResult->deteksi_email }}</td>
            <td>{{ $r->getResult->mempertimbangkan }}</td>
            <td>{{ $r->getResult->fitur_utama }}</td>
            <td>{{ $r->getResult->seberapa_nyaman }}</td>
            <td>{{ $r->getResult->platform_email }}</td>
            <td>{{ $r->getResult->updated_at }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
