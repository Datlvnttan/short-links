@extends('layouts.layoutmanager')
@section('content')
<link href="{{ asset('css/library/tab.css') }}" rel="stylesheet">
<div class="card">
    <div class="card-body">
      <ul class="navbar">
        <li>
          <a class="tab active" data-id="home">
            <span class="icon"><i class="fas fa-home"></i></span>
            <span class="text">ALL</span>
          </a>
        </li>
        <li>
          <a class="tab" data-id="profile">
            <span class="icon"><i class="fas fa-user"></i></span>
            <span class="text">Still in use</span>
          </a>
        </li>
        <li>
          <a  class="tab" data-id="messages">
            <span class="icon"><i class="far fa-envelope"></i></span>
            <span class="text">Coming soon</span>
          </a>
        </li>
        <li>
            <a class="tab" data-id="settings">
              <span class="icon"><i class="fas fa-cog"></i></span>
              <span class="text">Not enough visits</span>
            </a>
        </li>
        <li>
          <a class="tab" data-id="settings">
            <span class="icon"><i class="fas fa-cog"></i></span>
            <span class="text">Expired</span>
          </a>
        </li>       
      </ul>

      <div class="tab-content">
        <div class="tab-pane active" id="home">          
        </div>
        <div class="tab-pane" id="profile">          
        </div>
        <div class="tab-pane" id="messages">          
        </div>
        <div class="tab-pane" id="settings">          
        </div>
        <div class="tab-pane" id="">            
          </div>
      </div>
    </div>
</div>


  <script src="{{asset("js/library/tab.js")}}"></script>

@endsection


