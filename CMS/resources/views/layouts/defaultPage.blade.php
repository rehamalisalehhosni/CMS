<!DOCTYPE html>

<!--[if IE 8]>   http://ianlunn.github.io/Hover/
<html lang="en" class="ie8 no-js">
<![endif]-->
<!--[if IE 9]>
<html lang="en" class="ie9 no-js">
<![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<!-- Head BEGIN -->
<head>
    <?php
    //$setting = \App\Models\Setting::find(1);
    $locale = App::getLocale();
    $setting = \App\Models\SettingTranslation::where(['locale'=>$locale,'setting_id'=>1])->first();;

    $social = \App\Models\SocialMedia::orderby('sort','asc')->get();
    ?>
    <meta charset="utf-8">
    <title> <?php echo $setting->company_name?> </title>
    <meta content="width=device-width, initial-scale=1.0 , minimum-scale=1.0" name="viewport">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta content="" name="description">
    <meta content="" name="keywords">
    {{ Html::style('front/fonts/font-awesome/css/font-awesome.min.css')}}
    {{ Html::style('front/dist/css/bootstrap.min.css') }}
    @if(App::isLocale('ar'))
    {{ Html::style('front/dist/css/bootstrap.rtl.min.css') }}
    @endif
    {{ Html::style('front/css/jquery.mCustomScrollbar.min.css') }}
    {{ Html::style('front/css/swiper.min.css') }}
    {{ Html::style('front/css/bootstrap-select.min.css') }}
    @if(App::isLocale('ar'))
    {{ Html::style('front/css/style-rtl.css') }}
    @else
    {{ Html::style('front/css/style.css') }}
    @endif
    {{ Html::script('front/js/jquery.min.js') }}
    <link rel="shortcut icon" href="{{url('/front/fav/favicon.ico')}}" type="image/x-icon">
    <link rel="icon" href="{{url('/front/fav//favicon.ico')}}" type="image/x-icon">
</head>
<body>
    <header>
        <nav class="navbar navbar-toggleable-sm navbar-inverse fixed-top top-navigation-bar">
            <div class="navbar-collapse collapse justify-content-between align-items-center" id="navbarCollapse" aria-expanded="false">
                <a class="navbar-brand" href="{{url('/')}}/{{$locale}}">
                    <?php if($setting->logo){ ?>
                        <img src='{{url('/Uploads/setting/logo/'.$locale.'/'. $setting->logo)}}' alt="{{$setting->company_name}}" />
                    <?php }?>
                </a>
                <span class="js-nav-toggle nav-toggle"><i></i></span>
                <ul class="social d-flex align-items-center mb-0">
                    <li class='form mr-2'>
                        <form class="form-inline mt-2 mt-md-0" id="newsletter_form">
                            {{ csrf_field() }}
                            <input class="form-control" type="text" placeholder="@lang('front.email')" name="email" required id="newsletter_email">
                            <button type="submit" class="btn btn-primary my-1" role='button'>@lang('front.subscribe') </button>
                        </form>
                    </li>
                    @if(App::isLocale('ar'))
                    <li class='d-md-block d-none lang'>
                        <?php $url =str_replace("ar","en",url()->current()); ?>
                        <a href="{{$url}}" target="_self">
                            EN
                        </a>
                    </li>
                    @elseif(App::isLocale('en'))
                    <?php $url =str_replace("en","ar",url()->current()); ?>
                    <li class='d-md-block d-none lang'>
                        <a href="{{$url}}" target="_self">
                            ع
                        </a>
                    </li>
                    @endif
                    @foreach ($social as $item)
                    <li>
                        <a href="{{$item->link}}" target="_blank">
                            <i class="fa fa-{{$item->icon}}" aria-hidden="true"></i>
                        </a>
                    </li>
                    @endforeach
                </ul>
            </div>
        </nav>
        <div class='back_bg'>  </div>
        <div id="menu-offcanvas">
            <div class=" text-center mp-2 p-1 ">
                <a class="navbar-brand" href="{{url('/')}}/">
                    <?php if($setting->logo){ ?>
                        <img src='{{url('/Uploads/setting/logo/'.$locale.'/'. $setting->logo)}}' alt="{{$setting->company_name}}"/>
                    <?php }?>
                </a>
            </div>
            <ul  class='items'>
                <li> <a href="{{route('index',App::getLocale())}}" class="{{ Request::segment(2) =='' ? 'active' : '' }}">@lang('front.home') </a></li>
                <li> <a href="{{route('aboutUs.index',App::getLocale())}}" class="{{ Request::segment(2) === 'aboutUs' ? 'active' : '' }}">@lang('front.aboutUs') </a></li>
                <li> <a href="{{route('ourServices.index',App::getLocale())}}" class="{{ Request::segment(2) === 'ourServices' ? 'active' : '' }}">@lang('front.services') </a></li>
                <li> <a href="{{ route('ourProcessing.index',App::getLocale()) }}" class="{{ Request::segment(2) === 'ourProcessing' ? 'active' : '' }}">@lang('front.process') </a></li>
                <li> <a href="{{ route('ourCustomers.index',App::getLocale()) }}" class="{{ Request::segment(2) === 'ourCustomers' ? 'active' : '' }}">@lang('front.customers') </a> </li>
                <li> <a href="{{ route('contactUs.index',App::getLocale()) }}" class="{{ Request::segment(2) === 'contactUs' ? 'active' : '' }}">@lang('front.contact') </a> </li>
            </ul>
            <form action="" method="get" class="search-form my-4">
                <div class="form-group mb-0">
                    <input type="email" name="q" class='form-control' id="mail" placeholder="Email">
                    <button  type="submit" class="fa fa-send" aria-hidden="true"></button>
                </div>
            </form>
            <ul class="social list-inline">
                @if(App::isLocale('ar'))
                <li class='d-md-none d-block lang'>
                    <a href="" target="_blank">
                        EN
                    </a>
                </li>

                @elseif(App::isLocale('en'))
                <li class='d-md-none d-block lang'>
                    <a href="" target="_blank">
                        ع
                    </a>
                </li>
                @endif
                @foreach ($social as $item)
                <li>
                    <a href="{{$item->link}}" target="_blank">
                        <i class="fa fa-{{$item->icon}}" aria-hidden="true"></i>
                    </a>
                </li>
                @endforeach

            </ul>
        </div>
    </header>
    <div class='page-wrapper'>
        @yield('content')
    </div>
    <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modal" aria-hidden="true">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content ">

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>

                <div class="modal-body msg">
                    <div class='p-1 p-md-4'>
                        error :)

                    </div>
                </div>

            </div>

        </div>
    </div>


    {{ Html::script('front/dist/js/tether.min.js') }}
    {{ Html::script('front/dist/js/bootstrap.min.js') }}
    {{ Html::script('front/js/bootstrap-select.min.js') }}
    {{ Html::script('front/js/swiper.min.js') }}
    {{ Html::script('front/js/jquery.mCustomScrollbar.concat.min.js') }}
    {{ Html::script('front/js/scripts.js') }}
    <script>
    $( document ).ready(function() {
        $('#newsletter_form').submit(function(e){
            e.preventDefault();
            var _token = $('input[name="_token"]').val();
            let email =$('#newsletter_email').val();
            $.ajax({
                type:'POST',
                url:'{{ route('subscribe.add',App::getLocale()) }}',
                data:{'email':email,_token : _token },
                success:function(data){
                    console.log(data);
                    var output="";
                    if(data.status){
                        output+="<div class='text-success text-center'>";
                          output+=data.message;
                        output+="</div>";
                        $('#newsletter_email').val("");
                    }else{
                        output+="<div class='text-danger text-center'>";
                        for(var i=0;i<data.message.length;i++){
                            output+=data.message[i];
                        }
                        output+="</div>";
                    }
                    $('.msg').html(output);
                    if(!$('#modal').is(':visible')){
                        $('#modal').modal('show');
                    }
                }
            });

        })
    });

    </script>
</body>
<!-- END BODY -->
</html>
