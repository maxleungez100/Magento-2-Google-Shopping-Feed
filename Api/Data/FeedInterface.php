<?php

declare(strict_types=1);

namespace RunAsRoot\GoogleShoppingFeed\Api\Data;

interface FeedInterface
{
    public const FILENAME = 'filename';
    public const PATH = 'path';
    public const LINK = 'link';
    public const LAST_GENERATED = 'last_generated';
    public const STORE = 'store';

    /**
     * Feed file name
     *
     * @return string
     */
    public function getFileName(): string;

    /**
     * @param string $fileName
     *
     * @return $this
     */
    public function setFileName(string $fileName): FeedInterface;

    /**
     * Feed media path
     *
     * @return string
     */
    public function getPath(): string;

    /**
     * @param string $path
     *
     * @return $this
     */
    public function setPath(string $path): FeedInterface;

    /**
     * Feed Link for Google
     *
     * @return string
     */
    public function getLink(): string;

    /**
     * @param string $link
     *
     * @return $this
     */
    public function setLink(string $link): FeedInterface;

    /**
     * Feed Last Generated Time
     *
     * @return string
     */
    public function getLastGenerated(): string;

    /**
     * @param string $lastGenerated
     *
     * @return $this
     */
    public function setLastGenerated(string $lastGenerated): FeedInterface;

    /**
     * Feed Store View
     *
     * @return string
     */
    public function getStore(): string;

    /**
     * @param string $store
     *
     * @return $this
     */
    public function setStore(string $store): FeedInterface;
}
