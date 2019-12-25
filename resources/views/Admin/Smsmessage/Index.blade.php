@extends('Admin.PublicItems');

@section('content')

    <section class="content">
        <div class="row">
            <div class="col-12">

                <!-- /.card -->

                <div class="card">
                    <div class="card-header" style="
    display: flex;
    justify-content: space-between;
">


                        <a href="{{ route('Categories.create') }}">

                            <button type="button" class="btn btn-primary btn-lg">NEW</button>
                        </a>
                        @if (session('success'))
                            <div class="alert alert-success alert-dismissible" style="
    height: 50px;
">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                <h5><i class="icon fa fa-check"></i> {{ session('success') }}</h5>
                            </div>
                        @endif
                    </div>
                    <!-- /.card-header -->


                    <form enctype="multipart/form-data" role="form" action="{{ route('Sms.store') }}" method="POST">

                        {{ csrf_field() }}

                        <div class="card-body">


                                <!-- /.form group -->

                                <!-- phone mask -->
                                <div class="form-group">
                                    <label>قالب شماره همراه</label>

                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fa fa-phone"></i></span>
                                        </div>
                                        <input type="text" name="PhoneNumber" class="form-control ltr" data-inputmask='"mask": "9999-999-9999"' data-mask>
                                    </div>
                                    <!-- /.input group -->
                                </div>
                                <!-- /.form group -->

                                <div class="form-group">
                                    <label>متن</label>
                                    <textarea name="MessageBody" class="form-control" rows="3" placeholder="وارد کردن اطلاعات ..."></textarea>
                                </div>



                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">ارسال</button>
                            </div>
                        </form>




                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>

@endsection

@section('scriptJs')
    <script src="{{URL::asset('TemplateAsset/plugins/jquery/jquery.min.js')}}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ URL::asset('TemplateAsset/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>


    <script src="{{ URL::asset('TemplateAsset/plugins/input-mask/jquery.inputmask.js')}}"></script>



    <!-- DataTables -->
    <script src="{{URL::asset('TemplateAsset/plugins/datatables/jquery.dataTables.js')}}"></script>
    <script src="{{URL::asset('TemplateAsset/plugins/datatables/dataTables.bootstrap4.js')}}"></script>
    <!-- SlimScroll -->
    <script src="{{URL::asset('TemplateAsset/plugins/slimScroll/jquery.slimscroll.min.js')}}"></script>
    <!-- FastClick -->
    <script src="{{URL::asset('TemplateAsset/plugins/fastclick/fastclick.js')}}"></script>
    <!-- AdminLTE App -->
    <script src="{{URL::asset('TemplateAsset/dist/js/adminlte.min.js')}}"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="{{URL::asset('TemplateAsset/dist/js/demo.js')}}"></script>
    <!-- page script -->


    <script>
        $(function () {
            //Initialize Select2 Elements


            $('[data-mask]').inputmask()

            //iCheck for checkbox and radio inputs




        })
    </script>


@endsection

@section('stylesheet')
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css')">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="{{URL::asset('TemplateAsset/plugins/datatables/dataTables.bootstrap4.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{URL::asset('TemplateAsset/dist/css/adminlte.min.css')}}">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet')}}">

    <!-- bootstrap rtl -->
    <link rel="stylesheet" href="{{URL::asset('TemplateAsset/dist/css/bootstrap-rtl.min.css')}}">
    <!-- template rtl version -->
    <link rel="stylesheet" href="{{URL::asset('TemplateAsset/dist/css/custom-style.css')}}">
@endsection
