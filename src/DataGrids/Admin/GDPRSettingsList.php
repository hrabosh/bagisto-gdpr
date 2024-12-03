<?php

namespace Webkul\GDPR\DataGrids\Admin;

use Illuminate\Support\Facades\DB;
use Webkul\DataGrid\DataGrid;

class GDPRSettingsList extends DataGrid
{
    /**
     * @var integer
     */
    protected $primaryColumn = 'id';

    protected $sortOrder = 'desc'; //asc or desc

    public function prepareQueryBuilder()
    {
        return DB::table('gdpr')
            ->leftJoin('channels', 'channels.id', '=', 'gdpr.channel_id')
            ->leftJoin('locales', 'locales.id', '=', 'gdpr.locale_id')
            ->addSelect('gdpr.id',
                'channels.code AS channel_code',
                'locales.code AS locale_code',
                'gdpr.gdpr_status',
                'gdpr.customer_agreement_status',
                'gdpr.cookie_status',
                'gdpr.updated_at',
                'gdpr.created_at',
            );
    }

    public function prepareColumns()
    {
        $this->addColumn([
            'index' => 'id',
            'label' => 'ID',
            'type' => 'integer',
            'searchable' => true,
            'sortable' => true,
            'filterable' => true
        ]);

        $this->addColumn([
            'index' => 'channel_code',
            'label' => trans('gdpr::app.admin.settings.fields.channel-code'),
            'type' => 'string',
            'searchable' => true,
            'sortable' => true,
            'filterable' => true
        ]);

        $this->addColumn([
            'index' => 'locale_code',
            'label' => trans('gdpr::app.admin.settings.fields.locale-code'),
            'type' => 'string',
            'searchable' => true,
            'sortable' => true,
            'filterable' => true
        ]);

        $this->addColumn([
            'index' => 'gdpr_status',
            'label' => trans('gdpr::app.admin.settings.fields.enabled-gdpr'),
            'type' => 'boolean',
            'searchable' => false,
            'sortable' => true,
            'filterable' => false,
            'closure' => function ($row) {
                switch ($row->gdpr_status) {
                    case 0:
                        return '<p class="label-canceled">' . trans('gdpr::app.admin.settings.fields.inactive') . '</p>';
                    case 1:
                        return '<p class="label-active">' . trans('gdpr::app.admin.settings.fields.active') . '</p>';
                }
            },
        ]);

        $this->addColumn([
            'index' => 'customer_agreement_status',
            'label' => trans('gdpr::app.admin.settings.fields.enabled-customer-data-agreement'),
            'type' => 'string',
            'searchable' => false,
            'sortable' => true,
            'filterable' => false,
            'closure' => function ($row) {
                switch ($row->customer_agreement_status) {
                    case 0:
                        return '<p class="label-canceled">' . trans('gdpr::app.admin.settings.fields.inactive') . '</p>';
                    case 1:
                        return '<p class="label-active">' . trans('gdpr::app.admin.settings.fields.active') . '</p>';
                }
            },
        ]);

        $this->addColumn([
            'index' => 'cookie_status',
            'label' => trans('gdpr::app.admin.settings.fields.enabled-cookie-notice'),
            'type' => 'string',
            'searchable' => false,
            'sortable' => true,
            'filterable' => false,
            'closure' => function ($row) {
                switch ($row->cookie_status) {
                    case 0:
                        return '<p class="label-canceled">' . trans('gdpr::app.admin.settings.fields.inactive') . '</p>';
                    case 1:
                        return '<p class="label-active">' . trans('gdpr::app.admin.settings.fields.active') . '</p>';
                }
            },
        ]);

        $this->addColumn([
            'index' => 'updated_at',
            'label' => trans('gdpr::app.shop.customer-index-field.updated-at'),
            'type' => 'datetime',
            'sortable' => true,
            'searchable' => false,
            'filterable' => true
        ]);

        $this->addColumn([
            'index' => 'created_at',
            'label' => trans('gdpr::app.shop.customer-index-field.created-at'),
            'type' => 'datetime',
            'sortable' => true,
            'searchable' => false,
            'filterable' => true
        ]);
    }

    public function prepareActions()
    {
        $this->addAction([
            'icon' => 'icon-edit',
            'title' => trans('gdpr::app.admin.data-request.edit-data-request'),
            'method' => 'GET',
            'url' => function ($row) {
                return route('admin.gdpr.settings.edit', $row->id);
            },
        ]);

        if (bouncer()->hasPermission('admin.gdpr.settings.delete')) {
            $this->addAction([
                'icon' => 'icon-delete',
                'title' => trans('gdpr::app.admin.data-request.delete-data-request'),
                'method' => 'DELETE',
                'url' => function ($row) {
                    return route('admin.gdpr.settings.delete', $row->id);
                },
                'confirm_text' => trans('ui::app.datagrid.massaction.delete'),
            ]);
        }
    }
}
