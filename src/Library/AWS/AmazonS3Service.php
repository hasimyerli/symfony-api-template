<?php


namespace App\Library\AWS;

use Aws\S3\S3Client;

class AmazonS3Service
{
    private S3Client $client;

    private string $bucket;

    public function __construct(string $bucket, array $s3arguments)
    {
        $this->setBucket($bucket);
        $this->setClient(new S3Client($s3arguments));
    }

    public function upload(string $fileName, string $content, array $meta = [], string $privacy = 'public-read')
    {
        return $this->getClient()->upload($this->getBucket(), $fileName, $content, $privacy, [
            'ContentType' => $meta['ContentType']
        ])->toArray()['ObjectURL'];
    }

    public function uploadFile(string $fileName, string $newFilename = null, array $meta = [], string $privacy = 'public-read') {

        if(!$newFilename) {
            $newFilename = md5(uniqid(mt_rand(), true));
        }

        if(!isset($meta['contentType'])) {
            // Detect Mime Type
            $mimeTypeHandler = finfo_open(FILEINFO_MIME_TYPE);
            $meta['ContentType'] = finfo_file($mimeTypeHandler, $fileName);

            finfo_close($mimeTypeHandler);
        }

        return $this->upload($newFilename, file_get_contents($fileName), $meta, $privacy);
    }

    protected function getClient(): S3Client
    {
        return $this->client;
    }

    private function setClient(S3Client $client): AmazonS3Service
    {
        $this->client = $client;

        return $this;
    }

    protected function getBucket(): string
    {
        return $this->bucket;
    }

    private function setBucket($bucket): AmazonS3Service
    {
        $this->bucket = $bucket;

        return $this;
    }
}