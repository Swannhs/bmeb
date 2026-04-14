<?php

namespace App\Controllers;

use App\Libraries\RemotePortalFetcher;
use CodeIgniter\HTTP\ResponseInterface;
use RuntimeException;

class Ajax extends BaseController
{
    public function __construct(
        private readonly RemotePortalFetcher $remote = new RemotePortalFetcher(),
    ) {
    }

    public function proxy(string ...$segments): ResponseInterface
    {
        $path = implode('/', array_filter($segments, static fn ($segment) => $segment !== ''));

        try {
            $remoteResponse = $this->remote->fetch('ajax/' . ltrim($path, '/'), $this->request->getGet());
        } catch (RuntimeException $exception) {
            return $this->response
                ->setStatusCode(502)
                ->setJSON([
                    'message' => 'Unable to load remote portal data.',
                    'error'   => $exception->getMessage(),
                ]);
        }

        return $this->response
            ->setStatusCode($remoteResponse['status'])
            ->setContentType($remoteResponse['contentType'])
            ->setBody($remoteResponse['body']);
    }

    public function submitOpinion(): ResponseInterface
    {
        $name = trim((string) $this->request->getPost('name'));
        $email = trim((string) $this->request->getPost('email'));
        $phone = trim((string) $this->request->getPost('phone'));
        $body = trim((string) $this->request->getPost('body'));
        $type = trim((string) ($this->request->getPost('type') ?: $this->request->getPost('opinionType') ?: 'suggestion'));
        $referrerUrl = trim((string) $this->request->getPost('referrer_url'));
        $attachment = $this->request->getFile('attachment');

        if ($name === '' || ! filter_var($email, FILTER_VALIDATE_EMAIL) || preg_match('/^01[0-9]{9}$/', $phone) !== 1 || mb_strlen(strip_tags($body)) < 20) {
            return $this->response
                ->setStatusCode(422)
                ->setJSON(['message' => 'Please provide valid opinion form তথ্য.']);
        }

        $attachmentPath = null;

        if ($attachment !== null && $attachment->isValid() && ! $attachment->hasMoved()) {
            $allowedMimeTypes = [
                'image/jpeg',
                'image/png',
                'application/pdf',
            ];

            if ($attachment->getSize() > 2 * 1024 * 1024 || ! in_array($attachment->getMimeType(), $allowedMimeTypes, true)) {
                return $this->response
                    ->setStatusCode(422)
                    ->setJSON(['message' => 'Attachment must be JPG, PNG, or PDF and within 2MB.']);
            }

            $attachmentDirectory = WRITEPATH . 'uploads/opinions';

            if (! is_dir($attachmentDirectory)) {
                mkdir($attachmentDirectory, 0775, true);
            }

            $storedName = $attachment->getRandomName();
            $attachment->move($attachmentDirectory, $storedName);
            $attachmentPath = 'writable/uploads/opinions/' . $storedName;
        }

        $storageDirectory = WRITEPATH . 'opinions';

        if (! is_dir($storageDirectory)) {
            mkdir($storageDirectory, 0775, true);
        }

        $record = [
            'submitted_at' => date(DATE_ATOM),
            'type'         => $type,
            'name'         => $name,
            'email'        => $email,
            'phone'        => $phone,
            'body'         => $body,
            'referrer_url' => $referrerUrl,
            'attachment'   => $attachmentPath,
            'ip_address'   => (string) $this->request->getIPAddress(),
            'user_agent'   => (string) $this->request->getUserAgent(),
        ];

        $fileName = $storageDirectory . '/' . date('Ymd_His') . '_' . bin2hex(random_bytes(4)) . '.json';
        file_put_contents($fileName, json_encode($record, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));

        return $this->response->setJSON([
            'message' => 'আপনার মতামত সফলভাবে জমা হয়েছে।',
        ]);
    }
}
