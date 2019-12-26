<div class="bs-stepper-content">
    <!-- your steps content here -->
    <div id="vouchers-part" class="content" role="tabpanel" aria-labelledby="vouchers-part-trigger">
        @include('templates.common.voucher-selection')
        @include('templates.template-3.buttons.button-next')
    </div>
    <div id="delivery-part" class="content" role="tabpanel" aria-labelledby="delivery-part-trigger">
        @include('templates.common.delivery-choose')

        @include('templates.template-3.buttons.button-previous')
        <br>
        @include('templates.template-3.buttons.button-next')

    </div>
    <div id="information-part" class="content" role="tabpanel" aria-labelledby="information-part-trigger">
{{--        <div class="box">--}}
            <h3 class="box-title">Your Recipient</h3>
            @include('templates.template-3.fields.text-input', [
                'data_validate' => 'Name is required',
                'name' => "first_name"
            ])
            @include('templates.template-3.fields.text-input', [
                'data_validate' => 'Last Name is required',
                'name' => "last_name"
            ])
            @include('templates.template-3.fields.text-input', [
                'data_validate' => 'Email is required',
                'name' => "email"
            ])
            @include('templates.template-3.fields.text-input', [
                'data_validate' => 'Phone is required',
                'name' => "phone"
            ])

            @include('templates.template-3.buttons.button-previous')
            <br>
            @include('templates.template-3.buttons.button-next')

{{--        </div>--}}

    </div>
    <div id="client-part" class="content" role="tabpanel" aria-labelledby="client-part-trigger">
{{--        <div class="box">--}}
{{--            <h3 class="box-title">Your details</h3>--}}

            @include('templates.template-3.fields.text-input-table', [
                'data_validate' => 'Country is required',
                'name' => "client",
                'fields' => ['name', 'email', 'phone', 'city', 'address', 'postcode', 'country']
            ])
            @include('templates.template-3.buttons.button-previous')
            <br>
            @include('templates.template-3.buttons.button-confirm')
        </div>

{{--    </div>--}}
</div>

