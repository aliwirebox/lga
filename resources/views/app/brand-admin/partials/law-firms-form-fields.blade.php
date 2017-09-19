{{csrf_field()}}

<div class="form-group">
    <label>Name</label>
    <input type="text" class="form-control" name="name" value="{{ old('name', $lawFirm->name) }}">
</div>
<div class="form-group">
    <label>Domains</label>
    <input type="text" class="form-control" name="domains" value="{{ old('domains', $lawFirm->domains->implode('name', ', ')) }}">
    <small>Please comma seperate each domain.</small>
</div>
