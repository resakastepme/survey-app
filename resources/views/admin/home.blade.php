@include('admin.rules')
@extends('admin.mainlayout')
@section('extra-nav')
    <li class="nav-item">
        <a class="nav-link active" href="{{ url('/adminPlace/home') }}">Home</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" id="downloadBtn" href="{{ url('/adminPlace/home') }}">
            <i class="spinner-border spinner-border-sm" role="status" style="display: none;" id="loadExcel">
            </i> Download-Excel
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ url('/adminPlace/logout') }}" style="color: red">logout</a>
    </li>
@endsection
@section('content')
    <?php error_reporting(0); ?>
    <div class="container mt-5 d-flex align-items-center justify-content-center">
        <div class="row">
            <div class="col-md-4">
                <div class="card shadow rounded border-0 mt-2" style="background-color: rgb(231, 225, 225)">
                    <div class="card-body">
                        <canvas id="menggunakan_email_chart" height="220" style="width:100%;max-width:700px"></canvas>
                    </div>
                </div>
                <div class="card shadow rounded border-0 mt-3" style="background-color: rgb(231, 225, 225);">
                    <div class="card-body">
                        <canvas id="mengalami_chart" height="250" style="width:100%;max-width:700px;height:200%"></canvas>
                    </div>
                </div>
                <div class="card shadow rounded border-0 mt-3" style="background-color: rgb(231, 225, 225);">
                    <div class="card-body">
                        <canvas id="kesadaran_chart" height="230" style="width:100%;max-width:700px;height:200%"></canvas>
                    </div>
                </div>
                <div class="card shadow rounded border-0 mt-3" style="background-color: rgb(231, 225, 225);">
                    <div class="card-body">
                        <canvas id="korban_chart" height="250" style="width:100%;max-width:700px;height:200%"></canvas>
                    </div>
                </div>
                <div class="card shadow rounded border-0 mt-3" style="background-color: rgb(231, 225, 225);">
                    <div class="card-body">
                        <canvas id="pengguna_extension_chart" height="220"
                            style="width:100%;max-width:700px;height:200%"></canvas>
                    </div>
                </div>
                <div class="card shadow rounded border-0 mt-3" style="background-color: rgb(231, 225, 225);">
                    <div class="card-body">
                        <canvas id="deteksi_email_chart" height="220"
                            style="width:100%;max-width:700px;height:200%"></canvas>
                    </div>
                </div>
                <div class="card shadow rounded border-0 mt-3" style="background-color: rgb(231, 225, 225);">
                    <div class="card-body">
                        <canvas id="mempertimbangkan_chart" height="220"
                            style="width:100%;max-width:700px;height:200%"></canvas>
                    </div>
                </div>
                <div class="card shadow rounded border-0 mt-3" style="background-color: rgb(231, 225, 225);">
                    <div class="card-body">
                        <canvas id="fitur_utama_chart" height="220"
                            style="width:100%;max-width:700px;height:200%"></canvas>
                    </div>
                </div>
                <div class="card shadow rounded border-0 mt-3" style="background-color: rgb(231, 225, 225);">
                    <div class="card-body">
                        <canvas id="seberapa_nyaman_chart" height="220"
                            style="width:100%;max-width:700px;height:200%"></canvas>
                    </div>
                </div>
                <div class="card shadow rounded border-0 mt-3" style="background-color: rgb(231, 225, 225);">
                    <div class="card-body">
                        <canvas id="platform_email_chart" height="220"
                            style="width:100%;max-width:700px;height:200%"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-md-8">

                <h1 class="text-center"> Hasil Survey #{{ $_GET['page'] != null ? $_GET['page'] : 1 }}</h1><br>
                <div class="d-flex justify-content-center align-items-center" id="paginationLinks">
                    {{ $post->links() }}
                </div>

                <section id="paginationAjax" style="display: block">

                    @foreach ($post as $p)
                        <div class="card shadow rounded border-0 bg-light">
                            <div class="card-body">

                                <label for="nama"> Nama </label>
                                <input type="text" id="nama" name="nama" class="form-control"
                                    placeholder="default: Anonymous" value="{{ $p->nama }}">

                                <label class="mt-2" for="email"> Email </label>
                                <input type="email" id="email" name="email" class="form-control"
                                    value="{{ $p->email }}">

                                <label class="mt-2" for="jenisKelamin"> Jenis Kelamin </label>
                                <input name="jenisKelamin" id="jenisKelamin" value="{{ $p->jenis_kelamin }}"
                                    class="form-control">
                                {{-- <option value="null" default>-- Pilih --</option>
                                    <option value="laki-laki">Laki-laki</option>
                                    <option value="perempuan">Perempuan</option>
                                    <option value="tidak_memilih">Tidak memilih</option> --}}
                                </input>

                                <label class="mt-2" for="usia">Rentang usia</label>
                                <input name="usia" id="usia" value="{{ $p->rentang_usia }}"
                                    class="form-control">
                                {{-- <option value="null" default>-- Pilih --</option>
                                    <option value="Kurang dari 12 tahun"> Kurang dari 12 tahun </option>
                                    <option value="12 sampai 17 tahun"> 12 sampai 17 tahun </option>
                                    <option value="18 sampai 25 tahun"> 18 sampai 25 tahun </option>
                                    <option value="26 sampai 35 tahun"> 26 sampai 35 tahun </option>
                                    <option value="Lebih dari 35 tahun"> Lebih dari 35 tahun </option>
                                    <option value="tidak_memilih">Tidak memilih</option> --}}
                                </input>

                                <div class="row d-flex mt-2">
                                    <div class="col-md-6">

                                        <label for="pekerjaan"> Pekerjaan </label>
                                        <input name="pekerjaan" id="pekerjaan" value="{{ $p->pekerjaan }}"
                                            class="form-control">
                                        {{-- <option value="null" id="pekerjaanDefault" default>-- Pilih --</option>
                                            <option value="Mahasiswa" id="pekerjaanDefault">Mahasiswa</option>
                                            <option value="Karyawan Swasta" id="pekerjaanDefault">Karyawan Swasta</option>
                                            <option value="Pengusaha/Entreprenuer" id="pekerjaanDefault">
                                                Pengusaha/Entreprenuer
                                            </option>
                                            <option value="Wiraswasta" id="pekerjaanDefault">Wiraswasta</option>
                                            <option value="PNS (Pegawai Negeri Sipil)" id="pekerjaanDefault">PNS (Pegawai
                                                Negeri
                                                Sipil)</option>
                                            <option value="Freelancer" id="pekerjaanDefault">Freelancer</option>
                                            <option value="Dosen/Akademisi" id="pekerjaanDefault">Dosen/Akademisi</option>
                                            <option value="Peneliti" id="pekerjaanDefault">Peneliti</option>
                                            <option value="Profesional Kesehatan" id="pekerjaanDefault">Profesional
                                                Kesehatan
                                            </option>
                                            <option value="Lainnya" id="pekerjaanLainnya">Lainnya (Spesifikan)</option>
                                            <option value="Tidak memilih">Tidak memilih</option> --}}
                                        </input>
                                        {{-- <section id="pekerjaanSpesifikSection" class="mt-2" style="display: none;">
                                            <label for="pekerjaanSpesifik">Sebutkan pekerjaan <span
                                                    style="color: red">*</span></label>
                                            <input type="text" class="form-control" id="pekerjaanSpesifik"
                                                name="pekerjaanSpesifik">
                                        </section> --}}

                                    </div>
                                    <div class="col-md-6">

                                        <label for="bidangIndustri">Bidang Industri</label>
                                        <input name="bidangIndustri" value="{{ $p->bidang_industri }}"
                                            id="bidangIndustri" class="form-control">
                                        {{-- <option value="null" default>-- Pilih --</option>
                                            <option value="Teknologi Informasi dan Telekomunikasi">Teknologi Informasi dan
                                                Telekomunikasi</option>
                                            <option value="Keuangan dan Perbankan">Keuangan dan Perbankan</option>
                                            <option value="Kesehatan dan Kedokteran">Kesehatan dan Kedokteran</option>
                                            <option value="Pendidikan dan Penelitian">Pendidikan dan Penelitian</option>
                                            <option value="E-commerce dan Perdangan Online">E-commerce dan Perdangan Online
                                            </option>
                                            <option value="Jasa Konsultasi">Jasa Konsultasi</option>
                                            <option value="Manufaktur">Manufaktur</option>
                                            <option value="Otomotif">Otomotif</option>
                                            <option value="Media dan Hiburan">Media dan Hiburan</option>
                                            <option value="Pariwisata dan Perhotelan">Pariwisata dan Perhotelan</option>
                                            <option value="Layanan Umum dan Pemerintahan">Layanan Umum dan Pemerintahan
                                            </option>
                                            <option value="Lainnya">Lainnya (Spesifikan)</option>
                                            <option value="Tidak memilih">Tidak memilih</option> --}}
                                        </input>
                                        {{-- <section id="bidangIndustriSpesifikSection" class="mt-2"
                                            style="display: none;">
                                            <label for="bidangIndustriSpesifik">Sebutkan bidang industri <span
                                                    style="color: red">*</span></label>
                                            <input type="text" class="form-control" id="bidangIndustriSpesifik"
                                                name="bidangIndustriSpesifik">
                                        </section> --}}

                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class="card rounded shadow border-0 bg-light mt-3">
                            <div class="card-body">
                                <label for="menggunakanEmail">Seberapa sering Anda menggunakan email untuk keperluan
                                    pribadi
                                    atau pekerjaan? <span style="color: red">*</span></label>
                                <input name="menggunakanEmail" id="menggunakanEmail" class="form-control"
                                    value="{{ $p->getResult->menggunakan_email }}">
                                {{-- <option value="null" default>-- Pilih --</option>
                                    <option value="Setiap Hari">Setiap Hari</option>
                                    <option value="Beberapa Kali dalam Seminggu">Beberapa Kali dalam Seminggu</option>
                                    <option value="Sekitar Sekali Seminggu">Sekitar Sekali Seminggu</option>
                                    <option value="Sekitar Sekali Sebulan">Sekitar Sekali Sebulan</option>
                                    <option value="Jarang Sekali atau Tidak Pernah">Jarang Sekali atau Tidak Pernah
                                    </option> --}}
                                </input>
                            </div>
                        </div>

                        <div class="card rounded shadow border-0 bg-light mt-3">
                            <div class="card-body">
                                <label for="mengalami">Apakah Anda pernah mengalami atau menyadari adanya upaya
                                    penipuan melalui email? <span style="color: red">*</span></label>
                                <input value="{{ $p->getResult->mengalami }}" name="mengalami" id="mengalami"
                                    class="form-control">
                                {{-- <option value="null" default>-- Pilih --</option>
                                    <option value="Ya, Saya Pernah Mengalami">Ya, Saya Pernah Mengalami</option>
                                    <option value="Tidak, Saya Tidak Pernah Mengalami">Tidak, Saya Tidak Pernah Mengalami
                                    </option>
                                    <option value="Tidak Yakin">Tidak Yakin</option>
                                    <option value="Mungkin, Tetapi Saya Tidak Yakin">Mungkin, Tetapi Saya Tidak Yakin
                                    </option>
                                    <option value="Tidak Ingin Mengungkapkan">Tidak Ingin Mengungkapkan</option> --}}
                                </input>
                            </div>
                        </div>

                        <div class="card rounded shadow border-0 bg-light mt-3">
                            <div class="card-body">
                                <label for="kesadaran">Seberapa sadar Anda terhadap potensi risiko keamanan
                                    email, seperti phishing atau penipuan email? <span style="color: red">*</span></label>
                                <input value="{{ $p->getResult->kesadaran }}" name="kesadaran" id="kesadaran"
                                    class="form-control">
                                {{-- <option value="null" default>-- Pilih --</option>
                                    <option value="Sangat Sadar">Sangat Sadar</option>
                                    <option value="Cukup Sadar">Cukup Sadar
                                    </option>
                                    <option value="Kurang Sadar">Kurang Sadar</option>
                                    <option value="Sama Sekali Tidak Sadar">Sama Sekali Tidak Sadar</option>
                                    <option value="Tidak Yakin">Tidak Yakin</option>
                                </input> --}}
                            </div>
                        </div>

                        <div class="card rounded shadow border-0 bg-light mt-3">
                            <div class="card-body">
                                <label for="korban">Apakah Anda pernah menjadi korban penipuan email atau
                                    keamanan email yang buruk? <span style="color: red">*</span></label>
                                <input value="{{ $p->getResult->korban }}" name="korban" id="korban"
                                    class="form-control">
                                {{-- <option value="null" default>-- Pilih --</option>
                                    <option value="Ya, Saya Pernah Menjadi Korban">Ya, Saya Pernah Menjadi Korban</option>
                                    <option value="Tidak, Saya Belum Pernah Menjadi Korban">Tidak, Saya Belum Pernah
                                        Menjadi
                                        Korban
                                    </option>
                                    <option value="Tidak Yakin">Tidak Yakin</option>
                                    <option value="Mungkin, Tetapi Saya Tidak Yakin">Mungkin, Tetapi Saya Tidak Yakin
                                    </option>
                                    <option value="Tidak Ingin Mengungkapkan">Tidak Ingin Mengungkapkan</option> --}}
                                </input>
                            </div>
                        </div>

                        <div class="card rounded shadow border-0 bg-light mt-3">
                            <div class="card-body">
                                <label for="penggunaExtension">Apakah Anda pernah menggunakan atau menginstall aplikasi
                                    Chrome
                                    Extension sebelumnya? <span style="color: red">*</span></label>
                                <input value="{{ $p->getResult->pengguna_extension }}" name="penggunaExtension"
                                    id="penggunaExtension" class="form-control">
                                {{-- <option value="null" default>-- Pilih --</option>
                                    <option value="Ya, Saya Pernah">Ya, Saya Pernah</option>
                                    <option value="Tidak, Saya Belum Pernah">Tidak, Saya Belum Pernah
                                    </option> --}}
                                </input>
                                <section class="mt-2" id="penggunaExtensionTrue" style="display: block;">
                                    <label for="penggunaExtensionSpesifik">Sebutkan beberapa aplikasi Chrome Extension yang
                                        biasa Anda gunakan <span style="color: red">*</span></label>
                                    <input value="{{ $p->getResult->pengguna_extension_spesifik }}" type="text"
                                        id="penggunaExtensionSpesifik" name="penggunaExtensionSpesifik"
                                        class="form-control">
                                </section>
                            </div>
                        </div>

                        <div class="card rounded shadow border-0 bg-light mt-3">
                            <div class="card-body">
                                <label for="deteksiEmail">Apakah Anda berpikir bahwa deteksi email penipuan
                                    adalah
                                    hal yang penting untuk keamanan email Anda? <span style="color: red">*</span></label>
                                <input value="{{ $p->getResult->deteksi_email }}" name="deteksiEmail" id="deteksiEmail"
                                    class="form-control">
                                {{-- <option value="null" default>-- Pilih --</option>
                                    <option value="Sangat Penting">Sangat Penting</option>
                                    <option value="Penting">Penting</option>
                                    <option value="Netral">Netral</option>
                                    <option value="Tidak Terlalu Penting">Tidak Terlalu Penting</option>
                                    <option value="Tidak Penting Sama Sekali">Tidak Penting Sama Sekali</option> --}}
                                </input>
                            </div>
                        </div>

                        <div class="card shadow rounded border-0 bg-light mt-3">
                            <div class="card-body">
                                <label for="mempertimbangkan">Apakah Anda saat ini menggunakan atau
                                    mempertimbangkan
                                    menggunakan alat atau layanan untuk melindungi diri dari penipuan email? <span
                                        style="color: red">*</span></label>
                                <input value="{{ $p->getResult->mempertimbangkan }}" name="mempertimbangkan"
                                    id="mempertimbangkan" class="form-control">
                                {{-- <option value="null" default>-- Pilih --</option>
                                    <option value="Ya, Saya Sedang Menggunakan Alat atau Layanan Tersebut">Ya, Saya Sedang
                                        Menggunakan Alat atau Layanan Tersebut</option>
                                    <option value="Belum, Tetapi Saya Mempertimbangkan">Belum, Tetapi Saya Mempertimbangkan
                                    </option>
                                    <option value="Tidak Pernah Memikirkan">Tidak Pernah Memikirkan</option>
                                    <option value="Tidak Tahu">Tidak Tahu</option>
                                    <option value="Tidak Ingin Menggunakan">Tidak Ingin Menggunakan</option> --}}
                                </input>
                            </div>
                        </div>

                        <div class="card rounded shadow border-0 bg-light mt-3">
                            <div class="card-body">
                                <label>Apa yang menurut Anda menjadi fitur utama yang harus dimiliki oleh
                                    aplikasi deteksi email penipuan agar dapat membantu Anda secara efektif? <span
                                        style="color: red">*</span> </label> <span> (**Plih bisa lebih dari satu**)
                                </span><br>

                                <textarea name="" id="" cols="30" rows="5" class="form-control mt-2"> {{ $p->getResult->fitur_utama }}</textarea>

                                {{-- <div class="m-3" id="cbForm1">

                                    <input type="checkbox" id="cb1" class="fiturCheckbox mt-4" name="fitur"
                                        value="Scan Email Otomatis">
                                    <span style="cursor: pointer;" id="tcb1">Aplikasi dapat secara otomatis mengenali
                                        dan
                                        menyaring email
                                        yang
                                        mencurigakan tanpa perlu campur tangan Anda.</span> <br>

                                    <input type="checkbox" id="cb2" class="fiturCheckbox mt-3" name="fitur"
                                        value="Peringatan Langsung">
                                    <span style="cursor: pointer;" id="tcb2">Anda akan langsung diberi tahu ketika
                                        ada email
                                        yang dianggap mencurigakan.</span> <br>

                                    <input type="checkbox" id="cb3" class="fiturCheckbox mt-3" name="fitur"
                                        value="Integrasi Mudah">
                                    <span style="cursor: pointer;" id="tcb3">Aplikasi dapat terhubung dengan mudah ke
                                        platform email yang Anda gunakan.</span> <br>

                                    <input type="checkbox" id="cb4" class="fiturCheckbox mt-3" name="fitur"
                                        value="Analisis Tautan dan Lampiran">
                                    <span style="cursor: pointer;" id="tcb4">Aplikasi menganalisis link dan file
                                        terlampir untuk memastikan keamanan.</span> <br>

                                    <input type="checkbox" id="cb5" class="fiturCheckbox mt-3" name="fitur"
                                        value="Pembaruan Berkala">
                                    <span style="cursor: pointer;" id="tcb5">Aplikasi secara rutin diperbarui dengan
                                        fitur-fitur keamanan terbaru.</span> <br>

                                    <input type="checkbox" id="cb6" class="fiturCheckbox mt-3" name="fitur"
                                        value="Panduan Keamanan">
                                    <span style="cursor: pointer;" id="tcb6">Aplikasi menyediakan tips keamanan email
                                        yang praktis.</span> <br>

                                </div> --}}

                            </div>
                        </div>

                        <div class="card rounded shadow border-0 bg-light mt-3">
                            <div class="card-body">
                                <label for="seberapaNyaman">Seberapa nyaman Anda dengan ide menggunakan aplikasi Chrome
                                    Extension untuk melindungi email Anda? <span style="color: red">*</span></label>
                                <input value="{{ $p->getResult->seberapa_nyaman }}" name="seberapaNyaman"
                                    id="seberapaNyaman" class="form-control">
                                {{-- <option value="null" default>-- Pilih --</option>
                                    <option value="Sangat Nyaman">Sangat Nyaman</option>
                                    <option value="Nyaman">Nyaman
                                    </option>
                                    <option value="Netral">Netral</option>
                                    <option value="Tidak Nyaman">Tidak Nyaman</option>
                                    <option value="Tidak Suka">Tidak Ingin Menggunakan</option> --}}
                                </input>
                            </div>
                        </div>

                        <div class="card rounded shadow border-0 bg-light mt-3">
                            <div class="card-body">
                                <label>Dari beberapa Platform Pengelola Email dibawah ini, manakah yang
                                    anda gunakan? <span style="color: red">*</span></label>
                                <p> (**Plih bisa lebih dari
                                    satu**)
                                </p>

                                <textarea name="" id="" cols="30" rows="5" class="form-control mt-2"> {{ $p->getResult->platform_email }} </textarea>

                                {{-- <div class="m-3" id="cbForm2">

                                    <input type="checkbox" id="cb11" class="fiturCheckbox1 mt-4" value="RoundCube">
                                    <span style="cursor: pointer;" id="tcb11">RoundCube (Web Mail)</span> <br>

                                    <input type="checkbox" id="cb12" class="fiturCheckbox1 mt-3" value="Gmail">
                                    <span style="cursor: pointer;" id="tcb12">Gmail (Google Mail)</span> <br>

                                    <input type="checkbox" id="cb13" class="fiturCheckbox1 mt-3"
                                        value="Yahoo Mail">
                                    <span style="cursor: pointer;" id="tcb13">Yahoo Mail</span> <br>

                                    <input type="checkbox" id="cb14" class="fiturCheckbox1 mt-3"
                                        value="Apple Mail">
                                    <span style="cursor: pointer;" id="tcb14">Apple Mail</span> <br>

                                    <label for="LainnyaEmail" class="mt-3">Lainnya (Spesifikan)</label>
                                    <input type="text" class="form-control" id="LainnyaEmail" name="LainnyaEmail">

                                </div> --}}

                            </div>
                        </div>

                        <small style="font-size: 10px;"> ***Catatan: form dengan simbol <span style="color: red">*</span>
                            wajib di isi! </small>
                    @endforeach


                </section>

                <div class="d-flex mt-4 justify-content-center align-items-center" id="paginationLinks">
                    {{ $post->links() }}
                </div>

            </div>
        </div>
    </div>
