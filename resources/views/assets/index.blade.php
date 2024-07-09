<div class="row">
    <div class="col-md-12">

        <h2>All Assets</h2>

{{--        <form action="{{ route('import') }}" method="POST" enctype="multipart/form-data" class="form-inline">--}}
{{--            @csrf--}}
{{--            <div class="input-group input-group-sm">--}}
{{--                <input type="file" name="file" class="form-control form-control-navbar">--}}
{{--                <div class="input-group-append">--}}
{{--                    <button class="btn btn-primary" type="submit">Hantar</button>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </form>--}}

        <br>

        <div class="row">
            <div class="col-md-3">
                <div class="card card-primary card-outline collapsed-card">
                    <div class="card-header">
                        @foreach ($assets as $t)
{{--<h3 class="card-title">{{$t->department->deptname}}</h3>--}}
                            @break
                        @endforeach

                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i>
                            </button>
                        </div>
                        <!-- /.card-tools -->
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <ul class="nav nav-pills flex-column">
{{--                            @foreach ($depart as $cat)--}}
{{--                                <li class="nav-item {{ $cat->id == $id ? 'active' : ''}} ">--}}
{{--                                    <a class="nav-link" href="/asset/department/{{ $cat->id }}">{{ $cat->deptname }}</a>--}}
{{--                                    <a class="nav-link {{ $cat->id == $id ? 'active' : ''}}" href="/asset/department/downloadPdf/{{ $cat->id }}"><i class="fas fa-download"></i>  DOWNLOAD PDF {{ $cat->deptname }}</a>--}}
{{--                                </li>--}}
{{--                            @endforeach--}}
                        </ul>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
            <div class="col-md-3">
                <div class="card card-primary card-outline collapsed-card">
                    <div class="card-header">
                        @foreach ($assets as $t)
                            <h3 class="card-title">{{$t->asset_name}}</h3>
                            @break
                        @endforeach
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i>
                            </button>
                        </div>
                        <!-- /.card-tools -->
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <ul class="nav nav-pills flex-column">
{{--                            @foreach ($devices as $c)--}}
{{--                                <li class="nav-item {{ $c->id == $id ? 'active' : ''}} ">--}}
{{--                                    <a class="nav-link" href="/asset/device/{{ $c->id }}">{{ $c->device_name }}</a>--}}
{{--                                </li>--}}
{{--                            @endforeach--}}
                        </ul>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->

        </div>

    </div>
</div>



{{--@if ($message = Session::get('success'))--}}
{{--    <div class="alert alert-success">--}}
{{--        <p>{{ $message }}</p>--}}
{{--    </div>--}}
{{--@endif--}}

<div class="card col-md-12">
    <div class="card-header">
        <a class="btn btn-success" href="{{ route('asset.create') }}"> Tambah Inventori Asset</a>
        <br><br>
        <form action="" class="form-inline">
            <div class="input-group ">
                <input type="search" class="form-control form-control-navbar" name="search" placeholder="Search">
                <div class="input-group-append">
                    <button class="btn btn-primary">Cari</button>
                </div>
            </div>
        </form>
    </div>

    <!-- /.card-header -->
    <div class="card-body">
        <table id="example2" class="table table-bordered table-hover">
            <thead>
            <tr>
                <th>No</th>
                <th>Nombor Harta Modal</th>
                <th>No Casis</th>
                <th>Tahun Pembelian</th>
                <th>Nama Pengguna</th>
                <th>Jenis Perkakasan</th>
                <th>Jenama</th>
                <th>Jabatan</th>
                <th>Juruteknik Bertanggungjawab</th>
                <th>Lokasi</th>
                <th>Dikemaskini Oleh</th>
                <th>Tarikh & Masa Dikemaskini</th>
                <th width="280px">Pilihan</th>
            </tr>
            </thead>
            <tbody>
            @if($assets->count())
                @foreach ($assets as $t)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $t->asset_name }}</td>
                        <td>{{ $t->purchased_date }}</td>
                        <td>{{ $t->end_of_life}}</td>
                        <td>{{ $t->warrant}} </td>
                        <td>{{ $t->vendor->vendor_name}} </td>
                        <td>{{ $t->user->name}}</td>
                        <td>{{ $t->updated_at}}</td>
                        <td>
{{--                            <form action="{{ route('asset.destroy',$t->id) }}" method="POST">--}}

{{--                                <a class="btn btn-primary" href="{{ route('asset.edit',$t->id) }}"><i class="fa fa-edit"></i></a>--}}

{{--                                @csrf--}}
{{--                                @method('DELETE')--}}

{{--                                <button onclick="return confirm('Adakah anda ingin membuang data ini?')" type="submit" class="btn btn-danger"><i class="fa fa-trash"></i></button>--}}
{{--                            </form>--}}
                        </td>
                    </tr>
            @endforeach
            @endif
        </table>
        {!! $assets->appends(\Request::except('page'))->render() !!}
    </div>
    <!-- /.card-body -->
</div>


@push('script')
    <script>
        $(function () {
            $('#example2').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });
        });
    </script>
@endpush
