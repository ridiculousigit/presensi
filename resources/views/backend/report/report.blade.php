@extends('backend.partial.master')

@section('content')
    @php
        $role = App\User::where('id', Auth::id())->first();
    @endphp
    <div class="container-fluid">
        <!-- Navigasi Breadcrumb -->
        <nav aria-label="breadcrumb" role="navigation">
            <ol class="breadcrumb adminx-page-breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Report Absen</li>
            </ol>
        </nav>

        <div class="pb-3">
            <h1>Report Absen</h1>
        </div>

        <div class="row">
            <div class="col">
                <div class="card mb-grid">
                    <div class="table-responsive-md">
                        <!-- Form Pencarian -->
                        <form method="post" action="{{ route('searchRiwayat') }}">
                            {{ csrf_field() }}
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="form-label">Tanggal Awal </label>
                                            <input name="start" class="form-control mb-2 input-credit-card"
                                                type="date" />
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="form-label">Tanggal Akhir </label>
                                            <input name="end" class="form-control mb-2 input-credit-card"
                                                type="date" />
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label class="form-label" style="">Cari </label><br />
                                            <button type="submit" class="btn btn-info">-></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <!-- Tabel Data -->
                        <table class="table table-actions table-striped table-hover mb-0 dataTable no-footer"
                            data-table="data-table" id="DataTables_Table_0" role="grid"
                            aria-describedby="DataTables_Table_0_info">
                            <thead>
                                <tr role="row">
                                    <!-- Kolom Pilihan -->
                                    <th scope="col" class="sorting_asc" tabindex="0" rowspan="1" colspan="1"
                                        aria-sort="ascending" aria-label=": activate to sort column descending"
                                        style="width: 88px;">
                                        <label class="custom-control custom-checkbox m-0 p-0">
                                            <input type="checkbox" class="custom-control-input table-select-all" />
                                            <span class="custom-control-indicator"></span>
                                        </label>
                                    </th>
                                    <!-- Kolom ID Asisten -->
                                    <th scope="col" class="sorting" tabindex="0" rowspan="1" colspan="1"
                                        aria-label="First Name: activate to sort column ascending" style="width: 320px;">
                                        ID Asisten
                                    </th>
                                    <!-- Kolom Nama Asisten -->
                                    <th scope="col" class="sorting" tabindex="0" rowspan="1" colspan="1"
                                        aria-label="First Name: activate to sort column ascending" style="width: 320px;">
                                        Nama Asisten
                                    </th>
                                    <!-- Kolom Kelas -->
                                    <th scope="col" class="sorting" tabindex="0" rowspan="1" colspan="1"
                                        aria-label="First Name: activate to sort column ascending" style="width: 320px;">
                                        Kelas
                                    </th>
                                    <!-- Kolom Materi -->
                                    <th scope="col" class="sorting" tabindex="0" rowspan="1" colspan="1"
                                        aria-label="First Name: activate to sort column ascending" style="width: 320px;">
                                        Materi
                                    </th>
                                    <!-- Kolom Jaga Sebagai -->
                                    <th scope="col" class="sorting" tabindex="0" rowspan="1" colspan="1"
                                        aria-label="First Name: activate to sort column ascending" style="width: 320px;">
                                        Jaga Sebagai
                                    </th>
                                    <!-- Kolom Tanggal -->
                                    <th scope="col" class="sorting" tabindex="0" rowspan="1" colspan="1"
                                        aria-label="First Name: activate to sort column ascending" style="width: 320px;">
                                        Tanggal
                                    </th>
                                    <!-- Kolom Waktu Mulai -->
                                    <th scope="col" class="sorting" tabindex="0" rowspan="1" colspan="1"
                                        aria-label="First Name: activate to sort column ascending" style="width: 320px;">
                                        Waktu Mulai
                                    </th>
                                    <!-- Kolom Waktu Akhir -->
                                    <th scope="col" class="sorting" tabindex="0" rowspan="1" colspan="1"
                                        aria-label="First Name: activate to sort column ascending" style="width: 320px;">
                                        Waktu Akhir
                                    </th>
                                    <!-- Kolom Durasi -->
                                    <th scope="col" class="sorting" tabindex="0" rowspan="1" colspan="1"
                                        aria-label="First Name: activate to sort column ascending" style="width: 320px;">
                                        Durasi
                                    </th>
                                    <!-- Kolom PJ / Asisten / Staff Approved -->
                                    <th scope="col" class="sorting" tabindex="0" rowspan="1" colspan="1"
                                        aria-label="First Name: activate to sort column ascending" style="width: 320px;">
                                        PJ / Asisten / Staff Approved
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Looping Data Absen -->
                                @foreach ($absen as $item)
                                    <tr role="row" class="odd">
                                        <!-- Kolom Pilihan -->
                                        <th scope="row" class="sorting_1">
                                            <label class="custom-control custom-checkbox m-0 p-0">
                                                <input type="checkbox" class="custom-control-input table-select-row" />
                                                <span class="custom-control-indicator"></span>
                                            </label>
                                        </th>
                                        <!-- Kolom ID Asisten -->
                                        <td>{{ $item->idasisten }}</td>
                                        <!-- Kolom Nama Asisten -->
                                        <td>{{ $item->name }}</td>
                                        <!-- Kolom Kelas -->
                                        <td>{{ $item->nama_kelas }}</td>
                                        <!-- Kolom Materi -->
                                        <td>{{ $item->materi }}</td>
                                        <!-- Kolom Jaga Sebagai -->
                                        <td>
                                            @if ($item->teaching_role == 'Ketua')
                                                <span class="badge badge-pill badge-danger">Ketua</span>
                                            @elseif($item->teaching_role == 'Asisten Baris')
                                                <span class="badge badge-pill badge-warning">Asisten
                                                    Baris</span>
                                            @else
                                                <span class="badge badge-pill badge-success"> Tutor</span>
                                            @endif
                                        </td>
                                        <!-- Kolom Tanggal -->
                                        <td>{{ $item->date }}</td>
                                        <!-- Kolom Waktu Mulai -->
                                        <td>
                                            @if ($item->start > '17:30:00')
                                                <span class="badge badge-pill badge-info">{{ $item->start }}
                                                    **</span>
                                            @else
                                                {{ $item->start }}
                                            @endif
                                        </td>
                                        <!-- Kolom Waktu Akhir -->
                                        <td>
                                            @if ($item->end > '17:30:00')
                                                <span class="badge badge-pill badge-info">{{ $item->end }}
                                                    **</span>
                                            @else
                                                {{ $item->end }}
                                            @endif
                                        </td>
                                        <!-- Kolom Durasi -->
                                        <td>
                                            @if ($item->start > '17:30:00')
                                                <span class="badge badge-pill badge-info">{{ $item->duration }}
                                                    Menit</span>
                                            @else
                                                {{ $item->duration }} Menit
                                            @endif
                                        </td>
                                        <!-- Kolom PJ / Asisten / Staff Approved -->
                                        @php
                                            $getIdCode = App\Model\Kode::where('id', $item->id_code)->first();
                                            $getApproved = App\User::where('id', $getIdCode->id_user)->first();
                                        @endphp
                                        <td>{{ $getApproved->name }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" type="text/javascript"></script>
    <!-- Axios -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.1/axios.min.js"
        integrity="sha512-bZS47S7sPOxkjU/4Bt0zrhEtWx0y0CRkhEp8IckzK+ltifIIE9EMIMTuT/mEzoIMewUINruDBIR/jJnbguonqQ=="
        crossorigin="anonymous"></script>
    <!-- DataTables -->
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap4.min.js"></script>
    <!-- DataTables Buttons -->
    <script src="https://cdn.datatables.net/buttons/1.5.6/js/dataTables.buttons.min.js"></script>
    <!-- JSZip -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <!-- DataTables HTML5 Export -->
    <script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.html5.min.js"></script>
    <script>
        $(document).ready(function() {
            var table = $("[data-table]").DataTable({
                dom: 'frtipB',
                buttons: [{
                    extend: 'excel',
                    className: 'btn btn-warning',
                    text: 'Export to Excel',
                    title: 'Laporan Presensi Laboratorium'
                }],
                columns: [null, null, null, null, null, null, null, null, null, null, {
                    orderable: true
                }],
            });

            $('.form-control-search').keyup(function() {
                table.search($(this).val()).draw();
            });
        });
    </script>
@endsection
