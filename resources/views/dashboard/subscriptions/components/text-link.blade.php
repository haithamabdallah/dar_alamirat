<div class="col-md-2  m-1 p-2 border">
    <div class="mb-3">
        <label class="form-label">Text {{$textIndex}} Link :</label>
        <input type="text" class="form-control" name="texts[{{$textIndex}}][link]"
            value="{{ $linkValue ?? old("texts[{$textIndex}][link]") }}" placeholder=" text {{$textIndex}} link ">
    </div>
    @error("texts.{$textIndex}.link")
        <span class="text-danger" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
    <div class="mb-3">
        <label class="form-label">Text {{$textIndex}} :</label>
        <input type="text" class="form-control" name="texts[{{$textIndex}}][text]"
            value="{{ $textValue ?? old("texts[{$textIndex}][text]") }}" placeholder=" text {{$textIndex}} ">
    </div>
    @error("texts.{$textIndex}.text")
        <span class="text-danger" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
</div>