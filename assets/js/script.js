function open(FormOpen){

    document.querySelector(FormOpen).classList.remove("hidden");

}
function cancel(FormCancel) {

    document.querySelector(FormCancel).classList.add("hidden");

}
function addProjectUser(item) {

    if(item['status_project']==3||item['status_project']==4||item['status_project']==5)
    {
        str1='<td></td>';
    }
    else
    {
        str1='<td class="deleteProject_'+item['id']+'"><button title="Удалить" class="closeProject btn btn-default" delete_id="'+item['id']+'"> <span class="fa fa-times" aria-hidden="true"></span>       </button>        </td>';
    }
    if(item['name_curator']==null)
    {
        str2='У данного проекта нет куратора';
    }
    else
    {
        str2=item["name_curator"];
    }
    var str = 'tr class="listProjects_'+item['id']+'">'+str1+'<td>'+item["subdomain"]+'</td>        <td class="status_project_'+item['id']+'">'+item["status_project"]+'</td><td>'+item["files_size"]+'</td>        <td>'+item["title"]+'</td>        <td>'+item["date_add"]+'</td>        <td>'+item["email_user"]+'" "'+item["group"]+'</td><td>'+str2+'</td><td>'+item["git"]+'</td>   </tr>';

    $("#user_project").append(str);

}
function addRelease(item) {

    $(".release_table").append("<tr class='listRelease_"+ item["id"] +"'><td>"+ item["subdomain"] +"</td><td>"+ item["date_time"] +"</td><td>"+ item["release_type"] +"</td><td>"+ item["log"] +"</td></tr>");

}
function addCurator(item) {
    if(item['status_curator']==0)
    {
        str1='<td></td>';
    }
    else
    {
        str1="<td>    <button title='Удалить' class='closeCurator btn btn-default' delete_id='"+ item["id"] +"'>    <span class='fa fa-times' aria-hidden='true'></span>        </button>        </td>";
    }
    $(".curator_table").append("<tr class='listCurator_"+ item["id"] +"'>      "+str1+"      <td id='name_curator_"+ item["id"] +"'>"+ item["name_curator"] +"</td>    <td id='status_curator_"+ item["id"] +"'>"+ item["status"] +"</td>    <td id='email_curator_"+ item["id"] +"'>"+ item["email_curator"] +"</td>    <td>        <button title='Редактировать' class='edit editCurator btn btn-default' edit_id='"+ item["id"] +"'>    <span class='fa fa-gear'></span>        </button>        </td>               </tr>");
}
function editCurator(item) {

    $('#name_curator_'+item['id']).text(item['name_curator']);
    $('.status_curator_'+item['id']).text(item['status']);
    $('#email_curator_'+item['id']).text(item['email_curator']);
}
function editUser(item) {

    $('#email_user_'+item['id']).text(item['email_user']);
    //$('#password_user_'+item['id']).text(item['password_user']);
    $('#status_user_'+item['id']).text(item['status_user']);
}


$('.userProjects').change(  function(){

    if(this.form.userProjects.value==0)
    {
        $("#user_project").html("");
        return false;
    }
    var itemData = {
        id: this.form.userProjects.value
    };
    $.ajax({
        url: '/admin/userProject',
        type : 'POST',
        dataType:'json',
        data : itemData,
        success: function (data) {
            if(data!=undefined&&data.length>0)
            {
                $("#user_project").html("");
                for(var i = 0 ; i<data.length;i++)
                {
                    addProjectUser(data[i]);
                }
            }
            else
            {
                $("#user_project").html("");
            }
        }
    });

});
$('.userRelease').change(  function(){

    var itemData = {
        id: this.form.userRelease.value
    };

    $.ajax({
        url: '/admin/userRelease',
        type : 'POST',
        dataType:'json',
        data : itemData,
        success: function (data) {
            if(data!=undefined&&data.length>0)
            {
                $(".release_table").html("");
                for(var i = 0 ; i<data.length;i++)
                {
                    addRelease(data[i]);
                }
            }
            else
            {
                $(".release_table").html("");
                // $.ajax({
                //     url: '/admin/listReleateMain',
                //     type : 'POST',
                //     dataType:'json',
                //     data : itemData,
                //     success: function (data) {
                //         $(".release_table").html("");
                //         for(var i = 0 ; i<data.length;i++)
                //         {
                //             addRelease(data[i]);
                //         }
                //     }
                // });
            }
        }
    });

});


$('#add_date_release').click(  function(){

    var itemData = {
        date: this.form.date_release.value
    };
    $.ajax({
        url: '/admin/dateRelease',
        type : 'POST',
        dataType:'json',
        data : itemData,
        success: function (data) {
            $(".release_table").html("");
            for(var i = 0 ; i<data.length;i++)
            {
                addRelease(data[i]);
            }
        }
    });


});


