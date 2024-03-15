@extends('backend.partial.master')

@section('content')
    @php
        // Retrieve user role, class, material, and current date for the dashboard
        $role = App\User::where('id', Auth::id())->first();
        $kelas = App\Model\Kelas::all();
        $materi = App\Model\Materi::all();
        $today = Carbon\Carbon::now('GMT+7')->toDateString();
        $cekAbsen = App\Model\Absen::where('id_asisten', Auth::id())
            ->where('date', $today)
            ->where('end', null)
            ->first();
    @endphp

    <div class="container-fluid">
        <!-- Breadcrumb Navigation -->
        <nav aria-label="breadcrumb" role="navigation">
            <ol class="breadcrumb adminx-page-breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
            </ol>
        </nav>

        <div class="pb-3">
            <h1>Dashboard</h1>
        </div>

        <div class="row">
            @if ($role->role == 'Staff' || $role->role == 'Admin' || $role->role == 'PJ')
                <div class="col-lg-6">
                    <!-- Form for generating attendance code -->
                    <form id="form-data-kode" method="post" data-route="{{ route('storeKode') }}" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="card">
                            <div class="card-header">
                                Generate Attendance Code
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col text-center">
                                        <button type="submit" class="btn btn-danger">Generate Attendance Code</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            @endif

            <div class="{{ $role->role == 'Asisten' ? 'col-lg-12' : 'col-lg-6' }}">
                <!-- Absentee Form -->
                <div class="card">
                    <div class="card-header">
                        Attendance Form
                    </div>
                    <br />
                    <div class="row">
                        <div class="col text-center">
                            <!-- Welcome message with user's name -->
                            <h4>Welcome {{ $role->name }}</h4>
                            <!-- Digital clock display -->
                            <div class="digital_clock_wrapper">
                                <div id="digit_clock_time"></div>
                                <div id="digit_clock_date"></div>
                            </div>
                        </div>
                    </div>
                    <!-- Check if there's no ongoing attendance -->
                    @if (empty($cekAbsen))
                        <form id="form-absen" method="post" data-route="{{ route('storeAbsen') }}" enctype="multipart/form-data">
                    @endif
                    {{ csrf_field() }}
                    <div class="card-body">
                        <div class="form-group">
                            <label class="form-label">Assistant ID</label>
                            <!-- Display assistant's ID -->
                            <input value="{{ $role->id_asisten }}" name="id_asisten" class="form-control mb-2 input-credit-card" type="text" readonly />
                        </div>
                        <div class="form-group">
                            <label class="form-label">Class</label>
                            <!-- Dropdown for selecting class -->
                            <select name="kelas" class="form-control" @if (!empty($cekAbsen)) disabled @endif>
                                <option disabled selected>Please Select</option>
                                @foreach ($kelas as $item)
                                    <option value="{{ $item->id }}">{{ $item->nama_kelas }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Material</label>
                            <!-- Dropdown for selecting material -->
                            <select name="materi" class="form-control" @if (!empty($cekAbsen)) disabled @endif>
                                <option disabled selected>Please Select</option>
                                @foreach ($materi as $item)
                                    <option value="{{ $item->id }}">{{ $item->materi }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Role</label>
                            <!-- Dropdown for selecting role -->
                            <select name="peran_jaga" class="form-control" @if (!empty($cekAbsen)) disabled @endif>
                                <option disabled selected>Please Select</option>
                                <option value="Asisten Baris">Assistant Row</option>
                                <option value="Ketua">Chairman</option>
                                <option value="Tutor">Tutor</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Attendance Code</label>
                            <!-- Input for entering attendance code -->
                            <input name="kode" class="form-control mb-2 input-credit-card" type="text" @if (!empty($cekAbsen)) disabled @endif placeholder="Ex: 87ADsds0" />
                            <!-- Instruction for obtaining attendance code -->
                            <a>*Please ask PJ or Staff for the attendance code</a>
                        </div>
                        <div class="row">
                            <!-- Submit button for attendance -->
                            @if (empty($cekAbsen))
                                <div class="col text-center">
                                    <button type="submit" class="btn btn-info">Attendance</button>
                                </div>
                            @endif
                        </div>
                    </div>
                    </form>
                    <!-- Check if there's ongoing attendance -->
                    @if (!empty($cekAbsen))
                        <!-- Form for clocking out -->
                        <form id="form-update-absen" method="post" data-route="{{ route('updateAbsen') }}" enctype="multipart/form-data">
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
    <!-- Include necessary JavaScript libraries -->
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" type="text/javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.1/axios.min.js"
        integrity="sha512-bZS47S7sPOxkjU/4Bt0zrhEtWx0y0CRkhEp8IckzK+ltifIIE9EMIMTuT/mEzoIMewUINruDBIR/jJnbguonqQ=="
        crossorigin="anonymous"></script>
    <!-- Include custom JavaScript files -->
    <script type="text/javascript" src="{{ URL::asset('js/backend/kode/postKode.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('js/backend/absen/postAbsen.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('js/backend/absen/updateAbsen.js') }}"></script>
    <!-- Include DataTables JavaScript files -->
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap4.min.js"></script>
    <script>
        // Function to fetch data for editing material
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

        // Initialize DataTable
        $(document).ready(function() {
            var table = $("[data-table]").DataTable({
                columns: [null, null, null, {
                    orderable: true
                }],
            });

            // Search functionality for DataTable
            $(".form-control-search").keyup(function() {
                table.search($(this).val()).draw();
            });
        });
    </script>
    <script type="text/javascript">
        // Function to display current time and date
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

            var months = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October",
                "November", "December"
            ];
            var days = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];

            var curWeekDay = days[date.getDay()];
            var curDay = date.getDate();
            var curMonth = months[date.getMonth()];
            var curYear = date.getFullYear();
            var date = curWeekDay + ", " + curDay + " " + curMonth + " " + curYear;
            document.getElementById("digit_clock_date").innerHTML = date;

            var t = setTimeout(currentTime, 1000);
        }

        // Function to append leading zero if necessary
        function changeTime(k) {
            if (k < 10) {
                return "0" + k;
            } else {
                return k;
            }
        }

        // Call the currentTime function to start the clock
        currentTime();
    </script>
@endsection
