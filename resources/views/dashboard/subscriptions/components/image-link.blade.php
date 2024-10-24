<div class="{{ isset($isHalf)  && $isHalf ? 'col-md-5  m-2 p-2 border' : '' }}">
    <div class="mb-3">
        <label class="form-label">Image {{$imageIndex}} Link :</label>
        <input type="text" class="form-control" name="images[{{$imageIndex}}][link]"
            value="{{ old("images[{$imageIndex}][link]") ?? config('app.frontend_url') }}" placeholder=" image {{$imageIndex}} link ">
    </div>
    @error("images.{$imageIndex}.link")
        <span class="text-danger" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
    <div class="mb-3">
        <label for="image" class="form-label col-form-label col-md-3">
            Image {{$imageIndex}} ( {{ $imageSize}} ) :
        </label>
        <input type="file" name="images[{{$imageIndex}}][image]" class="form-control" id="image{{$imageIndex}}" onchange="preview({{$imageIndex}})">
    </div>
    @error("images.$imageIndex.image")
        <span class="text-danger" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
    <div class="d-flex">
        <img src="" id="frame{{$imageIndex}}" alt="preview{{$imageIndex}}" width="100px" height="100px">
    </div>
</div>