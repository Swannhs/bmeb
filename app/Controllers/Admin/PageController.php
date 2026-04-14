<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Libraries\CmsPageService;
use App\Models\CmsPageModel;

class PageController extends BaseController
{
    public function __construct(
        private readonly CmsPageModel $pages = new CmsPageModel(),
        private readonly CmsPageService $cms = new CmsPageService(),
    ) {
    }

    public function index()
    {
        $search = trim((string) $this->request->getGet('search'));
        $section = trim((string) $this->request->getGet('section'));

        $builder = $this->pages->orderBy('updated_at', 'DESC');

        if ($search !== '') {
            $builder = $builder->groupStart()
                ->like('title', $search)
                ->orLike('route_key', $search)
                ->groupEnd();
        }

        if ($section !== '') {
            $builder = $builder->where('section', $section);
        }

        return view('admin/pages/index', [
            'pages'    => $builder->paginate(30),
            'pager'    => $this->pages->pager,
            'search'   => $search,
            'section'  => $section,
            'sections' => (new CmsPageModel())->select('section')->distinct()->orderBy('section', 'ASC')->findColumn('section') ?? [],
        ]);
    }

    public function new()
    {
        return view('admin/pages/form', [
            'page'   => null,
            'errors' => session()->getFlashdata('errors') ?? [],
        ]);
    }

    public function create()
    {
        return $this->savePage();
    }

    public function edit(int $id)
    {
        $page = $this->pages->find($id);

        if ($page === null) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Admin page not found');
        }

        return view('admin/pages/form', [
            'page'   => $page,
            'errors' => session()->getFlashdata('errors') ?? [],
        ]);
    }

    public function update(int $id)
    {
        return $this->savePage($id);
    }

    public function delete(int $id)
    {
        $this->pages->delete($id);

        return redirect()->to('/admin/pages')->with('message', 'Page deleted.');
    }

    public function import()
    {
        $imported = $this->cms->importMirrorPages();

        return redirect()->to('/admin/pages')->with('message', "Imported {$imported} mirror pages.");
    }

    private function savePage(?int $id = null)
    {
        $payload = $this->cms->preparePageData([
            'route_key'    => trim((string) $this->request->getPost('route_key')),
            'title'        => trim((string) $this->request->getPost('title')),
            'html_content' => (string) $this->request->getPost('html_content'),
            'source_type'  => 'admin',
            'source_path'  => trim((string) $this->request->getPost('source_path')),
            'status'       => trim((string) $this->request->getPost('status')) ?: 'published',
        ]);

        $rules = [
            'route_key'    => 'required',
            'html_content' => 'required',
            'status'       => 'required|in_list[published,draft]',
        ];

        if (! $this->validateData($payload, $rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $existing = $this->pages->where('route_key', $payload['route_key'])->first();

        if ($existing !== null && (int) $existing['id'] !== (int) $id) {
            return redirect()->back()->withInput()->with('errors', [
                'route_key' => 'That route key is already in use.',
            ]);
        }

        if ($id !== null) {
            $payload['id'] = $id;
        }

        $this->pages->save($payload);

        return redirect()->to('/admin/pages')->with('message', 'Page saved.');
    }
}
