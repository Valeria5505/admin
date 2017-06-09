<?require_once ('header.php');?>

<div class="container" id="my_container" style="display: none">
    <ul class="nav nav-tabs">
        <li class="active"><a href="#statistics" data-toggle="tab">Статистика</a></li>
        <li><a href="#project" data-toggle="tab">Проекты</a></li>
        <li><a href="#curator" data-toggle="tab">Кураторы</a></li>
        <li><a href="#user" data-toggle="tab">Пользователи</a></li>
        <li><a href="#release" data-toggle="tab">Релизы</a></li>
    </ul>

    <div class="tab-content">
        <div class="tab-pane active" id="statistics">
            <h2>Статистика</h2>
            <div class="container">
                <div>
                    <h3>Количество:</h3>
                    <div>
                        <div>- Проектов</div>
                        <div><?echo $countProject['COUNT(*)']?></div>
                    </div>
                    <div>
                        <div>- Пользователей</div>
                        <div><?echo $countUsers['COUNT(*)']?></div>
                    </div>
                    <div>
                        <div>- Кураторов</div>
                        <div><?echo $countCurator['COUNT(*)']?></div>
                    </div>
                </div>
                <div>
                    <?
                    $kb = 1024;
                    $mb = 1024 * $kb;
                    $disk_total = disk_total_space(".")/$mb;
                    $disk_free = disk_free_space(".")/$mb;
                    ?>
                    <h3>Объем дискового пространства:</h3>
                    <div>
                        <div>- Всего</div>
                        <div><?=$disk_total?></div>
                    </div>
                    <div>
                        <div>- Свободно</div>
                        <div><?=$disk_free?></div>
                    </div>
                    <div>
                        <div>- Занято проектами</div>
                        <div><?=$sizeProject[0]["SUM(files_size)"]?></div>
                    </div>
                    <div>
                        <div>- Занято Базами данных</div>
                        <div><?=$sizeDatabase[0]["SUM(size)"]?></div>
                    </div>
                    <div>
                        <div>- Диаграмма</div>
                        <div id="piechart" style="width: 900px; height: 500px;"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-pane" id="project">
            <h2>Проекты</h2>

                <ul class="nav nav-tabs">
                    <li class="active"><a href="#allProject" data-toggle="tab">Все проекты</a></li>
                    <li><a href="#userProgect" data-toggle="tab">Проекты по пользователю</a></li>
                    <li><a href="#ProjectSt0" data-toggle="tab">Не подтвержденные проекты</a></li>
                    <li><a href="#ProjectSt1" data-toggle="tab">Подтвержденные, но не выполненные проекты</a></li>
                    <li><a href="#ProjectSt2" data-toggle="tab">Подтвержденные и выполненные проекты</a></li>
                    <li><a href="#ProjectSt3" data-toggle="tab">Проекты помеченные как удаленные</a></li>
                    <li><a href="#ProjectSt45" data-toggle="tab">Удаленные и отклоненные проекты</a></li>
                    <li><a href="#ProjectSt6" data-toggle="tab">Проекты в процессе выкладки</a></li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="allProject">


                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Домен</th>
                                    <th>Статус</th>
                                    <th>Размер</th>
                                    <th>Название проекта</th>
                                    <th>Дата добавления</th>
                                    <th>Имя создателя</th>
                                    <th>Куратор проекта</th>
                                    <th>Адрес GitHub</th>
                                    <th></th>
                                </tr>
                            </thead>

                            <tbody class="project_table">
                                <?foreach ($listProjects as $listProjects):?>
                                <tr class="listProjects_<?=$listProjects["id"]?>">
                                    <?if ($listProjects["status_project"]==3||$listProjects["status_project"]==4||$listProjects["status_project"]==5):?>
                                        <td></td>
                                        <?else:?>
                                        <td class="deleteProject_<?=$listProjects["id"]?>">
                                            <button title="Удалить" class='closeProject btn btn-default' delete_id="<?=$listProjects["id"]?>">
                                                <span class="fa fa-times" aria-hidden="true"></span>
                                            </button>
                                        </td>
                                    <?endif;?>

                                        <td><?=$listProjects["subdomain"]?></td>
                                        <td class="status_project_<?=$listProjects["id"]?>"><?=$listProjects["status_project"]?></td>
                                    <td><?=$listProjects["files_size"]?></td>
                                        <td><?=$listProjects["title"]?></td>
                                        <td><?=$listProjects["date_add"]?></td>
                                        <td><?=$listProjects["email_user"]." ".$listProjects["group"]?></td>
                                        <td><?=$listProjects["name_curator"]==null?"У данного проекта нет куратора":$listProjects["name_curator"]?></td>
                                        <td><?=$listProjects["git"]?></td>
                                        <td>
                                            <button title="Подробнее" class='detailProject btn btn-default' detailPr_id="<?=$listProjects["id"]?>">
                                                <span class="fa fa-id-card-o" aria-hidden="true"></span>
                                            </button>
                                        </td>
                                    </tr>
                                <?endforeach;?>
                            </tbody>
                        </table>

                    </div>
                    <div class="tab-pane" id="userProgect">
                        <form>
                            <select class="userProjects" name="userProjects">
                                <option value="0">Пользователь не выбран</option>
                                <?foreach ($userProjects as $userProjects):?>
                                    <option value="<?=$userProjects["id"]?>"><?=$userProjects["email_user"]?></option>
                                <?endforeach;?>
                            </select>
                        </form>
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th></th>
                                <th>Домен</th>
                                <th>Статус</th>
                                <th>Размер</th>
                                <th>Название проекта</th>
                                <th>Дата добавления</th>
                                <th>Имя создателя</th>
                                <th>Куратор проекта</th>
                                <th>Адрес GitHub</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody id="user_project" class="project_table">

                            </tbody>
                        </table>

                    </div>

                    <div class="tab-pane" id="ProjectSt0">


                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th></th>
                                <th>Домен</th>
                                <th>Статус</th>
                                <th>Размер</th>
                                <th>Название проекта</th>
                                <th>Дата добавления</th>
                                <th>Имя создателя</th>
                                <th>Куратор проекта</th>
                                <th>Адрес GitHub</th>
                                <th></th>
                            </tr>
                            </thead>

                            <tbody class="project_table">
                            <?foreach ($listProjects0 as $listProjects0):?>
                                <?if(($listProjects0["status_project"]==0)):?>
                                    <tr class="listProjects_<?=$listProjects0["id"]?>">
                                        <?if ($listProjects0["status_project"]==3||$listProjects0["status_project"]==4||$listProjects0["status_project"]==5):?>
                                            <td></td>
                                        <?else:?>
                                            <td class="deleteProject_<?=$listProjects0["id"]?>">
                                                <button title="Удалить" class='closeProject btn btn-default' delete_id="<?=$listProjects0["id"]?>">
                                                    <span class="fa fa-times" aria-hidden="true"></span>
                                                </button>
                                            </td>
                                        <?endif;?>

                                        <td><?=$listProjects0["subdomain"]?></td>
                                        <td class="status_project_<?=$listProjects0["id"]?>"><?=$listProjects0["status_project"]?></td>
                                        <td><?=$listProjects["files_size"]?></td>
                                        <td><?=$listProjects0["title"]?></td>
                                        <td><?=$listProjects0["date_add"]?></td>
                                        <td><?=$listProjects0["email_user"]." ".$listProjects0["group"]?></td>
                                        <td><?=$listProjects0["name_curator"]==null?"У данного проекта нет куратора":$listProjects0["name_curator"]?></td>
                                        <td><?=$listProjects0["git"]?></td>
                                        <td>
                                            <button title="Подробнее" class='detailProject btn btn-default' detailPr_id="<?=$listProjects0["id"]?>">
                                                <span class="fa fa-id-card-o" aria-hidden="true"></span>
                                            </button>
                                        </td>
                                    </tr>
                                <?endif;?>

                            <?endforeach;?>
                            </tbody>
                        </table>

                    </div>
                    <div class="tab-pane " id="ProjectSt1">


                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th></th>
                                <th>Домен</th>
                                <th>Статус</th>
                                <th>Размер</th>
                                <th>Название проекта</th>
                                <th>Дата добавления</th>
                                <th>Имя создателя</th>
                                <th>Куратор проекта</th>
                                <th>Адрес GitHub</th>
                                <th></th>
                            </tr>
                            </thead>

                            <tbody class="project_table">
                            <?foreach ($listProjects1 as $listProjects1):?>
                                <?if(($listProjects1["status_project"]==1)):?>
                                    <tr class="listProjects_<?=$listProjects1["id"]?>">
                                        <?if ($listProjects1["status_project"]==3||$listProjects1["status_project"]==4||$listProjects1["status_project"]==5):?>
                                            <td></td>
                                        <?else:?>
                                            <td class="deleteProject_<?=$listProjects1["id"]?>">
                                                <button title="Удалить" class='closeProject btn btn-default' delete_id="<?=$listProjects1["id"]?>">
                                                    <span class="fa fa-times" aria-hidden="true"></span>
                                                </button>
                                            </td>
                                        <?endif;?>

                                        <td><?=$listProjects1["subdomain"]?></td>
                                        <td class="status_project_<?=$listProjects1["id"]?>"><?=$listProjects1["status_project"]?></td>
                                        <td><?=$listProjects["files_size"]?></td>
                                        <td><?=$listProjects1["title"]?></td>
                                        <td><?=$listProjects1["date_add"]?></td>
                                        <td><?=$listProjects1["email_user"]." ".$listProjects1["group"]?></td>
                                        <td><?=$listProjects1["name_curator"]==null?"У данного проекта нет куратора":$listProjects1["name_curator"]?></td>
                                        <td><?=$listProjects1["git"]?></td>
                                        <td>
                                            <button title="Подробнее" class='detailProject btn btn-default' detailPr_id="<?=$listProjects1["id"]?>">
                                                <span class="fa fa-id-card-o" aria-hidden="true"></span>
                                            </button>
                                        </td>
                                    </tr>
                                <?endif;?>

                            <?endforeach;?>
                            </tbody>
                        </table>

                    </div>
                    <div class="tab-pane " id="ProjectSt2">


                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th></th>
                                <th>Домен</th>
                                <th>Статус</th>
                                <th>Размер</th>
                                <th>Название проекта</th>
                                <th>Дата добавления</th>
                                <th>Имя создателя</th>
                                <th>Куратор проекта</th>
                                <th>Адрес GitHub</th>
                                <th></th>
                            </tr>
                            </thead>

                            <tbody class="project_table">
                            <?foreach ($listProjects2 as $listProjects2):?>
                                <?if(($listProjects2["status_project"]==2)):?>
                                    <tr class="listProjects_<?=$listProjects2["id"]?>">
                                        <?if ($listProjects2["status_project"]==3||$listProjects2["status_project"]==4||$listProjects2["status_project"]==5):?>
                                            <td></td>
                                        <?else:?>
                                            <td class="deleteProject_<?=$listProjects2["id"]?>">
                                                <button title="Удалить" class='closeProject btn btn-default' delete_id="<?=$listProjects2["id"]?>">
                                                    <span class="fa fa-times" aria-hidden="true"></span>
                                                </button>
                                            </td>
                                        <?endif;?>

                                        <td><?=$listProjects2["subdomain"]?></td>
                                        <td class="status_project_<?=$listProjects2["id"]?>"><?=$listProjects2["status_project"]?></td>
                                        <td><?=$listProjects["files_size"]?></td>
                                        <td><?=$listProjects2["title"]?></td>
                                        <td><?=$listProjects2["date_add"]?></td>
                                        <td><?=$listProjects2["email_user"]." ".$listProjects2["group"]?></td>
                                        <td><?=$listProjects2["name_curator"]==null?"У данного проекта нет куратора":$listProjects2["name_curator"]?></td>
                                        <td><?=$listProjects2["git"]?></td>
                                        <td>
                                            <button title="Подробнее" class='detailProject btn btn-default' detailPr_id="<?=$listProjects2["id"]?>">
                                                <span class="fa fa-id-card-o" aria-hidden="true"></span>
                                            </button>
                                        </td>
                                    </tr>
                                <?endif;?>

                            <?endforeach;?>
                            </tbody>
                        </table>

                    </div>
                    <div class="tab-pane " id="ProjectSt3">


                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th></th>
                                <th>Домен</th>
                                <th>Статус</th>
                                <th>Размер</th>
                                <th>Название проекта</th>
                                <th>Дата добавления</th>
                                <th>Имя создателя</th>
                                <th>Куратор проекта</th>
                                <th>Адрес GitHub</th>
                                <th></th>
                            </tr>
                            </thead>

                            <tbody class="project_table">
                            <?foreach ($listProjects3 as $listProjects3):?>
                                <?if(($listProjects3["status_project"]==3)):?>
                                    <tr class="listProjects_<?=$listProjects3["id"]?>">
                                        <?if ($listProjects3["status_project"]==3||$listProjects3["status_project"]==4||$listProjects3["status_project"]==5):?>
                                            <td></td>
                                        <?else:?>
                                            <td class="deleteProject_<?=$listProjects3["id"]?>">
                                                <button title="Удалить" class='closeProject btn btn-default' delete_id="<?=$listProjects3["id"]?>">
                                                    <span class="fa fa-times" aria-hidden="true"></span>
                                                </button>
                                            </td>
                                        <?endif;?>

                                        <td><?=$listProjects3["subdomain"]?></td>
                                        <td class="status_project_<?=$listProjects3["id"]?>"><?=$listProjects3["status_project"]?></td>
                                        <td><?=$listProjects["files_size"]?></td>
                                        <td><?=$listProjects3["title"]?></td>
                                        <td><?=$listProjects3["date_add"]?></td>
                                        <td><?=$listProjects3["email_user"]." ".$listProjects3["group"]?></td>
                                        <td><?=$listProjects3["name_curator"]==null?"У данного проекта нет куратора":$listProjects3["name_curator"]?></td>
                                        <td><?=$listProjects3["git"]?></td>
                                        <td>
                                            <button title="Подробнее" class='detailProject btn btn-default' detailPr_id="<?=$listProjects3["id"]?>">
                                                <span class="fa fa-id-card-o" aria-hidden="true"></span>
                                            </button>
                                        </td>
                                    </tr>
                                <?endif;?>

                            <?endforeach;?>
                            </tbody>
                        </table>

                    </div>

                    <div class="tab-pane " id="ProjectSt45">


                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th></th>
                                <th>Домен</th>
                                <th>Статус</th>
                                <th>Размер</th>
                                <th>Название проекта</th>
                                <th>Дата добавления</th>
                                <th>Имя создателя</th>
                                <th>Куратор проекта</th>
                                <th>Адрес GitHub</th>
                                <th></th>
                            </tr>
                            </thead>

                            <tbody class="project_table">
                            <?foreach ($listProjects45 as $listProjects45):?>
                                <?if(($listProjects45["status_project"]==4 || $listProjects45["status_project"]==5)):?>
                                    <tr class="listProjects_<?=$listProjects45["id"]?>">
                                        <?if ($listProjects45["status_project"]==3||$listProjects45["status_project"]==4||$listProjects45["status_project"]==5):?>
                                            <td></td>
                                        <?else:?>
                                            <td class="deleteProject_<?=$listProjects45["id"]?>">
                                                <button title="Удалить" class='closeProject btn btn-default' delete_id="<?=$listProjects45["id"]?>">
                                                    <span class="fa fa-times" aria-hidden="true"></span>
                                                </button>
                                            </td>
                                        <?endif;?>

                                        <td><?=$listProjects45["subdomain"]?></td>
                                        <td class="status_project_<?=$listProjects45["id"]?>"><?=$listProjects45["status_project"]?></td>
                                        <td><?=$listProjects["files_size"]?></td>
                                        <td><?=$listProjects45["title"]?></td>
                                        <td><?=$listProjects45["date_add"]?></td>
                                        <td><?=$listProjects45["email_user"]." ".$listProjects45["group"]?></td>
                                        <td><?=$listProjects45["name_curator"]==null?"У данного проекта нет куратора":$listProjects45["name_curator"]?></td>
                                        <td><?=$listProjects45["git"]?></td>
                                        <td>
                                            <button title="Подробнее" class='detailProject btn btn-default' detailPr_id="<?=$listProjects45["id"]?>">
                                                <span class="fa fa-id-card-o" aria-hidden="true"></span>
                                            </button>
                                        </td>
                                    </tr>
                                <?endif;?>

                            <?endforeach;?>
                            </tbody>
                        </table>

                    </div>
                    <div class="tab-pane " id="ProjectSt6">


                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th></th>
                                <th>Домен</th>
                                <th>Статус</th>
                                <th>Размер</th>
                                <th>Название проекта</th>
                                <th>Дата добавления</th>
                                <th>Имя создателя</th>
                                <th>Куратор проекта</th>
                                <th>Адрес GitHub</th>
                                <th></th>
                            </tr>
                            </thead>

                            <tbody class="project_table">
                            <?foreach ($listProjects6 as $listProjects6):?>
                                <?if(($listProjects6["status_project"]==6)):?>
                                    <tr class="listProjects_<?=$listProjects6["id"]?>">
                                        <?if ($listProjects6["status_project"]==3||$listProjects6["status_project"]==4||$listProjects6["status_project"]==5):?>
                                            <td></td>
                                        <?else:?>
                                            <td class="deleteProject_<?=$listProjects6["id"]?>">
                                                <button title="Удалить" class='closeProject btn btn-default' delete_id="<?=$listProjects6["id"]?>">
                                                    <span class="fa fa-times" aria-hidden="true"></span>
                                                </button>
                                            </td>
                                        <?endif;?>

                                        <td><?=$listProjects6["subdomain"]?></td>
                                        <td class="status_project_<?=$listProjects6["id"]?>"><?=$listProjects6["status_project"]?></td>
                                        <td><?=$listProjects["files_size"]?></td>
                                        <td><?=$listProjects6["title"]?></td>
                                        <td><?=$listProjects6["date_add"]?></td>
                                        <td><?=$listProjects6["email_user"]." ".$listProjects6["group"]?></td>
                                        <td><?=$listProjects6["name_curator"]==null?"У данного проекта нет куратора":$listProjects6["name_curator"]?></td>
                                        <td><?=$listProjects6["git"]?></td>
                                        <td>
                                            <button title="Подробнее" class='detailProject btn btn-default' detailPr_id="<?=$listProjects6["id"]?>">
                                                <span class="fa fa-id-card-o" aria-hidden="true"></span>
                                            </button>
                                        </td>
                                    </tr>
                                <?endif;?>

                            <?endforeach;?>
                            </tbody>
                        </table>

                    </div>
                </div>

        </div>
        <div class="tab-pane" id="curator">
            <h2>Кураторы</h2>
            <table class="table table-striped">
                <thead>
                <tr>
                    <th></th>
                    <th>Имя</th>
                    <th>Статус</th>
                    <th>E-mail</th>
                    <th></th>
                </tr>
                </thead>

                <tbody class="curator_table">
                <?foreach ($listCurator as $listCurator):?>
                    <tr class="listCurator_<?=$listCurator["id"]?>">

                        <?if ($listCurator["status"]==0):?>
                            <td></td>
                        <?else:?>
                            <td class="deleteCurator_<?=$listCurator["id"]?>">
                                <button title="Удалить" class='closeCurator btn btn-default' delete_id="<?=$listCurator["id"]?>">
                                    <span class="fa fa-times" aria-hidden="true"></span>
                                </button>
                            </td>
                        <?endif;?>



                        <td id="name_curator_<?=$listCurator["id"]?>"><?=$listCurator["name_curator"]?></td>
                        <td class="status_curator_<?=$listCurator["id"]?>"><?=$listCurator["status"]?></td>
                        <td id="email_curator_<?=$listCurator["id"]?>"><?=$listCurator["email_curator"]?></td>
                        <td>
                            <button title="Редактировать" class='edit editCurator btn btn-default' edit_id="<?=$listCurator["id"]?>">
                                <span class="fa fa-gear"></span>
                            </button>
                        </td>
                    </tr>

                <?endforeach;?>

                </tbody>

            </table>
            <button title="Добавить" class='add addCurator btn btn-default' add_id="<?=$listCurator["id"]?>">
                <span class="fa fa-plus" aria-hidden="true"></span>
            </button>

            <div class="modal fade" id="m1" >
                <div class="modal-dialog" style="z-index: 1234" >
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title">Редактировать куратора</h4>
                        </div>
                        <form>
                            <div class="modal-body">
                                <input type="text" id="edit_id_curator" name="id_curator" value="" style="display: none"/>
                                Имя куратора<br>
                                <input type="text" id="edit_name_curator" name="name_curator" value=""/><br>
                                Статус куратора<br>
                                <p class="edit_status_curator">
                                    <input type="radio" name="status" value="1"> Активный!!!!<Br>
                                    <input type="radio" name="status" value="0"> Не активный<Br>
                                </p>

                                e-mail куратора<input type="text" id="edit_email_curator" name="email_curator" value=""/><br>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-primary" id="edit_button">Сохранить</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="m3" >
                <div class="modal-dialog" style="z-index: 1234" >
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title">Добавить куратора</h4>
                        </div>
                        <form>
                            <div class="modal-body">
                                <input type="text" id="add_id_curator" name="id_curator" value="" style="display: none"/>
                                Имя куратора<input type="text" id="add_name_curator" name="name_curator" value=""/><br>

                                Статус куратора<br>
                                <p id="add_status">
                                    <input type="radio" name="status" value="1"> Активный<Br>
                                    <input type="radio" name="status" value="0"> Не активный<Br>
                                </p>
                                e-mail куратора<input type="text" id="add_email_curator" name="email_curator" value=""/><br>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-primary" id="add_button">Сохранить</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
        <div class="tab-pane" id="user">
            <h2>Пользователи</h2>
            <table class="table table-striped">
                <thead>
                <tr>
                    <th></th>
                    <th>E-mail</th>

                    <th>Статус</th>
                    <th></th>
                </tr>
                </thead>

                <tbody class="user_table">
                <?foreach ($listUsers as $listUsers):?>
                    <tr class="listUsers_<?=$listUsers["id"]?>">

                            <td class="deleteUser_<?=$listUsers["id"]?>">
                                <button title="Удалить" class='closeUser btn btn-default' delete_id="<?=$listUsers["id"]?>">
                                    <span class="fa fa-times" aria-hidden="true"></span>
                                </button>
                            </td>

                        <td id="email_user_<?=$listUsers["id"]?>"><?=$listUsers["email_user"]?></td>

                        <td id="status_user_<?=$listUsers["id"]?>"><?=$listUsers["status_user"]?></td>
                        <td>
                            <button title="Редактировать" class='edit editUser btn btn-default' edit_id_user="<?=$listUsers["id"]?>">
                                <span class="fa fa-gear"></span>
                            </button>
                        </td>
                    </tr>
                <?endforeach;?>
                </tbody>
            </table>
            <div class="modal fade" id="m2" >
                <div class="modal-dialog" style="z-index: 1234" >
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title">Редактировать пользователя</h4>
                        </div>
                        <form>
                            <div class="modal-body">
                                <input type="text" id="edit_id_user" name="id_user" value="" style="display: none"/>
                                e-mail пользователя<input type="text" id="edit_email_user" name="email_user" value=""/><br>
