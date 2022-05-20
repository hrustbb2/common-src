<?php

namespace Src\Lib\CategoriesTree\Application;

use Src\Common\Application\TraitDomain;
use Src\Common\Application\ResponsesCode;
use Src\Lib\CategoriesTree\Interfaces\Application\IDomain;
use Src\Common\Interfaces\Adapters\ILog;
use Src\Lib\CategoriesTree\Interfaces\Application\IValidator;
use Src\Lib\CategoriesTree\Interfaces\Application\IDataBuilder;
use Src\Lib\CategoriesTree\Interfaces\Dto\IFactory as IDtoFactory;
use Src\Lib\CategoriesTree\Interfaces\Dto\IResource;
use Src\Lib\CategoriesTree\Interfaces\Infrastructure\IPersistLayer;
use Src\Lib\CategoriesTree\Interfaces\Infrastructure\IStorage;
use \Throwable;

class Domain implements IDomain {

    use TraitDomain;

    protected ILog $logAdapter;

    protected IValidator $validator;

    protected IDataBuilder $dataBuilder;

    protected IDtoFactory $dtoFactory;

    protected IPersistLayer $persistLayer;

    protected IStorage $storage;

    protected ?IResource $dir = null;

    public function setLogAdapter(ILog $adapter):void
    {
        $this->logAdapter = $adapter;
    }

    public function setValidator(IValidator $validator):void
    {
        $this->validator = $validator;
    }

    public function setDataBuilder(IDataBuilder $builder):void
    {
        $this->dataBuilder = $builder;
    }

    public function setDtoFactory(IDtoFactory $factory):void
    {
        $this->dtoFactory = $factory;
    }

    public function setPersistLayer(IPersistLayer $layer):void
    {
        $this->persistLayer = $layer;
    }

    public function setStorage(IStorage $storage):void
    {
        $this->storage = $storage;
    }

    public function createDir(array $data):bool
    {
        $this->dir = $this->dtoFactory->createResource();
        if($this->validator->createDir($data)){
            try{
                $cleanData = $this->validator->getCleanData();
                $dirData = $this->dataBuilder->buildData($cleanData);
                $dirPersist = $this->dtoFactory->createPersist();
                $dirPersist->load($dirData);
                $this->persistLayer->newDir($dirPersist);
                $this->dir->load($dirPersist->getAttributes());
                return true;
            }catch(Throwable $e){
                $this->logAdapter->error($e);
                return false;
            }
        }else{
            $this->errors = $this->validator->getErrors();
            $this->responseCode = ResponsesCode::VALIDATION_FAILED_CODE;
            return false;
        }
    }

    public function renameDir(array $data):bool
    {
        $this->dir = $this->dtoFactory->createResource();
        if($this->validator->renameDir($data)){
            try {
                $cleanData = $this->validator->getCleanData();
                $dirData = $this->getDirData($cleanData['id']);
                $dirPersist = $this->dtoFactory->createPersist();
                $dirPersist->load($dirData);
                $dirPersist->update($cleanData);
                $this->persistLayer->updateDir($dirPersist);
                $this->dir->load($dirPersist->getAttributes());
                return true;
            }catch(Throwable $e){
                $this->logAdapter->error($e);
                return false;
            }
        }else{
            $this->errors = $this->validator->getErrors();
            $this->responseCode = ResponsesCode::VALIDATION_FAILED_CODE;
            return false;
        }
    }

    public function deleteDir(array $data):bool
    {
        if($this->validator->deleteDir($data)){
            try {
                $cleanData = $this->validator->getCleanData();
                $dirsIds = $this->storage->getIdsInDir($cleanData['id']);
                $dirsIds[] = $cleanData['id'];
                $this->persistLayer->deleteDirs($dirsIds);
                return true;
            }catch(Throwable $e){
                $this->logAdapter->error($e);
                return false;
            }
        }else{
            $this->errors = $this->validator->getErrors();
            $this->responseCode = ResponsesCode::VALIDATION_FAILED_CODE;
            return false;
        }
    }

    public function getDir():IResource
    {
        return $this->dir;
    }

    protected function getDirData(string $dirId, array $dsl = [])
    {
        return $this->storage->getById($dirId, $dsl);
    }

}