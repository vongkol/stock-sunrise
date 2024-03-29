@extends('layouts.master')
@section('header')
    <strong><i class="fa fa-home"></i> Dashboard</strong>
@endsection
@section('content')
    <div class="row sameheight-container">
        <div class="col col-12 col-sm-12 col-md-6 col-xl-5 stats-col">
            <div class="card sameheight-item stats" data-exclude="xs">
                <div class="card-block">
                    <div class="title-block">
                        <h4 class="title"> Stats </h4>
                        <p class="title-description"> Website metrics for <a href="http://modularteam.github.io/modularity-free-admin-dashboard-theme-html/"> your awesome project </a>
                        </p>
                    </div>
                    <div class="row row-sm stats-container">
                        <div class="col-12 col-sm-6 stat-col">
                            <div class="stat-icon">
                                <i class="fa fa-rocket"></i>
                            </div>
                            <div class="stat">
                                <div class="value"> 5407 </div>
                                <div class="name"> Active items </div>
                            </div>
                            <div class="progress stat-progress">
                                <div class="progress-bar" style="width: 75%;"></div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6 stat-col">
                            <div class="stat-icon">
                                <i class="fa fa-shopping-cart"></i>
                            </div>
                            <div class="stat">
                                <div class="value"> 78464 </div>
                                <div class="name"> Items sold </div>
                            </div>
                            <div class="progress stat-progress">
                                <div class="progress-bar" style="width: 25%;"></div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6  stat-col">
                            <div class="stat-icon">
                                <i class="fa fa-line-chart"></i>
                            </div>
                            <div class="stat">
                                <div class="value"> $80.560 </div>
                                <div class="name"> Monthly income </div>
                            </div>
                            <div class="progress stat-progress">
                                <div class="progress-bar" style="width: 60%;"></div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6  stat-col">
                            <div class="stat-icon">
                                <i class="fa fa-users"></i>
                            </div>
                            <div class="stat">
                                <div class="value"> 359 </div>
                                <div class="name"> Total users </div>
                            </div>
                            <div class="progress stat-progress">
                                <div class="progress-bar" style="width: 34%;"></div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6  stat-col">
                            <div class="stat-icon">
                                <i class="fa fa-list-alt"></i>
                            </div>
                            <div class="stat">
                                <div class="value"> 59 </div>
                                <div class="name"> Tickets closed </div>
                            </div>
                            <div class="progress stat-progress">
                                <div class="progress-bar" style="width: 49%;"></div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6 stat-col">
                            <div class="stat-icon">
                                <i class="fa fa-dollar"></i>
                            </div>
                            <div class="stat">
                                <div class="value"> $780.064 </div>
                                <div class="name"> Total income </div>
                            </div>
                            <div class="progress stat-progress">
                                <div class="progress-bar" style="width: 15%;"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col col-12 col-sm-12 col-md-6 col-xl-7 history-col">
            <div class="card sameheight-item" data-exclude="xs" id="dashboard-history">
                <div class="card-header card-header-sm bordered">
                    <div class="header-block">
                        <h3 class="title">History</h3>
                    </div>
                    <ul class="nav nav-tabs pull-right" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" href="#visits" role="tab" data-toggle="tab">Visits</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#downloads" role="tab" data-toggle="tab">Downloads</a>
                        </li>
                    </ul>
                </div>
                <div class="card-block">
                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane active fade show" id="visits">
                            <p class="title-description"> Number of unique visits last 30 days </p>
                            <div id="dashboard-visits-chart"></div>
                        </div>
                        <div role="tabpanel" class="tab-pane fade" id="downloads">
                            <p class="title-description"> Number of downloads last 30 days </p>
                            <div id="dashboard-downloads-chart"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection