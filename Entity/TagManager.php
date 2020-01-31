<?php

/*
 * This file is part of the FPNTagBundle package.
 * (c) 2011 Fabien Pennequin <fabien@pennequin.me>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FPN\TagBundle\Entity;

use Doctrine\ORM\EntityManagerInterface;
use FPN\TagBundle\Taggable\TagManager as BaseTagManager;
use FPN\TagBundle\Util\SlugifierInterface;

class TagManager extends BaseTagManager
{
    protected $slugifier;

    public function __construct(EntityManagerInterface $em, $tagClass = null, $taggingClass = null, SlugifierInterface $slugifier)
    {
        parent::__construct($em, $tagClass, $taggingClass);
        $this->slugifier = $slugifier;
    }

    protected function createTag($name)
    {
        $tag = parent::createTag($name);
        $tag->setSlug($this->slugifier->slugify($name));

        return $tag;
    }
}
