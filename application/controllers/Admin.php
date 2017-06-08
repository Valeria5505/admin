<?php

class Admin extends Core\Controller{

    public $modelTheme;

    function index()
    {


        $this->modelProject = new Application\Models\Project();
        $this->modelUsers = new Application\Models\User();
        $this->modelCurator = new Application\Models\Curator();
        $this->modelConstants = new Application\Models\Constants();
        $this->modelRelease = new Application\Models\Release();
        $this->modelDatabase = new Application\Models\Database();

        ///Статистика
        $countProject = $this->modelProject->count();
        $countUsers = $this->modelUsers->count();
        $countCurator = $this->modelCurator->count();
        //$lestConstants = $this->modelConstants->getById(1);
        $sizeProject = $this->modelProject->sizeProject();
        $sizeDatabase = $this->modelDatabase->sizeDatabase();

        ///Проекты
            /// Все проекты
        $listProjects = $this->modelProject->getList();
        $listProjects0 = $this->modelProject->getList();
        $listProjects1 = $this->modelProject->getList();
        $listProjects2 = $this->modelProject->getList();
        $listProjects3 = $this->modelProject->getList();
        $listProjects45 = $this->modelProject->getList();
        $listProjects6 = $this->modelProject->getList();


            /// Проекты по пользователю
        $userProjects = $this->modelUsers->getListUser();

        ///Релизы
            ///список релизов
        $listRelease = $this->modelRelease->getListRelease();
            /// сортировка релизов по пользователю
        $subRelease = $this->modelRelease->getListRelease();

        ///Куратор
        $listCurator = $this->modelCurator->getList();

        ///Пользователь
        $listUsers = $this->modelUsers->getList();

        $this->template->setTemplateName('admin');

        ///Статистика
        $this->template->setVariable('countProject', $countProject);
        $this->template->setVariable('countUsers', $countUsers);
        $this->template->setVariable('countCurator', $countCurator);
        $this->template->setVariable('sizeProject', $sizeProject);
        $this->template->setVariable('sizeDatabase', $sizeDatabase);
        //$this->template->setVariable('lestConstants', $lestConstants);

        ///Проекты
            /// Все проекты
        $this->template->setVariable('listProjects', $listProjects);
        $this->template->setVariable('listProjects0', $listProjects0);
        $this->template->setVariable('listProjects1', $listProjects1);
        $this->template->setVariable('listProjects2', $listProjects2);
        $this->template->setVariable('listProjects3', $listProjects3);
        $this->template->setVariable('listProjects45', $listProjects45);
        $this->template->setVariable('listProjects6', $listProjects6);

            /// Проекты по пользователю
        $this->template->setVariable('userProjects', $userProjects);

        ///Куратор
        $this->template->setVariable('listCurator', $listCurator);

        ///Пользователь
        $this->template->setVariable('listUsers', $listUsers);

        ///Релизы
        $this->template->setVariable('listRelease', $listRelease);
        $this->template->setVariable('subRelease', $subRelease);


        $this->template->output();


    }
    function userProject(){


        $this->modelProject = new Application\Models\Project();
        $userProjectList = $this->modelProject->getListByUser($_POST["id"]);
        echo json_encode($userProjectList);

    }
    function listReleateMain(){
        $this->modelRelease = new Application\Models\Release();
        $listReleateMain = $this->modelRelease->getListRelease();
        echo json_encode($listReleateMain);
    }
    function userRelease(){

        $this->modelRelease = new Application\Models\Release();
        $userReleaseList = $this->modelRelease->getListByUser($_POST["id"]);

        echo json_encode($userReleaseList);

    }
    function deleteProject(){

        $this->modelProject = new Application\Models\Project();
        $deleteProject = $this->modelProject->delete($_POST["id"]);
        echo json_encode($deleteProject);

    }

    function deleteCurator(){
        $this->modelCurator = new Application\Models\Curator();
        $deleteCurator = $this->modelCurator->delete($_POST["id"]);
        echo json_encode($deleteCurator);

    }

    function deleteUser(){

        $this->modelUsers = new Application\Models\User();
        $deleteUser = $this->modelUsers->delete($_POST["id"]);
        echo json_encode($deleteUser);

    }
    function dateRelease(){
        $this->modelRelease = new Application\Models\Release();
        $dateReleaseList = $this->modelRelease->dateReleaseList($_POST["date"]);
        echo json_encode($dateReleaseList);
    }
    function editCurator(){
        $this->modelCurator = new Application\Models\Curator();
        $editCurator = $this->modelCurator->update($_POST["id"],$_POST["name"],$_POST["status"],$_POST["email"]);
        echo json_encode($editCurator);
    }
    function editUser(){
        $this->modelUser = new Application\Models\User();
        $editUser = $this->modelUser->update($_POST["id"],$_POST["email"],$_POST["status"]);
        echo json_encode($editUser);
    }
    function addCurator(){
        $this->modelCurator = new Application\Models\Curator();
        $addCurator = $this->modelCurator->add($_POST["name"],$_POST["status"],$_POST["email"]);
        echo json_encode($addCurator);
    }
    function detailProject(){
        $this->modelProject = new Application\Models\Project();
        $detailProject = $this->modelProject->getById($_POST["id"]);
        echo json_encode($detailProject);
    }
}