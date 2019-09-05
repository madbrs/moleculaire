<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\RecipeRepository")
 */
class Recipe
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=150)
     */
    private $title;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $image;

    /**
     * @ORM\Column(type="integer")
     */
    private $setup_time;

    /**
     * @ORM\Column(type="integer")
     */
    private $baking_time;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $price;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Tag", mappedBy="recipe")
     */
    private $recipe_tag;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Ingredient", mappedBy="recipe")
     */
    private $recipe_ingredient;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\CookingTools", mappedBy="recipe")
     */
    private $recipe_tools;

    public function __construct()
    {
        $this->recipe_tag = new ArrayCollection();
        $this->recipe_ingredient = new ArrayCollection();
        $this->recipe_tools = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getSetupTime(): ?int
    {
        return $this->setup_time;
    }

    public function setSetupTime(int $setup_time): self
    {
        $this->setup_time = $setup_time;

        return $this;
    }

    public function getBakingTime(): ?int
    {
        return $this->baking_time;
    }

    public function setBakingTime(int $baking_time): self
    {
        $this->baking_time = $baking_time;

        return $this;
    }

    public function getPrice(): ?int
    {
        return $this->price;
    }

    public function setPrice(?int $price): self
    {
        $this->price = $price;

        return $this;
    }

    /**
     * @return Collection|Tag[]
     */
    public function getRecipeTag(): Collection
    {
        return $this->recipe_tag;
    }

    public function addRecipeTag(Tag $recipeTag): self
    {
        if (!$this->recipe_tag->contains($recipeTag)) {
            $this->recipe_tag[] = $recipeTag;
            $recipeTag->addRecipe($this);
        }

        return $this;
    }

    public function removeRecipeTag(Tag $recipeTag): self
    {
        if ($this->recipe_tag->contains($recipeTag)) {
            $this->recipe_tag->removeElement($recipeTag);
            $recipeTag->removeRecipe($this);
        }

        return $this;
    }

    /**
     * @return Collection|Ingredient[]
     */
    public function getRecipeIngredient(): Collection
    {
        return $this->recipe_ingredient;
    }

    public function addRecipeIngredient(Ingredient $recipeIngredient): self
    {
        if (!$this->recipe_ingredient->contains($recipeIngredient)) {
            $this->recipe_ingredient[] = $recipeIngredient;
            $recipeIngredient->addRecipe($this);
        }

        return $this;
    }

    public function removeRecipeIngredient(Ingredient $recipeIngredient): self
    {
        if ($this->recipe_ingredient->contains($recipeIngredient)) {
            $this->recipe_ingredient->removeElement($recipeIngredient);
            $recipeIngredient->removeRecipe($this);
        }

        return $this;
    }

    /**
     * @return Collection|CookingTools[]
     */
    public function getRecipeTools(): Collection
    {
        return $this->recipe_tools;
    }

    public function addRecipeTool(CookingTools $recipeTool): self
    {
        if (!$this->recipe_tools->contains($recipeTool)) {
            $this->recipe_tools[] = $recipeTool;
            $recipeTool->addRecipe($this);
        }

        return $this;
    }

    public function removeRecipeTool(CookingTools $recipeTool): self
    {
        if ($this->recipe_tools->contains($recipeTool)) {
            $this->recipe_tools->removeElement($recipeTool);
            $recipeTool->removeRecipe($this);
        }

        return $this;
    }
}
