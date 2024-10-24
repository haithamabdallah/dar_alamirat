<div class="col-md-2  m-1 p-2 border">
    <div class="mb-3">
        <label class="form-label">{{$socialIndex}} Link :</label>
        <input type="text" class="form-control" name="socials[{{$socialIndex}}]"
            value="{{ $linkValue ?? old("socials[{$socialIndex}]") }}" placeholder=" social {{$socialIndex}} link ">
    </div>
    @error("socials.{$socialIndex}")
        <span class="text-danger" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
</div>