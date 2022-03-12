<?php

namespace App\Http\Controllers;

use App\Events\Client\SendForm;
use App\Services\Client\ClientService;
use App\Services\Client\FormValidation;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

class ClientController extends Controller
{
    use FormValidation;

    public function __construct(protected ClientService $clientService)
    {
        view()->share('nav', 'client');
    }

    public function index()
    {
        $countries = $this->clientService->getCountries();
        $clients = $this->clientService->getClients();

        return view('client.index', [
            'clients' => $clients,
            'clientsNumber' => count($clients),
            'countries' => $countries,
            'breadcrumb' => [
                ['name' => _('Clients')]
            ]
        ]);
    }

    /**
     * Add client
     * @param Request $request
     * @return RedirectResponse
     */
    public function add(Request $request)
    {
        SendForm::dispatch($request->input());

        // Validate request
        $request->validate($this->getFormValidationRules());

        // Add client
        $this->clientService->addClient(
            $request->input('name'),
            $request->input('country'),
            $request->input('city'),
            $request->input('postcode'),
            $request->input('street'),
            $request->input('houseNumber'),
        );

        // Redirect with success message
        return redirect()->back()->with('success', $this->clientService::$messages['client added']);
    }

    /**
     * Edit client
     * @param Request $request
     * @return void
     */
    public function edit(Request $request)
    {
        $countries = $this->clientService->getCountries();
        $client = $this->clientService->getClient($request->id);

        return view('client.edit', [
            'client' => $client,
            'countries' => $countries
        ]);
    }

    public function save(Request $request)
    {
        // Validate request
        $request->validate($this->getFormValidationRules());

        $this->clientService->saveClient(
            $request->id,
            $request->input('name'),
            $request->input('country'),
            $request->input('city'),
            $request->input('postcode'),
            $request->input('street'),
            $request->input('houseNumber')
        );

        // Redirect with success message
        return redirect()->back()->with('success', $this->clientService::$messages['client saved']);
    }

    /**
     * Disable client
     * @param Request $request
     * @return RedirectResponse
     */
    public function disable(Request $request): RedirectResponse
    {
        $this->clientService->disable($request->id);

        // Redirect with success message
        return redirect()->back()->with('success', $this->clientService::$messages['client disabled']);
    }
}
