<?php

namespace Webkul\GDPR\Http\Controllers\Admin;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;
use Webkul\GDPR\DataGrids\Admin\GDPRDataRequest;
use Webkul\GDPR\Http\Controllers\Controller;
use Webkul\GDPR\Mail\AdminUpdateDataRequestMail;
use Webkul\GDPR\Repositories\GDPRDataRequestRepository;
use Webkul\GDPR\Repositories\GDPRRepository;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @var Response
     */
    protected $_config;

    protected GDPRRepository $gdprRepository;

    protected GDPRDataRequestRepository $gdprDataRequestRepository;

    /**
     * Create a new controller instance.
     *
     * @param GDPRRepository $gdprRepository
     * @param GDPRDataRequestRepository $gdprDataRequestRepository
     * @return void
     */
    public function __construct(GDPRRepository $gdprRepository, GDPRDataRequestRepository $gdprDataRequestRepository)
    {
        $this->middleware('admin');
        $this->gdprRepository = $gdprRepository;
        $this->gdprDataRequestRepository = $gdprDataRequestRepository;
        $this->_config = request('_config');
    }

    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function customerDataRequest()
    {
        if (request()->ajax()) {
            return app(GDPRDataRequest::class)->toJson();
        }

        return view($this->_config['view']);
    }

    /**
     * Show the Data Request edit form
     *
     * @return View
     */
    public function edit($id)
    {
        $data = $this->gdprDataRequestRepository->find($id);

        return view($this->_config['view'], compact('data'));
    }

    /**
     * Method to update the Data Request information.
     *
     * @return RedirectResponse
     */
    public function update()
    {
        $data = request()->except('_token');
        $request = $this->gdprDataRequestRepository->where('id', $data['id'])->get();

        foreach ($request as $value) {
            $requestData = $value;
        }

        $result = $this->gdprDataRequestRepository->find($data['id'])->update($data);

        $params = $data + [
                'customer_id' => $requestData->customer_id,
                'email' => $requestData->email,
            ];

        if ($result) {
            try {
                if ($data['sent_email'] ?? false) {
                    Mail::queue(new AdminUpdateDataRequestMail($params));
                    session()->flash('success', trans('gdpr::app.response.update-success', ['name' => 'Data Request']));
                } else {
                    session()->flash('success', trans('gdpr::app.response.update-success-without-email'));
                }
            } catch (\Exception $e) {
                session()->flash('success', trans('gdpr::app.response.update-success-unsent-email', ['name' => 'Data Request']));
            }
        }

        return redirect()->route($this->_config['redirect']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return RedirectResponse
     */
    public function delete($id)
    {
        $this->gdprDataRequestRepository->findOrFail($id);

        try {
            $this->gdprDataRequestRepository->delete($id);
            session()->flash('success', trans('gdpr::app.response.delete-success', ['name' => 'Data Request']));
        } catch (\Exception $e) {
            session()->flash('error', trans('gdpr::app.response.attribute-reason-error', ['name' => 'Data Request']));
        }

        return redirect()->back();
    }
}
