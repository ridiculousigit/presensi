@extends('backend.partial.master') @section('content')
    <div class="container-fluid">
        <nav aria-label="breadcrumb" role="navigation">
            <ol class="breadcrumb adminx-page-breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Data Materi</li>
            </ol>
        </nav>

        <div class="pb-3">
            <h1>Data Materi</h1>
        </div>

        <div class="row">
            <div class="col">
                <div class="card mb-grid">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#ModalUploadPhoto">+
                        Materi Baru</button>
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
                                                    Materi
                                                </th>
                                                <th scope="col" class="sorting_disabled" rowspan="1" colspan="1"
                                                    aria-label="Actions" style="width: 107px;">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            @foreach ($materi as $item)
                                                <tr role="row" class="odd">
                                                    <th scope="row" class="sorting_1">
                                                        <label class="custom-control custom-checkbox m-0 p-0">
                                                            <input type="checkbox"
                                                                class="custom-control-input table-select-row" />
                                                            <span class="custom-control-indicator"></span>
                                                        </label>
                                                    </th>
                                                    <td>{{ $item->materi }}</td>
                                                    <td>
                                                        <button class="btn btn-sm btn-primary" data-toggle="modal"
                                                            data-target="#ModalEdit"
                                                            onclick="getData('{{ $item->id }}')">Edit</button>
                                                        <a class="btn btn-sm btn-danger"
                                                            href="{{ route('destroyMateri', ['id' => $item->id]) }}">Delete</a>
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
                    <h5 class="modal-title" id="exampleModalLabel"> Materi Baru</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="form-data-materi" method="post" data-route="{{ route('storeMateri') }}"
                    enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <div id="messages"></div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <label class="form-label">Materi </label>
                                        <input name="materi" class="form-control mb-2 input-credit-card" type="text"
                                            placeholder="Materi" />
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
                    <h5 class="modal-title" id="exampleModalLabel">Edit Data Materi</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="form-data-materi-edit" method="post" data-route="{{ route('updateMateri') }}"
                    enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <div id="messages"></div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <label class="form-label">Materi </label>
                                        <input type="hidden" name="id">
                                        <input name="materiU" class="form-control mb-2 input-credit-card" type="text"
                                            placeholder="Materi" />
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
    <script type="text/javascript" src="{{ URL::asset('js/backend/materi/postMateri.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('js/backend/materi/updateMateri.js') }}"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap4.min.js"></script>
    <script>
        function getData(id) {
            axios.post("{{ route('editMateri') }}", {
                id: id
            }).then(res => {
                $('input[name=id]').val(res.data.id)
                $('input[name=materiU]').val(res.data.materi)


            })

        }
        $(document).ready(function() {
            var table = $("[data-table]").DataTable({
                columns: [null, null, {
                    orderable: true
                }],
            });

            $('.form-control-search').keyup(function() {
                table.search($(this).val()).draw();
            });
        });
    </script>
@endsection
