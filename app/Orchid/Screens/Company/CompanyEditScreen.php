<?php

namespace App\Orchid\Screens\Company;

use App\Models\Company;
use App\Orchid\Layouts\Company\CompanyEditLayout;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Orchid\Screen\Action;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Screen;
use Orchid\Support\Color;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Toast;

class CompanyEditScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'Edit company';

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
     * @var Company
     */
    private $company;

    /**
     * Query data.
     *
     * @param Company $company
     *
     * @return array
     */
    public function query(Company $company): array
    {
        $this->company = $company;

        if (!$company->exists) {
            $this->name = 'Create company';
        }

        return [
            'company' => $company,
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
                ->confirm(__('Once the company is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.'))
                ->method('remove')
                ->canSee($this->company->exists),

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
            Layout::columns([CompanyEditLayout::class]),
        ];
    }

    /**
     * @param Company $company
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function save(Company $company, Request $request)
    {
        $request_validated = $request->validate([
            'company.name' => [
                'required',
                Rule::unique(Company::class, 'name')->ignore($company),
            ],
        ]);

        $company
            ->fill($request_validated['company'])
            ->save();

        Toast::info(__('Company was saved.'));

        return redirect()->route('platform.systems.companies');
    }

    /**
     * @param Company $company
     *
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     *
     */
    public function remove(Company $company)
    {
        $company->delete();

        Toast::info(__('Company was removed'));

        return redirect()->route('platform.systems.companies');
    }
}
