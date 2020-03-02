@extends('layouts.app')

@section('content')

<div class="container">

<h2>Credit Application Form</h2>

<hr>

<form action="#" method="post">
    {{ csrf_field() }}

    <fieldset>
        <legend>Company Contact Information</legend>

        <div class="form-group">
            <label for="company-trading-name">Company Trading Name *</label>
            <input class="form-control" name="company_trading_name" id="company-trading-name" type="text" required>
        </div>

        <div class="form-group">
            <label for="company-full-address">Full Address *</label>
            <textarea class="form-control" name="company_full_address" rows="5" id="company-full-address" required></textarea>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="company-postcode">Postcode *</label>
                    <input class="form-control" name="company_postcode" id="company_postcode" type="text" required>
                </div>

                <div class="form-group">
                    <label for="company-contact-name">Contact Name/s</label>
                    <input class="form-control" name="company_contact_name" id="company-contact-name" type="text">
                </div>

                <div class="form-group">
                    <label for="company-telephone">Telephone</label>
                    <input class="form-control" name="company_telephone" id="company-telephone" type="text">
                </div>

                <div class="form-group">
                    <label for="company-email">Email</label>
                    <input class="form-control" name="company_email" id="company-email" type="text">
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label for="company-accounts-name">Accounts Name/s *</label>
                    <input class="form-control" name="company_accounts_name" id="company-accounts-name" type="text" required>
                </div>

                <div class="form-group">
                    <label for="company-accounts-telephone">Accounts Telephone *</label>
                    <input class="form-control" name="company_accounts_telephone" id="company-accounts-telephone" type="text" required>
                </div>

                <div class="form-group">
                    <label for="company-accounts-email">Accounts Email *</label>
                    <input class="form-control" name="company_accounts_email" id="company-accounts-email" type="text" required>
                </div>
            </div>
        </div>
    </fieldset>

    <hr>

    <fieldset>
        <legend>Company Details</legend>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="company-registration-number">Company Registration Number *</label>
                    <input class="form-control" name="company_registration_no" id="company-registration-number" type="text" required>
                </div>

                <div class="form-group">
                    <label for="date-of-incorporation">Date of Incorporation</label>
                    <input class="form-control" name="date_of_incorporation" id="date-of-incorporation" type="text">
                </div>

                <div class="form-group">
                    <label for="vat-registration-number">VAT Registration Number *</label>
                    <input class="form-control" name="vat_registration_number" id="vat-registration-number" type="text" required>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label for="director-1-name">Director's Name</label>
                    <input class="form-control" name="director_1_name" id="director-1-name" type="text">
                </div>
                
                <div class="form-group">
                    <label for="director-2-name">Director's Name</label>
                    <input class="form-control" name="director_2_name" id="director-2-name" type="text">
                </div>
                
                <div class="form-group">
                    <label for="director-3-name">Director's Name</label>
                    <input class="form-control" name="director_3_name" id="director-3-name" type="text">
                </div>
            </div>
        </div>
    </fieldset>

    <hr>

    <fieldset>
        <legend>Banking Details</legend>

        <div class="form-group">
            <label for="bank-name">Bank Name *</label>
            <input class="form-control" name="bank_name" id="bank-name" type="text" required>
        </div>

        <div class="form-group">
            <label for="bank-address">Bank Address *</label>
            <textarea class="form-control" rows="4" name="bank_address" cols="50" id="bank-address" required></textarea>
        </div>
        
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="bank-postcode">Postcode *</label>
                    <input class="form-control" name="bank_postcode" id="bank-postcode" type="text" required>
                </div>
            </div>
            
            <div class="col-md-6">
                <div class="form-group">
                    <label for="bank-sort-code">Sort Code *</label>
                    <input class="form-control" name="bank_sort_code" id="bank-sort-code" type="text" required>
                </div>
                <div class="form-group">
                    <label for="bank-account-number">Account Number *</label>
                    <input class="form-control" name="bank_account_number" id="bank-account-number" type="text" required>
                </div>
            </div>
        </div>
    </fieldset>

    <hr>

    <fieldset>
        <legend>Trade References</legend>
        
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="reference-1-name">Name *</label>
                    <input class="form-control" name="reference_1_name" id="reference-1-name" type="text" required>
                </div>
                
                <div class="form-group">
                    <label for="reference-1-address">Address *</label>
                    <textarea class="form-control" rows="5" name="reference_1_address" id="reference-1-address" required></textarea>
                </div>
                
                <div class="form-group">
                    <label for="reference-1-postcode">Postcode *</label>
                    <input class="form-control" name="reference_1_postcode" id="reference-1-postcode" type="text" required>
                </div>
                
                <div class="form-group">
                    <label for="reference-1-telephone">Telephone *</label>
                    <input class="form-control" name="reference_1_telephone" id="reference-1-telephone" type="text" required>
                </div>
                
                <div class="form-group">
                    <label for="reference-1-email">Email *</label>
                    <input class="form-control" name="reference_1_email" id="reference-1-email" type="text" required>
                </div>
            </div>
            
            <div class="col-md-6">
                <div class="form-group">
                    <label for="reference-2-name">Name *</label>
                    <input class="form-control" name="reference_2_name" id="reference-2-name" type="text" required>
                </div>
                
                <div class="form-group">
                    <label for="reference-2-address">Address *</label>
                    <textarea class="form-control" rows="5" name="reference_2_address" id="reference-2-address" required></textarea>
                </div>
                
                <div class="form-group">
                    <label for="reference-2-postcode">Postcode *</label>
                    <input class="form-control" name="reference_2_postcode" id="reference-2-postcode" type="text" required>
                </div>
                
                <div class="form-group">
                    <label for="reference-2-telephone">Telephone *</label>
                    <input class="form-control" name="reference_2_telephone" id="reference-2-telephone" type="text" required>
                </div>
                
                <div class="form-group">
                    <label for="reference-2-email">Email *</label>
                    <input class="form-control" name="reference_2_email" id="reference-2-email" type="text" required>
                </div>
            </div>
        </div>
    </fieldset>

    <hr>

    <fieldset>
        <legend>Credit Limit</legend>
                
        <div class="form-group">
            <label for="credit-limit">Credit Limit Requested *</label>
            <input class="form-control" name="credit_limit" id="credit-limit" type="text" required>
        </div>
    </fieldset>

    <hr>

    <div class="text-center">
        <p>
            All first orders are dealt with on a pro-forma basis.<br>
            Subject to a satisfactory credit check, credit terms are strictly 30 days from date of invoice.
        </p>
        
        <p>By submitting this form, the person named beneath states that all the above information is true and agrees to abide by LSi's terms &amp; conditions.</p>
        
        <p><a href="{{ action('TermController@index', 'terms') }}" target="_blank">View our terms &amp; conditions (opens in a new tab)</a></p>
    </div>

    <hr>

    <fieldset>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="signed-name">Name *</label>
                    <input class="form-control" name="signed_name" id="signed-name" type="text" required>
                </div>
            </div>
            
            <div class="col-md-4">
                <div class="form-group">
                    <label for="signed-position">Position *</label>
                    <input class="form-control" name="signed_position" id="signed-position" type="text" required>
                </div>
            </div>
            
            <div class="col-md-4">
                <div class="form-group">
                    <label for="signed-date">Date *</label>
                    <input class="form-control" readonly="readonly" name="signed_date" id="signed-date" type="text" value="{{ date('d-m-Y') }}" required>
                </div>
            </div>
        </div>
        
        <div class="form-check text-center">
            <input class="form-check-input" id="terms-agreed" name="terms_agreed" value="Agreed" type="checkbox" required>
            <label class="form-check-label" for="terms-agreed">
                I agree to abide by LSi's terms and conditions *
            </label>
        </div>
    </fieldset>

    <div class="text-center mt-4">
        <input class="btn btn-primary" value="Send Account Application" type="submit">
    </div>
</form>

<hr>

<a href="{{ url()->previous() }}">Back to the last page you viewed</a>

</div>

@endsection