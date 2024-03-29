<?php

namespace Modules\CongregateUi\Services;


class MenuItem
{

    private $children = [];
    private string $label;
    private string $link;
    private string $id;
    private string | null $icon;
    private bool $active;
    private  MenuItem | null $parent = null;
    private bool $hasActiveChild = false;

    public function __construct(string $label, string | array $link = '#', string $icon = null, string $id = null, bool $active = false)
    {
        $this->label = $label;
        $routeName = $link;

        if (is_array($link)) {
            $routeName = $link[0];
            $parameters = (isset($link[1])) ? $link[1] : [];
            $this->link = route($routeName, $parameters);
        } else {
            $this->link = $link;
        }
        $this->active = $active;
        $this->id  = $id ?? md5($this->label . $routeName);
        $this->icon = $icon;

        if (is_array($link)) {
            MenuService::watchRoute($routeName, $this);
        }
    }

    public function setParent(MenuItem $parent): self
    {
        $this->parent = $parent;
        return $this;
    }

    public function getParent(): MenuItem | null
    {
        return $this->parent;
    }

    public function getLabel(): string
    {
        return $this->label;
    }

    public function getLink(): string
    {
        return $this->link;
    }

    public function getIcon(): string | null
    {
        return $this->icon;
    }

    public function isActive(): bool
    {
        return $this->active;
    }

    public function setActive(bool $active = true, bool $applyToParent = false): self
    {
        $this->active = $active;

        if ($this->parent && $applyToParent) {
            $this->parent->setHasActiveChild($active);
        }

        return $this;
    }

    public function getHasActiveChild(): bool
    {
        return $this->hasActiveChild;
    }

    public function setHasActiveChild(bool $has = true): self
    {
        $this->hasActiveChild = $has;
        if ($has && $this->parent) {
            $this->getParent()->setHasActiveChild($has);
        }
        return $this;
    }

    public function getId()
    {
        return $this->id;
    }

    public function addChildInstance(self $item): self
    {
        $this->children[$item->getId()] = $item;
        return $item;
    }
    public function addChild(string $label, string | array $link = '#', string | null $icon = null, string $id = null, bool $active = false)
    {
        $this->link = '#';
        $child = new self($label, $link, $icon, $id, $active);
        $this->children[$child->id] = $child;

        $child->setParent($this);

        return  $this->children[$child->id];
    }

    public function addChildren(array $children)
    {
        $this->link = '#';
        foreach ($children as $child) {
            $this->children[$child->getId()] = $child;
        }
    }

    public function getChildById(string $id)
    {
        return $this->children[$id];
    }

    public function getChildren()
    {
        return $this->children;
    }
}
