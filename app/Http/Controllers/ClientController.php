<?php

namespace App\Http\Controllers;

use App\Events\Client\SendForm;
use App\Services\Client\ClientService;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

class ClientController extends Controller
{
    public function __construct(protected ClientService $clientService)
    {}

    public function index()
    {
        $countries = $this->clientService->getCountries();
        $clients = $this->clientService->getClients();

        return view('client.index', [
            'clients' => $clients,
            'clientsNumber' => count($clients),
            'countries' => $countries,
        ]);
    }

    public function add(Request $request)
    {
        SendForm::dispatch($request->input());

        // Validate request
        $request->validate([
            'name' => 'required|max:255',
            'city' => 'max:255',
            'postcode' => 'max:10',
            'street' => 'max:255',
            'house_number' => 'max:10',
        ]);

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

    public function edit(Request $request)
    {

    }

    public function save(Request $request)
    {

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