@endsection
@section('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
    <script type="text/javascript">
        $('#downloadBtn').on('click', function(e) {
            e.preventDefault();
            location.href = window.location.origin + '/adminPlace/excel';
        });

        $(':input').prop('disabled', true);

        const menggunakan_email1 = '{{ $menggunakan_email1 }}';
        const menggunakan_email2 = '{{ $menggunakan_email2 }}';
        const menggunakan_email3 = '{{ $menggunakan_email3 }}';
        const menggunakan_email4 = '{{ $menggunakan_email4 }}';
        const menggunakan_email5 = '{{ $menggunakan_email5 }}';

        var xValues_menggunakan_email = ["Setiap Hari", "Beberapa Kali dalam Seminggu", "Sekitar Sekali Seminggu",
            "Sekitar Sekali Sebulan", "Jarang Sekali atau Tidak Pernah"
        ];
        var yValues_menggunakan_email = [menggunakan_email1, menggunakan_email2, menggunakan_email3, menggunakan_email4,
            menggunakan_email5
        ];
        var barColors_menggunakan_email = ["red", "green", "blue", "orange", "brown"];
        new Chart("menggunakan_email_chart", {
            type: "pie",
            data: {
                labels: xValues_menggunakan_email,
                datasets: [{
                    backgroundColor: barColors_menggunakan_email,
                    data: yValues_menggunakan_email
                }]
            },
            options: {
                title: {
                    display: true,
                    text: "Seberapa sering Anda menggunakan email untuk keperluan pribadi atau pekerjaan?"
                }
            }
        });

        const mengalami1 = '{{ $mengalami1 }}';
        const mengalami2 = '{{ $mengalami2 }}';
        const mengalami3 = '{{ $mengalami3 }}';
        const mengalami4 = '{{ $mengalami4 }}';
        const mengalami5 = '{{ $mengalami5 }}';

        var xValues_mengalami = ["Ya, Saya Pernah Mengalami", "Tidak, Saya Tidak Pernah Mengalami", "Tidak Yakin",
            "Mungkin, Tetapi Saya Tidak Yakin", "Tidak Ingin Mengungkapkan"
        ];
        var yValues_mengalami = [mengalami1, mengalami2, mengalami3, mengalami4, mengalami5];
        var barColors_mengalami = ["red", "green", "blue", "orange", "brown"];
        new Chart("mengalami_chart", {
            type: "pie",
            data: {
                labels: xValues_mengalami,
                datasets: [{
                    backgroundColor: barColors_mengalami,
                    data: yValues_mengalami
                }]
            },
            options: {
                title: {
                    display: true,
                    text: "Apakah Anda pernah mengalami atau menyadari adanya upaya penipuan melalui email?"
                }
            }
        });

        const kesadaran1 = '{{ $kesadaran1 }}';
        const kesadaran2 = '{{ $kesadaran2 }}';
        const kesadaran3 = '{{ $kesadaran3 }}';
        const kesadaran4 = '{{ $kesadaran4 }}';
        const kesadaran5 = '{{ $kesadaran5 }}';

        var xValues_kesadaran = ["Sangat Sadar", "Cukup Sadar", "Kurang Sadar", "Sama Sekali Tidak Sadar", "Tidak Yakin"];
        var yValues_kesadaran = [kesadaran1, kesadaran2, kesadaran3, kesadaran4, kesadaran5];
        var barColors_kesadaran = ["red", "green", "blue", "orange", "brown"];
        new Chart("kesadaran_chart", {
            type: "pie",
            data: {
                labels: xValues_kesadaran,
                datasets: [{
                    backgroundColor: barColors_kesadaran,
                    data: yValues_kesadaran
                }]
            },
            options: {
                title: {
                    display: true,
                    text: "Seberapa sadar Anda terhadap potensi risiko keamanan email, seperti phishing atau penipuan email?"
                }
            }
        });

        const korban1 = '{{ $korban1 }}';
        const korban2 = '{{ $korban2 }}';
        const korban3 = '{{ $korban3 }}';
        const korban4 = '{{ $korban4 }}';
        const korban5 = '{{ $korban5 }}';

        var xValues_korban = ["Ya, Saya Pernah Menjadi Korban", "Tidak, Saya Belum Pernah Menjadi Korban", "Tidak Yakin",
            "Mungkin, Tetapi Saya Tidak Yakin", "Tidak Ingin Mengungkapkan"
        ];
        var yValues_korban = [korban1, korban2, korban3, korban4, korban5];
        var barColors_korban = ["red", "green", "blue", "orange", "brown"];
        new Chart("korban_chart", {
            type: "pie",
            data: {
                labels: xValues_korban,
                datasets: [{
                    backgroundColor: barColors_korban,
                    data: yValues_korban
                }]
            },
            options: {
                title: {
                    display: true,
                    text: "Apakah Anda pernah menjadi korban penipuan email atau keamanan email yang buruk?"
                }
            }
        });

        const pengguna_extension1 = '{{ $pengguna_extension1 }}';
        const pengguna_extension2 = '{{ $pengguna_extension2 }}';

        var xValues_pengguna_extension = ["Ya, Saya Pernah", "Tidak, Saya Belum Pernah"];
        var yValues_pengguna_extension = [pengguna_extension1, pengguna_extension2];
        var barColors_pengguna_extension = ["red", "green"];
        new Chart("pengguna_extension_chart", {
            type: "pie",
            data: {
                labels: xValues_pengguna_extension,
                datasets: [{
                    backgroundColor: barColors_pengguna_extension,
                    data: yValues_pengguna_extension
                }]
            },
            options: {
                title: {
                    display: true,
                    text: "Apakah Anda pernah menggunakan atau menginstall aplikasi Chrome Extension sebelumnya?"
                }
            }
        });

        const deteksi_email1 = '{{ $deteksi_email1 }}';
        const deteksi_email2 = '{{ $deteksi_email2 }}';
        const deteksi_email3 = '{{ $deteksi_email3 }}';
        const deteksi_email4 = '{{ $deteksi_email4 }}';
        const deteksi_email5 = '{{ $deteksi_email5 }}';

        var xValues_deteksi_email = ["Sangat Penting", "Penting", "Netral", "Tidak Terlalu Penting",
            "Tidak Penting Sama Sekali"
        ];
        var yValues_deteksi_email = [deteksi_email1, deteksi_email2, deteksi_email3, deteksi_email4, deteksi_email5];
        var barColors_deteksi_email = ["red", "green", "blue", "orange", "brown"];
        new Chart("deteksi_email_chart", {
            type: "pie",
            data: {
                labels: xValues_deteksi_email,
                datasets: [{
                    backgroundColor: barColors_deteksi_email,
                    data: yValues_deteksi_email
                }]
            },
            options: {
                title: {
                    display: true,
                    text: "Apakah Anda berpikir bahwa deteksi email penipuan adalah hal yang penting untuk keamanan email Anda?"
                }
            }
        });

        const mempertimbangkan1 = '{{ $mempertimbangkan1 }}';
        const mempertimbangkan2 = '{{ $mempertimbangkan2 }}';
        const mempertimbangkan3 = '{{ $mempertimbangkan3 }}';
        const mempertimbangkan4 = '{{ $mempertimbangkan4 }}';
        const mempertimbangkan5 = '{{ $mempertimbangkan5 }}';

        var xValues_mempertimbangkan = ["Ya, Saya Sedang Menggunakan Alat atau Layanan Tersebut",
            "Belum, Tetapi Saya Mempertimbangkan", "Tidak Pernah Memikirkan", "Tidak Tahu", "Tidak Ingin Menggunakan"
        ];
        var yValues_mempertimbangkan = [mempertimbangkan1, mempertimbangkan2, mempertimbangkan3, mempertimbangkan4,
            mempertimbangkan5
        ];
        var barColors_mempertimbangkan = ["red", "green", "blue", "orange", "brown"];
        new Chart("mempertimbangkan_chart", {
            type: "pie",
            data: {
                labels: xValues_mempertimbangkan,
                datasets: [{
                    backgroundColor: barColors_mempertimbangkan,
                    data: yValues_mempertimbangkan
                }]
            },
            options: {
                title: {
                    display: true,
                    text: "Apakah Anda saat ini menggunakan atau mempertimbangkan menggunakan alat atau layanan untuk melindungi diri dari penipuan email?"
                }
            }
        });

        const fitur_utama1 = '{{ $fitur_utama1 }}';
        const fitur_utama2 = '{{ $fitur_utama2 }}';
        const fitur_utama3 = '{{ $fitur_utama3 }}';
        const fitur_utama4 = '{{ $fitur_utama4 }}';
        const fitur_utama5 = '{{ $fitur_utama5 }}';
        const fitur_utama6 = '{{ $fitur_utama6 }}';

        var xValues_fitur_utama = ["Scan Email Otomatis", "Peringatan Langsung", "Integrasi Mudah",
            "Analisis Tautan dan Lampiran", "Pembaruan Berkala", "Panduan Keamanan"
        ];
        var yValues_fitur_utama = [fitur_utama1, fitur_utama2, fitur_utama3, fitur_utama4, fitur_utama5, fitur_utama6];
        var barColors_fitur_utama = ["red", "green", "blue", "orange", "brown", "purple"];
        new Chart("fitur_utama_chart", {
            type: "pie",
            data: {
                labels: xValues_fitur_utama,
                datasets: [{
                    backgroundColor: barColors_fitur_utama,
                    data: yValues_fitur_utama
                }]
            },
            options: {
                title: {
                    display: true,
                    text: "Apa yang menurut Anda menjadi fitur utama yang harus dimiliki oleh aplikasi deteksi email penipuan agar dapat membantu Anda secara efektif?"
                }
            }
        });

        const seberapa_nyaman1 = '{{ $seberapa_nyaman1 }}';
        const seberapa_nyaman2 = '{{ $seberapa_nyaman2 }}';
        const seberapa_nyaman3 = '{{ $seberapa_nyaman3 }}';
        const seberapa_nyaman4 = '{{ $seberapa_nyaman4 }}';
        const seberapa_nyaman5 = '{{ $seberapa_nyaman5 }}';

        var xValues_seberapa_nyaman = ["Sangat Nyaman", "Nyaman", "Netral", "Tidak Nyaman", "Tidak Suka"];
        var yValues_seberapa_nyaman = [seberapa_nyaman1, seberapa_nyaman2, seberapa_nyaman3, seberapa_nyaman4,
            seberapa_nyaman5
        ];
        var barColors_seberapa_nyaman = ["red", "green", "blue", "orange", "brown"];
        new Chart("seberapa_nyaman_chart", {
            type: "pie",
            data: {
                labels: xValues_seberapa_nyaman,
                datasets: [{
                    backgroundColor: barColors_seberapa_nyaman,
                    data: yValues_seberapa_nyaman
                }]
            },
            options: {
                title: {
                    display: true,
                    text: "Seberapa nyaman Anda dengan ide menggunakan aplikasi Chrome Extension untuk melindungi email Anda?"
                }
            }
        });

        const platform_email1 = '{{ $platform_email1 }}';
        const platform_email2 = '{{ $platform_email2 }}';
        const platform_email3 = '{{ $platform_email3 }}';
        const platform_email4 = '{{ $platform_email4 }}';

        var xValues_platform_email = ["RoundCube", "Gmail", "Yahoo Mail", "Apple Mail"];
        var yValues_platform_email = [platform_email1, platform_email2, platform_email3, platform_email4];
        var barColors_platform_email = ["red", "green", "blue", "orange"];
        new Chart("platform_email_chart", {
            type: "pie",
            data: {
                labels: xValues_platform_email,
                datasets: [{
                    backgroundColor: barColors_platform_email,
                    data: yValues_platform_email
                }]
            },
            options: {
                title: {
                    display: true,
                    text: "Dari beberapa Platform Pengelola Email dibawah ini, manakah yang anda gunakan?"
                }
            }
        });

        // var appUrl = "{{ url('/') }}";
        // var page = window.location.hash.replace('#', '');
        // $('li[aria-label="pagination.previous"]').remove();
        // $('a[aria-label="pagination.next"]').parent('li').remove();
        // setTimeout(() => {
        //     $('.pagination li').find('span').parent('li').removeClass('active');
        //     $('.pagination li').find('span').remove().html(
        //         '<a class="page-link" href="' + appUrl + '/adminPlace/home?page=1">1</a>');
        //     $('.pagination li:first').html(
        //         '<a class="page-link" href="' + appUrl + '/adminPlace/home?page=1">1</a>');
        //     if (page == 1) {
        //         $('.pagination li:first').addClass('active');
        //     }
        // }, 500);

        // $(window).on('hashchange', function() {
        //     if (window.location.hash) {
        //         var page = window.location.hash.replace('#', '');
        //         if (page == Number.NaN || page <= 0) {
        //             return false;
        //         } else {
        //             getData(page);
        //         }
        //     }
        // });

        // $(document).on('click', '.pagination a', function(event) {
        //     event.preventDefault();
        //     $('li').removeClass('active');
        //     $(this).parent('li').addClass('active');
        //     var myurl = $(this).attr('href');
        //     var page = $(this).attr('href').split('page=')[1];
        //     getData(page);
        // });

        // function getData(page) {
        //     $.ajax({
        //             url: '?page=' + page,
        //             type: "get",
        //             datatype: "html",
        //         })
        //         .done(function(data) {
        //             $("#paginationAjax").empty().html(data);
        //             location.hash = page;
        //         })
        //         .fail(function(jqXHR, ajaxOptions, thrownError) {
        //             alert('Tidak ada respon dari server');
        //         });
        // }

        // function loadLists(callback) {
        //     var page = window.location.hash.replace('#', '');
        //     // $('#loadTableLists').show();
        //     $('#paginationLinks').addClass('d-none');
        //     $('#paginationAjax').hide();
        //     $.ajax({
        //         url: '?page=' + page,
        //         type: "get",
        //         datatype: "html",
        //     }).done(function(data) {
        //         setTimeout(function() {
        //             // $('#loadTableLists').hide();
        //             $('#paginationLinks').removeClass('d-none');
        //             $('#paginationAjax').show();
        //             $("#paginationAjax").empty().html(data);
        //             callback();
        //         }, 2000);
        //         location.hash = page;
        //     }).fail(function(jqXHR, ajaxOptions, thrownError) {
        //         alert('Tidak ada respon dari server');
        //     });

        // }
        // loadLists();
    </script>
@endsection
