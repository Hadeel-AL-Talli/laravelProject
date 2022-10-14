<label for="{{ $id }}"> {{ $label }}  </label>
        <input type="{{ $type ?? 'text' }}" 
        id="{{ $id }}" 
        name="{{ $name }}" 
        value ="{{ old($name , $value) }}" 
        class="form-control @error($name) is-invalid @enderror">
       

        @error($name)
        <p class="invalid-feedback"> {{ $message }}</p>
        @enderror