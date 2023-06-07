<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
    <label for="name" class="col-md-4 control-label">Name</label>

    <div class="col-md-6">
        <input id="name" type="text" class="form-control" name="name" value="{{ old('name') ?? $user->name }}" required autofocus>

        @if ($errors->has('name'))
            <span class="help-block">
                <strong>{{ $errors->first('name') }}</strong>
            </span>
        @endif
    </div>
</div>

<div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
    <label for="email" class="col-md-4 control-label">E-Mail Address</label>

    <div class="col-md-6">
        <input id="email" type="email" class="form-control" name="email" value="{{ old('email') ?? $user->email }}" required>

        @if ($errors->has('email'))
            <span class="help-block">
                <strong>{{ $errors->first('email') }}</strong>
            </span>
        @endif
    </div>
</div>

@if(\Auth::user()->company_id == 1 && Auth::user()->isAdmin())
<div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
    <label for="company_id" class="col-md-4 control-label">Company</label>

    <div class="col-md-6">
        <select name="company_id" id="company_id" class="form-control">
            <option value="">[ Please select a company ]</option>
            @foreach(\App\Company::all() as $company)
                <option value="{{ $company->id }}" @if($company->id == $user->company_id) selected @endif>{{ $company->company }}</option>
            @endforeach
        </select>

        @if ($errors->has('company'))
            <span class="help-block">
                <strong>{{ $errors->first('company') }}</strong>
            </span>
        @endif
    </div>
</div>
@endif