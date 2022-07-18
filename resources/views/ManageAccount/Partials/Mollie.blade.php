<section class="payment_gateway_options" id="gateway_{{$payment_gateway['id']}}">
    <h4>@lang("ManageAccount.mollie_settings")</h4>
    @php
        $apiKey = '';
        if ($system) {
            $apiKey = $system->getGatewayConfigVal($payment_gateway['id'], 'apiKey');
        }
    @endphp
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                {!! Form::label('mollie[apiKey]', trans("ManageAccount.mollie_api_key"), array('class'=>'control-label ')) !!}
                {!! Form::text('mollie[apiKey]', $apiKey,[ 'class'=>'form-control'])  !!}
            </div>
        </div>
    </div>
</section>
