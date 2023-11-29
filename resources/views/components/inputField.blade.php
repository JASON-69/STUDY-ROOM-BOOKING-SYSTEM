<div class="row mb-3">
    @if ($inputType === 'checkbox')
        <div class="col-md-6 offset-md-4">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="{{$inputName}}" id="{{$inputName}}"
                    {{ old($inputName) ? 'checked' : '' }}>

                <label class="form-check-label" for="{{$inputName}}">
                    {{ __($inputLabel) }}
                </label>
            </div>
        </div>
    @else
        <label for="{{ $inputName }}" class="col-md-4 col-form-label text-md-end">{{ ucfirst($inputLabel) }}</label>

        <div class="col-md-6">
            <input id="{{ $inputName }}" type="{{ $inputType }}"
                class="form-control @error($inputName) is-invalid @enderror" name="{{ $inputName }}"
                value="{{ $inputDefault ?? old($inputName) }}" autocomplete="{{ $inputName }}" @required($required ?? false)
                @if ($autofocus ?? false) autofocus @endif>

            @error($inputName)
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    @endif
</div>
