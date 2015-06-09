<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
    <!--<![endif]-->
    <!-- BEGIN HEAD -->
    <head>
        <meta charset="utf-8" />
        <title>{{Config::get('app.title')}}</title>
        <meta content="width=device-width, initial-scale=1.0" name="viewport" />
        <meta content="" name="description" />
        <meta content="" name="author" />
        <!-- BEGIN GLOBAL MANDATORY STYLES -->
        {{HTML::style('assets/css/style.default.css')}}
        {{HTML::style('assets/css/jquery.datatables.css')}}        
        {{HTML::style('assets/bootstrap-modal/css/bootstrap-modal-bs3patch.css')}}
        {{HTML::style('assets/bootstrap-modal/css/bootstrap-modal.css')}}        
        {{HTML::style('assets/css/jquery.fileupload.css')}}
        {{HTML::style('assets/css/jquery.fileupload-ui.css')}}
        {{HTML::style('assets/css/jquery.fileupload-noscript.css')}}
        {{HTML::style('assets/css/jquery.fileupload-ui-noscript.css')}}
    </head>
    <!-- END HEAD -->
    <!-- BEGIN BODY -->
    @section('body')
    <body class="page-header-fixed page-full-width">

        <div id="preloader">
            <div id="status">
                <i class="fa fa-spinner fa-spin"></i>
            </div>
        </div>
        <section>
            <div class="leftpanel">
                <div class="logopanel">
                    <h1><span>[</span> {{Config::get('app.title')}} <span>]</span></h1>
                </div><!-- logopanel -->
                <div class="leftpanelinner">
                    @section('nav')
                    @include('home.admin_nav')
                    @show
                </div>
            </div>
            <div class="mainpanel">
                @section('admin-header')
                @include('home.header')
                @show
                @yield('pageContainer')
            </div>

        </section>

        {{HTML::script('assets/js/jquery-1.10.2.min.js')}}
        {{HTML::script('assets/js/jquery-migrate-1.2.1.min.js')}}
        {{HTML::script('assets/js/jquery-ui-1.10.3.min.js')}}
        {{HTML::script('assets/js/bootstrap.min.js')}}
        {{HTML::script('assets/js/retina.min.js')}}
        <!-- END CORE PLUGINS -->
        <!-- BEGIN PAGE LEVEL PLUGINS -->

        {{HTML::script('assets/js/morris.min.js')}}
        {{HTML::script('assets/js/raphael-2.1.0.min.js')}}
        {{HTML::script('assets/js/jquery.datatables.min.js')}}
        {{HTML::script('assets/js/chosen.jquery.min.js')}}
        {{HTML::script('assets/js/custom.js')}}

        {{HTML::script('assets/js/jquery.sparkline.min.js')}}
        {{HTML::script('assets/js/jquery.cookies.js')}}
        {{HTML::script('assets/bootstrap-modal/js/bootstrap-modalmanager.js')}}
        {{HTML::script('assets/bootstrap-modal/js/bootstrap-modal.js')}}
        {{HTML::script('assets/js/ui-extended-modals.js')}}
        {{HTML::script('assets/js/jquery.fileupload.js')}}
        {{HTML::script('assets/js/jquery.validate.min.js')}}

        {{HTML::script('assets/js/toggles.min.js')}}
        {{HTML::script('assets/js/jquery.validate.min.js')}}
        {{HTML::script('assets/js/additional-methods.min.js')}}
        {{HTML::script('assets/js/app.js')}}

        @yield('javaScript')
    </body>
    <!-- END BODY -->
</html>