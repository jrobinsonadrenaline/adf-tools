<?php

declare(strict_types=1);

namespace DH\Adf\Child;

use DH\Adf\BlockNode;
use DH\Adf\Node;
use InvalidArgumentException;

/**
 * @see https://developer.atlassian.com/cloud/jira/platform/apis/document/nodes/media
 */
class Media extends Node
{
    public const TYPE_FILE = 'file';
    public const TYPE_LINK = 'link';

    protected string $type = 'media';
    private string $id;
    private string $mediaType;
    private string $collection;
    private ?string $occurrenceKey;
    private ?int $width;
    private ?int $height;

    public function __construct(string $id, string $mediaType, string $collection, ?int $width = null, ?int $height = null, ?string $occurrenceKey = null, ?BlockNode $parent = null)
    {
        if (!\in_array($mediaType, [self::TYPE_FILE, self::TYPE_LINK], true)) {
            throw new InvalidArgumentException('Invalid media type');
        }

        parent::__construct($parent);
        $this->id = $id;
        $this->mediaType = $mediaType;
        $this->collection = $collection;
        $this->occurrenceKey = $occurrenceKey;
        $this->width = $width;
        $this->height = $height;
    }

    protected function attrs(): array
    {
        $attrs = parent::attrs();

        $attrs['id'] = $this->id;
        $attrs['type'] = $this->mediaType;
        $attrs['collection'] = $this->collection;

        if (null !== $this->occurrenceKey) {
            $attrs['occurrenceKey'] = $this->occurrenceKey;
        }

        if (null !== $this->width) {
            $attrs['width'] = $this->width;
        }

        if (null !== $this->height) {
            $attrs['height'] = $this->height;
        }

        return $attrs;
    }
}