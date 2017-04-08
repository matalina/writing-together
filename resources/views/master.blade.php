<!doctype html>
<html lang="en">
    <head>
        <title>Write Together</title>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="{{ url('css/app.css') }}" />
        <style>
            
        </style>
    </head>
    <body>
        <div id="app">
            <header>
                <nav class="nav">
                  <div class="nav-left">
                    <a class="nav-item" href="{{ route('home') }}">
                      Write Together
                    </a>
                  </div>
                
                  <div class="nav-right">
                    @if(\Auth::check())
                        <span class="nav-item">
                          Welcome back, 
                          <a href="{{ route('profile.update') }}">{{ Auth::user()->name }}</a>
                        </span>
                        <span class="nav-item">
                          <a class="button" href="{{ route('logout') }}">
                            <span class="icon">
                              <i class="fa fa-sign-out"></i>
                            </span>
                            <span>Logout</span>
                          </a>
                        </span>
                        <span class="nav-item">
                          <a class="button is-primary" href="{{ route('new') }}">
                            <span class="icon">
                              <i class="fa fa-plus-square-o"></i>
                            </span>
                            <span>New Thread</span>
                          </a>
                        </span>
                    @else 
                    <span class="nav-item">
                      <a class="button" href="{{route('login', ['provider' => 'twitter']) }}">
                        <span class="icon">
                          <i class="fa fa-twitter"></i>
                        </span>
                        <span>Login</span>
                      </a>
                    </span>
                    
                    <span class="nav-item">
                      <a class="button" href="{{route('login', ['provider' => 'facebook']) }}">
                        <span class="icon">
                          <i class="fa fa-facebook"></i>
                        </span>
                        <span>Login</span>
                      </a>
                    </span>
                    
                    <span class="nav-item">
                      <a class="button" href="{{route('login', ['provider' => 'google']) }}">
                        <span class="icon">
                          <i class="fa fa-google"></i>
                        </span>
                        <span>Login</span>
                      </a>
                    </span>
                    
                    <span class="nav-item">
                      <a class="button" href="{{route('login', ['provider' => 'wordpress']) }}">
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
            
            <div class="container">
                @if(\Session::has('success'))
                <div class="notification is-success">
                  <button class="delete"></button>
                 {{ \Session::get('success') }}
                </div>
                @endif
                
                @if(\Session::has('warning'))
                <div class="notification is-success">
                  <button class="delete"></button>
                 {{ \Session::get('warning') }}
                </div>
                @endif
                
                @if(\Session::has('error'))
                <div class="notification is-success">
                  <button class="delete"></button>
                 {{ \Session::get('error') }}
                </div>
                @endif
              </div>
            
            <main class="container">
                @yield('content')
            </main>
            <div class="column content has-text-right">
                {{ printDate(Carbon\Carbon::now()) }}
            </div>
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
