<?php

use App\Models\Tag;

function tag_label(Tag $tag)
{
    return "<i class='fas fa-circle' style='color: {$tag->color}'></i> {$tag->name}";
}
