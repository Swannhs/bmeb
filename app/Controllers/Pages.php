<?php

namespace App\Controllers;

use App\Libraries\MirrorContentRepository;

class Pages extends BaseController
{
    public function __construct(
        private readonly MirrorContentRepository $content = new MirrorContentRepository(),
    ) {
    }

    public function index(string $section)
    {
        return $this->serve($this->content->pageIndex($section, $this->request->getGet()));
    }

    public function detail(string $section, string $slug)
    {
        return $this->serve($this->content->pageDetail($section, $slug));
    }

    private function serve(string $absolutePath)
    {
        return $this->renderMirrorFile($absolutePath);
    }
}
