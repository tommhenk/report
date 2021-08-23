 <div class="mb-3">
    <label for="title" class="form-label">Title</label>
    <input type="text" name="title" class="form-control" id="title" placeholder="type title" value="{{ old('title') }}">
    @error('title')
      <div class="alert alert-danger">{{ $message }}</div>
    @enderror
  </div>
  <div class="mb-3">
    <label for="desc" class="form-label">Description</label>
    <textarea name="desc" id="desc" class="form-control" rows="10">{{ old('desc') }}</textarea>
    @error('desc')
      <div class="alert alert-danger">{{ $message }}</div>
    @enderror
  </div>
 