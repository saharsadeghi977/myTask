<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>

      <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  </head>
  <body>
    {{-- @include('back.sidebar') --}}
{{--    @include('back.messages')--}}


        <div class="container" style="margin-top: 170x" id="sidebar">
          <div class="panel panel-primary">

            <div class="panel-heading">افزودن محصول</div>


            <div class="panel-body">
              <form action="{{route('products.store')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                  <label for="name">عنوان محصول </label>
                  <input type="text" class="form-control  @error('title') is-invalid @enderror" id="title"  name="title"  value="{{old('title')}}" />
                </div>
                <div class="form-group">
                  <label for="k">نوع</label>
                  <input type="number" class="form-control @error('price') is-invalid @enderror" id="price"  name="price"  value="{{old('price')}}"  />
                </div>
                <div class="form-group">
                  <label for="title">انتخاب دسته بندی</label>
                  <div id="output"></div>
                  <select class="chosen-select" name="categories"  style="width:400px">
{{--                      @foreach ($categories as $cat_id => $cat_name)--}}
{{--                      <option value="{{$cat_id}}">{{$cat_name}}</option>--}}
{{--                      @endforeach--}}

                  </select>


              </div>
              <div class="form-group">
                <label for="price">انتخاب تصویر</label>
                <input type="file" class="form-control @error('image') is-invalid @enderror" id="image"  name="im"  value="{{old('image')}}"  />
              </div>
<hr>
                <div class="form-group">
                  <label for="body">توضیحات</label>
                  <textarea
                  id="body" type="text"
                  class="form-control @error('description') is-invalid @enderror"
                  name="description">{{old('description')}}
                  </textarea>
                </div>
                <div class="form-group">

                  <button type="submit" class="btn btn-success">ذخیره</button>
                  <a href="{{route('products')}}" class="btn btn-warning"> انصراف </a>
              </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
    integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
    integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous">
</script>
  </body>
</html>
