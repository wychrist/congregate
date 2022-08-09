<?php

namespace Modules\CongregateCms\Repositories;

use App\Cms\Page;

class ContentRepository
{

    public function getLatestPost(): Page
    {
        // $default = new Page(['title' => 'We are cooking something', 'intro' => '', 'content' => 'A post will be out here soon']);
        return include_once content_dir('data/posts/latest.php');
    }

    public function findAPost(string | int $idOrSlug): Page | null
    {
        return (is_numeric($idOrSlug)) ? $this->findPostById($idOrSlug) : $this->findPostBySlug($idOrSlug);
    }

    public function getListOfPosts($total = 10): array
    {
        $lists = include_once content_dir('data/posts/list.php');
        if (count($lists) > $total) {
            return collect($lists)->splice(0, $total)->toArray();
        }

        return $lists;
    }

    public function findPostById(int $id): Page | null
    {
        try {
            return require(content_dir("data/posts/{$id}.php"));
        } catch (\Exception $_) {
            return null;
        }
    }

    public function findPostBySlug(string $slug): Page | null
    {
        try {
            $posts = include content_dir('data/posts/list.php');
            return collect($posts)->sole(function ($value) use ($slug) {
                return $value->slug == $slug;
            });
        } catch (\Exception $_) {
            return null;
        }
    }

    public function findAPage(string | int $idOrSlug): Page | null
    {
        return (is_numeric($idOrSlug)) ? $this->findPageById($idOrSlug) : $this->findPageBySlug($idOrSlug);
    }

    public function findPageById(int $id): Page | null
    {
        try {
            return require(content_dir("data/pages/{$id}.php"));
        } catch (\Exception $_) {
            return null;
        }
    }

    public function findPageBySlug(string $slug): Page | null
    {
        try {
            $pages = include(content_dir('data/pages/list.php'));
            return collect($pages)->sole(function ($value) use ($slug) {
                return $value->slug == $slug;
            });
        } catch (\Exception $_) {
            return null;
        }
    }
}
