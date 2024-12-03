<?php

namespace Webkul\GDPR\Http\Controllers\Admin;

use Illuminate\Database\Query\Builder;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;
use Prettus\Validator\Exceptions\ValidatorException;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;
use Webkul\Admin\DataGrids\CMS\CMSPageDataGrid;
use Webkul\DataGrid\Exceptions\InvalidDataGridException;
use Webkul\GDPR\DataGrids\Admin\GDPRSettingsList;
use Webkul\GDPR\Http\Controllers\Controller;
use Webkul\GDPR\Models\GDPR;
use Webkul\GDPR\Repositories\GDPRRepository;

class SettingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @var Response
     */
    protected $_config;

    private GDPRRepository $gdprRepository;

    /**
     * @param GDPRRepository $gdprRepository
     * @return void
     */
    public function __construct(GDPRRepository $gdprRepository)
    {
        $this->middleware('admin');
        $this->gdprRepository = $gdprRepository;
        $this->_config = request('_config');
    }

    /**
     * @return View
     */
    public function index()
    {
        if (request()->ajax()) {
            return app(GDPRSettingsList::class)->process();
        }

        return view($this->_config['view']);
    }

    public function create()
    {
        return $this->edit();
    }

    /**
     * @param int|null $id
     * @return View
     * @throws InvalidDataGridException
     */
    public function edit(int $id = null)
    {
        $gdprSettings = null;
        if ($id > 0) {
            $gdprSettings = $this->gdprRepository->findOneWhere([
                'id' => $id,
            ]);
        }

        $pageDataGrid = datagrid(CMSPageDataGrid::class);
        /** @var \Illuminate\Database\Query\Builder $qb */
        $qb = $pageDataGrid->prepareQueryBuilder();

        return view($this->_config['view'], [
            'gdprData' => $gdprSettings,
            'pages' => $qb->get(),
        ]);
    }

    /**
     * @param $id
     * @return RedirectResponse
     * @throws ValidationException
     * @throws ValidatorException
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function store($id)
    {
        $this->validate(request(), [
            'channel_id'   => 'required|in:'.implode(',', (core()->getAllChannels()->pluck('id')->toArray())),
            'locale_id' => [
                'required',
                'exists:locales,id',
                Rule::unique(GDPR::class)
                    ->ignore($id)
                    ->where(fn(Builder $query) => $query
                        ->where('channel_id', request('channel_id'))
                        ->where('locale_id', request('locale_id'))
                    ),
            ],
        ]);

        if (is_numeric($id)) {
            $gdpr = $this->gdprRepository->findOneWhere([
                'id' => $id,
            ]);
            if (!$gdpr) {
                session()->flash('error', trans('gdpr::app.admin.create-gdpr.update-fail'));
                return redirect()->back();
            }
        }

        $gdprStatus = 0;
        if (request()->get('enabled_gdpr') == 'on') {
            $gdprStatus = 1;
        }

        $customerAgreementStatus = 0;
        if (request()->get('customer_agreement') == 'on') {
            $customerAgreementStatus = 1;
        }

        $cookieStatus = 0;
        if (request()->get('enabled_cookie_notice') == 'on') {
            $cookieStatus = 1;
        }

        $params = request()->except('_token') + [
                'gdpr_status' => $gdprStatus,
                'customer_agreement_status' => $customerAgreementStatus,
                'cookie_status' => $cookieStatus
            ];

        unset($params['enabled_gdpr']);
        unset($params['customer_agreement']);
        unset($params['enabled_cookie_notice']);

        if ($id == 'new') {
            $result = $this->gdprRepository->create($params);
        } else {
            $result = $this->gdprRepository->update($params, $id);
        }

        if ($result) {
            session()->flash('success', trans('gdpr::app.admin.create-gdpr.update-success'));
        } else {
            session()->flash('error', trans('gdpr::app.admin.create-gdpr.update-fail'));
        }

        Artisan::call('optimize');

        return redirect()->route($this->_config['redirect']);
    }

    /**
     * @param int $id
     * @return JsonResponse
     */
    public function destroy(int $id): JsonResponse
    {
        $this->gdprRepository->findOrFail($id);

        try {
            $this->gdprRepository->delete($id);
            return new JsonResponse([
                'message' => trans('gdpr::app.admin.settings.response.delete-success'),
            ], 200);
        } catch (\Exception $e) {
            report($e);

            return new JsonResponse([
                'message' => trans('gdpr::app.admin.settings.response.delete-failed'),
            ], 500);
        }
    }
}
