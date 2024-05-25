<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>

    <link rel="stylesheet" href="../../assets/css/bootstrap-rtl.css" />
    <script src="../../scripts/jquery-1.10.2.min.js"></script>
    <script src="../../scripts/bootstrap-rtl.js"></script>
  </head>
  <body>
{{--    @include('back.sidebar')--}}

{{--        @include('back.messages')--}}
        <div class="container" style="margin-top: 170x" id="sidebar">
          <div class="panel panel-primary">
            <div class="panel-heading"> <a href="{{route('admin.categories.create')}}" class="btn btn-success btn-fw  ">دسته
                بندی جدید</a></div>
            <div class="panel-body">
              <table style="width:100%;">
                <thead>
                    <tr style="padding-block: 10px;border-bottom: 1px solid black;">
                        <td style="padding-block: 10px;text-align: center;">نام دسته بندی</td>

                        <td style="padding-block: 10px;text-align: center;">نام مستعار</td>


                    </tr>
                </thead>
                <tbody>
                    @foreach ($categories as $category)
                    <tr style="padding-block: 10px;border-bottom: 1px solid rgb(196, 196, 196);">

                        <td style="padding-block: 10px;text-align: center;">{{$category->name}}</td>


                        <td style="padding-block: 10px;text-align: center;"><a href="{{route('admin.categories.edit',$category->id)}}"
                          class="badge badge-success">ویرایش</a>
                      <a href="{{route('admin.categories.destroy',$category->id)}}"
                          onclick="return confirm('آیا آیتم مورد نظر حذف شود');"
                          class="badge badge-warning"> حذف </a></td>


                    </tr>
                    @endforeach
                </tbody>
            </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>
