<?php

namespace App\Entity;
// Définit l'espace de nommage de l'entité Contact.

use App\Repository\ContactRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
// Importe la classe ContactRepository, qui est le référentiel personnalisé pour cette entité.

use Doctrine\DBAL\Types\Types;
// Importe la classe Types, qui contient des constantes pour les types de colonnes de base de données.

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\OrderBy;
use Doctrine\ORM\Query\Expr\OrderBy as ExprOrderBy;

// Importe les annotations de mappage Doctrine ORM.

#[ORM\Entity(repositoryClass: ContactRepository::class)]
// Définit l'entité Contact et spécifie que le référentiel personnalisé ContactRepository doit être utilisé pour cette entité.
class Contact
{
    #[ORM\Id]
    // Définit la propriété id comme l'identifiant unique de l'entité.
    #[ORM\GeneratedValue]
    // Définit que la valeur de l'identifiant doit être générée automatiquement.
    #[ORM\Column]
    // Définit les détails de la colonne de base de données pour la propriété id.
    private ?int $id = null;
    // Définit la propriété id comme une valeur entière nullable

    #[ORM\Column(length: 255)]
    // Définit les détails de la colonne de base de données pour la propriété brand, avec une longueur maximale de 255 caractères.
    private ?string $brand = null;
    // Définit la propriété brand comme une chaîne de caractères nullable.

    #[ORM\Column(length: 255)]
    // Définit les détails de la colonne de base de données pour la propriété website, avec une longueur maximale de 255 caractères.
    private ?string $website = null;
    // Définit la propriété website comme une chaîne de caractères nullable.

    #[ORM\Column(length: 255)]
    // Définit les détails de la colonne de base de données pour la propriété socialMedia, avec une longueur maximale de 255 caractères.
    private ?string $socialMedia = null;
    // Définit la propriété socialMedia comme une chaîne de caractères nullable.

    #[ORM\Column(type: Types::TEXT)]
    // Définit les détails de la colonne de base de données pour la propriété collectionDescription, avec un type texte.
    private ?string $collectionDescription = null;
    // Définit la propriété collectionDescription comme une chaîne de caractères nullable.

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    // Définit les détails de la colonne de base de données pour la propriété desiredDates, avec un type date et heure mutable et une valeur nullable.
    private ?\DateTimeInterface $desiredDates = null;
    // Définit la propriété desiredDates comme une valeur DateTimeInterface nullable.

    #[ORM\Column(type: Types::TEXT)]
    // Définit les détails de la colonne de base de données pour la propriété concept, avec un type texte.
    private ?string $concept = null;
    // Définit la propriété concept comme une chaîne de caractères nullable.

    #[ORM\Column(type: Types::INTEGER)]
    // Définit les détails de la colonne de base de données pour la propriété outfitCount, avec un type entier.
    private ?int $outfitCount = null;
    // Définit la propriété outfitCount comme une valeur entière nullable.

    #[ORM\Column(type: Types::TEXT)]
    // Définit les détails de la colonne de base de données pour la propriété technicalRequirements, avec un type texte.
    private ?string $technicalRequirements = null;
    // Définit la propriété technicalRequirements comme une chaîne de caractères nullable.

    #[ORM\Column(type: Types::INTEGER)]
    // Définit les détails de la colonne de base de données pour la propriété budget, avec un type entier.
    private ?int $budget = null;
    // Définit la propriété budget comme une valeur entière nullable.

    #[ORM\Column(type: Types::TEXT)]
    // Définit les détails de la colonne de base de données pour la propriété additionalInformation, avec un type texte.
    private ?string $additionalInformation = null;
    // Définit la propriété additionalInformation comme une chaîne de caractères nullable.

    #[ORM\Column(type: Types::BOOLEAN)]
    // Définit les détails de la colonne de base de données pour la propriété consent, avec un type booléen.
    private ?bool $consent = null;

    #[ORM\ManyToOne(inversedBy: 'contacts')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $User = null;

    /**
     * @var Collection<int, Comment>
     */
    #[ORM\OneToMany(targetEntity: Comment::class, mappedBy: 'contact')]
    #[ORM\OrderBy(["id" => "DESC"])]
    private Collection $comments;

    public function __construct()
    {
        $this->comments = new ArrayCollection();
    }
    // Définit la propriété consent comme une valeur booléenne nullable.

    // Les méthodes getId, getName, setName, getFirstName, setFirstName, etc. sont des méthodes d'accès
    // standard pour les propriétés de l'entité. Elles permettent de récupérer et de modifier les valeurs
    // des propriétés.
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBrand(): ?string
    {
        return $this->brand;
    }

    public function setBrand(string $brand): static
    {
        $this->brand = $brand;

        return $this;
    }

    public function getWebsite(): ?string
    {
        return $this->website;
    }

    public function setWebsite(string $website): static
    {
        $this->website = $website;

        return $this;
    }

    public function getSocialMedia(): ?string
    {
        return $this->socialMedia;
    }

    public function setSocialMedia(string $socialMedia): static
    {
        $this->socialMedia = $socialMedia;

        return $this;
    }

    public function getCollectionDescription(): ?string
    {
        return $this->collectionDescription;
    }

    public function setCollectionDescription(string $collectionDescription): static
    {
        $this->collectionDescription = $collectionDescription;

        return $this;
    }

    public function getDesiredDates(): ?\DateTimeInterface
    {
        return $this->desiredDates;
    }

    public function setDesiredDates(?\DateTimeInterface $desiredDates): self
    {
        $this->desiredDates = $desiredDates;

        return $this;
    }
    
    public function getConcept(): ?string
    {
        return $this->concept;
    }

    public function setConcept(string $concept): static
    {
        $this->concept = $concept;

        return $this;
    }

    public function getOutfitCount(): ?int
    {
        return $this->outfitCount;
    }

    public function setOutfitCount(int $outfitCount): static
    {
        $this->outfitCount = $outfitCount;

        return $this;
    }

    public function getTechnicalRequirements(): ?string
    {
        return $this->technicalRequirements;
    }

    public function setTechnicalRequirements(string $technicalRequirements): static
    {
        $this->technicalRequirements = $technicalRequirements;

        return $this;
    }

    public function getBudget(): ?int
    {
        return $this->budget;
    }

    public function setBudget(int $budget): static
    {
        $this->budget = $budget;

        return $this;
    }

    public function getAdditionalInformation(): ?string
    {
        return $this->additionalInformation;
    }

    public function setAdditionalInformation(string $additionalInformation): static
    {
        $this->additionalInformation = $additionalInformation;

        return $this;
    }

    public function isConsent(): ?bool
    {
        return $this->consent;
    }

    public function setConsent(bool $consent): static
    {
        $this->consent = $consent;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->User;
    }

    public function setUser(?User $User): static
    {
        $this->User = $User;

        return $this;
    }

    /**
     * @return Collection<int, Comment>
     */
    public function getComments(): Collection
    {
        return $this->comments;
    }

    public function addComment(Comment $comment): static
    {
        if (!$this->comments->contains($comment)) {
            $this->comments->add($comment);
            $comment->setContact($this);
        }

        return $this;
    }

    public function removeComment(Comment $comment): static
    {
        if ($this->comments->removeElement($comment)) {
            // set the owning side to null (unless already changed)
            if ($comment->getContact() === $this) {
                $comment->setContact(null);
            }
        }

        return $this;
    }
}
