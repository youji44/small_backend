<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" type="image/png" href="{{asset('logo.svg')}}">

    <title>@yield('title') | Danske Bank</title>

    <link rel="stylesheet" href="{{ asset('backend/vendor/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/css/fontawesome-iconpicker.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/css/sb-admin-2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/vendor/datatables/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/css/toastr.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/css/jquery-ui.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/css/jquery.timepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/css/bootstrap4-toggle.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/css/spacing.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/css/style.css') }}">
    {{--<link href="https://fonts.googleapis.com/css2?family=Maven+Pro:wght@400;500;600;700&display=swap" rel="stylesheet">--}}
    @yield('header_styles')
</head>

<body id="page-top">
<!-- Page Wrapper -->
<div id="wrapper">
@include('admin.menu')
<!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">
        <!-- Main Content -->
        <div id="content">
        @include('admin.header')
        <!-- Begin Page Content -->
            <div class="container-fluid">
                @yield('admin_content')
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- End of Main Content -->
    </div>
    <!-- End of Content Wrapper -->
    <audio id="sound1" src="{{asset('sound/sound1.mp3')}}" style="display: none;"></audio>
    <audio id="sound2" src="{{asset('sound/sound2.mp3')}}" style="display: none;"></audio>
</div>
<!-- End of Page Wrapper -->
<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top"><i class="fas fa-angle-up"></i></a>
</body>
<script src="{{ asset('backend/vendor/jquery/jquery-3.6.0.min.js') }}"></script>
<script src="{{ asset('backend/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('backend/vendor/jquery-easing/jquery.easing.min.js') }}"></script>
<script src="{{ asset('backend/vendor/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('backend/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('backend/js/demo/datatables-demo.js') }}"></script>
<script src="{{ asset('backend/js/toastr.min.js') }}"></script>
<script src="{{ asset('backend/js/jscolor.js') }}"></script>
<script src="{{ asset('backend/js/jquery.timepicker.js') }}"></script>
<script src="{{ asset('backend/js/jquery-ui.js') }}"></script>
<script src="{{ asset('backend/js/select2.min.js') }}"></script>
<script src="{{ asset('backend/js/bootstrap4-toggle.min.js') }}"></script>
<script src="{{ asset('backend/js/fontawesome-iconpicker.js') }}"></script>

<script src="{{ asset('backend/js/sb-admin-2.min.js') }}"></script>
<script src="{{ asset('backend/js/custom.js') }}"></script>

{{--<script src="{{ asset('js/app.js') }}"></script>--}}
@include('notification')
@yield('footer_scripts')

<script>
    const sound1 = document.getElementById("sound1");
    const sound2 = document.getElementById("sound2");
    check('','');
    function check(visit_cnt, store_cnt) {
        $.ajax({
            type:'POST',
            url:'{{route('user.check')}}',
            data:{_token:'{{csrf_token()}}', visit:visit_cnt,store:store_cnt},
            success:function(result){
                if(result.visitor){
                    toastr.success('A User is visiting');
                    sound1.play().then(() => {}).catch((error)=>{});
                }
                if(result.store){
                    toastr.success('A User login');
                    sound2.play().then(() => {}).catch((error)=>{});
                }
                store_cnt = result.store_count;
                visit_cnt = result.visit_count;
                setTimeout(function () {
                    check(result.visit_count, result.store_count);
                }, 3000);

            },error:function (e) {
                console.log(e.message())
            }});
    }

    function update(value,id) {
        $("#enable-"+id).val(value);
        $("#form-status-"+id).submit();
    }

</script>
</html>
