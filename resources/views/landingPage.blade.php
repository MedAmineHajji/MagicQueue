@extends('layout')

@section('content')
    <!-- Background image -->
    
          <div class="container d-flex align-items-center justify-content-center text-center h-100">
            <div class="text-white">
              <h1 class="mb-3">Welcome To Magic Queue Dashboard</h1>
              <h5 class="mb-4">ticket personalization</h5>
              @auth
                <a class="btn btn-outline-light btn-lg m-2" href="/dashboard" role="button"
                rel="nofollow" target="_blank">Dashboard</a>
                <a class="btn btn-outline-light btn-lg m-2" href="/view" target="_blank"
                role="button">View Ticket</a>
              @else
                <a class="btn btn-outline-light btn-lg m-2" href="/dashboard/login" role="button"
                  rel="nofollow" target="_blank">Log In</a>
                <a class="btn btn-outline-light btn-lg m-2" href="/view" target="_blank"
                  role="button">View Ticket</a>
              @endauth
            </div>
          </div>
    <!-- Background image -->
@endsection