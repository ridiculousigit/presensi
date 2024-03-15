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
                <li class="breadcrumb-item active" aria-current="page">Riwayat Absen</li>
            </ol>
        </nav>

        <div class="pb-3">
            <h1>Riwayat Absen</h1>
        </div>

        <div class="row">
            <div class="col">
                <div class="card mb-grid">
                    <div class="table-responsive-md">
                        <div id="DataTables_Table_0_wrapper"
                            class="dataTables_wrapper container-fluid dt-bootstrap4 no-footer">
                            <div class="row">
                                <div class="col-sm-12">
                                    <table class="table table-actions table-striped table-hover mb-0 dataTable no-footer"
                                        data-table="data-table" id="DataTables_Table_0" role="grid"
                                        aria-describedby="DataTables_Table_0_info">
                                        <thead>
                                            <tr role="row">
                                                <!-- Kolom Pilihan -->
                                                <th scope="col" class="sorting_asc" tabindex="0"
                                                    aria-controls="DataTables_Table_0" rowspan="1" colspan="1"
                                                    aria-sort="ascending" aria-label=": activate to sort column descending"
                                                    style="width: 88px;">
                                                    <label class="custom-control custom-checkbox m-0 p-0">
                                                        <input type="checkbox"
                                                            class="custom-control-input table-select-all" />
                                                        <span class="custom-control-indicator"></span>
                                                    </label>
                                                </th>
                                                <!-- Kolom ID Asisten -->
                                                <th scope="col" class="sorting" tabindex="0"
                                                    aria-controls="DataTables_Table_0" rowspan="1" colspan="1"
                                                    aria-label="First Name: activate to sort column ascending"
                                                    style="width: 320px;">
                                                    ID Asisten
                                                </th>
                                                <!-- Kolom Nama Asisten -->
                                                <th scope="col" class="sorting" tabindex="0"
                                                    aria-controls="DataTables_Table_0" rowspan="1" colspan="1"
                                                    aria-label="First Name: activate to sort column ascending"
                                                    style="width: 320px;">
                                                    Nama Asisten
                                                </th>
                                                <!-- Kolom Kelas -->
                                                <th scope="col" class="sorting" tabindex="0"
                                                    aria-controls="DataTables_Table_0" rowspan="1" colspan="1"
                                                    aria-label="First Name: activate to sort column ascending"
                                                    style="width: 320px;">
                                                    Kelas
                                                </th>
                                                <!-- Kolom Materi -->
                                                <th scope="col" class="sorting" tabindex="0"
                                                    aria-controls="DataTables_Table_0" rowspan="1" colspan="1"
                                                    aria-label="First Name: activate to sort column ascending"
                                                    style="width: 320px;">
                                                    Materi
                                                </th>
                                                <!-- Kolom Jaga Sebagai -->
                                                <th scope="col" class="sorting" tabindex="0"
                                                    aria-controls="DataTables_Table_0" rowspan="1" colspan="1"
                                                    aria-label="First Name: activate to sort column ascending"
                                                    style="width: 320px;">
                                                    Jaga Sebagai
                                                </th>
                                                <!-- Kolom Tanggal -->
                                                <th scope="col" class="sorting" tabindex="0"
                                                    aria-controls="DataTables_Table_0" rowspan="1" colspan="1"
                                                    aria-label="First Name: activate to sort column ascending"
                                                    style="width: 320px;">
                                                    Tanggal
                                                </th>
                                                <!-- Kolom Waktu Mulai -->
                                                <th scope="col" class="sorting" tabindex="0"
                                                    aria-controls="DataTables_Table_0" rowspan="1" colspan="1"
                                                    aria-label="First Name: activate to sort column ascending"
                                                    style="width: 320px;">
                                                    Waktu Mulai
                                                </th>
                                                <!-- Kolom Waktu Akhir -->
                                                <th scope="col" class="sorting" tabindex="0"
                                                    aria-controls="DataTables_Table_0" rowspan="1" colspan="1"
                                                    aria-label="First Name: activate to sort column ascending"
                                                    style="width: 320px;">
                                                    Waktu Akhir
                                                </th>
                                                <!-- Kolom Durasi -->
                                                <th scope="col" class="sorting" tabindex="0"
                                                    aria-controls="DataTables_Table_0" rowspan="1" colspan="1"
                                                    aria-label="First Name: activate to sort column ascending"
                                                    style="width: 320px;">
                                                    Durasi
                                                </th>
                                                <!-- Kolom PJ / Asisten / Staff Approved -->
                                                <th scope="col" class="sorting" tabindex="0"
                                                    aria-controls="DataTables_Table_0" rowspan="1" colspan="1"
                                                    aria-label="First Name: activate to sort column ascending"
                                                    style="width: 320px;">
                                                    PJ / Asisten / Staff Approved
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            @foreach ($absen as $item)
                                                <tr role="row" class="odd">
                                                    <th scope="row" class="sorting_1">
                                                        <label class="custom-control custom-checkbox m-0 p-0">
                                                            <input type="checkbox"
                                                                class="custom-control-input table-select-row" />
                                                            <span class="custom-control-indicator"></span>
                                                        </label>
                                                    </th>
                                                    <td>{{ $item->idasisten }}</td>
                                                    <td>{{ $item->name }}</td>
                                                    <td>{{ $item->nama_kelas }}</td>
                                                    <td>{{ $item->materi }}</td>
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
                                                    <td>{{ $item->date }}</td>
                                                    <td>
                                                        @if ($item->start > '17:30:00')
                                                            <span class="badge badge-pill badge-info">{{ $item->start }}
                                                                **</span>
                                                        @else
                                                            {{ $item->start }}
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if ($item->end > '17:30:00')
                                                            <span class="badge badge-pill badge-info">{{ $item->end }}
                                                                **</span>
                                                        @else
                                                            {{ $item->end }}
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if ($item->start > '17:30:00')
                                                            <span
                                                                class="badge badge-pill badge-info">{{ $item->duration }}
                                                                Menit</span>
                                                        @else
                                                            {{ $item->duration }} Menit
                                                        @endif
                                                    </td>
                                                    @php
                                                        $getIdCode = App\Model\Kode::where(
                                                            'id',
                                                            $item->id_code,
                                                        )->first();
                                                        $getApproved = App\User::where(
                                                            'id',
                                                            $getIdCode->id_user,
                                                        )->first();
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
            </div>
        </div>
    </div>


    {{-- Form Penambahan Akhir --}}
@endsection

@section('script')
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" type="text/javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.1/axios.min.js"
        integrity="sha512-bZS47S7sPOxkjU/4Bt0zrhEtWx0y0CRkhEp8IckzK+ltifIIE9EMIMTuT/mEzoIMewUINruDBIR/jJnbguonqQ=="
        crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap4.min.js"></script>
    <script>
        $(document).ready(function() {
            var table = $("[data-table]").DataTable({
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
