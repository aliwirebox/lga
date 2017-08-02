<form action="{{ route('hirer.details.store') }}" method="post">
    {{csrf_field()}}

    <div class="form-group m-top-20">
        <strong class="fs-12 text-muted text-blue">First Name*</strong>
        <input type="text" id="first_name" name="first_name" class="form-control"
               value="{{ old('first_name', $hirer->first_name) }}">
    </div>
    <div class="form-group m-top-20">
        <strong class="fs-12 text-muted text-blue">Last Name*</strong>
        <input type="text" id="last_name" name="last_name" class="form-control"
               value="{{ old('last_name', $hirer->last_name) }}">

    </div>
    <div class="form-group m-top-20">
        <strong class="fs-12 text-muted text-blue">Email*</strong>
        <input type="text" id="email" name="email" class="form-control"
               value="{{ old('email', $hirer->email) }}">

    </div>
    <div class="form-group m-top-20">
        <strong class="fs-12 text-muted text-blue">Telephone*</strong>
        <input type="text" id="telephone" name="telephone" class="form-control"
               value="{{ old('telephone', formatTelephone($hirer->telephone)) }}">
    </div>
    <div class="text-right m-top-20">
        <input type="submit" class="btn btn-primary fs-12 btn-lg" value="Update">
    </div>
</form>
