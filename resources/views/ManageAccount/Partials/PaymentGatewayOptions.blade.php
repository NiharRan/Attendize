@if(Gate::allows('change-payment-gateway'))
    @php
        $current_payment_gateway_id = $default_payment_gateway_id;
        foreach ($payment_gateways as $id => $payment_gateway) {
            if ($system && $payment_gateway['id'] == $system->payment_gateway_id) {
                $current_payment_gateway_id = $payment_gateway['id'];
            }
        }
    @endphp
    <script>
        $(function () {
            $('.payment_gateway_options').hide();
            $('#gateway_{{ $current_payment_gateway_id }}').show();

            $('input[type=radio][name=payment_gateway]').on('change', function (e) {
                $('.payment_gateway_options').hide();
                $('#gateway_' + $(this).val()).fadeIn();
            });

        });
    </script>


    {!! Form::model($account, array('url' => route('postEditSystemPayment'), 'class' => 'ajax ')) !!}
    <div class="form-group">
        {!! Form::label('payment_gateway_id', trans("ManageAccount.default_payment_gateway"), array('class'=>'control-label
        ')) !!}<br/>

        @foreach ($payment_gateways as $id => $payment_gateway)
            @php
                $checked = ($system && $payment_gateway['id'] == $system->payment_gateway_id) ? true : false;
            @endphp
            {!! Form::radio('payment_gateway', $payment_gateway['id'], $payment_gateway['default'],
            array('id'=>'payment_gateway_' . $payment_gateway['id'], 'checked' => $checked)) !!}
            {!! Form::label($payment_gateway['provider_name'],$payment_gateway['provider_name'] , array('class'=>'control-label
            gateway_selector')) !!}<br/>
        @endforeach


    </div>

    @foreach ($payment_gateways as $id => $payment_gateway)

        @if(View::exists($payment_gateway['admin_blade_template']))
            @include($payment_gateway['admin_blade_template'])
        @endif


    @endforeach


    <div class="row">
        <div class="col-md-12">
            <div class="panel-footer">
                {!! Form::submit(trans("ManageAccount.save_payment_details_submit"), ['class' => 'btn btn-success
                pull-right']) !!}
            </div>
        </div>
    </div>


    {!! Form::close() !!}
@endif
