<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
/**
 * @ORM\Entity(repositoryClass="App\Repository\BeerRepository")
 */
class Beer
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(
     *      min = 2,
     *      max = 255,
     *      minMessage = "Le titre doit avoir au moins {{ limit }} caractères",
     *      maxMessage = "Le titre doit avoir au plus {{ limit }} caractères"
     * )
     * @Assert\NotBlank
     */
    private $title;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Url(
     *   message = "Merci d'entrer une url valide.")
     * @Assert\NotBlank
     */
    private $img;

    /**
     * @ORM\Column(type="text")
     * @Assert\Length(
     *      min = 10,
     *      minMessage = "Le contenu doit avoir au moins {{ limit }} caractères",
     * )
     * @Assert\NotBlank
     */
    private $content;

    /**
     * @ORM\Column(type="float")
     */
    private $price_ht;

    /**
     * @ORM\Column(type="integer")
     */
    private $slug;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $stock;

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

    public function getImg(): ?string
    {
        return $this->img;
    }

    public function setImg(string $img): self
    {
        $this->img = $img;

        return $this;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;

        return $this;
    }

    public function getPriceHt(): ?float
    {
        return $this->price_ht;
    }

    public function setPriceHt(float $price_ht): self
    {
        $this->price_ht = $price_ht;

        return $this;
    }

    public function getSlug(): ?int
    {
        return $this->slug;
    }

    public function setSlug(int $slug): self
    {
        $this->slug = $slug;

        return $this;
    }

    public function getStock(): ?int
    {
        return $this->stock;
    }

    public function setStock(?int $stock): self
    {
        $this->stock = $stock;

        return $this;
    }

        /**
     *  prix ht
     *  @return string
     **/
    public function getPrixHt(): string
    {
        return (string) number_format($this->price_ht, 2, ',', ' ') . '€';
    }
    /**
     *  prix
     *  @return string
     **/
    public function getPrixTTC(): string
    {
        return (string) number_format($this->price_ht * 1.2, 2, ',', ' ') . '€';
    }

}
