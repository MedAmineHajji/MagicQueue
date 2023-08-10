@extends('layout')

@section('content')
<section class="vh-100" >
    <div class="container py-5 h-100">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-12 col-md-8 col-lg-6 col-xl-5">
          <div class="card shadow-2-strong" style="border-radius: 1rem;">
            <div class="card-body p-5 text-center">
  
              <h3 class="mb-5">Sign in</h3>
              <form method="POST" action="/admin/authenticate">
                @csrf
                <div class="form-outline mb-4">
                    <input type="text" id="typeEmailX-2" class="form-control form-control-lg" name="username"/>
                    @error('username')
                        <p class="text-red-500 text-xs mt-1">
                            {{$message}}
                        </p>
                    @enderror
                    <label class="form-label" for="typeEmailX-2">Username</label>
                </div>
    
                <div class="form-outline mb-4">
                    <input type="password" id="typePasswordX-2" class="form-control form-control-lg" name="password"/>
                    @error('password')
                        <p class="text-red-500 text-xs mt-1">
                            {{$message}}
                        </p>
                    @enderror
                    <label class="form-label" for="typePasswordX-2">Password</label>
                </div>
    
    
                <button class="btn btn-primary btn-lg btn-block" type="submit">Login</button>
              </form>
  
              <hr class="my-4">
  
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection