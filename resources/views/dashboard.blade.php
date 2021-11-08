@extends('layouts.master')
@section('content')
<section class="content card" style="padding: 10px 10px 10px 10px ">
    <div class="box">
        <div class="row">
            <div class="col">
                <center>
                    <h3 class="font-weight-bold">Management Referral Code</h3>
                    <hr />
                </center>
                <br>
            </div>
        </div>

        <div class="row">
            <div class="card-body">
                <!-- Small boxes (Stat box) -->
                <div class="filter-container p-0 row">
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-light">
                            <div class="inner">
                                <h3>{{DB::table('referral')->count()}}</h3>
                                <p>Referral Promo <br> Code</p>
                            </div>
                            <div class="icon">
                                <i class="nav-icon fas fa-envelope-open-text"></i>
                            </div>
                            <a href="/referral/index" class="small-box-footer bg-orange">Lihat Detail <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-light">
                            <div class="inner">
                                <h3>{{DB::table('referral_agent')->count()}}</h3>
                                <p>Referral Agent <br> Internal Code</p>
                            </div>
                            <div class="icon">
                                <i class="nav-icon fas fa-envelope"></i>
                            </div>
                            <a href="/referralagent/index" class="small-box-footer bg-orange">Lihat Detail <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-light">
                            <div class="inner">
                                <h3>{{DB::table('referral_ext')->count()}}</h3>
                                <p>Referral Agent <br> External Code</p>
                            </div>
                            <div class="icon">
                                <i class="nav-icon fas fa-layer-group"></i>
                            </div>
                            <a href="/referralext/index" class="small-box-footer bg-orange">Lihat Detail <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->
                    @if (auth()->user()->role == 'admin')
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-light">
                            <div class="inner">
                                <h3>{{DB::table('users')->count()}}</h3>
                                <p>Management <br> Pengguna</p>
                            </div>
                            <div class="icon">
                                <i class="nav-icon fas fa-user"></i>
                            </div>
                            <a href="{{ route('pengguna.index') }}" class="small-box-footer bg-orange">Lihat Detail <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    @endif
                    <!-- ./col -->
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
