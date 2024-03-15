@extends('backend.partial.master') @section('content')
    <div class="container-fluid">
        <nav aria-label="breadcrumb" role="navigation">
            <ol class="breadcrumb adminx-page-breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Data Kelas</li>
            </ol>
        </nav>

        <div class="pb-3">
            <h1>Data Kelas</h1>
        </div>

        <div class="row">
            <div class="col">
                <div class="card mb-grid">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#ModalUploadPhoto">+
                        Kelas Baru</button>
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
                                                <th scope="col" class="sorting" tabindex="0"
                                                    aria-controls="DataTables_Table_0" rowspan="1" colspan="1"
                                                    aria-label="First Name: activate to sort column ascending"
                                                    style="width: 320px;">
                                                    Jurusan
                                                </th>
                                                <th scope="col" class="sorting" tabindex="0"
                                                    aria-controls="DataTables_Table_0" rowspan="1" colspan="1"
                                                    aria-label="First Name: activate to sort column ascending"
                                                    style="width: 320px;">
                                                    Fakultas
                                                </th>
                                                <th scope="col" class="sorting" tabindex="0"
                                                    aria-controls="DataTables_Table_0" rowspan="1" colspan="1"
                                                    aria-label="Last Name: activate to sort column ascending"
                                                    style="width: 311px;">
                                                    Tingkat
                                                </th>
                                                <th scope="col" class="sorting" tabindex="0"
                                                    aria-controls="DataTables_Table_0" rowspan="1" colspan="1"
                                                    aria-label="Username: activate to sort column ascending"
                                                    style="width: 305px;">Nama Kelas</th>
                                                <th scope="col" class="sorting_disabled" rowspan="1" colspan="1"
                                                    aria-label="Actions" style="width: 107px;">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($kelas as $item)
                                                <tr role="row" class="odd">

                                                    <th scope="row" class="sorting_1">
                                                        <label class="custom-control custom-checkbox m-0 p-0">
                                                            <input type="checkbox"
                                                                class="custom-control-input table-select-row" />
                                                            <span class="custom-control-indicator"></span>
                                                        </label>
                                                    </th>
                                                    <td>{{ $item->jurusan }}</td>
                                                    <td>{{ $item->fakultas }}</td>
                                                    <td>{{ $item->tingkat }}</td>
                                                    <td>{{ $item->nama_kelas }}</td>
                                                    <td>
                                                        <button class="btn btn-sm btn-primary" data-toggle="modal"
                                                            data-target="#ModalEdit"
                                                            onclick="getData('{{ $item->id }}')">Edit</button>
                                                        <a class="btn btn-sm btn-danger"
                                                            href="{{ route('destroyKelas', ['id' => $item->id]) }}">Delete</a>
                                                    </td>
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

    <div class="modal fade" id="ModalUploadPhoto" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Data Kelas Baru</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="form-data-kelas" method="post" data-route="{{ route('storeKelas') }}"
                    enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <div id="messages"></div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <label class="form-label">Jurusan </label>
                                        <input name="jurusan" class="form-control mb-2 input-credit-card" type="text"
                                            placeholder="Jurusan" />
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Fakultas </label>
                                        <input name="fakultas" class="form-control mb-2 input-credit-card" type="text"
                                            placeholder="Fakultas" />
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Tingkat </label>
                                        <input name="tingkat" class="form-control mb-2 input-credit-card" type="number"
                                            min="1" max="5" placeholder="Tingkat" />
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Nama Kelas </label>
                                        <input name="nama_kelas" class="form-control mb-2 input-credit-card"
                                            type="text" placeholder="cth : 4KAXX" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="ModalEdit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Data Kelas</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="form-data-kelas-edit" method="post" data-route="{{ route('updateKelas') }}"
                    enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <div id="messages"></div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <label class="form-label">Jurusan </label>
                                        <input type="hidden" name="id">
                                        <input name="jurusanU" class="form-control mb-2 input-credit-card" type="text"
                                            placeholder="Jurusan" />
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Fakultas </label>
                                        <input name="fakultasU" class="form-control mb-2 input-credit-card"
                                            type="text" placeholder="Fakultas" />
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Tingkat </label>
                                        <input name="tingkatU" class="form-control mb-2 input-credit-card" type="number"
                                            min="1" max="5" placeholder="Tingkat" />
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Nama Kelas </label>
                                        <input name="nama_kelasU" class="form-control mb-2 input-credit-card"
                                            type="text" placeholder="cth : 4KAXX" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" type="text/javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.1/axios.min.js"
        integrity="sha512-bZS47S7sPOxkjU/4Bt0zrhEtWx0y0CRkhEp8IckzK+ltifIIE9EMIMTuT/mEzoIMewUINruDBIR/jJnbguonqQ=="
        crossorigin="anonymous"></script>
    <script type="text/javascript" src="{{ URL::asset('js/backend/kelas/postKelas.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('js/backend/kelas/updateKelas.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('js/backend/kelas/destroyKelas.js') }}"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap4.min.js"></script>
    <script>
        function getData(id) {
            axios.post("{{ route('editKelas') }}", {
                id: id
            }).then(res => {
                $('input[name=id]').val(res.data.id)
                $('input[name=jurusanU]').val(res.data.jurusan)
                $('input[name=fakultasU]').val(res.data.fakultas)
                $('input[name=tingkatU]').val(res.data.tingkat)
                $('input[name=nama_kelasU]').val(res.data.nama_kelas)


            })

        }


        $(document).ready(function() {
            var table = $("[data-table]").DataTable({
                columns: [null, null, null, null, null, {
                    orderable: true
                }],
            });

            $('.form-control-search').keyup(function() {
                table.search($(this).val()).draw();
            });
        });
    </script>
@endsection
