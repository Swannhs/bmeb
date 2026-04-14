<?php

namespace App\Controllers;

use App\Libraries\MirrorContentRepository;
use App\Libraries\RemotePortalFetcher;
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
        return $this->serve($this->content->home());
    }

    public function notices()
    {
        return $this->serve($this->content->noticesList());
    }

    public function notice(string $slug)
    {
        return $this->serve($this->content->noticeDetail($slug));
    }

    public function officers()
    {
        return $this->serve($this->content->officersList());
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
    }
}