<!--                                Пароль пользователя<input type="text" id="edit_password_user" name="password_user" value=""/><br>-->
                                Статус пользователя<input type="text" id="edit_status_user" name="status_user" value=""/><br>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-primary" id="edit_button_user">Сохранить</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-pane" id="release">
            <h2>Релизы</h2>
            <form>
                <select class="userRelease" name="userRelease">
                    <option value="0">Все домены</option>
                    <?foreach ($subRelease as $subRelease):?>
                        <option value="<?=$subRelease["id"]?>"><?=$subRelease["subdomain"]?></option>
                    <?endforeach;?>
                </select>
            </form>
            <form class="form-group">
                <div class="input-group date" id="datetimepicker2">
                    <input type="text" class="form-control" name="date_release"/>
                    <span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
                    </span>
                </div>
                <input type="button" id="add_date_release" value="Вывести релизы по дате"/>
            </form>

            <!-- Инициализация виджета "Bootstrap datetimepicker" -->

            <table class="table table-striped">
                <thead>
                <tr>
                    <th>Субдомен</th>
                    <th>Дата и время</th>
                    <th>Тип</th>
                    <th>Лог</th>
                </tr>
                </thead>

                <tbody class="release_table">
                <?foreach ($listRelease as $listRelease):?>
                    <tr class="listRelease_<?=$listRelease["id"]?>">
                        <td><?=$listRelease["subdomain"]?></td>
                        <td><?=$listRelease["date_time"]?></td>
                        <td><?=$listRelease["release_type"]?></td>
                        <td><?=$listRelease["log"]?></td>
                    </tr>
                <?endforeach;?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="modal fade" id="m-detailProject" >
    <div class="modal-dialog" style="z-index: 1234" >
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Детальная информация о проекте </h4>
<!--                --><?//=$detailProject["subdomain"]?>
            </div>
            <form>
                <div class="modal-body componDetailPr">

                </div>

            </form>
        </div>
    </div>
</div>
<?require_once ('footer.php');?>

