<div class="row">
    <div class="col-lg-12">
        <div class="card border-0 mb-4">
            <div class="card-header h6 mb-0 bg-none p-3">
                <i class="fa fa-dolly fa-lg fa-fw text-dark text-opacity-50 me-1"></i> Slider Information
            </div>
            <div class="card-body">

              <div class="row">
                <div class="col-md-12">

                  <div class="mb-3">
                      <label for="is_dark" class="form-label col-form-label">
                          Is Dark :
                      </label>
                      <input type="checkbox" name="is_dark" class="" id="is_dark" value="1" {!! isset($slider->is_dark) && $slider->is_dark ? "checked" : '' !!}>
                  </div>
                  @error('is_dark')
                      <span class="text-danger" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                  @enderror
                </div>

                <div class="col-md-12">

                  <div class="mb-3">
                      <label for="is_reversed" class="form-label col-form-label">
                          Is Reversed :
                      </label>
                      <input type="checkbox" name="is_reversed" class="" id="is_reversed" value="1" {!! isset($slider->is_reversed) && $slider->is_reversed ? "checked" : '' !!}>
                  </div>
                  @error('is_reversed')
                      <span class="text-danger" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                  @enderror
                </div>
              </div>

                @foreach (Config('language') as $key => $lang)
                    <div class="mb-3">
                        <label class="form-label">Title In {{ $lang }} :</label>
                        <input type="text" class="form-control" name="title_{{ $key }}"
                            value="{{ $slider['title_' . $key] ?? old('title_' . $key) }}" placeholder=" Title">
                    </div>
                    @error('title_' . $key)
                        <span class="text-danger" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                @endforeach

                @foreach (Config('language') as $key => $lang)
                    <div class="mb-3">
                        <label class="form-label">Subtitle In {{ $lang }} :</label>
                        <input type="text" class="form-control" name="subtitle_{{ $key }}"
                            value="{{ $slider['subtitle_' . $key] ?? old('subtitle_' . $key) }}"
                            placeholder=" Subtitle">
                    </div>
                    @error('subtitle_' . $key)
                        <span class="text-danger" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                @endforeach

                @foreach (Config('language') as $key => $lang)
                    <div class="mb-3">
                        <label class="form-label">Button Text In {{ $lang }} :</label>
                        <input type="text" class="form-control" name="button_text_{{ $key }}"
                            value="{{ $slider['button_text_' . $key] ?? old('button_text_' . $key) }}"
                            placeholder=" Button_text">
                    </div>
                    @error('button_text_' . $key)
                        <span class="text-danger" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                @endforeach

                <div class="mb-3">
                    <label class="form-label">Button Link :</label>
                    <input type="text" class="form-control" name="button_link"
                        value="{{ $slider->button_link ?? old('button_link') }}" placeholder=" button link ">
                </div>
                @error('button_link')
                    <span class="text-danger" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror

                <div class="mb-3">
                    <label for="background-image" class="form-label col-form-label col-md-3">
                        Background Image :
                    </label>
                    <input type="file" name="background_image" class="form-control" id="background-image" onchange="preview1()">
                </div>
                @error('background_image')
                    <span class="text-danger" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                <div class="d-flex">
                  @if (isset( $slider->background_image) ) 
                    <img src="{{ asset('storage/' . $slider->background_image) }}" alt="slider background image" width="100px" height="100px">
                  @endif
                  <img src="" id="frame1" alt="preview1" width="100px" height="100px">
                </div>

                <div class="mb-3">
                    <label for="image" class="form-label col-form-label col-md-3">
                        Image :
                    </label>
                    <input type="file" name="image" class="form-control" id="image" onchange="preview2()">
                </div>
                @error('image')
                    <span class="text-danger" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                <div class="d-flex">
                    @if (isset( $slider->image) ) 
                        <img src="{{ asset('storage/' . $slider->image) }}" alt="slider image" width="100px" height="100px">
                    @endif
                    <img src="" id="frame2" alt="preview2" width="100px" height="100px">
                </div>
                <button type="submit" class="btn btn-primary d-block w-100 mt-5"> Save </button>

            </div>
        </div>
    </div>
</div>


