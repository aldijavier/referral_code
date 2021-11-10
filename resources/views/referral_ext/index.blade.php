<style>
    .highcharts-figure, .highcharts-data-table table {
        min-width: 320px; 
        max-width: 660px;
        margin: 1em auto;
    }

    .highcharts-data-table table {
        font-family: Verdana, sans-serif;
        border-collapse: collapse;
        border: 1px solid #EBEBEB;
        margin: 10px auto;
        text-align: center;
        width: 100%;
        max-width: 500px;
    }

    .highcharts-data-table caption {
        padding: 1em 0;
        font-size: 1.2em;
        color: #555;
    }

    .highcharts-data-table th {
        font-weight: 600;
        padding: 0.5em;
    }

    .highcharts-data-table td, .highcharts-data-table th, .highcharts-data-table caption {
        padding: 0.5em;
    }
    .highcharts-data-table tr:hover {
        background: #f1f7ff;
    }
    .highcharts-credits {
        display: none;
    }

    #btnSubmitGraph {
        background-color: #151a48;
        color: white;
        font-weight: 700;
        margin-top: 23px;
        margin-left: 15px; 
        padding : 5px 15px;
        font-size: 15px;
    }
    #pie_chart {
        border: 5px solid #151a48;
        border-radius: 25px;
    }
    #pie_chart_x {
        border: 5px solid #151a48;
        border-radius: 25px;
    }
    #chartKota {
        text-align-last: center;
        border: 5px solid #151a48;
        border-radius: 25px;
    }
    #chartProvinsi {
        text-align-last: center;
        border: 5px solid #151a48;
        border-radius: 25px;
    }
    #member-daterangepicker {
        margin-top: 22px;
        border: 2px solid gainsboro;
        padding-left: 150px;
        padding-bottom: 6px;
        font-size: 15px;
    }
    .ion-calendar {
        margin-left: -140px;
        margin-right: 50px;
    }
    .ion-ios-arrow-down {
        margin-left: 50px;
    }
    .applyBtn {
        margin-top: 22px;
        margin-left: 7px;
    }
    .cancelBtn {
        margin-top: 22px;
        margin-left: 5px;
    }
    .daterangepicker_start_input{
        margin-left: 5px;
    }   

    @media (max-width: 765px) {
        .hidden-xs {
            display: block !important;
        }
        #provinsi {
           width: 80%;
        }

        #member-daterangepicker {
            margin-top: 22px;
            border: 2px solid gainsboro;
            padding-left: 70px;
            padding-bottom: 6px;
            font-size: 15px;
        }

        .ion-calendar {
            margin-left: -60px;
            margin-right: 5px;
        }
        .ion-ios-arrow-down {
            margin-left: 15px;
        }

       

    }

</style>
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
                <h3><i class="nav-icon fas fa-envelope-open my-1 btn-sm-1"></i> Management Agent External Code</h3>
                <hr>
            </div>
            </div>
            {{-- <div class="col-7">
                <div id="member-daterangepicker" class="gymie-daterangepicker btn bg-grey-50 daterange-padding no-border color-grey-600 no-shadow">
                    <i class="ion-calendar margin-right-10"></i>
                        <span>{{$drp_placeholder}}</span>
                    <i class="ion-ios-arrow-down margin-left-5"></i>
                </div>
                <input type="hidden" class="form-control" id="drp_start" name="drp_start">
                <input type="hidden" class="form-control" id="drp_end" name="drp_end">
                <div class="input-group-btn" style="margin-top:10px;">
                    <input type="submit" class="btn btn-primary" value="Filter">
                </div> 
            </div> --}}
           <!-- datepicker -->
           
            {{-- <script src="{{ URL::asset('admin/assets/plugins/jquery-countTo/jquery.countTo.js') }}" type="text/javascript"></script> --}}
            <!-- datepicker -->

            <link href="{{ URL::asset('admin/assets/plugins/ionicons/css/ionicons.min.css') }}" rel="stylesheet"/>
            <link href="{{ URL::asset('admin/assets/plugins/datepicker/css/bootstrap-datepicker.css') }}" rel="stylesheet"/>
            
            {{-- <link rel="stylesheet" type="text/css" href="{{asset('admin/assets/css/plugins.css')}}" /> --}}
            <link rel="stylesheet" type="text/css" href="{{asset('admin/assets/plugins/bootstrap-daterangepicker/daterangepicker-bs3.css')}}" />
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
            <script src="{{ URL::asset('admin/assets/plugins/bootstrap-daterangepicker/moment.min.js') }}" type="text/javascript"></script>
            <script src="{{ URL::asset('admin/assets/plugins/bootstrap-daterangepicker/daterangepicker.js') }}" type="text/javascript"></script>
            <script src="{{ URL::asset('admin/assets/plugins/datepicker/js/bootstrap-datepicker.min.js') }}" type="text/javascript"></script>
            <script src="{{ URL::asset('admin/assets/plugins/jquery-countTo/jquery.countTo.js') }}" type="text/javascript"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.2/js/bootstrap-select.min.js"></script>
            <script src="{{asset('admin/assets/js/bootstrap.js')}}"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js"></script>.
	        <script src="{{asset('admin/assets/js/proton.js')}}"></script>
            <!-- gymie -->
            <script src="{{ URL::asset('admin/assets/js/gymie.js') }}" type="text/javascript"></script>

            <script type="text/javascript">

                $(document).ready(function () {
                    gymie.loadcounter();
                    gymie.loadprogress();
                    gymie.loaddatepicker();
                    gymie.loaddaterangepicker();
                    gymie.loadbsselect();
                });
            
            </script>
            <div>
                <div class="col">
                    <a class="btn btn-primary btn-sm my-1 mr-sm-1" href="/referral/create" role="button"><i class="fas fa-plus"></i> Tambah Data</a>
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
                        {{-- <th>Provinces</th> --}}
                        <th>Regencies</th>
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
                            @elseif($suratkeluar->referral_for == 3)
                                <span>Agent External Code</span>
                            @else($suratkeluar->referral)
                                <span>Agent Code Ext</span>
                            @endif
                            </td>
                            <td>{{$suratkeluar->start_date}}</td>
                            <td>{{$suratkeluar->end_date}}</td>
                            {{-- <td>{{$suratkeluar->province}}</td> --}}
                            <td>{{$suratkeluar->regencies}}</td>
                            <td>{{$suratkeluar->description}}</td>
                            <td>@if ($suratkeluar->status == 1)
                                <span style="color:green">Active</span>
                            @else
                                <span style="color:red">Non Active</span>
                            @endif
                            </td>
                            {{-- <td>{{$suratkeluar->keterangan}}</td> --}}
                            <td>
                                <a href="/referralext/{{$suratkeluar->id}}/edit" class="btn btn-primary btn-sm my-1 mr-sm-1 btn-block"><i class="nav-icon fas fa-pencil-alt"></i> Edit</a>
                                @if (auth()->user()->role == 'admin')
                                <a href="/referralext/{{$suratkeluar->id}}/delete" class="btn btn-danger btn-sm my-1 mr-sm-1 btn-block" onclick="return confirm('Hapus Data ?')"><i class="nav-icon fas fa-trash"></i> Hapus</a>
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

