<?php

namespace App\Controllers;

use App\Libraries\MirroredDocumentFactory;
use App\Libraries\NativePageViewLocator;
use Config\Mimes;
use CodeIgniter\Controller;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

/**
 * BaseController provides a convenient place for loading components
 * and performing functions that are needed by all your controllers.
 *
 * Extend this class in any new controllers:
 * ```
 *     class Home extends BaseController
 * ```
 *
 * For security, be sure to declare any new methods as protected or private.
 */
abstract class BaseController extends Controller
{
    protected MirroredDocumentFactory $mirroredDocuments;
    protected NativePageViewLocator $nativePageViews;

    /**
     * Be sure to declare properties for any property fetch you initialized.
     * The creation of dynamic property is deprecated in PHP 8.2.
     */

    // protected $session;

    /**
     * @return void
     */
    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        // Load here all helpers you want to be available in your controllers that extend BaseController.
        // Caution: Do not put the this below the parent::initController() call below.
        // $this->helpers = ['form', 'url'];

        // Caution: Do not edit this line.
        parent::initController($request, $response, $logger);

        $this->mirroredDocuments = new MirroredDocumentFactory();
        $this->nativePageViews = new NativePageViewLocator();

        // Preload any models, libraries, etc, here.
        // $this->session = service('session');
    }

    protected function renderMirrorFile(string $absolutePath): ResponseInterface
    {
        $extension = pathinfo($absolutePath, PATHINFO_EXTENSION);
        $mimeType = $this->detectMimeType($absolutePath, $extension);

        if (
            str_starts_with(strtolower($mimeType), 'text/html')
            && $this->nativePageViews->hasViewForFile($absolutePath)
        ) {
            return $this->response
                ->setContentType('text/html', 'UTF-8')
                ->setBody(view($this->nativePageViews->viewNameForFile($absolutePath)));
        }

        return $this->renderMirrorContent(
            (string) file_get_contents($absolutePath),
            $mimeType,
        );
    }

    protected function renderMirrorContent(string $content, string $contentType = 'text/html; charset=UTF-8', int $statusCode = 200): ResponseInterface
    {
        $response = $this->response->setStatusCode($statusCode);

        if (str_starts_with(strtolower($contentType), 'text/html')) {
            return $response
                ->setContentType('text/html', 'UTF-8')
                ->setBody(view('mirror/document', [
                    'document' => $this->mirroredDocuments->fromHtml($content),
                ]));
        }

        return $response
            ->setContentType($contentType)
            ->setBody($content);
    }

    protected function detectMimeType(string $absolutePath, string $extension): string
    {
        if ($extension !== '') {
            $mimeTypes = Mimes::guessTypeFromExtension($extension);

            if ($mimeTypes !== null) {
                return $mimeTypes;
            }
        }

        return mime_content_type($absolutePath) ?: 'text/html; charset=UTF-8';
    }
}
