 <div class="mb-3">
    <label for="name" class="form-label">Name</label>
    <input type="text" name="name" class="form-control" id="name" placeholder="type name" value="{{ old('name') }}">
    @error('name')
      <div class="alert alert-danger">{{ $message }}</div>
    @enderror
  </div>
  <div class="mb-3">
    <label for="login" class="form-label">Login</label>
    <input type="text" name="login" class="form-control" id="login" placeholder="type login" value="{{ old('login') }}">
    @error('login')
      <div class="alert alert-danger">{{ $message }}</div>
    @enderror
  </div>
  <div class="mb-3">
    <label for="email" class="form-label">Email</label>
    <input type="text" name="email" class="form-control" id="email" placeholder="type email" value="{{ old('email') }}">
    @error('email')
      <div class="alert alert-danger">{{ $message }}</div>
    @enderror
  </div>
  <div class="mb-3">
    <label for="number" class="form-label">Number</label>
    <input type="text" name="number" class="form-control" id="number" placeholder="type number" value="{{ old('number') }}">
    @error('number')
      <div class="alert alert-danger">{{ $message }}</div>
    @enderror
  </div>