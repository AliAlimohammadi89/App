@extends('Admin.PublicItems');

@section('content')

    <?php
//       dd(\App\product::All())
    ?>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- left column -->
                <div class="col-md-6">
                    <!-- general form elements -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">اضافه کردن محصول</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form enctype="multipart/form-data"  role="form" action="{{ route('Experts.store') }}" method="POST">
                            {{ csrf_field() }}

                            <div class="card-body">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">عنوان محصول</label>
                                    <input type="text" class="form-control" name="title" placeholder="عنوان را وارد کنید">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">قیمت محصول</label>
                                    <input type="text" class="form-control" name="price" placeholder="قیمت را وارد کنید">
                                </div>
                                <div class="form-group">
                                    <label>توضیحات محصول</label>
                                    <textarea class="form-control" rows="3" name="description" placeholder="وارد کردن توضیحات ..."></textarea>
                                </div>

                                <div class="form-group">
                                    <label>چند انتخابی</label>
                                    <select name="product[]" multiple="" id="product" class="form-control">

                                       @foreach(\App\product::all() as $product)

                                        <option value="{{$product->id}}" >{{$product->title}}</option>

                                        @endforeach

                                    </select>
                                </div>


                                <div class="form-group">
                                    <label for="exampleInputFile">ارسال فایل</label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" name="image" class="custom-file-input" id="exampleInputFile">
                                            <label class="custom-file-label" for="exampleInputFile">انتخاب فایل</label>
                                        </div>
                                        <div class="input-group-append">
                                            <span class="input-group-text" id="">Upload</span>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">ثبت</button>
                            </div>
                        </form>
                    </div>
                    <!-- /.card -->



                </div>
                <!--/.col (left) -->
                <!-- right column -->

                <!--/.col (right) -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>

@endsection

@section('scriptJs')
{{--     <script type="text/javascript" src="{{URL::asset('../TemplateAsset/plugins/jquery/jquery.min.js')}}"></script>--}}
    <script type="text/javascript" src="{{URL::asset('TemplateAsset/plugins/jquery/jquery.min.js')}}')}}"></script>

    <!-- Bootstrap 4 -->
     <script type="text/javascript" src="{{URL::asset('TemplateAsset/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <!-- DataTables -->
     <script type="text/javascript" src="{{URL::asset('TemplateAsset/plugins/datatables/jquery.dataTables.js')}}"></script>
     <script type="text/javascript" src="{{URL::asset('TemplateAsset/plugins/datatables/dataTables.bootstrap4.js')}}"></script>
    <!-- SlimScroll -->
     <script type="text/javascript" src="{{URL::asset('TemplateAsset/plugins/slimScroll/jquery.slimscroll.min.js')}}"></script>
    <!-- FastClick -->
     <script type="text/javascript" src="{{URL::asset('TemplateAsset/plugins/fastclick/fastclick.js')}}"></script>
    <!-- AdminLTE App -->
     <script type="text/javascript" src="{{URL::asset('TemplateAsset/dist/js/adminlte.min.js')}}"></script>
    <!-- AdminLTE for demo purposes -->
     <script type="text/javascript" src="{{URL::asset('TemplateAsset/dist/js/demo.js')}}"></script>
    <!-- page script -->
    <script>
        $(function () {
            $("#example1").DataTable({
                "language": {
                    "paginate": {
                        "next": "بعدی",
                        "previous": "قبلی"
                    }
                },
                "info": false,
            });
            $('#example2').DataTable({
                "language": {
                    "paginate": {
                        "next": "بعدی",
                        "previous": "قبلی"
                    }
                },
                "info": false,
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "autoWidth": false
            });
        });
    </script>

@endsection

@section('stylesheet')
    <!-- Font Awesome -->
{{--    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">--}}
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="{{URL::asset('TemplateAsset/plugins/datatables/dataTables.bootstrap4.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{URL::asset('TemplateAsset/dist/css/adminlte.min.css')}}">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

    <!-- bootstrap rtl -->
    <link rel="stylesheet" href="{{URL::asset('TemplateAsset/dist/css/bootstrap-rtl.min.css')}}">
    <!-- template rtl version -->
    <link rel="stylesheet" href="{{URL::asset('TemplateAsset/dist/css/custom-style.css')}}">
@endsection
