<?php

namespace Modules\Page\app\ViewModels;

use Modules\Page\Models\Page;
use Spatie\ViewModels\ViewModel;

class PageViewModel extends ViewModel
{
    public Page $page;

    public function __construct($page = null)
    {
        $this->page = is_null($page) ? new Page(old()) : $page;
    }

    public function action(): string
    {
        return is_null($this->page->id)
            ? route('page.store')
            : route('page.update', ['page' => $this->page->id]);
    }

    public function method(): string
    {
        return is_null($this->page->id) ? 'POST' : 'PUT';
    }

}
