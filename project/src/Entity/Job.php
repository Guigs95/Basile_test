<?php

namespace App\Entity;

use App\Repository\JobRepository;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Doctrine\ORM\Mapping as ORM;

/**
 * Job
 * 
 * @ORM\Table(name="job")
 * @ORM\Entity
 * @UniqueEntity("id")
 */
class Job
{
    /**
     * @ORM\Id
     * @ORM\Column(type="bigint", unique=true)
    */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
    */
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
    */
    private $company;

    /**
     * @ORM\Column(type="string", length=255)
    */
    private $city;

    /**
     * @ORM\Column(type="string", length=255)
    */
    private $region;

    /**
     * @ORM\Column(type="string", length=255)
    */
    private $country;

    /**
     * @ORM\Column(type="string", length=255)
    */
    private $address;

    /**
     * @ORM\Column(type="string", length=255)
    */
    private $applyUrl;

    /**
     * @ORM\Column(type="string", length=255)
    */
    private $jobDescription;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): self
    {
        $this->id = $id;

        return $this;    
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getCompany(): ?string
    {
        return $this->company;
    }

    public function setCompany(string $company): self
    {
        $this->company = $company;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(string $city): self
    {
        $this->city = $city;

        return $this;
    }

    public function getRegion(): ?string
    {
        return $this->region;
    }

    public function setRegion(string $region): self
    {
        $this->region = $region;

        return $this;
    }

    public function getCountry(): ?string
    {
        return $this->country;
    }

    public function setCountry(string $country): self
    {
        $this->country = $country;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(string $address): self
    {
        $this->address = $address;

        return $this;
    }

    public function getApplyUrl(): ?string
    {
        return $this->applyUrl;
    }

    public function setApplyUrl(string $applyUrl): self
    {
        $this->applyUrl = $applyUrl;

        return $this;
    }

    public function getJobDescription(): ?string
    {
        return $this->jobDescription;
    }

    public function setJobDescription(string $jobDescription): self
    {
        $this->jobDescription = $jobDescription;

        return $this;
    }
}
