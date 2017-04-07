<!doctype html>
<html lang="en">
    <head>
        <title>Write Together</title>
        <meta charset="UTF-8" />
        
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.4.0/css/bulma.css" />
        <style>
            
        </style>
    </head>
    <body>
        <div id="app">
            <header>
                <nav class="nav">
                  <div class="nav-left">
                    <a class="nav-item">
                      Write Together
                    </a>
                  </div>
                
                  <div class="nav-right nav-menu">
                    @if(\Auth::check())
                        @if(\Route::current()->getName() == 'view')
                        <span class="nav-item">
                          <a class="button" >
                            <span class="icon">
                              <i class="fa fa-plus-square-o"></i>
                            </span>
                            <span>New Reply</span>
                          </a>
                        </span>
                        @elsif(\Route::current()->getName() != 'new')
                        <span class="nav-item">
                          <a class="button" >
                            <span class="icon">
                              <i class="fa fa-plus-square-o"></i>
                            </span>
                            <span>New Thread</span>
                          </a>
                        </span>
                        @endif
                    @else 
                    <span class="nav-item">
                      <a class="button" >
                        <span class="icon">
                          <i class="fa fa-twitter"></i>
                        </span>
                        <span>Login</span>
                      </a>
                    </span>
                    
                    <span class="nav-item">
                      <a class="button" >
                        <span class="icon">
                          <i class="fa fa-facebook"></i>
                        </span>
                        <span>Login</span>
                      </a>
                    </span>
                    
                    <span class="nav-item">
                      <a class="button" >
                        <span class="icon">
                          <i class="fa fa-google"></i>
                        </span>
                        <span>Login</span>
                      </a>
                    </span>
                    
                    <span class="nav-item">
                      <a class="button" >
                        <span class="icon">
                          <i class="fa fa-wordpress"></i>
                        </span>
                        <span>Login</span>
                      </a>
                    </span>
                    @endif
                  </div>
                </nav>
            </header>
            <main>
                @yield('content')
            </main>
            <footer class="footer">
                <div class="container">
                    <div class="content has-text-centered">
                        Copyright &copy; 2017 
                        @if(date('Y') != '2017')
                            - {{ date('Y') }}
                        @endif
                         - All rights reserved by the original posters.  Do not reproduce others works without permission.
                    </div>
                </div>
            </footer>
        </div>
    </body>
</html>
