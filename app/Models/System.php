<?php

namespace App\Models;

class System extends MyBaseModel
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'payment_gateway_id',
        'config'
    ];

    /**
     * Indicates whether the model should be timestamped.
     *
     * @var bool $timestamps
     */
    public $timestamps = false;
    /**
     * The database table used by the model.
     *
     * @var string $table
     */
    protected $table = 'system';
    /**
     * Indicates whether the model should use soft deletes.
     *
     * @var bool $softDelete
     */
    protected $softDelete = false;


    /**
     * Parent payment gateway
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function payment_gateway()
    {
        return $this->belongsTo(\App\Models\PaymentGateway::class, 'payment_gateway_id', 'id');
    }


    /**
     * Get a config value for a gateway
     *
     * @param $gateway_id
     * @param $key
     * @return mixed
     */
    public function getGatewayConfigVal($payment_id, $key)
    {
        $config = unserialize($this->config);
        if(is_array($config) && $this->payment_gateway_id == $payment_id) {
            return $config[$key] ?? false;
        }

        return false;
    }
}
