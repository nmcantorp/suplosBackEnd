<?php

namespace App\Http\Controllers;

use App\entities\Bienes;
use App\Http\Classes\ExtractData\FileDataExtract;
use App\Http\Response;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\ORMException;
use Dotenv\Dotenv;
use App\entities\Users;

class BienesController
{
    protected $fileDataExtract;

    public function __construct()
    {
        $this->fileDataExtract = new FileDataExtract();
    }

    public function index(){
        $data = $this->fileDataExtract->getData();

        return responseJson($data);
    }

    public function filters(){
        $data = $this->fileDataExtract->filtersFromData();
        return responseJson($data);
    }

    public function byFilter(){
        $valuesFilter = $_GET;
        $data = $this->fileDataExtract->getData();
        foreach ($valuesFilter as $key => $value){
            $data = $this->fileDataExtract->filterData($data,$key, $value);
        }

        return responseJson($data);
    }

    public function getBienesByUser()
    {
        try {
            $user = $_GET['user_id'];
            $entityManager = getEntityManager();
            $queryBuilder = $entityManager->createQueryBuilder();

            $result = $queryBuilder
                ->select([
                    'bienes.id',
                    'bienes.idBien',
                    'bienes.content',
                    'user.id',
                    'user.name'])
                ->from(Bienes::class, 'bienes')
                ->join(Users::class, 'user', 'WITH', 'bienes.user = user.id')
                ->where('user.id = :id_user')
                ->setParameter('id_user', $user)
                ->getQuery()
                ->setCacheable(true)
                ->setCacheMode(\Doctrine\ORM\Cache::MODE_NORMAL)
                ->setLifetime(3600)
                ->getResult()
            ;

            $result = new ArrayCollection($result);

            return responseJson($result->toArray());

        } catch (ORMException $e) {
            var_dump($e->getMessage());die;
        }
    }

    public function saveOwnRealty(){
        $user_id = $_GET['user_id'];
        $bien_id = $_GET['bien_id'];

        try {
            $content = array_filter($this->fileDataExtract->getData(), function ($record) use ($bien_id){
                return $record->Id == $bien_id;
            });

            $entityManager = getEntityManager();
            $user =  $entityManager->getRepository(Users::class)->find($user_id);

            $bien = $entityManager->getRepository(Bienes::class)->findOneBy([
                'user' => $user,
                'idBien' => $bien_id
            ]);

            if(!$bien){
                $bien = new Bienes();
                $bien->setContent(json_encode(reset($content)));
                $bien->setIdBien($bien_id);
                $bien->setUser($user);

                $entityManager->persist($bien);
                $entityManager->flush();
            }

            return responseJson(['save'=>true]);
        }catch (\Exception $e){

            return responseJson(['save'=>false]);
        }




    }
}