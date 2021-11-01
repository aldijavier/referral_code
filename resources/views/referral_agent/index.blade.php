@extends('layouts.master')
@section('content')
    <section class="content card" style="padding: 10px 10px 10px 10px ">
        <div class="box">
                @if(session('sukses'))
                <div class="alert alert-success" role="alert">
                        {{session('sukses')}}
                </div>
                @endif
            <div class="row">
                <div class="col">
                <h3><i class="nav-icon fas fa-envelope-open my-1 btn-sm-1"></i> Management Agent Internal Code</h3>
                <hr>
            </div>
            </div>
            <div>
                <div class="col">
                    <a class="btn btn-primary btn-sm my-1 mr-sm-1" href="create" role="button"><i class="fas fa-plus"></i> Tambah Data</a>
                    <br>
                </div>
            </div>
            <div class="row table-responsive">
                <div class="col">
                <table class="table table-hover table-head-fixed" id="tabelSuratkeluar">
                    <thead>
                        <tr class="bg-light">
                        <th>No.</th>
                        <th>Code</th>
                        <th>Type Code</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th>Description</th>
                        <th>Status</th>
                        <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 0;?>
                        @foreach($referral as $suratkeluar)
                        <?php $no++ ;?>
                        <tr>
                            <td>{{$no}}</td>
                            <td>{{$suratkeluar->referral_code}}</td>
                            {{-- <td><a href="/suratkeluar/{{$suratkeluar->id}}/tampil">{{$suratkeluar->filekeluar}}</a></td> --}}
                            <td>@if ($suratkeluar->referral_for == 1)
                                <span>Promo Code</span>
                            @elseif($suratkeluar->referral_for == 2)
                                <span>Agent Code</span>
                            @else($suratkeluar->referral)
                                <span>Agent Code Ext</span>
                            @endif
                            </td>
                            <td>{{$suratkeluar->start_date}}</td>
                            <td>{{$suratkeluar->end_date}}</td>
                            <td>{{$suratkeluar->description}}</td>
                            <td>@if ($suratkeluar->status == 1)
                                <span style="color:green">Active</span>
                            @else
                                <span style="color:red">Non Active</span>
                            @endif
                            </td>
                            {{-- <td>{{$suratkeluar->keterangan}}</td> --}}
                            <td>
                                <a href="/suratkeluar/{{$suratkeluar->id}}/edit" class="btn btn-primary btn-sm my-1 mr-sm-1 btn-block"><i class="nav-icon fas fa-pencil-alt"></i> Edit</a>
                                @if (auth()->user()->role == 'admin')
                                <a href="/suratkeluar/{{$suratkeluar->id}}/delete" class="btn btn-danger btn-sm my-1 mr-sm-1 btn-block" onclick="return confirm('Hapus Data ?')"><i class="nav-icon fas fa-trash"></i> Hapus</a>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                </div>
            </div>
        </div>
    </section>
 @endsection

