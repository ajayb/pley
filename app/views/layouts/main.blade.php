<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        @section('title')
        <title>{{{$title}}}</title>
        @show
        {{ HTML::style(Config::get('app.cdn_path').'packages/bootstrap/css/bootstrap.min.css') }}
        {{ HTML::style(Config::get('app.cdn_path').'css/main.css')}}
        {{ HTML::style(Config::get('app.cdn_path').'packages/bootstrap/css/bootstrap-responsive.css') }} 
        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
          <script src="http://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.6.2/html5shiv.js"></script>
          <script src="http://cdnjs.cloudflare.com/ajax/libs/respond.js/1.2.0/respond.js"></script>
        <![endif]-->
    </head>

    <body>
        <div class="navbar navbar-inverse navbar-fixed-top">
            <div class="navbar-inner">
                <div class="container">
                    <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <a class="brand" href="/"><img src="{{asset(Config::get('app.cdn_path').'images/logo-original.png')}}"></a>
                    <div class="nav-collapse collapse">
                        <ul class="nav">
                            @if(!Auth::check())
                            <li><a href="users/register" data-keyboard="true" data-toggle="modal" data-target="#myModal">Register</a></li>   
                            <li><a href="users/login"  data-keyboard="true" data-toggle="modal" data-target="#myModal">Login</a></li>   
                            @else
                            <li>{{ HTML::link('users/logout', 'logout') }}</li>
                            @endif
                        </ul>
                    </div><!--/.nav-collapse -->
                </div>
            </div>
            <div class="teeth"></div>
        </div>
        <div class="container">
            @if(Session::has('message'))
            <p class="alert">{{ Session::get('message') }}</p>
            @endif

            {{ $content }}
        </div>
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content"></div>
            </div>
        </div>
        <div id="footer"> 
            <footer>
                <div class="container123">
                    <div class="row">
                        <p class="copyright">
                            &copy; {{date('Y')}} Pley&nbsp;&nbsp;|&nbsp;&nbsp;<a href="#">Terms &amp; Privacy Policy</a>
                        </p>
                    </div>
                </div>  
            </footer>
        </div>        
        {{ HTML::script(Config::get('app.cdn_path').'js/jquery.min.js') }}
        {{ HTML::script(Config::get('app.cdn_path').'packages/bootstrap/js/bootstrap.min.js') }}
        {{ HTML::script(Config::get('app.cdn_path').'js/main.js') }}
        
        <script type="text/javascript">
            $(document).ready(function() {
                $('body').on('hidden.bs.modal', '.modal', function() {
                    $(this).removeData('bs.modal');
                });
            });
        </script>
    </body>
</html>