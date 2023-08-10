<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>MagicQueue</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
        <!-- Font Awesome -->
        <link
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
        rel="stylesheet"
        />
        <!-- Google Fonts -->
        <link
        href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap"
        rel="stylesheet"
        />
        <!-- MDB -->
        <link
        href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.4.1/mdb.min.css"
        rel="stylesheet"
        />
        <!-- MDB -->
        <script
        type="text/javascript"
        src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.4.1/mdb.min.js"
        ></script>
    </head>
  <body>
    
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta http-equiv="x-ua-compatible" content="ie=edge" />
        <title>Material Design for Bootstrap</title>
        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css" />
        <!-- Google Fonts Roboto -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" />
        
        <!-- Custom styles -->
        {{-- <link rel="stylesheet" href="css/style.css" /> --}}

        <style>
            #intro {
                background-image: url("#");
                height: 100vh;
            }
    
          /* Height for devices larger than 576px */
          @media (min-width: 992px) {
            #intro {
              margin-top: -58.59px;
            }
          }
    
          .navbar .nav-link {
            color: #fff !important;
          }
        </style>
    </head>
    <body>
          <!--Main Navigation-->
      <header>
    
        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg navbar-dark d-none d-lg-block" style="z-index: 2000;">
          <div class="container-fluid">
            <!-- Navbar brand -->
            <a class="navbar-brand nav-link" target="_blank" href="/">
              <strong>Magic Queue</strong>
            </a>
            <button class="navbar-toggler" type="button" data-mdb-toggle="collapse" data-mdb-target="#navbarExample01"
              aria-controls="navbarExample01" aria-expanded="false" aria-label="Toggle navigation">
              <i class="fas fa-bars"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarExample01">
              <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                @auth
                    <a class="nav-link" aria-current="page" href="/dashboard">Dashboard</a>
                    <li class="nav-item">
                      <a class="nav-link" href="/view" rel="nofollow"
                        target="_blank">View Ticket</a>
                    </li>
                    <form method="POST" action="/admin/logout">
                      @csrf
                      <button type="submit" class="nav-link">
                        logout
                      </button>
                    </form>
                @else 
                  <li class="nav-item active">
                    <a class="nav-link" aria-current="page" href="/dashboard/login">Log In</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="/view" rel="nofollow"
                      target="_blank">View Ticket</a>
                  </li>
                @endauth
              </ul>
            </div>
          </div>
        </nav>
        <!-- Navbar -->
      </header>
      <!--Main Navigation-->
        <main>
            <div id="intro" class="bg-image shadow-2-strong">
                <div class="mask" style="background-color: rgba(0, 0, 0, 0.8);">
                    @yield('content')
                </div>
            </div>
        </main>
      <!--Main Navigation-->
      <!--Footer-->
      <footer class="bg-light text-lg-start">
    
        <!-- Copyright -->
        <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">
          © 2023 Copyright:
          <a class="text-dark" href="https://www.digika.tn/">Digika</a>
        </div>
        <!-- Copyright -->
      </footer>
      <!--Footer-->
        <!-- MDB -->
        {{-- <script type="text/javascript" src="js/mdb.min.js"></script> --}}
        <!-- Custom scripts -->
        {{-- <script type="text/javascript" src="js/script.js"></script> --}}
    </body>
    </html>
    
</body>
</html>