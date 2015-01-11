<?php

/*
 * This file is part of Laravel Dropbox.
 *
 * (c) Graham Campbell <graham@mineuk.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace GrahamCampbell\Dropbox;

use GrahamCampbell\Dropbox\Factories\DropboxFactory;
use GrahamCampbell\Manager\AbstractManager;
use Illuminate\Config\Repository;

/**
 * This is the dropbox manager class.
 *
 * @method string getAccessToken()
 * @method string getClientIdentifier()
 * @method string|null getUserLocale()
 * @method string getHost()
 * @method string appendFilePath(string $base, string $path)
 * @method void disableAccessToken()
 * @method array getAccountInfo()
 * @method array|null getFile(string $path, resource $outStream, string|null $rev = null)
 * @method mixed uploadFile(string $path, \Dropbox\WriteMode $writeMode, string $data)
 * @method mixed uploadFileChunked(string $path, \Dropbox\WriteMode $writeMode, resource $inStream, int|null $numBytes = null, int|null $chunkSize = null)
 * @method array chunkedUploadStart(string $data)
 * @method int|bool chunkedUploadContinue(string $uploadId, int $byteOffset, string $data)
 * @method array|null chunkedUploadFinish(string $uploadId, string $path, \Dropbox\WriteMode $writeMode)
 * @method array|null getMetadata(string $path)
 * @method array|null getMetadataWithChildren(string $path)
 * @method array getMetadataWithChildrenIfChanged(string $path, string $previousFolderHash)
 * @method array getDelta(string|null $cursor = null, string|null $pathPrefix = null)
 * @method array|null getRevisions(string $path, int|null $limit = null)
 * @method mixed restoreFile(string $path, string $rev)
 * @method mixed searchFileNames(string $basePath, string $query, int|null $limit = null, bool $includeDeleted = false)
 * @method string createShareableLink(string $path)
 * @method array createTemporaryDirectLink(string $path)
 * @method string createCopyRef(string $path)
 * @method array|null getThumbnail(string $path, string $format, string $size)
 * @method mixed copy(string $fromPath, string $toPath)
 * @method mixed copyFromCopyRef(string $copyRef, string $toPath)
 * @method array|null createFolder(string $path)
 * @method mixed delete(string $path)
 * @method mixed move(string $fromPath, string $toPath)
 * @method string buildUrlForGetOrPut(string $host, string $path, array|null $params = null)
 * @method \Dropbox\HttpResponse doGet(string $host, string $path, array|null $params = null)
 * @method \Dropbox\HttpResponse doPost(string $host, string $path, array|null $params = null)
 * @method \Dropbox\Curl mkCurl(string $url)
 * @method \DateTime parseDateTime(string $apiDateTimeString)
 * @method string|null getAccessTokenError(string $s)
 *
 * @author Graham Campbell <graham@mineuk.com>
 */
class DropboxManager extends AbstractManager
{
    /**
     * The factory instance.
     *
     * @var \GrahamCampbell\Dropbox\Factories\DropboxFactory
     */
    protected $factory;

    /**
     * Create a new dropbox manager instance.
     *
     * @param \Illuminate\Config\Repository                    $config
     * @param \GrahamCampbell\Dropbox\Factories\DropboxFactory $factory
     *
     * @return void
     */
    public function __construct(Repository $config, DropboxFactory $factory)
    {
        parent::__construct($config);
        $this->factory = $factory;
    }

    /**
     * Create the connection instance.
     *
     * @param array $config
     *
     * @return \Dropbox\Client
     */
    protected function createConnection(array $config)
    {
        return $this->factory->make($config);
    }

    /**
     * Get the configuration name.
     *
     * @return string
     */
    protected function getConfigName()
    {
        return 'graham-campbell/dropbox';
    }

    /**
     * Get the factory instance.
     *
     * @return \GrahamCampbell\Dropbox\Factories\DropboxFactory
     */
    public function getFactory()
    {
        return $this->factory;
    }
}
