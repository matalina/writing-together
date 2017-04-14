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
                          <img src="{{ Auth::user()->getAvatar() }}" />
                          &nbsp;<a class="profile" href="{{ route('profile.update') }}">{{ Auth::user()->name }}</a>
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
                <wt-notification class="is-success">
                   {{ \Session::get('success') }}
                 </wt-notification>
                @endif
                
                @if(\Session::has('warning'))
                <wt-notification class="is-warning">
                   {{ \Session::get('warning') }}
                 </wt-notification>
                @endif
                
                @if(\Session::has('error'))
                <wt-notification class="is-danger">
                   {{ \Session::get('error') }}
                 </wt-notification>
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
                  <small>
                    <div class="content has-text-centered">
                        Copyright &copy; 2017 
                        @if(date('Y') != '2017')
                            - {{ date('Y') }}
                        @endif
                         - All rights reserved by the original posters.  Do not reproduce others works without permission.
                    </div>
                  </small>
                </div>
            </footer>
        </div>
        
        
        <script>
          (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
          (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
          m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
          })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');
        
          ga('create', '{{ env('GOOGLE_UA_ID') }}', 'auto');
          ga('send', 'pageview');
        
        </script>
        
        <script src="https://unpkg.com/vue"></script>
        <script src="{{ url('js/main.js') }}"></script>
    </body>
</html>
