@extends('Admin.PublicItems');

@section('content')

    <?php
    //    dd(\App\Product::All())
    ?>
    <section class="content">
        <div class="row">
            <div class="col-12">

                <!-- /.card -->

                <div class="card">
                    <div class="card-header row">
                        <h3 class="card-title"> لیست خدمات </h3>
                        <div class="col-md-2">
                        <a href="{{ route('Products.create') }}">

                            <button type="button" class="btn btn-primary btn-lg">NEW</button>
                        </a>
                        </div>
                        <div class="col-md-5">
                        @if (session('success'))
                            <div class="alert alert-success alert-dismissible" style="
    height: 50px;
">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                <h5><i class="icon fa fa-check"></i> {{ session('success') }}</h5>
                            </div>
                        @endif
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>-</th>
                                <th>عنوان مجموعه</th>
                                <th>توضیحات</th>
                                <th>تصویر</th>
                                <th>مجموعه ها</th>
                                <th>تاریخ ایجاد</th>
                            </tr>
                            </thead>
                            <tbody>

                             @foreach(\App\Product::all() as $k => $Product)
                                <tr>
                                    <td>
                                        <div class="btn-group">
                                            <div class="btn-sm">@if ($k > 10 | $k == 0 ){{ $k }}@else{{ '0'.$k }}@endif</div>

                                            <form action="{{ route('Products.destroy', $Product->id)}}"
                                                  method="post"
                                                  style="display: flex;"
                                            >
                                                {{ csrf_field() }}
                                                @method('DELETE')
                                                <button class="btn btn-danger btn-sm" type="submit">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                                <button type="button" class="btn btn-default btn-sm">
                                                    <a href="{{route('Products.edit',$Product->id)}}">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                </button>

                                            </form>


                                        </div>
                                    </td>

                                    <td>{{$Product->title}}</td>
                                    <td>
                                        {{$Product->description}}
                                    </td>
                                    <td>
                                        <div class="widget-user-image">
                                            <img class="image-list" src="{{'/images/Products/Product_'.$Product->id.'.'.$Product->image}}" alt="User Avatar">
                                        </div>

                                    </td>
                                    <td>
                                        @foreach($Product ->categories as $category)

                                            <span class="btn btn-sm badge-success"> {{$category->title}}</span>


                                            @endforeach


                                    </td>
                                     <td class="time-list-view"><?PHP $v = verta($Product->created_at);$v->timezone = 'Asia/Tehran';print $v;?></td>
                                </tr>
                            @endforeach
                            </tbody>
                            <tfoot>
                            <tr>
                                <th>-</th>
                                <th>عنوان</th>
                                <th>توضیحات</th>
                                <th>تصویر</th>
                                <th>مجموعه ها</th>
                                <th>تاریخ ایجاد</th>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
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
    <script src="{{URL::asset('TemplateAsset//plugins/jquery/jquery.min.js')}}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ URL::asset('TemplateAsset//plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <!-- DataTables -->
    <script src="{{URL::asset('TemplateAsset//plugins/datatables/jquery.dataTables.js')}}"></script>
    <script src="{{URL::asset('TemplateAsset//plugins/datatables/dataTables.bootstrap4.js')}}"></script>
    <!-- SlimScroll -->
    <script src="{{URL::asset('TemplateAsset//plugins/slimScroll/jquery.slimscroll.min.js')}}"></script>
    <!-- FastClick -->
    <script src="{{URL::asset('TemplateAsset//plugins/fastclick/fastclick.js')}}"></script>
    <!-- AdminLTE App -->
    <script src="{{URL::asset('TemplateAsset//dist/js/adminlte.min.js')}}"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="{{URL::asset('TemplateAsset//dist/js/demo.js')}}"></script>
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
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css')">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="{{URL::asset('TemplateAsset//plugins/datatables/dataTables.bootstrap4.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{URL::asset('TemplateAsset//dist/css/adminlte.min.css')}}">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet')}}">

    <!-- bootstrap rtl -->
    <link rel="stylesheet" href="{{URL::asset('TemplateAsset//dist/css/bootstrap-rtl.min.css')}}">
    <!-- template rtl version -->
    <link rel="stylesheet" href="{{URL::asset('TemplateAsset//dist/css/custom-style.css')}}">
@endsection
