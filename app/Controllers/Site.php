<?php

namespace App\Controllers;

use App\Libraries\MirrorContentRepository;
use App\Libraries\RemotePortalFetcher;
use App\Models\NoticeModel;
use CodeIgniter\Exceptions\PageNotFoundException;
use RuntimeException;

class Site extends BaseController
{
    private MirrorContentRepository $content;
    private RemotePortalFetcher $remote;

    public function __construct() {
        $this->content = new MirrorContentRepository();
        $this->remote = new RemotePortalFetcher();
    }

    public function home()
    {
        try {
            $noticeModel = new NoticeModel();
            $data['notices'] = $noticeModel->getRecent(6);
        } catch (\Throwable $e) {
            $data['notices'] = [
                ['title' => 'সিলেটের মত বিনিময় সভার সময় পরিবর্তন প্রসঙ্গে', 'publish_date' => date('Y-m-d'), 'is_new' => 1],
                ['title' => 'আপিল ও সালিশ কমিটির সভায় উপস্থিত হওয়ার পত্র', 'publish_date' => date('Y-m-d'), 'is_new' => 1],
                ['title' => '২০২৬ সালের ৬ষ্ঠ শ্রেণির রেজিস্ট্রেশনের ডাউনলোড ও সংশোধন', 'publish_date' => date('Y-m-d'), 'is_new' => 0],
            ];
        }
        return view('pages/home', $data);
    }

    public function notices()
    {
        try {
            $noticeModel = new NoticeModel();
            $data['notices'] = $noticeModel->orderBy('publish_date', 'DESC')->findAll();
        } catch (\Throwable $e) {
            $data['notices'] = [
                ['id' => 1, 'title' => 'সিলেটের মত বিনিময় সভার সময় পরিবর্তন প্রসঙ্গে', 'publish_date' => '2026-04-13', 'file_path' => '#'],
                ['id' => 2, 'title' => 'আপিল ও সালিশ কমিটির সভায় উপস্থিত হওয়ার পত্র', 'publish_date' => '2026-04-13', 'file_path' => '#'],
                ['id' => 3, 'title' => '২০২৬ সালের ৬ষ্ঠ শ্রেণির রেজিস্ট্রেশনের ডাউনলোড ও সংশোধন', 'publish_date' => '2026-04-13', 'file_path' => '#'],
            ];
        }
        return view('pages/notices', $data);
    }

    public function notice(string $slug)
    {
        try {
            $noticeModel = new NoticeModel();
            $notice = $noticeModel->where('slug', $slug)->first();
            if ($notice) {
                return view('pages/document', [
                    'title'   => $notice['title'],
                    'content' => $notice['content'] . '<br><br><a href="' . $notice['file_path'] . '" class="btn btn-primary">ডাউনলোড করুন</a>'
                ]);
            }
        } catch (\Throwable $e) {}
        
        return $this->serve($this->content->noticeDetail($slug));
    }

    public function officers()
    {
        try {
            $officerModel = new \App\Models\OfficerModel();
            $data['officers'] = $officerModel->orderBy('sort_order', 'ASC')->findAll();
        } catch (\Throwable $e) {
            $data['officers'] = [
                [
                    'name' => 'প্রফেসর মিঞা মোঃ নূরুল হক',
                    'designation' => 'চেয়ারম্যান',
                    'office' => 'বাংলাদেশ মাদ্রাসা শিক্ষা বোর্ড',
                    'email' => 'chairman@bmeb.gov.bd',
                    'phone_office' => '০২৫৮৬১০২১৬',
                    'mobile' => '০১৭১৩০০১২৩২',
                    'photo_url' => 'https://objectstorage.ap-dcc-gazipur-1.oraclecloud15.com/n/axvjbnqprylg/b/V2Ministry/o/office-bmeb/2024/12/9e0ef9ab396b4f7e96b8602de11711c7.jpg'
                ],
                [
                    'name' => 'প্রফেসর ছালেহ আহমাদ',
                    'designation' => 'রেজিস্ট্রার',
                    'office' => 'বাংলাদেশ মাদ্রাসা শিক্ষা বোর্ড',
                    'email' => 'registrar@bmeb.gov.bd',
                    'phone_office' => '০২৯৬১২৮৫৮',
                    'mobile' => '০১৩২৪৭২৭৩৬৫',
                    'photo_url' => 'https://objectstorage.ap-dcc-gazipur-1.oraclecloud15.com/n/axvjbnqprylg/b/V2Ministry/o/office-bmeb/2024/12/5fb070181013449fa7bf026022af9229.jpg'
                ]
            ];
        }
        return view('pages/officers', $data);
    }

