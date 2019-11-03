@extends('Admin.PublicItems');

@section('content')

    <?php
    //       dd(\App\Category::All())
    ?>
    <section class="content">
        <div class="container-fluid">
            <form enctype="multipart/form-data" role="form" action="{{ route('Products.store') }}" method="POST">
                <div class="row">
                    <!-- left column -->

                    <div class="col-md-6">
                        <!-- general form elements -->
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">اضافه کردن خدمت</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->

                            {{ csrf_field() }}

                            <div class="card-body">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">عنوان خدمت</label>
                                    <input type="text" class="form-control" name="title"
                                           placeholder="عنوان را وارد کنید">
                                </div>

                                <div class="form-group">
                                    <label>توضیحات خدمت</label>
                                    <textarea class="form-control" rows="3" name="description"
                                              placeholder="وارد کردن توضیحات ..."></textarea>
                                </div>

                                <div class="form-group">
                                    <label>انتخاب مجموعه ها</label>
                                    <select name="category[]" multiple="" id="category" class="form-control">

                                        @foreach(\App\Category::all() as $category)

                                            <option value="{{$category->id}}">{{$category->title}}</option>

                                        @endforeach

                                    </select>
                                </div>


                                <div class="form-group">
                                    <label for="exampleInputFile">ارسال فایل</label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" name="image" class="custom-file-input"
                                                   id="exampleInputFile">
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

                        </div>
                        <!-- /.card -->


                    </div>
                    <div class="col-md-6">
                        <!-- TO DO List -->
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">
                                    <i class="ion ion-clipboard mr-1"></i>
                                    لیست اطلاعات تخصصی
                                </h3>


                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <ul class="todo-list">
                                    {{--                                <li id="1">--}}
                                    {{--                                    <!-- drag handle -->--}}
                                    {{--                                    <span class="handle">--}}
                                    {{--                                      <i class="fa fa-ellipsis-v"></i>--}}
                                    {{--                                      <i class="fa fa-ellipsis-v"></i>--}}
                                    {{--                                    </span>--}}
                                    {{--                                    <!-- checkbox -->--}}
                                    {{--                                    <input type="checkbox" value="" name="">--}}
                                    {{--                                    <!-- todo text -->--}}
                                    {{--                                    <span class="text"><input type="text" value="test" name="mor_info[]"></span>--}}
                                    {{--                                    <!-- Emphasis label -->--}}
                                    {{--                                     <!-- General tools such as edit or delete-->--}}
                                    {{--                                    <div class="tools">--}}
                                    {{--                                        <i style="margin-top: 4px" class="fas fa-trash" onclick="DeleteItem(1)"></i>--}}
                                    {{--                                    </div>--}}
                                    {{--                                </li>--}}
                                </ul>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer clearfix">
                                <button type="button" onclick="Add()" class="btn btn-info float-right"><i
                                        class="fa fa-plus"></i> جدید
                                </button>
                            </div>
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
            </form>
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
    <script type="text/javascript" src="{{URL::asset('TemplateAsset/plugins/jquery/jquery.min.js')}}"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>




    <script src="{{URL::asset('TemplateAsset/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>



    <script src="{{URL::asset('TemplateAsset/plugins/datepicker/bootstrap-datepicker.js')}}"></script>
    <!-- Bootstrap WYSIHTML5 -->



    <script src="{{URL::asset('TemplateAsset/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js')}}"></script>
    <!-- Slimscroll -->

    <script src="{{URL::asset('TemplateAsset/plugins/fastclick/fastclick.js')}}"></script>
    <!-- AdminLTE App -->
    <script src="{{URL::asset('TemplateAsset/dist/js/adminlte.js')}}"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="{{URL::asset('TemplateAsset/dist/js/pages/dashboard_new.js')}}"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="{{URL::asset('TemplateAsset/dist/js/demo.js')}}"></script>








@endsection

@section('stylesheet')
    <!-- Font Awesome -->
    {{--    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">--}}
    <!-- Ionicons -->
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


    <script type="text/javascript">

        function Add() {

            var number = Math.round(Math.random() * 10000);
            $(".todo-list").append(
                `<li id='${number}'><span class="handle"> <i class="fa fa-ellipsis-v"></i> <i class="fa fa-ellipsis-v"></i>  </span><input type="checkbox" value="" name=""><span class="text"><input type="text" value="پرسش ${number}"  name="SpecialtyFields[]"></span><div class="tools"><i style="margin-top: 4px" class="fas fa-trash" onclick="DeleteItem(${number})"></i> </div> </li>`
            );
        }

        function DeleteItem(item) {
            $(`#${item}`).remove();
        }
    </script>
@endsection
