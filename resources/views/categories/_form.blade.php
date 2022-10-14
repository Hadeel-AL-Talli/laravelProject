<div class="form-group">
    <x-form.input id="name" name="name" label=" Category name" :value ="$category->name" />
        
</div>
<div class="form-group">
    <x-form.input id="slug" name="slug" label="Category slug" value ="{{ $category->slug }}" />
</div>

<div class="form-group">
    
    
    <label for="description"> Description </label>
        <textarea id="description" name="description" class="form-control @error('description') is-invalid @enderror">{{old('description' , $category->description) }} </textarea>
        @error('description')
        <p class="text-danger"> {{ $message }}</p>
        @enderror
       
</div>
<div class="form-group">
    <label for="parent_id"> ParentID </label>
        <select id="parent_id" name="parent_id" class="form-control @error('parent_id') is-invalid @enderror">

            <option value=""> No Parent</option>
             @foreach ($parents as $parent) 
                
            
            <option value="{{ $parent->id }} " @if ($parent->id == old('parent_id' , $category->parent_id)) selected  @endif>
                
            {{ $parent->name }} </option>
            @endforeach 
            
        </select>
        @error('parent_id')
        <p class="invalid-feedback"> {{ $message }}</p>
        @enderror
       
</div>

<div class="form-group">
    <label for="art_file"> Art File</label>
        <input type="file" id="art_file" name="art_file" class="form-control @error('art_file') is-invalid @enderror">
        @error('art_file')
        <p class="invalid-feedback"> {{ $message }}</p>
        @enderror
</div>

<div class="form-group"> 

    <button class="btn btn-primary"> Save</button>
</div>