@extends('backend.partial.master')
@section('content')
    @php
        $role = App\User::where('id', Auth::id())->first();
    @endphp
    <div class="container-fluid">
        <nav aria-label="breadcrumb" role="navigation">
            <ol class="breadcrumb adminx-page-breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Data Asisten</li>
            </ol>
        </nav>

        <div class="pb-3">
            <h1>Data Asisten</h1>
        </div>

        <div class="row">
            <div class="col">
                <div class="card mb-grid">
                    @if ($role->role == 'Admin' || $role->role == 'Staff')
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#ModalUploadPhoto">+
                            Asisten Baru</button>
                    @endif
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
                                                    ID Asisten
                                                </th>
                                                <th scope="col" class="sorting" tabindex="0"
                                                    aria-controls="DataTables_Table_0" rowspan="1" colspan="1"
                                                    aria-label="First Name: activate to sort column ascending"
                                                    style="width: 320px;">
                                                    Nama
                                                </th>
                                                <th scope="col" class="sorting" tabindex="0"
                                                    aria-controls="DataTables_Table_0" rowspan="1" colspan="1"
                                                    aria-label="First Name: activate to sort column ascending"
                                                    style="width: 320px;">
                                                    Join Date
                                                </th>
                                                <th scope="col" class="sorting" tabindex="0"
                                                    aria-controls="DataTables_Table_0" rowspan="1" colspan="1"
                                                    aria-label="First Name: activate to sort column ascending"
                                                    style="width: 320px;">
                                                    Jabatan
                                                </th>
                                                <th scope="col" class="sorting" tabindex="0"
                                                    aria-controls="DataTables_Table_0" rowspan="1" colspan="1"
                                                    aria-label="First Name: activate to sort column ascending"
                                                    style="width: 320px;">
                                                    Email
                                                </th>
                                                <th scope="col" class="sorting_disabled" rowspan="1" colspan="1"
                                                    aria-label="Actions" style="width: 107px;">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($asisten as $item)
                                                <tr role="row" class="odd">
                                                    <th scope="row" class="sorting_1">
                                                        <label class="custom-control custom-checkbox m-0 p-0">
                                                            <input type="checkbox"
                                                                class="custom-control-input table-select-row" />
                                                            <span class="custom-control-indicator"></span>
                                                        </label>
                                                    </th>
                                                    <td>{{ $item->id_asisten }}</td>
                                                    <td>{{ $item->name }}</td>
                                                    <td>{{ $item->join_date }}</td>
                                                    <td>{{ $item->role }}</td>
                                                    <td>{{ $item->email }}</td>
                                                    <td>
                                                        <button class="btn btn-sm btn-primary" data-toggle="modal"
                                                            data-target="#ModalEdit"
                                                            onclick="getData('{{ $item->id }}')">Edit</button>
                                                        <a class="btn btn-sm btn-danger"
                                                            href="{{ route('destroyAsisten', ['id' => $item->id]) }}">Delete</a>
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
                    <h5 class="modal-title" id="exampleModalLabel"> Asisten Baru</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="form-data-asisten" method="post" data-route="{{ route('storeAsisten') }}"
                    enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <div id="messages"></div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <label class="form-label">Id Asisten </label>
                                        <input name="id_asisten" class="form-control mb-2 input-credit-card"
                                            type="text" placeholder="Id Asisten" />
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Name </label>
                                        <input name="name" class="form-control mb-2 input-credit-card" type="text"
                                            placeholder="Name" />
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Join Date </label>
                                        <input name="join_date" class="form-control mb-2 input-credit-card"
                                            type="date" placeholder="Join Date" />
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Jabatan </label>
                                        <select class="form-control" name="role">
                                            <option value="selected disabled">Silahkan Pilih</option>
                                            <option value="Asisten"> Asisten </option>
                                            <option value="PJ"> PJ </option>
                                            <option value="Staff"> Staff </option>
                                            <option value="Admin"> Admin </option>
                                        </select>
                                    </div>
                                    <label class="form-label">Photo</label>
                                    <div class="custom-file">
                                        <input type="file" name="photo" class="custom-file-input" id="customFile">
                                        <label class="custom-file-label" for="customFile">Choose file</label>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Email</label>
                                        <input name="email" class="form-control mb-2 input-credit-card" type="email"
                                            placeholder="john@doe.com" />
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Password</label>
                                        <input name="password1" class="form-control mb-2 input-credit-card"
                                            type="password" />
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Re-Type Password</label>
                                        <input name="password2" class="form-control mb-2 input-credit-card"
                                            type="password" />
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
                    <h5 class="modal-title" id="exampleModalLabel">Edit Data Asisten</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="form-data-asisten-edit" method="post" data-route="{{ route('updateAsisten') }}"
                    enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <div id="messages"></div>
                                <div class="card-body">
                                    <img id="imagetest" width="425px" height="425px">
                                    <div class="form-group">
                                        <label class="form-label">Id Asisten </label>
                                        <input type="hidden" name="id">
                                        <input name="id_asistenU" class="form-control mb-2 input-credit-card"
                                            type="text" placeholder="Id Asisten" />
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Name </label>
                                        <input name="nameU" class="form-control mb-2 input-credit-card" type="text"
                                            placeholder="Name" />
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Join Date </label>
                                        <input name="join_dateU" class="form-control mb-2 input-credit-card"
                                            type="date" placeholder="Join Date" />
                                    </div>
                                    @if ($role->role == 'Admin' || $role->role == 'Staff')
                                        <div class="form-group">
                                            <label class="form-label">Jabatan </label>
                                            <select class="form-control" name="roleU">
                                                <option value="selected">Silahkan Pilih</option>
                                                <option value="Asisten"> Asisten </option>
                                                <option value="PJ"> PJ </option>
                                                <option value="Staff"> Staff </option>
                                                <option value="Admin"> Admin </option>
                                            </select>
                                        </div>
                                    @else
                                        <div class="form-group">
                                            <label class="form-label">Jabatan </label>
                                            <input name="roleU2" class="form-control mb-2 input-credit-card"
                                                type="text" disabled readonly placeholder="Join Date" />
                                        </div>
                                    @endif
                                    <label class="form-label">Photo</label>
                                    <div class="custom-file">
                                        <input type="file" name="photoU" class="custom-file-input" id="customFile">
                                        <label class="custom-file-label" for="customFile">Choose file</label>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Email</label>
                                        <input name="emailU" class="form-control mb-2 input-credit-card" type="email"
                                            placeholder="john@doe.com" />
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Password</label>
                                        <input name="password1U" class="form-control mb-2 input-credit-card"
                                            type="password" />
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Re-Type Password</label>
                                        <input name="password2U" class="form-control mb-2 input-credit-card"
                                            type="password" />
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
    <script type="text/javascript" src="{{ URL::asset('js/backend/asisten/postAsisten.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('js/backend/asisten/updateAsisten.js') }}"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap4.min.js"></script>
    <script>
        function getData(id) {
            axios.post("{{ route('editAsisten') }}", {
                id: id
            }).then(res => {
                $('input[name=id]').val(res.data.id)
                $('input[name=id_asistenU]').val(res.data.id_asisten)
                $('input[name=nameU]').val(res.data.name)
                $('input[name=join_dateU]').val(res.data.join_date)
                $('select[name=roleU').val(res.data.role)
                $('input[name=emailU]').val(res.data.email)
                $('#imagetest').attr('src', "{{ asset('photo') }}/" + res.data.photo)

            })
        }
        $(document).ready(function() {
            var table = $("[data-table]").DataTable({
                columns: [null, null, null, null, null, null, {
                    orderable: true
                }],
            });

            $('.form-control-search').keyup(function() {
                table.search($(this).val()).draw();
            });
        });
    </script>
@endsection
