<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>

      <link rel="stylesheet" href="{{ url('assets/css/bootstrap-rtl.css') }}">
  </head>
  <body>

  @include('messages')


        <div class="container"  id="sidebar">
          <div class="panel panel-primary">

            <div class="panel-heading">افزودن محصول</div>


            <div class="panel-body">
              <form action="{{route('products.store')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                  <label for="name">نام</label>
                  <input type="text" class="form-control  @error('title') is-invalid @enderror" id="name"  name="name"  value="{{old('name')}}" />
                </div>
                  <div class="form-group">
                      <label for="type">نوع</label>
                      <input type="text" class="form-control  @error('title') is-invalid @enderror" id="type"  name="type"  value="{{old('type')}}" />
                  </div>
                  <div class="form-group">
                      <label for="slug">slug </label>
                      <input type="text" class="form-control  @error('slug') is-invalid @enderror" id="slug"  name="slug"  value="{{old('slug')}}" />
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
                <input type="file" class="form-control @error('image') is-invalid @enderror" id="image"  name="image"/>
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
                  <a href="{{route('products.index')}}" class="btn btn-warning"> انصراف </a>
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