$('.project_table').on('click', '.closeProject', function(){
    if(!confirm("Вы уверены что хотите удалить проект?"))
    {
        return false;
    }
    var itemData = {
        id: $(this).attr('delete_id')
    };
    $.ajax({
        url: 'admin/deleteProject',
        type : 'POST',
        dataType:'json',
        data : itemData,
        success: function (data) {
            $('.status_project_'+data[0]['id']).text(data[0]['status_project']);
            $('.deleteProject_'+data[0]['id']).text("");
        }
    });
});
$('.curator_table').on('click', '.closeCurator', function(){
    if(!confirm("Вы уверены что хотите удалить куратора?"))
    {
        return false;
    }
    var itemData = {
        id: $(this).attr('delete_id')
    };
    console.log(itemData);
    $.ajax({
        url: 'admin/deleteCurator',
        type : 'POST',
        dataType:'json',
        data : itemData,
        success: function (data) {
            console.log('.status_curator_'+data[0]['id']);
            console.log(data[0]['status']);
            $('.status_curator_'+data[0]['id']).text(data[0]['status']);
            $('.deleteCurator_'+data[0]['id']).text("");
        }
    });
});



$('.addCurator').click(function(){
    $('#m3').modal('show');
});

$('#add_button').click(function(){
    var itemData = {
        id: this.form.id_curator.value,
        name: this.form.name_curator.value,
        status: this.form.status.value,
        email: this.form.email_curator.value
    };
    $.ajax({
        url: 'admin/addCurator',
        type : 'POST',
        dataType:'json',
        data : itemData,
        success: function (data) {
            $('#m3').modal('hide');
            $lengthCurator = data.length - 1;
            addCurator(data[$lengthCurator]);

        }
    });
});
$('.curator_table').on('click', '.editCurator', function(){

    $('#m1').modal('show');
    var edit_id_temp = $(this).attr('edit_id');
    $('#edit_id_curator').val(edit_id_temp);
    $('#edit_name_curator').val($('#name_curator_'+edit_id_temp).text());
    $('.status_curator').val($('.status_curator_'+edit_id_temp).text());
    $('#edit_email_curator').val($('#email_curator_'+edit_id_temp).text());
});
$('#edit_button').click(function () {

    var itemData = {
        id: this.form.id_curator.value,
        name: this.form.name_curator.value,
        status: this.form.status.value,
        email: this.form.email_curator.value
    };
    $.ajax({
        url: 'admin/editCurator',
        type : 'POST',
        dataType:'json',
        data : itemData,
        success: function (data) {

            $('#m1').modal('hide');

            for(var i = 0 ; i<data.length;i++)
            {
                editCurator(data[i]);
            }
        }
    });
});

$('.editUser').click(function(){
    $('#m2').modal('show');
    var edit_id_temp = $(this).attr('edit_id_user');
    $('#edit_id_user').val(edit_id_temp);
    $('#edit_email_user').val($('#email_user_'+edit_id_temp).text());
    //$('#edit_password_user').val($('#password_user_'+edit_id_temp).text());
    $('#edit_status_user').val($('#status_user_'+edit_id_temp).text());
});

$('#edit_button_user').click(function () {

    var itemData = {
        id: this.form.id_user.value,
        email: this.form.email_user.value,
      //  password: this.form.password_user.value,
        status: this.form.status_user.value
    };
    $.ajax({
        url: 'admin/editUser',
        type : 'POST',
        dataType:'json',
        data : itemData,
        success: function (data) {
            $('#m2').modal('hide');
            for(var i = 0 ; i<data.length;i++)
            {
                editUser(data[i]);
            }
        }
    });
});

$('.user_table').on('click', '.closeUser', function(){
    if(!confirm("Вы уверены что хотите удалить пользователя?"))
    {
        return false;
    }
    var deleteID = $(this).attr('delete_id');
    var itemData = {
        id: deleteID
    };
    $.ajax({
        url: 'admin/deleteUser',
        type : 'POST',
        data : itemData,
        success: function (data) {
            $('.listUsers_'+deleteID).remove();
        }
    });
});
$('.detailProject').click(function () {
    $('#m-detailProject').modal('show');
    var itemData = {
        id: $(this).attr('detailPr_id')
    };
    $.ajax({
        url: 'admin/detailProject',
        type : 'POST',
        dataType:'json',
        data : itemData,
        success: function (data) {
           // $(".componDetailPr").append('<div class="row">            <div class="col-xs-6">Домен</div>                <div class="col-xs-6">'+date['subdomain']+'</div>            </div><br>            <div class="row">                <div class="col-xs-6">Название проекта</div>            <div class="col-xs-6">'+date['name']+'</div>            </div><br>            <div class="row">                <div class="col-xs-6">Дата добавления</div>            <div class="col-xs-6">'+date['date_add']+'</div>            </div><br>            <div class="row">                <div class="col-xs-6">Дата изменения</div>            <div class="col-xs-6">'+date['date_check']+'</div>            </div><br>            <div class="row">                <div class="col-xs-6">GitHub</div>                <div class="col-xs-6">'+date['git']+'</div>            </div><br>            <div class="row">                <div class="col-xs-6">Пользователь</div>                <div class="col-xs-6">'+date['email_user']+' '+ date['group']+'</div>            </div><br>            <div class="row">                <div class="col-xs-6">Статус</div>                <div class="col-xs-6">'+date['status_project']+'</div>            </div><br>            <div class="row">                <div class="col-xs-6">Куратор</div>                <div class="col-xs-6">'+date['name_curator']+'</div>            </div><br>            <div class="row">                <div class="col-xs-6">Логи</div>                <div class="col-xs-12">                </div>                </div><br>');

        }
    });
});

