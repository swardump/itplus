$(function(){
    getBranch();
    getDamageList();
    getData1();
    getData2();
    $('#createBtn').on('click', createNode);
    $('#cancelBtn').on('click', cancel);
    $('#editBtn').on('click', updateNode);

    
    $(document).on('click','.delBtn', function(){
        $.ajax({
            url: '../api/deleteNode.php',
            method: 'POST',
            dataType: 'JSON',
            data: {
                id: $(this).attr('rowId'),
            },
            statusCode: {
                200: function() {
                    getDamageList();
                }
            }
        });
    });

    $(document).on('click','.updBtn', function() {
        var rowId = $(this).attr('rowId');
        var oldNameBranch = $('#tr_'+rowId).find("td").eq(0).html();
        var oldNameNode = $('#tr_'+rowId).find("td").eq(1).html();;
        var oldCountDamage = $('#tr_'+rowId).find("td").eq(3).html();

        $('#changedId').val(rowId);
        $('#updCountDamage').val(oldCountDamage);
        $('#createNode').hide();
        $('#updateNode').show();
        getUpdBranch(oldNameBranch);
        getUpdNode(oldNameNode);
    });
});

function getData1(){
    $.ajax({
        url: '../api/getData1.php',
        method: 'GET',
        dataType: 'JSON',
        success: function(response) {
           console.log(JSON.stringify(response));
           $('#test1 tbody').empty();
            $.each(response, function(i, item) {
                $('#test1 tbody').append("<tr class='rowTable'><td>"+item.id+"</td><td>"+item.dt+"</td><td>"+item.group_id+"</td></tr>")
            })
        }
    })
}

function getData2(){
    $.ajax({
        url: '../api/getData2.php',
        method: 'GET',
        dataType: 'JSON',
        success: function(response) {
            console.log(JSON.stringify(response));
            $('#test2 tbody').empty();
            $.each(response, function(i, item) {
                $('#test2 tbody').append("<tr class='rowTable'><td>"+item.id+"</td><td>"+item.dt+"</td><td>"+item.group_id+"</td></tr>")
            })
        }
    })
}

function getNode() {
    $.ajax({
        url: '../api/getNode.php',
        method: 'GET',
        dataType: 'JSON',
        data: {
            id_branch: $('#nameBranch').val(),
        },
        success: function(response) {
                $('#nameNode').empty();
                $.each(response, function(i, item) {
                    $('#nameNode').append("<option value="+item.id+">"+item.nameNode+"</option>");
                });
        }
    })
}

function getUpdNode(nameNode = null) {
    $.ajax({
        url: '../api/getNode.php',
        method: 'GET',
        dataType: 'JSON',
        data: {
            id_branch: $('#updNameBranch').val(),
        },
        success: function(response) {
            $('#updNameNode').empty();
            $.each(response, function(i, item) {
                $('#updNameNode').append("<option value="+item.id+" "+(nameNode === item.nameNode ? 'selected' : '')+">"+item.nameNode+"</option>");
            });
        }
    })
}

function getBranch() {
    $.ajax({
        url: '../api/getBranch.php',
        method: 'GET',
        dataType: 'JSON',
        success: function(response) {
            $('#nameBranch').empty();
            $.each(response, function(i, item) {
                $('#nameBranch').append("<option value="+item.id+">"+item.nameBranch+"</option>");
            });
            getNode();  
        }
    })
}

function getUpdBranch(nameBranch = null) {
    $.ajax({
        url: '../api/getBranch.php',
        method: 'GET',
        dataType: 'JSON',
        success: function(response) {
            $('#updNameBranch').empty();
            $.each(response, function(i, item) {
                $('#updNameBranch').append("<option value="+item.id+" "+(nameBranch === item.nameBranch ? 'selected' : '')+">"+item.nameBranch+"</option>");
            })
            getUpdNode();
        }
    })
}

function getDamageList() {
    $.ajax({
        url: '../api/getDamageList.php',
        method: 'GET',
        dataType: 'JSON',
        success: function(response) {
            $('#mainTable tbody').empty();
            $.each(response, function(i, item) {
                $('#mainTable tbody').append("<tr id='tr_"+item.id+"' class='rowTable'><td>"+item.nameBranch+"</td><td>"+item.nameNode+"</td><td>"+item.timeDamage+"</td><td>"+item.countDamage+"</td><td><input type='button' class='delBtn' rowId="+item.id+" value='Удалить'><br><input type='button' class='updBtn' rowId="+item.id+" value='Изменить'></td></tr>")
            })
        }
    })
}

function createNode() {
    $.ajax({
        url: '../api/createNode.php',
        method: 'POST',
        dataType: 'JSON',
        data: {
            nameBranch: $('#nameBranch').val(),
            nameNode: $('#nameNode').val(),
            countDamage: $('#countDamage').val(),
        },
        statusCode: {
                200: function() {
                    getDamageList();
                }
        }
    });
}

function updateNode() {
    $.ajax({
        url: '../api/updateNode.php',
        method: 'POST',
        dataType: 'JSON',
        data: {
            id: $('#changedId').val(),
            nameBranch: $('#updNameBranch').val(),
            nameNode: $('#updNameNode').val(),
            countDamage: $('#updCountDamage').val(),
        },
        statusCode: {
            200: function() {
                cancel();
                getDamageList();
            }
        }
    });
}

function cancel() {
    $('#updCountDamage').val();
    $('#changedId').val();
    $('#updNameNode').empty();
    $('#updNameBranch').empty();
    $('#createNode').show();
    $('#updateNode').hide();
}