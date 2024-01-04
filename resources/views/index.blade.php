@extends('mainlayout')
@section('content')
    <div class="container-lg mt-5">
        <div class="row">
            <div class="col">

                <div class="card shadow rounded border-0 bg-light" id="cardGreeting">
                    <div class="card-body">

                        <div class="row">
                            <div class="col-md-4 mb-3 d-flex justify-content-center align-items-center">

                                <img src="https://media.tenor.com/mtjcHYnJAQ0AAAAi/pixel-art.gif" alt="Media error"
                                    sizes="(max-width: 600px) 280px,
                                (max-width: 900px) 550px,
                                800px">

                            </div>
                            <div class="col-md-8">
                                <h1 class="animate__animated animate__fadeIn animate__delay-1s"> Hello! kenalin saya <span
                                        style="font-style: italic;"> Resa </span> </h1>
                                <br>
                                <p class="animate__animated animate__fadeIn animate__delay-2s">
                                    Disini saya mau ngadain survey nih, buat keperluan proposal saya dengan topik:
                                    <br>
                                    <br>
                                    <span class="animate__animated animate__fadeIn animate__delay-3s"
                                        style="font-weight: bold; font-style: italic;">
                                        "APLIKASI CHROME EXTENSION UNTUK DETEKSI EMAIL PENIPUAN"
                                    </span>
                                    <br>
                                    <br>
                                    Saya sangat berterima kasih karena sudah bersedia untuk menjadi responden saya <br> <br>
                                    Oh iya, <br>
                                    Untuk setiap responden yang sudah selesai mengisi survey, akan muncul di card bawah ini
                                    loh! <br>
                                    Untuk alasan privasi, kamu juga bisa mengisi sebagai Anonymous! <br>
                                    So, disini tidak ada paksaan yaa ^_^
                                    <br> <br>
                                    Jika kamu setuju, saya juga akan mengirim ucapan terima kasih melalui email! <br>
                                    Penasaran? isi saja form email nya ya! <br> <br>
                                    Thank you and have a great day!
                                </p>
                            </div>

                            <div
                                class="d-flex justify-content-end align-items-end animate__animated animate__fadeIn animate__delay-3s">
                                <button class="btn btn-secondary" id="tutupBtn"> TUTUP </button>
                            </div>

                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="container-lg animate__animated animate__fadeIn animate__delay-2s">
        <div class="row mt-4 mb-5">
            <div class="col-md-8">
                <section id="surveyDone">

                    <div class="card shadow rounded border-0 bg-light mt-5">
                        <div class="card-body">
                            <div class="row d-flex align-items-center">
                                <div class="col-md-8">

                                    <h1 class="ms-3"> Tampilan Responden </h1>
                                    <div class="card shadow rounded border-0 bg-light mt-3 100vh ms-3">
                                        <div class="card-body ">
                                            <table class="table table-hover mt-2" id="tableKustomisasi">
                                                <tbody>
                                                    <tr>
                                                        <td> <i class="fa-solid fa-user"></i> </td>
                                                        <td id="kustomisasiNama1"> Memuat.. </td>
                                                        <td id="kustomisasiEmote1"> 😁 </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="card shadow rounded border-0 bg-success mt-3 ms-3" id="emailSuccessCard"
                                        style="display: none;">
                                        <div class="card-body" style="color: white;">
                                            <h3 class="kanit-style"> <i class="fa-solid fa-envelope fa-xl d-none"></i> Email
                                                berhasil terkirim! </h3>
                                            <input type="email" class="form-control" id="emailReadOnly" disabled>
                                            <p> Periksa juga folder spam mu ya! </p>
                                        </div>
                                    </div>
                                    <div class="card shadow rounded border-0 bg-danger mt-3 ms-3" id="emailFailedCard"
                                        style="display: none;">
                                        <div class="card-body">
                                            <h3 class="kanit-style"> Email mu gagal terkirim! </h3>
                                            <input type="hidden" id="failedEmailHidden">
                                            <input type="hidden" id="respondenIdHidden">
                                            <form id="formResentEmail">
                                                <input type="email" class="form-control" id="emailNotReadOnly">
                                                <button class="btn btn-secondary mt-2" type="submit"
                                                    id="resentEmailBtn"> <i class="spinner-border spinner-border-sm"
                                                        id="resentEmailSpinner" style="display: none;"></i> Coba lagi
                                                </button>
                                            </form>
                                        </div>
                                    </div>

                                </div>
                                <div class="col-md-4">
                                    <div class="animate__animated animate__jello animate__delay-2s mt-5">
                                        <div class="d-flex justify-content-center align-items-center mt-5">
                                            <img src="{{ asset('img/checklist.png') }}"
                                                style="height: 200px; width: 200px;">
                                        </div>
                                        <h1 style="color: green" class="text-center mt-2"> SUKSES </h1>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="text-center">
                                <p class="mt-5">Sistem mendeteksi kamu sudah mengisi survey.</p>
                                <p class="mb-5">Jika kamu ingin mengisi survey lagi, <span
                                        style="text-decoration: underline; cursor: pointer;" id="fillSurveyAgainBtn">klik
                                        disini</span>.</p>
                            </div>
                        </div>
                    </div>

                </section>
                <section id="showSurvey">

                    <form id="surveyForm">
                        <h1> The Survey </h1>
                        <div class="card shadow rounded border-0 bg-light">
                            <div class="card-body">

                                <label for="nama"> Nama </label>
                                <input type="text" id="nama" name="nama" class="form-control"
                                    placeholder="default: Anonymous">

                                <label class="mt-2" for="email"> Email </label>
                                <input type="email" id="email" name="email" class="form-control">

                                <label class="mt-2" for="jenisKelamin"> Jenis Kelamin </label>
                                <select name="jenisKelamin" id="jenisKelamin" class="form-control">
                                    <option value="null" default>-- Pilih --</option>
                                    <option value="laki-laki">Laki-laki</option>
                                    <option value="perempuan">Perempuan</option>
                                    <option value="tidak_memilih">Tidak memilih</option>
                                </select>

                                <label class="mt-2" for="usia">Rentang usia</label>
                                <select name="usia" id="usia" class="form-control">
                                    <option value="null" default>-- Pilih --</option>
                                    <option value="Kurang dari 12 tahun"> Kurang dari 12 tahun </option>
                                    <option value="12 sampai 17 tahun"> 12 sampai 17 tahun </option>
                                    <option value="18 sampai 25 tahun"> 18 sampai 25 tahun </option>
                                    <option value="26 sampai 35 tahun"> 26 sampai 35 tahun </option>
                                    <option value="Lebih dari 35 tahun"> Lebih dari 35 tahun </option>
                                    <option value="tidak_memilih">Tidak memilih</option>
                                </select>

                                <div class="row d-flex mt-2">
                                    <div class="col-md-6">

                                        <label for="pekerjaan"> Pekerjaan </label>
                                        <select name="pekerjaan" id="pekerjaan" class="form-control">
                                            <option value="null" id="pekerjaanDefault" default>-- Pilih --</option>
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
                                            <option value="Tidak memilih">Tidak memilih</option>
                                        </select>
                                        <section id="pekerjaanSpesifikSection" class="mt-2" style="display: none;">
                                            <label for="pekerjaanSpesifik">Sebutkan pekerjaan <span
                                                    style="color: red">*</span></label>
                                            <input type="text" class="form-control" id="pekerjaanSpesifik"
                                                name="pekerjaanSpesifik">
                                        </section>

                                    </div>
                                    <div class="col-md-6">

                                        <label for="bidangIndustri">Bidang Industri</label>
                                        <select name="bidangIndustri" id="bidangIndustri" class="form-control">
                                            <option value="null" default>-- Pilih --</option>
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
                                            <option value="Tidak memilih">Tidak memilih</option>
                                        </select>
                                        <section id="bidangIndustriSpesifikSection" class="mt-2"
                                            style="display: none;">
                                            <label for="bidangIndustriSpesifik">Sebutkan bidang industri <span
                                                    style="color: red">*</span></label>
                                            <input type="text" class="form-control" id="bidangIndustriSpesifik"
                                                name="bidangIndustriSpesifik">
                                        </section>

                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class="card rounded shadow border-0 bg-light mt-3">
                            <div class="card-body">
                                <label for="menggunakanEmail">Seberapa sering Anda menggunakan email untuk keperluan
                                    pribadi
                                    atau pekerjaan? <span style="color: red">*</span></label>
                                <select name="menggunakanEmail" id="menggunakanEmail" class="form-control">
                                    <option value="null" default>-- Pilih --</option>
                                    <option value="Setiap Hari">Setiap Hari</option>
                                    <option value="Beberapa Kali dalam Seminggu">Beberapa Kali dalam Seminggu</option>
                                    <option value="Sekitar Sekali Seminggu">Sekitar Sekali Seminggu</option>
                                    <option value="Sekitar Sekali Sebulan">Sekitar Sekali Sebulan</option>
                                    <option value="Jarang Sekali atau Tidak Pernah">Jarang Sekali atau Tidak Pernah
                                    </option>
                                </select>
                            </div>
                        </div>

                        <div class="card rounded shadow border-0 bg-light mt-3">
                            <div class="card-body">
                                <label for="mengalami">Apakah Anda pernah mengalami atau menyadari adanya upaya
                                    penipuan melalui email? <span style="color: red">*</span></label>
                                <select name="mengalami" id="mengalami" class="form-control">
                                    <option value="null" default>-- Pilih --</option>
                                    <option value="Ya, Saya Pernah Mengalami">Ya, Saya Pernah Mengalami</option>
                                    <option value="Tidak, Saya Tidak Pernah Mengalami">Tidak, Saya Tidak Pernah Mengalami
                                    </option>
                                    <option value="Tidak Yakin">Tidak Yakin</option>
                                    <option value="Mungkin, Tetapi Saya Tidak Yakin">Mungkin, Tetapi Saya Tidak Yakin
                                    </option>
                                    <option value="Tidak Ingin Mengungkapkan">Tidak Ingin Mengungkapkan</option>
                                </select>
                            </div>
                        </div>

                        <div class="card rounded shadow border-0 bg-light mt-3">
                            <div class="card-body">
                                <label for="kesadaran">Seberapa sadar Anda terhadap potensi risiko keamanan
                                    email, seperti phishing atau penipuan email? <span style="color: red">*</span></label>
                                <select name="kesadaran" id="kesadaran" class="form-control">
                                    <option value="null" default>-- Pilih --</option>
                                    <option value="Sangat Sadar">Sangat Sadar</option>
                                    <option value="Cukup Sadar">Cukup Sadar
                                    </option>
                                    <option value="Kurang Sadar">Kurang Sadar</option>
                                    <option value="Sama Sekali Tidak Sadar">Sama Sekali Tidak Sadar</option>
                                    <option value="Tidak Yakin">Tidak Yakin</option>
                                </select>
                            </div>
                        </div>

                        <div class="card rounded shadow border-0 bg-light mt-3">
                            <div class="card-body">
                                <label for="korban">Apakah Anda pernah menjadi korban penipuan email atau
                                    keamanan email yang buruk? <span style="color: red">*</span></label>
                                <select name="korban" id="korban" class="form-control">
                                    <option value="null" default>-- Pilih --</option>
                                    <option value="Ya, Saya Pernah Menjadi Korban">Ya, Saya Pernah Menjadi Korban</option>
                                    <option value="Tidak, Saya Belum Pernah Menjadi Korban">Tidak, Saya Belum Pernah
                                        Menjadi
                                        Korban
                                    </option>
                                    <option value="Tidak Yakin">Tidak Yakin</option>
                                    <option value="Mungkin, Tetapi Saya Tidak Yakin">Mungkin, Tetapi Saya Tidak Yakin
                                    </option>
                                    <option value="Tidak Ingin Mengungkapkan">Tidak Ingin Mengungkapkan</option>
                                </select>
                            </div>
                        </div>

                        <div class="card rounded shadow border-0 bg-light mt-3">
                            <div class="card-body">
                                <label for="penggunaExtension">Apakah Anda pernah menggunakan atau menginstall aplikasi
                                    Chrome
                                    Extension sebelumnya? <span style="color: red">*</span></label>
                                <select name="penggunaExtension" id="penggunaExtension" class="form-control">
                                    <option value="null" default>-- Pilih --</option>
                                    <option value="Ya, Saya Pernah">Ya, Saya Pernah</option>
                                    <option value="Tidak, Saya Belum Pernah">Tidak, Saya Belum Pernah
                                    </option>
                                </select>
                                <section class="mt-2" id="penggunaExtensionTrue" style="display: none;">
                                    <label for="penggunaExtensionSpesifik">Sebutkan beberapa aplikasi Chrome Extension yang
                                        biasa Anda gunakan <span style="color: red">*</span></label>
                                    <input type="text" id="penggunaExtensionSpesifik" name="penggunaExtensionSpesifik"
                                        class="form-control">
                                </section>
                            </div>
                        </div>

                        <div class="card rounded shadow border-0 bg-light mt-3">
                            <div class="card-body">
                                <label for="deteksiEmail">Apakah Anda berpikir bahwa deteksi email penipuan
                                    adalah
                                    hal yang penting untuk keamanan email Anda? <span style="color: red">*</span></label>
                                <select name="deteksiEmail" id="deteksiEmail" class="form-control">
                                    <option value="null" default>-- Pilih --</option>
                                    <option value="Sangat Penting">Sangat Penting</option>
                                    <option value="Penting">Penting</option>
                                    <option value="Netral">Netral</option>
                                    <option value="Tidak Terlalu Penting">Tidak Terlalu Penting</option>
                                    <option value="Tidak Penting Sama Sekali">Tidak Penting Sama Sekali</option>
                                </select>
                            </div>
                        </div>

                        <div class="card shadow rounded border-0 bg-light mt-3">
                            <div class="card-body">
                                <label for="mempertimbangkan">Apakah Anda saat ini menggunakan atau
                                    mempertimbangkan
                                    menggunakan alat atau layanan untuk melindungi diri dari penipuan email? <span
                                        style="color: red">*</span></label>
                                <select name="mempertimbangkan" id="mempertimbangkan" class="form-control">
                                    <option value="null" default>-- Pilih --</option>
                                    <option value="Ya, Saya Sedang Menggunakan Alat atau Layanan Tersebut">Ya, Saya Sedang
                                        Menggunakan Alat atau Layanan Tersebut</option>
                                    <option value="Belum, Tetapi Saya Mempertimbangkan">Belum, Tetapi Saya Mempertimbangkan
                                    </option>
                                    <option value="Tidak Pernah Memikirkan">Tidak Pernah Memikirkan</option>
                                    <option value="Tidak Tahu">Tidak Tahu</option>
                                    <option value="Tidak Ingin Menggunakan">Tidak Ingin Menggunakan</option>
                                </select>
                            </div>
                        </div>

                        <div class="card rounded shadow border-0 bg-light mt-3">
                            <div class="card-body">
                                <label>Apa yang menurut Anda menjadi fitur utama yang harus dimiliki oleh
                                    aplikasi deteksi email penipuan agar dapat membantu Anda secara efektif? <span
                                        style="color: red">*</span> </label> <span> (**Plih bisa lebih dari satu**)
                                </span><br>

                                <div class="m-3" id="cbForm1">

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

                                </div>

                            </div>
                        </div>

                        <div class="card rounded shadow border-0 bg-light mt-3">
                            <div class="card-body">
                                <label for="seberapaNyaman">Seberapa nyaman Anda dengan ide menggunakan aplikasi Chrome
                                    Extension untuk melindungi email Anda? <span style="color: red">*</span></label>
                                <select name="seberapaNyaman" id="seberapaNyaman" class="form-control">
                                    <option value="null" default>-- Pilih --</option>
                                    <option value="Sangat Nyaman">Sangat Nyaman</option>
                                    <option value="Nyaman">Nyaman
                                    </option>
                                    <option value="Netral">Netral</option>
                                    <option value="Tidak Nyaman">Tidak Nyaman</option>
                                    <option value="Tidak Suka">Tidak Ingin Menggunakan</option>
                                </select>
                            </div>
                        </div>

                        <div class="card rounded shadow border-0 bg-light mt-3">
                            <div class="card-body">
                                <label>Dari beberapa Platform Pengelola Email dibawah ini, manakah yang
                                    anda gunakan? <span style="color: red">*</span></label>
                                <p> (**Plih bisa lebih dari
                                    satu**)
                                </p>

                                <div class="m-3" id="cbForm2">

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

                                </div>

                            </div>
                        </div>

                        <small style="font-size: 10px;"> ***Catatan: form dengan simbol <span style="color: red">*</span>
                            wajib di isi! </small>

                        <div class="mt-4" align="center">
                            <button class="btn btn-rounded btn-success" id="btnSubmit" style="width: 50%"
                                type="submit"> <i class="spinner-border spinner-border-sm" id="submitSpinner"
                                    style="display: none;"></i>
                                Submit </button>
                            <button class="btn btn-rounded btn-secondary mt-2" style="width: 50%" type="button"
                                id="resetSurveyBtn"> Clear
                            </button>
                        </div>

                    </form>
                </section>
            </div>
            <div class="col-md-4">

                <div class="card shadow rounded border-0 bg-light mt-5">
                    <div class="card-body">

                        <h1> Responden </h1>
                        <p style="font-size: 10px; margin-top: -10px;"> ***list orang-orang keren </p>

                        <div class="overflow-auto" style="max-height: 1000px;">

                            <table class="table table-hover" id="tableResponden">
                                <tbody id="respondenLoop">

                                </tbody>
                            </table>

                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>

    {{-- TOAST --}}
    <div class="toast-container top-0 end-0 me-2 position-fixed" style="margin-top: 65px;">
        <div class="toast align-items-center text-bg-warning border-0" style="background-color: yellow" role="alert"
            aria-live="assertive" aria-atomic="true" id="toast-warningLengkapiForm">
            <div class="d-flex">
                <i class="fa fa-circle-exclamation fa-fade fa-2xl mt-4 ms-2"></i>
                <div class="toast-body">
                    <h6> Mohon lengkapi form! </h6>
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" style="color: white;"
                    data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
        </div>
        <div class="toast align-items-center text-bg-success border-0" style="background-color: green" role="alert"
            aria-live="assertive" aria-atomic="true" id="toast-successSelesai">
            <div class="d-flex">
                <i class="fa-solid fa-check fa-fade fa-2xl mt-4 ms-2"></i>
                <div class="toast-body">
                    <h6> Selesai! </h6>
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" style="color: white;"
                    data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
        </div>
    </div>

    {{-- MODAL --}}
    <!-- SUBMITTED Modal -->
    <div class="modal fade animate__animated animate__fadeIn" id="submittedModal" data-bs-backdrop="static"
        data-bs-keyboard="false" tabindex="-1" aria-labelledby="submittedModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content">
                <div class="modal-body">

                    <div class="row">
                        <div class="col-md-4 p-5">
                            <div class="animate__animated animate__jello mt-5">
                                <div class="d-flex justify-content-center align-items-center mt-5">
                                    <img src="{{ asset('img/checklist.png') }}" style="height: 200px; width: 200px;">
                                </div>
                                <h1 style="color: green" class="text-center mt-2"> SUKSES </h1>
                            </div>

                            <div class="mt-5 d-md-none">
                                <h3 class="text-center"> Scroll ke bawah! </h3>
                                <hr>
                            </div>
                        </div>

                        <div class="col-md-8">

                            <div class="card rounded shadow border-0 bg-light">
                                <div class="card-body">
                                    <h1> Kustomisasi </h1>
                                    <table class="table table-hover mt-2" id="tableKustomisasi">
                                        <tbody>
                                            <tr>
                                                <td> <i class="fa-solid fa-user"></i> </td>
                                                <td id="kustomisasiNama"> Memuat.. </td>
                                                <td id="kustomisasiEmote"> 😁 </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <h5> Ganti emote </h5>
                                    <div class="d-flex flex-wrap">
                                        <p style="font-size: 50px; cursor: pointer;" id="emoteChoosed" data-emote="1"> 😁
                                        </p>
                                        <p style="font-size: 50px; cursor: pointer;" id="emoteChoosed" data-emote="2"> 🔥
                                        </p>
                                        <p style="font-size: 50px; cursor: pointer;" id="emoteChoosed" data-emote="3"> 😎
                                        </p>
                                        <p style="font-size: 50px; cursor: pointer;" id="emoteChoosed" data-emote="4"> ❤️
                                        </p>
                                        <p style="font-size: 50px; cursor: pointer;" id="emoteChoosed" data-emote="5"> 🍌
                                        </p>
                                        <p style="font-size: 50px; cursor: pointer;" id="emoteChoosed" data-emote="6"> 🗿
                                        </p>
                                        <p style="font-size: 50px; cursor: pointer;" id="emoteChoosed" data-emote="7"> 🤌
                                        </p>
                                        <p style="font-size: 50px; cursor: pointer;" id="emoteChoosed" data-emote="8"> 😱
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <div class="card shadow rounded border-0 bg-light mt-2">
                                <div class="card-body">

                                    <h1> Kirim ucapan? </h1>
                                    <label for="emailKustomisasi"> Email </label>
                                    <input type="email" id="emailKustomisasi" name="emailKustomisasi"
                                        class="form-control">
                                    <p style="font-size: 9px;"> ***Catatan: dengan anda mengisi form email, anda menyetujui
                                        untuk mendapat kiriman email. </p>
                                    <input type="hidden" id="respondenIdHidden">

                                </div>
                            </div>

                            <div class="d-flex justify-content-end align-items-end mt-3">
                                <button class="btn btn-success" type="button" id="btnKustomisasi"> <i
                                        class="spinner-border spinner-border-sm" id="submitKustomisasiSpinner"
                                        style="display: none;"></i> OK </button>
                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script type="text/javascript" src="{{ asset('js/main.js') }}"></script>
@endsection
