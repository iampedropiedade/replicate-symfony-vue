<?php

declare(strict_types=1);

namespace App\Model\Request;

class Marketing
{
    private const COUNT = 3;
    private const SLOGAN_PROMPT = 'Generate %s marketing slogans for marketing %s';
    private const CONTENT_PROMPT = 'Generate a text with 3 paragraphs for marketing %s';
    private const IMAGE_PROMPT = 'Generate one image for marketing %s';

    private const STYLES = [
        0 => 'very formal',
        1 => 'slightly formal',
        2 => null,
        3 => 'slightly informal',
        4 => 'very informal',
    ];

    private const IMAGE_TYPE = [
        0 => 'an illustration',
        1 => 'a real image',
    ];

    private string $what;
    private string $name;
    private string $where;
    /** @var array<string, int>  */
    private array $how;
    /** @var array<string, bool>  */
    private array $selected;

    public function getSloganPrompt(): string
    {
        $prompt = sprintf(self::SLOGAN_PROMPT, self::COUNT, $this->getWhat());
        if($this->getName()) {
            $prompt = sprintf('%s called %s', $prompt, $this->getName());
        }
        if($this->getWhere()) {
            $prompt = sprintf('%s %s (UK)', $prompt, $this->getWhere());
        }
        if($this->getStyle() !== null) {
            $prompt = sprintf('%s using a %s language style', $prompt, $this->getStyle());
        }
        $prompt = sprintf('%s. Use around %s tokens for each slogan but do not mention the number of tokens used. Always output your answer in JSON. Respond with a list with each item preceded by a *.', $prompt, $this->getSize());
        return $prompt;
    }

    public function getContentPrompt(): string
    {
        $prompt = sprintf(self::CONTENT_PROMPT, $this->getWhat());
        if($this->getName()) {
            $prompt = sprintf('%s called %s', $prompt, $this->getName());
        }
        if($this->getWhere()) {
            $prompt = sprintf('%s %s (UK)', $prompt, $this->getWhere());
        }
        if($this->getStyle() !== null) {
            $prompt = sprintf('%s using a %s language style.', $prompt, $this->getStyle());
        }
        return $prompt;
    }

    public function getImagePrompt(): string
    {
        $prompt = sprintf(self::IMAGE_PROMPT, $this->getWhat());
        if($this->getName()) {
            $prompt = sprintf('%s called %s', $prompt, $this->getName());
        }
        if($this->getWhere()) {
            $prompt = sprintf('%s %s (UK)', $prompt, $this->getWhere());
        }
        if($this->getImageType() !== null) {
            $prompt = sprintf('%s using %s', $prompt, $this->getImageType());
        }
        return $prompt;
    }

    public function getWhat(): string
    {
        return $this->what;
    }

    public function setWhat(string $what): self
    {
        $this->what = $what;
        return $this;
    }

    public function getWhere(): string
    {
        return $this->where;
    }

    public function setWhere(string $where): self
    {
        $this->where = $where;
        return $this;
    }

    /**
     * @return array<string, int>
     */
    public function getHow(): array
    {
        return $this->how;
    }

    public function setHow(array $how): self
    {
        $this->how = $how;
        return $this;
    }

    /**
     * @return array<string, bool>
     */
    public function getSelected(): array
    {
        return $this->selected;
    }

    /**
     * @param array<string, bool> $selected
     * @return $this
     */
    public function setSelected(array $selected): self
    {
        $this->selected = $selected;
        return $this;
    }

    public function isSloganSelected(): bool
    {
        return $this->selected['slogan'] === true;
    }

    public function isContentSelected(): bool
    {
        return $this->selected['content'] === true;
    }

    public function isImageSelected(): bool
    {
        return $this->selected['image'] === true;
    }

    public function getStyle(): string
    {
        return self::STYLES[$this->how['style']] ?? '';
    }

    public function getSize(): string|int
    {
        return $this->how['sloganSize'] ?? 20;
    }

    public function getImageType(): string
    {
        return self::IMAGE_TYPE[$this->how['imageType']] ?? '';
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }



}
