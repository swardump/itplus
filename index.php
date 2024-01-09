<?php
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="./css/main.css">
        <script src="./libs/jquery-3.7.1.min.js"></script>
        <script src="./js/main.js"></script>
        <title>IT Plus</title>
    </head>
    <body>
        <div id="content">
            <div id="damageList">
                <h4>Список повреждений</h4>
                <div id="createNode">
                    <form action="createNode" method="post">
                        <label for="nameBranch">Наименование филиала</label>
                        <select name="nameBranch" id="nameBranch" onchange="getNode();"></select>                  
                        
                        <label for="nameNode">Наименование теплового узла</label>
                        <select name="nameNode" id="nameNode"></select>

                        <label for="countDamage">Величина утечки, т/ч</label>
                        <input type="text" name="countDamage" id="countDamage"/>
                        <input type="button" id="createBtn" value="Добавить">
                    </form>
                </div>
                <div id="updateNode">
                    <form action="upadteNode" method="post">
                        <label for="updNameBranch">Наименование филиала</label>
                        <select name="updNameBranch" id="updNameBranch" onchange="getUpdNode();"></select>                  
                        
                        <label for="updNameNode">Наименование теплового узла</label>
                        <select name="updNameNode" id="updNameNode"></select>

                        <label for="updCountDamage">Величина утечки, т/ч</label>
                        <input type="text" name="updCountDamage" id="updCountDamage"/>
                        <input type="button" id="editBtn" value="Изменить">
                        <input type="button" id="cancelBtn" value="Отменить">
                        <input type="hidden" name="changedId" id="changedId" value="">
                    </form>
                </div>

                <hr>
                
                <table id="mainTable">
                    <thead>
                        <tr>
                            <th>Наименование филиала</th>
                            <th>Наименование теплового узла</th>
                            <th>Время регистрации повреждения</th>
                            <th>Величина утечки, <br>т/ч</th>
                            <th>Ред </th>
                        </tr>
                        <tbody></tbody>
                    </thead>
                </table>

                <hr>
                
                <h4>SQL test1</h4>
                <table id="test1">
                    <thead>
                        <tr>
                            <th>id</th>
                            <th>dt</th>
                            <th>group_id</th>
                        </tr>
                        <tbody></tbody>
                    </thead>
                </table>


                <hr>

                <h4>SQL test2</h4>
                <table id="test2">
                    <thead>
                        <tr>
                            <th>id</th>
                            <th>dt</th>
                            <th>group_id</th>
                        </tr>
                        <tbody></tbody>
                    </thead>
                </table>
            </div>
        </div>
    </body>
</html>