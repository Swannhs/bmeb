<?php

namespace App\Controllers;

use App\Libraries\RemotePortalFetcher;
use CodeIgniter\HTTP\ResponseInterface;
use RuntimeException;

class PortalView extends BaseController
{
    public function __construct(
        private readonly RemotePortalFetcher $remote = new RemotePortalFetcher(),
    ) {
    }

    public function search(): ResponseInterface
    {
        try {
            $remoteResponse = $this->remote->fetch('views/search', $this->request->getGet());
        } catch (RuntimeException $exception) {
            return $this->response
                ->setStatusCode(502)
                ->setBody('Unable to load search results at the moment.');
        }

        return $this->renderMirrorContent(
            $remoteResponse['body'],
            $remoteResponse['contentType'],
            $remoteResponse['status'],
        );
    }
}
