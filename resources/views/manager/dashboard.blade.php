@extends('layouts.layoutmanager')
<script src="{{asset('js/callapi/manager/premium_feature/premium.js')}}"></script>
<style>
     .input-link-lifetime{
            height: 40px;
            text-align: center;
            border-radius: 5px;
            border: 1px solid #858585;
            font-size: 26px;
            background: var(--light);
            color: var(--dark);
            width: 100px;
            font-weight: 700;
        }
</style>
<title>Dashboard</title>
@section('content')
        <div class="header">
            <div class="left">
                <h1>Dashboard</h1>
                <ul class="breadcrumb">
                    {{-- <li><a href="#">
                            Analytics
                        </a></li>
                    /
                    <li><a href="#" class="active">Shop</a></li> --}}
                </ul>
            </div>
            {{-- <a href="#" class="report">
                <i class='bx bx-cloud-download'></i>
                <span>Download CSV</span>
            </a> --}}
            <button class="report">
                <i class='bx bx-check-double' ></i>
                <span>Save</span>
            </button>
        </div>

        <!-- Insights -->
        <ul class="insights">
            <li>
                <i class='bx bx-timer' ></i>
                <span class="info">
                    <h3>
                        <input class="input-link-lifetime" type="text" name="EXPIRED_SHORT_LINK_AUTH"  value="{{config("setting.EXPIRED_SHORT_LINK_AUTH")}}" placeholder="x day">
                    </h3>
                    <p>Link Lifespan</p>
                </span>
            </li>
            <li>
                <i class='bx bx-timer' ></i>
                <span class="info">
                    <h3>
                        <input class="input-link-lifetime" type="text" name="EXPIRED_SHORT_LINK_DEFAULT" value="{{config("setting.EXPIRED_SHORT_LINK_DEFAULT")}}" placeholder="x day">
                    </h3>
                    <p>Default Link Lifespan</p>
                </span>
            </li>
            <li><i class='bx bx-line-chart'></i>
                <span class="info">
                    <h3>
                        {{$tatol_clicks}}
                    </h3>
                    <p>Total Clicks</p>
                </span>
            </li>
            {{-- <li><i class='bx bx-dollar-circle'></i>
                <span class="info">
                    <h3>
                        $6,742
                    </h3>
                    <p>Total Sales</p>
                </span>
            </li> --}}
        </ul>
        <!-- End of Insights -->

        <div class="bottom-data">
            <div class="orders">
                <div class="header">
                    <i class='bx bx-receipt'></i>
                    <a href="{{route("web.manager-premium-index")}}"><h3>Premiums</h3></a>
                    <i class='bx bx-filter'></i>
                    <a href="{{route("web.manager-premium-create")}}" class="btn btn-secondary"> <i class='bx bx-plus'></i></a>
                </div>
                <table>
                    <thead>
                        <tr>
                            <th>Name</th>                            
                            <th>Title</th>                            
                            <th>Level</th>                                                                                                          
                        </tr>
                    </thead>
                    <tbody id="body-show-premium">
                        {{-- <tr>
                            <td>
                                <img src="images/profile-1.jpg">
                                <p>John Doe</p>
                            </td>
                            <td>14-08-2023</td>
                            <td><span class="status completed">Completed</span></td>
                        </tr>
                        <tr>
                            <td>
                                <img src="images/profile-1.jpg">
                                <p>John Doe</p>
                            </td>
                            <td>14-08-2023</td>
                            <td><span class="status pending">Pending</span></td>
                        </tr>
                        <tr>
                            <td>
                                <img src="images/profile-1.jpg">
                                <p>John Doe</p>
                            </td>
                            <td>14-08-2023</td>
                            <td><span class="status process">Processing</span></td>
                        </tr> --}}
                    </tbody>
                </table>
            </div>

            <!-- Reminders -->
            <div class="reminders">
                <div class="header">
                    <i class='bx bx-note'></i>
                    <h3>Remiders</h3>
                    <i class='bx bx-filter'></i>
                    <i class='bx bx-plus'></i>
                </div>
                <ul class="task-list">
                    <li class="completed">
                        <div class="task-title">
                            <i class='bx bx-check-circle'></i>
                            <p>Start Our Meeting</p>
                        </div>
                        <i class='bx bx-dots-vertical-rounded'></i>
                    </li>
                    <li class="completed">
                        <div class="task-title">
                            <i class='bx bx-check-circle'></i>
                            <p>Analyse Our Site</p>
                        </div>
                        <i class='bx bx-dots-vertical-rounded'></i>
                    </li>
                    <li class="not-completed">
                        <div class="task-title">
                            <i class='bx bx-x-circle'></i>
                            <p>Play Footbal</p>
                        </div>
                        <i class='bx bx-dots-vertical-rounded'></i>
                    </li>
                </ul>
            </div>

            <!-- End of Reminders-->

        </div>
<script src="{{asset("js/handle/manager/dashboard.js")}}"></script>
@endsection

