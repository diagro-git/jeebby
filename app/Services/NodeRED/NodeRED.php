<?php
namespace App\Services\NodeRED;

use Illuminate\Support\Collection;

class NodeRED
{

    private Collection $tabs;

    public function __construct()
    {
        $this->tabs = new Collection();
    }

    public function toArray(): array
    {
        return [
        ];
    }

    public function addTab(Tab $tab): self
    {
        $this->tabs->add($tab);
        return $this;
    }

    public function tabs(): Collection
    {
        return $this->tabs->collect();
    }

    public function removeTab(Tab|string $tab): self
    {
        if($tab instanceof Tab) {
            $tab = $tab->id;
        }

        $this->tabs = $this->tabs->reject(fn(Tab $entry) => $entry->id = $tab);
        return $this;
    }

    public function find(string $id): Tab|Node|null
    {
        $found = null;
        /** @var Tab $tab */
        foreach($this->tabs as $tab) {
            if($found == null) {
                if($tab->id == $id) {
                    $found = $tab;
                } else {
                    $found = $tab->find($id);
                }
            }
        }

        return $tab;
    }

}
