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
                <h3><i class="nav-icon fas fa-envelope-open my-1 btn-sm-1"></i> Manage Promo Code API</h3>
                <hr>
            </div>
            </div>
            {{-- action="{{route('search')}}" --}}
            <form action="{{route('report')}}" method ="POST">
                @csrf
                <br>
                <div class="container">
                    <div class="row">
                        <div class="container-fluid">
                            <div class="form-group row">
                                <label for="date" class="col-form-label col-sm-2">Start Date</label>
                                <div class="col-sm-3">
                                    <input type="date" class="form-control input-sm" id="start_date" name="start_date" required/>
                                </div>
                                <label for="date" class="col-form-label col-sm-2">End Date</label>
                                <div class="col-sm-3">
                                    <input type="date" class="form-control input-sm" id="end_date" name="end_date" required/>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="date" class="col-form-label col-sm-2">Other</label>
                                <div class="col-sm-3">
                                    <input type="text" class="form-control input-sm" id="other" name="other"placeholder="Search other..." />
                                </div>
                                <div class="col-sm-2">
                                    <button type="submit" class="btn" name="search" title="Search"><img src="https://img.icons8.com/android/24/000000/search.png"/></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <br>
            </form>
            <div class="row table-responsive">
                <div class="col">
                <table class="table table-hover table-head-fixed" id="tabelSuratkeluar">
                    <thead>
                        <tr class="bg-light">
                            <th scope="col">No.</th>
                            <th scope="col">Kode Negara</th>
                            <th scope="col">Nama Negara</th>
                            <th scope="col">Terinfeksi Covid</th>
                            <th scope="col">Berhasil Sembuh</th>
                            <th scope="col">Meninggal</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 0;?>
                        @foreach($data as $item)
                        <?php $no++ ;?>
                        <tr>
                            <td>{{$no}}</td>
                            <th>{{ $item->countryCode}}</th>
                            <th>{{ $item->countryName}}</th>
                            <th>{{ $item->confirmed}}</th>
                            <th>{{ $item->recovered}}</th>
                            <th>{{ $item->deaths}}</th>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                </div><br><br>
            <div style="height: 1000px; width: 100%">
                <h1 class="text-center text-bold">Chart Reedem Promo Code</h1>
                {!! $chart->container() !!}
                <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js" charset="utf-8"></script>
                {!! $chart->script() !!}
            </div>
        </div>
        </div>
    </section>
 @endsection

