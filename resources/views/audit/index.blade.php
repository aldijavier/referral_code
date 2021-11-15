@extends('layouts.master')
@section('content')
<section class="content card" style="padding: 10px 10px 10px 10px ">
    <div class="box">
        @if(session('sukses'))
        <div class="alert alert-success" role="alert">
            {{session('sukses')}}
        </div>
        @endif
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        <div class="row">
            <div class="col">
                <h3><i class="nav-icon fas fa-check-square-o my-1 btn-sm-1"></i> Audit Log</h3>
                <hr>
            </div>
        </div>
        <div class="box-header">
            <button type="button" class="btn btn-primary" id="btnExportExcel" data-toggle="modal" data-target="#myModalExport" data-backdrop="static" data-keyboard="false">
                <i class="fa fa-table" aria-hidden="true"></i>
                <span class="nav-text">
                    Export to Excel with date
                </span>
            </button>
        </div><br>
        <!-- Modal Export-->
    <div class="modal fade" id="myModalExport" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel"><b>Export to Excel</b>
                    <button type="button" class="close" data-dismiss="modal" onclick="resetExport()" aria-label="Close">
                        <span aria-hidden="true" style="color:black"><i class="fa fa-times"></i></span>
                    </button>
                </h4>
            </div>
            <div class="modal-body">
                <form action="{{url('/tickets/exportreturn')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-body">
                        <div class="form-group">
                            <label>From</label>
                            <input type="date" id="date_start" name="date_start" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Until</label>
                            <input type="date" id="date_finish" name="date_finish" class="form-control">
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" id="btnResetModalExport" class="btn btn-primary"><i class="fa fa-refresh"></i> Reset</button>
                <button type="submit" class="btn btn-primary"><i class="fa fa-file-text"></i> Export Now</button>
            </div>
            </form>
            </div>
        </div>
    </div>
        {{-- <div>
            <div class="col">
                <a class="btn btn-primary btn-sm my-1 mr-sm-1" href="{{ route('pengguna.create') }}" role="button"><i
                        class="fas fa-plus"></i> Tambah Data</a>
                <br><br>
            </div>
        </div> --}}
        <div class="row table-responsive">
            <div class="col-12">
                <table class="table table-hover table-head-fixed" id='tabelSuratmasuk'>
                    <thead>
                        <tr class="bg-light">
                            <th>No.</th>
                            <th>Email</th>
                            <th>Ip Address</th>
                            <th>Access From</th>
                            <th>Activity</th>
                            <th>Time</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 0;?>
                        @foreach($data_pengguna as $pengguna)
                        <?php $no++ ;?>
                        <tr>
                            <td>{{$no}}</td>
                            <td>{{$pengguna->username}}</td>
                            <td>{{$pengguna->ip_address}}</td>
                            <td>{{$pengguna->access_from}}</td>
                            <td>{{$pengguna->activity}}</td>
                            <td>{{$pengguna->created_at}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    </div>
</section>
@endsection
