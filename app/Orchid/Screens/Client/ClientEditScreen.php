<?php

namespace App\Orchid\Screens\Client;

use App\Http\Requests\ClientEditRequest;
use App\Models\Client;
use App\Orchid\Layouts\Client\ClientInformationEditLayout;
use App\Orchid\Layouts\Client\ClientRelationEditLayout;
use Orchid\Screen\Action;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Toast;

class ClientEditScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'Edit client';

    /**
     * Display header description.
     *
     * @var string
     */
    public $description = 'Details such as name, email and password';

    /**
     * Permissions for this screen
     *
     * @var array|string
     */
    public $permission = [
        'platform.systems.users'
    ];


    /**
     * @var Client
     */
    private $client;

    /**
     * Query data.
     *
     * @param Client $client
     *
     * @return array
     */
    public function query(Client $client): array
    {
        $this->client = $client;

        if (!$client->exists) {
            $this->name = 'Create client';
        }

        return [
            'client' => $client,
        ];
    }

    /**
     * Button commands.
     *
     * @return Action[]
     */
    public function commandBar(): array
    {
        return [
            Button::make(__('Remove'))
                ->icon('trash')
                ->confirm(__('Once the client is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.'))
                ->method('remove')
                ->canSee($this->client->exists),

            Button::make(__('Save'))
                ->icon('check')
                ->method('save'),
        ];
    }

    /**
     * @return \Orchid\Screen\Layout[]
     */
    public function layout(): array
    {
        return [
            Layout::columns([
                ClientInformationEditLayout::class,
                ClientRelationEditLayout::class,
            ]),
        ];
    }

    /**
     * @param Client $client
     * @param ClientEditRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function save(Client $client, ClientEditRequest $request)
    {
        $data = $request->validated();

        $client
            ->fill($data['client'])
            ->save();

        Toast::info(__('Client was saved.'));

        return redirect()->route('platform.systems.clients');
    }

    /**
     * @param Client $client
     *
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     *
     */
    public function remove(Client $client)
    {
        $client->delete();

        Toast::info(__('Client was removed'));

        return redirect()->route('platform.systems.clients');
    }
}
