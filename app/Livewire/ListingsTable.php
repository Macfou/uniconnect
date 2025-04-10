<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Listing;

class ListingsTable extends Component
{
    use WithPagination;

    public $search = '';
    public $organization = '';

    protected $paginationTheme = 'tailwind';

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingOrganization()
    {
        $this->resetPage();
    }

    public function render()
    {
        $organizations = Listing::select('organization')->distinct()->pluck('organization');

        $listings = Listing::when($this->organization, function ($query) {
                $query->where('organization', $this->organization);
            })
            ->when($this->search, function ($query) {
                $query->where('tags', 'like', '%' . $this->search . '%');
            })
            ->paginate(10);

        return view('livewire.listings-table', [
            'listings' => $listings,
            'organizations' => $organizations
        ]);
    }
}
