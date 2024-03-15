@extends('backend.partial.master')

@section('content')
    @php
        // Mengambil peran pengguna, kelas, materi, dan tanggal saat ini untuk dashboard
        $peran = App\User::where('id', Auth::id())->first();
        $kelas = App\Model\Kelas::all();
        $materi = App\Model\Materi::all();
        $hariIni = Carbon\Carbon::now('GMT+7')->toDateString();
        $cekAbsen = App\Model\Absen::where('id_asisten', Auth::id())
            ->where('date', $hariIni)
            ->where('end', null)
            ->first();
    @endphp

    <div class="container-fluid">
        <!-- Navigasi Breadcrumb -->
        <nav aria-label="breadcrumb" role="navigation">
            <ol class="breadcrumb adminx-page-breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">Dasbor</li>
            </ol>
        </nav>

        <div class="pb-3">
            <h1>Dasbor</h1>
        </div>

        <div class="row">
            @if ($peran->role == 'Staff' || $peran->role == 'Admin' || $peran->role == 'PJ')
                <div class="col-lg-6">
                    <!-- Form untuk menghasilkan kode kehadiran -->
                    <form id="form-data-kode" method="post" data-route="{{ route('storeKode') }}"
                        enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="card">
                            <div class="card-header">
                                Hasilkan Kode Kehadiran
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col text-center">
                                        <button type="submit" class="btn btn-danger">Hasilkan Kode Kehadiran</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            @endif

            <div class="{{ $peran->role == 'Asisten' ? 'col-lg-12' : 'col-lg-6' }}">
                <!-- Form Absen -->
                <div class="card">
                    <div class="card-header">
                        Formulir Kehadiran
                    </div>
                    <br />
                    <div class="row">
                        <div class="col text-center">
                            <!-- Pesan selamat datang dengan nama pengguna -->
                            <h4>Selamat datang {{ $peran->name }}</h4>
                            <!-- Tampilan jam digital -->
                            <div class="digital_clock_wrapper">
                                <div id="digit_clock_time"></div>
                                <div id="digit_clock_date"></div>
                            </div>
                        </div>
                    </div>
                    <!-- Periksa jika tidak ada kehadiran berlangsung -->
                    @if (empty($cekAbsen))
                        <form id="form-absen" method="post" data-route="{{ route('storeAbsen') }}"
                            enctype="multipart/form-data">
                    @endif
                    {{ csrf_field() }}
                    <div class="card-body">
                        <div class="form-group">
                            <label class="form-label">ID Asisten</label>
                            <!-- Menampilkan ID asisten -->
                            <input value="{{ $peran->id_asisten }}" name="id_asisten"
                                class="form-control mb-2 input-credit-card" type="text" readonly />
                        </div>
                        <div class="form-group">
                            <label class="form-label">Kelas</label>
                            <!-- Dropdown untuk memilih kelas -->
                            <select name="kelas" class="form-control" @if (!empty($cekAbsen)) disabled @endif>
                                <option disabled selected>Silakan Pilih</option>
                                @foreach ($kelas as $item)
                                    <option value="{{ $item->id }}">{{ $item->nama_kelas }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Materi</label>
                            <!-- Dropdown untuk memilih materi -->
                            <select name="materi" class="form-control" @if (!empty($cekAbsen)) disabled @endif>
                                <option disabled selected>Silakan Pilih</option>
                                @foreach ($materi as $item)
                                    <option value="{{ $item->id }}">{{ $item->materi }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Peran</label>
                            <!-- Dropdown untuk memilih peran -->
                            <select name="peran_jaga" class="form-control"
                                @if (!empty($cekAbsen)) disabled @endif>
                                <option disabled selected>Silakan Pilih</option>
                                <option value="Asisten Baris">Asisten Baris</option>
                                <option value="Ketua">Ketua</option>
                                <option value="Tutor">Tutor</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Kode Kehadiran</label>
                            <!-- Input untuk memasukkan kode kehadiran -->
                            <input name="kode" class="form-control mb-2 input-credit-card" type="text"
                                @if (!empty($cekAbsen)) disabled @endif placeholder="Contoh: 87ADsds0" />
                            <!-- Instruksi untuk mendapatkan kode kehadiran -->
                            <a>*Mohon tanyakan PJ atau Staff untuk kode kehadiran</a>
                        </div>
                        <div class="row">
                            <!-- Tombol submit untuk kehadiran -->
                            @if (empty($cekAbsen))
                                <div class="col text-center">
                                    <button type="submit" class="btn btn-info">Kehadiran</button>
                                </div>
                            @endif
                        </div>
                    </div>
                    </form>
                    <!-- Periksa jika ada kehadiran sedang berlangsung -->
                    @if (!empty($cekAbsen))
                        <!-- Form untuk clocking out -->
                        <form id="form-update-absen" method="post" data-route="{{ route('updateAbsen') }}"
                            enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="card-body">
                                <div class="row">
                                    <div class="col text-center">
                                        <button type="submit" class="btn btn-warning">Clock Out</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <!-- Sertakan pustaka JavaScript yang diperlukan -->
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" type="text/javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.1/axios.min.js"
        integrity="sha512-bZS47S7sPOxkjU/4Bt0zrhEtWx0y0CRkhEp8IckzK+ltifIIE9EMIMTuT/mEzoIMewUINruDBIR/jJnbguonqQ=="
        crossorigin="anonymous"></script>
    <!-- Sertakan file JavaScript kustom -->
    <script type="text/javascript" src="{{ URL::asset('js/backend/kode/postKode.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('js/backend/absen/postAbsen.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('js/backend/absen/updateAbsen.js') }}"></script>
    <!-- Sertakan file JavaScript DataTables -->
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap4.min.js"></script>
    <script>
        // Fungsi untuk mengambil data untuk mengedit materi
        function getData(id) {
            axios
                .post("{{ route('editMateri') }}", {
                    id: id,
                })
                .then((res) => {
                    $("input[name=id]").val(res.data.id);
                    $("input[name=materiU]").val(res.data.materi);
                });
        }

        // Inisialisasi DataTable
        $(document).ready(function() {
            var table = $("[data-table]").DataTable({
                columns: [null, null, null, {
                    orderable: true
                }],
            });

            // Fungsionalitas pencarian untuk DataTable
            $(".form-control-search").keyup(function() {
                table.search($(this).val()).draw();
            });
        });
    </script>
    <script type="text/javascript">
        // Fungsi untuk menampilkan waktu dan tanggal saat ini
        function currentTime() {
            var date = new Date();
            var hour = date.getHours();
            var min = date.getMinutes();
            var sec = date.getSeconds();
            var midday = "AM";
            midday = hour >= 12 ? "PM" : "AM";
            hour = hour == 0 ? 12 : hour > 12 ? hour - 12 : hour;
            hour = changeTime(hour);
            min = changeTime(min);
            sec = changeTime(sec);
            document.getElementById("digit_clock_time").innerText = hour + " : " + min + " : " + sec + " " + midday;

            var months = ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober",
                "November", "Desember"
            ];
            var days = ["Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu"];

            var curWeekDay = days[date.getDay()];
            var curDay = date.getDate();
            var curMonth = months[date.getMonth()];
            var curYear = date.getFullYear();
            var date = curWeekDay + ", " + curDay + " " + curMonth + " " + curYear;
            document.getElementById("digit_clock_date").innerHTML = date;

            var t = setTimeout(currentTime, 1000);
        }

        // Fungsi untuk menambahkan nol di depan jika diperlukan
        function changeTime(k) {
            if (k < 10) {
                return "0" + k;
            } else {
                return k;
            }
        }

        // Panggil fungsi currentTime untuk memulai jam
        currentTime();
    </script>
@endsection
