<?php

namespace App\DataTypes;

class SearchCardsOptions implements DataType {
    private ?int $limit;

    private ?int $page;

    private ?int $product_id;

    private ?int $deck_id;

    private ?int $type_id;

    private ?string $name_ja;

    private ?string $name_en;

    private ?array $description_words;

    public function __construct(
        ?int $limit,
        ?int $page,
        ?int $product_id,
        ?int $deck_id,
        ?int $type_id,
        ?string $name_ja,
        ?string $name_en,
        ?array $description_words
    ) {
        $this->limit = $limit;
        $this->page = $page;
        $this->product_id = $product_id;
        $this->deck_id = $deck_id;
        $this->type_id = $type_id;
        $this->name_ja = $name_ja;
        $this->name_en = $name_en;
        $this->description_words = $description_words;
    }

	/**
	 * Get the value of limit
	 */
	public function getLimit(): ?int
	{
		return $this->limit;
	}

	/**
	 * Get the value of page
	 */
	public function getPage(): ?int
	{
		return $this->page;
	}

	/**
	 * Get the value of product_id
	 */
	public function getProductId(): ?int
	{
		return $this->product_id;
	}

	/**
	 * Get the value of deck_id
	 */
	public function getDeckId(): ?int
	{
		return $this->deck_id;
	}

	/**
	 * Get the value of type_id
	 */
	public function getTypeId(): ?int
	{
		return $this->type_id;
	}

	/**
	 * Get the value of name_ja
	 */
	public function getNameJa(): ?string
	{
		return $this->name_ja;
	}

	/**
	 * Get the value of name_en
	 */
	public function getNameEn(): ?string
	{
		return $this->name_en;
	}

	/**
	 * Get the value of description_words
	 */
	public function getDescriptionWords(): ?array
	{
		return $this->description_words;
	}
}