    public function officer(string $slug)
    {
        return $this->serve($this->content->officerDetail($slug));
    }

    public function commonDocuments()
    {
        return $this->serve($this->content->commonDocumentsList($this->request->getGet('filters')));
    }

    public function commonDocument(string $slug)
    {
        return $this->serve($this->content->commonDocumentDetail($slug));
    }

    public function staticPage(string $id)
    {
        if (str_ends_with($id, '.html')) {
            return redirect()->to(base_url('p/' . str_replace('.html', '', $id)), 301);
        }
        return $this->renderCmsPage("pages/static-pages/$id") 
            ?? $this->serve($this->content->staticPage($id));
    }

    public function filePage(string $id)
    {
        return $this->serve($this->content->filePage($id));
    }

    public function newsArchive()
    {
        return $this->serve($this->content->newsArchive());
    }

    public function news(string $slug)
    {
        return $this->serve($this->content->newsDetail($slug));
    }

    public function externalLinks()
    {
        return $this->serve($this->content->externalLinksList());
    }

    public function externalLink(string $slug)
    {
        return $this->serve($this->content->externalLinkDetail($slug));
    }

    public function cmsPage(string $id)
    {
        if (str_ends_with($id, '.html')) {
            return redirect()->to(base_url('p/' . str_replace('.html', '', $id)), 301);
        }
        // Try various route key formats
        return $this->renderCmsPage("p/$id")
            ?? $this->renderCmsPage("pages/static-pages/$id")
            ?? $this->renderCmsPage($id)
            ?? throw PageNotFoundException::forPageNotFound($id);
    }

    public function mirror(string ...$segments)
    {
        $path = implode('/', array_filter($segments, static fn ($segment) => $segment !== ''));
        
        if (str_ends_with($path, '.html')) {
            $cleanPath = str_replace('.html', '', $path);
            if (str_contains($cleanPath, 'static-pages/')) {
                return redirect()->to(base_url('p/' . basename($cleanPath)), 301);
            }
            return redirect()->to(base_url($cleanPath), 301);
        }
        
        $path = str_replace('.html', '', $path);
        
        // Try DB first
        $cmsPage = $this->renderCmsPage($path);
        if ($cmsPage) return $cmsPage;

        try {
            return $this->serve(
                $this->content->assetOrMirror($path, (string) ($_SERVER['QUERY_STRING'] ?? '')),
            );
        } catch (PageNotFoundException) {
            return $this->proxyRemote($path);
        }
    }

    private function renderCmsPage(string $routeKey)
    {
        try {
            $cmsModel = new \App\Models\CmsPageModel();
            $page = $cmsModel->getByRouteKey($routeKey);
            if ($page) {
                $document = $this->mirroredDocuments->fromHtml((string) $page['html_content']);

                return view('pages/document', [
                    'page'    => $page,
                    'title'   => $page['title'] ?: $document['title'],
                    'content' => $document['mainContent']
                ]);
            }
        } catch (\Throwable $e) {
            // Log or ignore
        }
        return null;
    }

    private function serve(string $absolutePath)
    {
        return $this->renderMirrorFile($absolutePath);
    }

    private function proxyRemote(string $path)
    {
        return $this->renderDynamicOr(function () use ($path) {
            try {
                $remoteResponse = $this->remote->fetch($path, $this->request->getGet());
            } catch (RuntimeException) {
                throw PageNotFoundException::forPageNotFound($path);
            }

            return $this->renderMirrorContent(
                $remoteResponse['body'],
                $remoteResponse['contentType'],
                $remoteResponse['status'],
            );
        });
    }
}
