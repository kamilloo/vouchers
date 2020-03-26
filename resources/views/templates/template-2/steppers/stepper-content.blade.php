<div class="bs-stepper-content">
    <!-- your steps content here -->
    <div id="vouchers-part" class="content" role="tabpanel" aria-labelledby="vouchers-part-trigger">
        @include('templates.common.voucher-selection')
        <div class="container-contact2-form-btn">
        @include('templates.template-2.buttons.button-next')
        </div>
    </div>
    <div id="delivery-part" class="content" role="tabpanel" aria-labelledby="delivery-part-trigger">
        @include('templates.common.delivery-choose')
        <div class="container-contact2-form-btn">
        @include('templates.template-2.buttons.button-previous')
        @include('templates.template-2.buttons.button-next')
        </div>

    </div>
    <div id="information-part" class="content" role="tabpanel" aria-labelledby="information-part-trigger">
        <div class="box">
            <h3 class="box-title">{{ __('Your Recipient') }}</h3>
            @include('templates.template-2.fields.text-input', [
                'data_validate' => 'Name is required',
                'name' => "first_name",
                'required' => true,
            ])
            @include('templates.template-2.fields.text-input', [
                'data_validate' => 'Last Name is required',
                'name' => "last_name",
                'required' => true,
            ])
            @include('templates.template-2.fields.text-input', [
                'data_validate' => 'Email is required',
                'name' => "email",
                'required' => false,
            ])
            @include('templates.template-2.fields.text-input', [
                'data_validate' => 'Phone is required',
                'name' => "phone",
                'required' => false,
            ])
            <small class="text-muted">*&nbsp;{{ __('required field')}}</small>

        </div>
        <div class="container-contact2-form-btn">
            @include('templates.template-2.buttons.button-previous')
            @include('templates.template-2.buttons.button-next')
        </div>
    </div>
    <div id="client-part" class="content" role="tabpanel" aria-labelledby="client-part-trigger">
        <div class="box">
            <h3 class="box-title">{{ __('Your details') }}</h3>

            @include('templates.template-2.fields.text-input-table', [
                'data_validate' => 'Country is required',
                'name' => "client",
                'fields' => [['name', __('First and Last name')], 'email', 'phone', 'city', 'address', 'postcode']
            ])
            <small class="text-muted">*&nbsp;{{ __('required field')}}</small>
        </div>
        <div class="container-contact2-form-btn">
            @include('templates.template-2.buttons.button-previous')
            @include('templates.template-2.buttons.button-confirm')
        </div>

    </div>
</div>

