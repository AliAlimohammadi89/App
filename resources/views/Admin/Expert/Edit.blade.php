@extends('Admin.PublicItems');

@section('content')

    <section class="content">
        <div class="container-fluid">
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
                        <form enctype="multipart/form-data" role="form" action="{{ route('Experts.update', $Expert_data->id) }}" name="update_Expert" method="POST">
                            {{ csrf_field() }}
                            @method('PATCH')

                            <div class="card-body">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">نام</label>
                                    <input value="{{$Customer_data->First_Name}}" type="text" class="form-control" name="First_Name" placeholder="نام">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1"> نام خانوادگی</label>
                                    <input  value="{{$Customer_data->Last_Name}}"  type="text" class="form-control" name="Last_Name" placeholder="نام خانوادگی">
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1"> شماره تماس</label>
                                    <input type="text" value="{{$Customer_data->Phone_Number}}"  class="form-control" name="Phone_Number" placeholder="09XXXXXXXX">
                                </div>
                                <div class="form-group">
                                    <label>آدرس</label>
                                    <textarea  value="{{$Customer_data->Address}}"  class="form-control" rows="3" name="Address" placeholder="وارد کردن آدرس ..."></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">شارژ</label>
                                    <input value="{{$Expert_data->wallet}}" type="text" class="form-control" name="wallet" placeholder="مقدار شارژ را وار کنید">
                                </div>
                                <div class="form-group">
                                    <label>توضیحات خدمت</label>
                                    <textarea class="form-control" rows="3" name="description" placeholder="وارد کردن توضیحات ...">{{$Expert_data->description}}</textarea>
                                </div>

                                <div class="form-group">
                                    <label>چند انتخابی</label>
                                    <select name="product[]" multiple="" id="Product" class="form-control">

                                       <?PHP foreach(\App\Product::all() as $Product) {?>

                                        <option
                                            <?PHP

                                            foreach ($Expert_data->Products as $index){
                                              //  dd($index->id);
                                            if ($index->id ==  $Product->id){
                                                print ' selected ';
                                            break;
                                            }
                                            }
                                          ?>




                                            value="{{$Product->id}}" >{{$Product->title}}</option>

                                        <?PHP } ?>

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
    <script type="text/javascript" src="{{URL::asset('TemplateAsset/plugins/jquery/jquery.min.js')}}"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>

    <script src="{{URL::asset('TemplateAsset/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

    <script src="{{URL::asset('TemplateAsset/plugins/datepicker/bootstrap-datepicker.js')}}"></script>
    <!-- Bootstrap WYSIHTML5 -->

    <script src="{{URL::asset('TemplateAsset/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js')}}"></script>
    <!-- Slimscroll -->

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
