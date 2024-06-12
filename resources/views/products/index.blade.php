<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>

      <link rel="stylesheet" href="{{ url('assets/css/bootstrap-rtl.css') }}">
  </head>
  <body>
    {{-- @include('back.sidebar') --}}

       @include('messages')
    <div class="container" style="margin-top: 170x" id="sidebar">
        <div class="panel panel-primary">
            <div class="panel-heading">لیست محصولات</div>
            <div class="panel-body">
                <table style="width:100%;">
                    <thead>
                    <tr style="padding-block: 10px;border-bottom: 1px solid black;">
                        <td style="padding-block: 10px;text-align: center;">نام</td>

                        <td style="padding-block: 10px;text-align: center;">نوع</td>
                        <td style="padding-block: 10px;text-align: center;">تصویر</td>
                        <td style="padding-block: 10px;text-align: center;">توضیحات</td>

                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($products as $product)

                        <tr style="padding-block: 10px;border-bottom: 1px solid rgb(196, 196, 196);">

                            <td style="padding-block: 10px;text-align: center;">{{$product->name}}</td>
                            <td style="padding-block: 10px;text-align: center;">{{$product->type}}</td>
                            <td style="padding-block: 10px;text-align: center;">
                                @foreach($product->files as $file)
                                    <img src="{{asset('storage/'.$file->path)}}">
                                @endforeach
                            </td>
                            <td style="padding-block: 10px;text-align: center;">
                                @foreach ($product->category()->pluck('name') as $category)
                                    <span class="badge badge-warning">{{$category}}</span>
                                @endforeach
                            </td>
                            <td style="padding-block: 10px;text-align: center;">{{$product->description}}</td>
                            <td style="padding-block: 10px;text-align: center;"><a
                                        href="{{route('products.edit',$product->id)}}"
                                        class="badge badge-success">ویرایش</a>
                            <form action="{{route('products.destroy',$product->id)}}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="badge badge-warning" onclick="return confirm('آیا ایتم مورد نظر حذف شود');">حذف</button>
                            </form>
                            </td>
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
