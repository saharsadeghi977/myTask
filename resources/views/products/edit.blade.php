<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>

      <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

  </head>
  <body>
    <div style="display: flex">
      <div
        style="
          height: 100vh;
          width: 300px;
          background-color: #428bca;
          color: white;
        "
      >

        @include('messages')
        <div class="container" style="margin-top: 170x" id="sidebar">
          <div class="panel panel-primary">

            <div class="panel-heading">ویرایش محصول</div>


            <div class="panel-body">
              <form action="{{route('products.update',['product'=>$product->id])}}" method="POST">
                  @csrf
                  @method('put')
                  <div class="form-group">
                      <label for="name">نام</label>
                      <input type="text" class="form-control @error('title') is-invalid @enderror" id="name" name="name" />

                      <!-- Loop through the product files and display image paths in hidden inputs -->
                      @foreach ($product->files as $file)
                          <input type="hidden" name="file_paths[]" value="{{ asset('storage/' . $file->path) }}" />
                      @endforeach

                  </div>
                  <div class="form-group">
                      <label for="type">نوع</label>
                      <input type="text" class="form-control  @error('title') is-invalid @enderror" id="type"  name="type"  value="{{$product->type}}" />
                  </div>
                  <div class="form-group">
                      <label for="slug">slug </label>
                      <input type="text" class="form-control  @error('slug') is-invalid @enderror" id="slug"  name="slug"  value="{{$product->slug}}" />
                  </div>

                  <div class="form-group">
                      <label for="title">انتخاب دسته بندی</label>
                      <div id="output"></div>
                      <select class="chosen-select" name="category_id"  style="width:400px">
                          <option value="1">1</option>
                          {{--                      @foreach ($categories as $cat_id => $cat_name)--}}
                          {{--                      <option value="{{$cat_id}}">{{$cat_name}}</option>--}}
                          {{--                      @endforeach--}}

                      </select>


                  </div>
                  <div class="form-group">
                      <label for="image">انتخاب تصویر</label>
                      <input type="file" class="form-control @error('image') is-invalid @enderror" id="image"  name="image" value="{{$product->files}}"/>
                  </div>
                  <hr>
                  <div class="form-group">
                      <label for="body">توضیحات</label>
                      <textarea
                          id="body" type="text"
                          class="form-control @error('description') is-invalid @enderror"
                          name="description">{{$product->description}}
                  </textarea>
                  </div>
                  <div class="form-group">

                      <button type="submit" class="btn btn-success">ذخیره</button>
                      <a href="{{route('products')}}" class="btn btn-warning"> انصراف </a>
                  </div>
              </form>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
    <script src="../../assets/scripts/jquery-1.10.2.min.js"></script>
    <script src="../../assets/scripts/bootstrap-rtl.js"></script>
  </body>
</html>
