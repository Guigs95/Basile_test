<?php 

namespace App\Service;

use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Job;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Component\Validator\Validation; 

class ApiBasileService
{
    private $client;
    private $em;

    public function __construct(HttpClientInterface $client, EntityManagerInterface $em)
    {
        $this->client = $client;
        $this->em = $em;
    }

    public function loadData(): array # load API data
    {        
        $response = $this->client->request(
            'GET', 
            'https://api.smartrecruiters.com/v1/companies/Basile1/postings'
        );

        return $response->toArray();
    }

    public function resetData()
    {
        $this->em->createQuery(
            'DELETE FROM App\Entity\Job'
         )->execute();

        return true;
    }

    public function saveData(): Bool # Save data in prostgresql database 
    {
        $lastInsertId = 0;
        
        $data = $this->loadData(); # Get data from API

        foreach ($data['content'] as $key => $job) {
            $value = $this->client->request(
                'GET', 
                'https://api.smartrecruiters.com/v1/companies/Basile1/postings/' . $job['id']
            )->toArray();

            $newJob = new Job(); # New Job instance

            $newJob->setId($value['id']);
            $newJob->setName($value['name']);
            $newJob->setCompany($value['company']['name']);
            $newJob->setCity($value['location']['city']);
            $newJob->setRegion($value['location']['region']);
            $newJob->setCountry($value['location']['country']);
            $newJob->setAddress($value['location']['address']);
            $newJob->setApplyUrl($value['applyUrl']);
            $newJob->setJobDescription($value['jobAd']['sections']['jobDescription']['text']);

            if (!$this->isIdExistInDatabase($newJob)) {
                $this->em->persist($newJob);
                $this->em->flush(); # save instance

                $lastInsertId = $newJob->getId();
            }
        }

        return $lastInsertId > 0 ? true : false;
    }

    public function getData() # return all jobs data
    {
        return $this->em->getRepository(Job::class)->findAll();
    }

    public function isIdExistInDatabase(Job $value) # verify if entity is already exist in database 
    {
        $job = $this->em->getRepository(Job::class)->find($value->getId());

        if ($job && $job->getId() == $value->getId()) {
            return true;
        }

        return false;
    }
}
