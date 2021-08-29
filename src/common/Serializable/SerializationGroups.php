<?php

declare(strict_types=1);

namespace App\Common\Serializable;

final class SerializationGroups
{
    public const USER = 'user';
    public const PATCH_USER = 'user.patch';
    public const UPDATE_USER = 'user-update';

    public const POST = 'post';
    public const PATCH_POST = 'post.patch';
    public const UPDATE_POST = 'post-update';
}