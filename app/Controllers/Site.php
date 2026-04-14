<?php

namespace App\Controllers;

use App\Libraries\MirrorContentRepository;
use App\Libraries\RemotePortalFetcher;
use App\Models\NoticeModel;
use CodeIgniter\Exceptions\PageNotFoundException;
use RuntimeException;

class Site extends BaseController
{
    public function __construct(
        private readonly MirrorContentRepository $content = new MirrorContentRepository(),
        private readonly RemotePortalFetcher $remote = new RemotePortalFetcher(),
    ) {
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
        return $this->serve($this->content->noticeDetail($slug));
    }

    public function officers()
    {
        return view('pages/officers');
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
        return $this->serve($this->content->staticPage($id));
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

    public function mirror(string ...$segments)
    {
        $path = implode('/', array_filter($segments, static fn ($segment) => $segment !== ''));

        try {
            return $this->serve(
                $this->content->assetOrMirror($path, (string) ($_SERVER['QUERY_STRING'] ?? '')),
            );
        } catch (PageNotFoundException) {
            return $this->proxyRemote($path);
        }
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
