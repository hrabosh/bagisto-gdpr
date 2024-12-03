<?php

namespace Webkul\GDPR\Models;

use Illuminate\Database\Eloquent\Model;
use Webkul\GDPR\Contracts\GDPR as GDPRContract;

class GDPR extends Model implements GDPRContract
{
    protected $table = 'gdpr';

    protected $fillable = [
        'channel_id',
        'locale_id',
        'gdpr_status',
        'customer_agreement_status',
        'agreement_label',
        'agreement_label_link_text',
        'agreement_cms_page_id',
        'cookie_status',
        'cookie_block_position',
        'cookie_static_block_identifier',
        'data_update_request_template',
        'data_delete_request_template',
        'request_status_update_template',
        'request_status_delete_template'
    ];
}
